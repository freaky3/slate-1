# Apache transparante docs-proxy

Deze map bevat een transparante PHP reverse proxy voor:

- `https://freaky3.github.io/API-Documents/`

Doel: dezelfde documentatie tonen onder je eigen host, inclusief querystrings (`?language=...`) en client-side hash navigatie (`#payments`).

## Bestanden

- `index.php`: proxy entrypoint
- `.htaccess`: Apache rewrite naar `index.php`

## Vereisten

- Apache met `mod_rewrite` en `AllowOverride` actief voor deze map
- PHP 8+ (of minimaal PHP 7.4 met `str_starts_with` vervanging)
- cURL extensie aanbevolen (`curl`), fallback via `file_get_contents` is aanwezig
- Uitgaande HTTPS connectie naar `freaky3.github.io` toegestaan

## Installatie

1. Plaats deze map als `/proxy` onder je webroot.
2. Zorg dat `.htaccess` wordt ingelezen (`AllowOverride All` of minstens `FileInfo`).
3. Open in browser:
   - `https://jouwdomein/proxy/`

## Gedrag

- Alle paden onder `/proxy/` worden doorgestuurd naar `/API-Documents/...` op `freaky3.github.io`.
- Querystrings worden ongewijzigd doorgestuurd.
- Redirect `Location` headers worden herschreven naar het lokale `/proxy/...` pad.
- Response headers zoals `Content-Type`, `Cache-Control`, `ETag`, `Last-Modified` worden doorgezet.

## Bekende beperking

- URL-fragmenten (`#...`) worden nooit naar de server gestuurd (browser-only gedrag).
- Dit is normaal; hash links blijven werken zolang de pagina en assets correct laden onder `/proxy/`.
