---
title: API Reference

language_tabs: # must be one of https://git.io/vQNgJ
  - php
  - shell

toc_footers:
  - <a href='https://github.com/slatedocs/slate'>Documentation Powered by Slate</a>

includes:
  - products
  - categories
  - brands
  - seasons
  - customers
  - vouchers
  - documents
  - payments
  - reports
  - reports-saletotals
  - reports-salesperproduct
  - reports-salesperrelation
  - reports-documents
  - errors


search: true

code_clipboard: true

meta:
  - name: description
    content: Documentation for the Onlinefact API
---

# Introduction

Welcome to the Onlinefact API! You can use our API to access Onlinefa t API endpoints, which can get information on products, customers or other information in the database.

We have language bindings in PHP and Curl! You can view code examples in the dark area to the right, and you can switch the programming language of the examples with the tabs in the top right.

# Authentication

> To authorize, use this code:

```php
$api_key = "api_key_here";
$api_secret = "api_secret_here";
$endpoint = "api_endpoint_here";
$query_parameters = "?limit=10&page=2";

$ch = curl_init('https://api.onlinefact.be/'.$endpoint.$query_parameters);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $api_key.":".$api_secret);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

print_r($result);
```

```shell
# With shell, you can just pass the correct header with each request
curl "https://api.onlinefact.be/api_endpoint_here" \
  -u "api_key_here:api_secret_here"
```

The Onlinefact API uses basic authentication. You can create the API key and secret via the Onlinefact Portal (https://admin.onlinefact.be)

In the portal you go to the menu 'configuration' -> 'settings' -> tab 'API'

<aside class="notice">
When you create a new API key and secret you have to write down the API secret because it will be invisible when you leave the screen.
</aside>



