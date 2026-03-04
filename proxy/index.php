<?php
declare(strict_types=1);

$upstreamBase = 'https://freaky3.github.io/API-Documents';
$upstreamBasePath = '/API-Documents';
$allowedMethods = ['GET', 'HEAD'];

$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
if (!in_array($method, $allowedMethods, true)) {
    http_response_code(405);
    header('Allow: GET, HEAD');
    header('Content-Type: text/plain; charset=UTF-8');
    echo "Method not allowed\n";
    exit;
}

$scriptName = $_SERVER['SCRIPT_NAME'] ?? '/proxy/index.php';
$proxyBasePath = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
if ($proxyBasePath === '') {
    $proxyBasePath = '/';
}

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestPath = parse_url($requestUri, PHP_URL_PATH);
if (!is_string($requestPath) || $requestPath === '') {
    $requestPath = '/';
}

$forwardPath = $requestPath;
if ($proxyBasePath !== '/' && startsWith($forwardPath, $proxyBasePath . '/')) {
    $forwardPath = substr($forwardPath, strlen($proxyBasePath));
} elseif ($proxyBasePath !== '/' && $forwardPath === $proxyBasePath) {
    $forwardPath = '/';
}

if ($forwardPath === '') {
    $forwardPath = '/';
}
if (!startsWith($forwardPath, '/')) {
    $forwardPath = '/' . $forwardPath;
}

$queryString = $_SERVER['QUERY_STRING'] ?? '';
$targetUrl = rtrim($upstreamBase, '/') . $forwardPath;
if ($queryString !== '') {
    $targetUrl .= '?' . $queryString;
}

$response = fetchUpstream($targetUrl, $method);
if ($response === null) {
    http_response_code(502);
    header('Content-Type: text/plain; charset=UTF-8');
    echo "Bad gateway: unable to fetch upstream\n";
    exit;
}

http_response_code($response['status']);
forwardHeaders(
    $response['headers'],
    $proxyBasePath,
    rtrim($upstreamBase, '/'),
    $upstreamBasePath
);

if ($method !== 'HEAD') {
    echo $response['body'];
}

function fetchUpstream(string $targetUrl, string $method): ?array
{
    if (!function_exists('curl_init')) {
        return fetchUpstreamWithStreams($targetUrl, $method);
    }

    $ch = curl_init($targetUrl);
    if ($ch === false) {
        return null;
    }

    curl_setopt_array($ch, [
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_ENCODING => '',
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTPHEADER => buildForwardRequestHeaders(),
        CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'] ?? 'SlateProxy/1.0',
    ]);

    $raw = curl_exec($ch);
    if ($raw === false) {
        curl_close($ch);
        return null;
    }

    $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    $headerSize = (int) curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    curl_close($ch);

    $rawHeaders = substr($raw, 0, $headerSize);
    $body = substr($raw, $headerSize);

    return [
        'status' => $status > 0 ? $status : 502,
        'headers' => explode("\r\n", trim((string) $rawHeaders)),
        'body' => $body === false ? '' : $body,
    ];
}

function fetchUpstreamWithStreams(string $targetUrl, string $method): ?array
{
    $headers = buildForwardRequestHeaders();
    $context = stream_context_create([
        'http' => [
            'method' => $method,
            'ignore_errors' => true,
            'header' => implode("\r\n", $headers),
            'timeout' => 30,
        ],
    ]);

    $body = @file_get_contents($targetUrl, false, $context);
    $meta = $http_response_header ?? [];

    if ($body === false && $meta === []) {
        return null;
    }

    $status = 502;
    if (isset($meta[0]) && preg_match('/\s(\d{3})\s/', $meta[0], $m) === 1) {
        $status = (int) $m[1];
    }

    return [
        'status' => $status,
        'headers' => $meta,
        'body' => $body === false ? '' : $body,
    ];
}

function buildForwardRequestHeaders(): array
{
    $forward = [];
    $copyable = [
        'HTTP_ACCEPT' => 'Accept',
        'HTTP_ACCEPT_LANGUAGE' => 'Accept-Language',
        'HTTP_CACHE_CONTROL' => 'Cache-Control',
        'HTTP_IF_NONE_MATCH' => 'If-None-Match',
        'HTTP_IF_MODIFIED_SINCE' => 'If-Modified-Since',
    ];

    foreach ($copyable as $serverKey => $headerName) {
        if (!empty($_SERVER[$serverKey])) {
            $forward[] = $headerName . ': ' . $_SERVER[$serverKey];
        }
    }

    $forward[] = 'Connection: close';
    return $forward;
}

function forwardHeaders(array $headers, string $proxyBasePath, string $upstreamBase, string $upstreamBasePath): void
{
    $blocked = [
        'connection',
        'keep-alive',
        'proxy-authenticate',
        'proxy-authorization',
        'te',
        'trailer',
        'transfer-encoding',
        'upgrade',
        'content-length',
        'content-encoding',
    ];

    foreach ($headers as $line) {
        if ($line === '' || startsWith($line, 'HTTP/')) {
            continue;
        }

        $parts = explode(':', $line, 2);
        if (count($parts) !== 2) {
            continue;
        }

        $name = trim($parts[0]);
        $value = trim($parts[1]);
        if ($name === '') {
            continue;
        }

        $lower = strtolower($name);
        if (in_array($lower, $blocked, true)) {
            continue;
        }

        if ($lower === 'location') {
            $value = rewriteLocationHeader($value, $proxyBasePath, $upstreamBase, $upstreamBasePath);
        }

        if ($value !== '') {
            header($name . ': ' . $value, false);
        }
    }
}

function rewriteLocationHeader(string $location, string $proxyBasePath, string $upstreamBase, string $upstreamBasePath): string
{
    $trimmedProxyBase = rtrim($proxyBasePath, '/');
    if ($trimmedProxyBase === '') {
        $trimmedProxyBase = '/';
    }

    $normalizedUpstream = rtrim($upstreamBase, '/');
    if (startsWith($location, $normalizedUpstream . '/')) {
        $relative = substr($location, strlen($normalizedUpstream));
        return ($trimmedProxyBase === '/' ? '' : $trimmedProxyBase) . $relative;
    }
    if ($location === $normalizedUpstream) {
        return ($trimmedProxyBase === '/' ? '/' : $trimmedProxyBase . '/');
    }

    if (startsWith($location, $upstreamBasePath . '/')) {
        $relative = substr($location, strlen($upstreamBasePath));
        return ($trimmedProxyBase === '/' ? '' : $trimmedProxyBase) . $relative;
    }
    if ($location === $upstreamBasePath) {
        return ($trimmedProxyBase === '/' ? '/' : $trimmedProxyBase . '/');
    }

    if (startsWith($location, '/')) {
        return ($trimmedProxyBase === '/' ? '' : $trimmedProxyBase) . $location;
    }

    return $location;
}

function startsWith(string $haystack, string $needle): bool
{
    if ($needle === '') {
        return true;
    }
    return substr($haystack, 0, strlen($needle)) === $needle;
}
