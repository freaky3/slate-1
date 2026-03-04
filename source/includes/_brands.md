# Brands

Parameter | Type | Description
--------- | ------- | -----------
brand_id | integer | Unique identifier for the resource. `[read-only]`
name | string | Name of brand.
datemodified | date-time | date and time of last modification `[read-only]`

## Get All Brands

```php

$ch = curl_init('https://api.onlinefact.be/brands/');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "api_key_here:api_secret_here");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

print_r($result);
```

```shell
curl "https://api.onlinefact.be/brands/" \
  -X GET \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
```

> The above command returns JSON structured like this:

```json
[
   {
      "brand_id":"2",
      "name":"Adidas",
      "datemodified":"2022-10-25 11:47:14"
   },
   {
      "brand_id":"3",
      "name":"Coca Cola",
      "datemodified":"2022-10-25 11:47:15"
   },
   {
      "brand_id":"4",
      "name":"Levis",
      "datemodified":"2022-10-25 11:47:15"
   }
]
```

This endpoint retrieves all brands.

### HTTPS Request

`GET https://api.onlinefact.be/brands/`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | 100 | limit results (max 1000).
page | 1 | page number of result.


## Get a Specific Brand

```php

$ch = curl_init('https://api.onlinefact.be/brands/3/');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "api_key_here:api_secret_here");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

print_r($result);
```

```shell
curl "https://api.onlinefact.be/brands/3/" \
  -X GET \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
```

> The above command returns JSON structured like this:

```json
{
    "brand_id":"3",
    "name":"Coca Cola",
    "datemodified":"2022-10-25 11:47:14"
}
```

This endpoint retrieves a specific brand.

### HTTPS Request

`GET https://api.onlinefact.be/brands/<ID>`

### URL Parameters

Parameter | Description
--------- | -----------
ID | The ID of the brand to retrieve


## Add a Brand

```php

$data_string = '{
                  "name":"Samsung"
                }'; //JSON String

$ch = curl_init("https://api.onlinefact.be/brands/");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "api_key_here:api_secret_here");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

print_r($result);
```

```shell
curl "https://api.onlinefact.be/brands/" \
  -X POST \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
  -d '{
        "name":"Samsung"
      }'
```

> The above command returns JSON structured like this:

```json
{
    "brand_id":"75",
    "name":"Samsung",
    "datemodified":"2022-10-25 11:47:14"
}
```

This endpoint add a brand.

### HTTPS Request

`POST https://api.onlinefact.be/brands/`

### URL Parameters

Parameter | Description
--------- | -----------
name | name of the brand


## Update a brand

```php

$data_string = '{
                  "name":"Apple"
                }'; //JSON String

$ch = curl_init("https://api.onlinefact.be/brands/76/");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "api_key_here:api_secret_here");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

print_r($result);
```

```shell
curl "https://api.onlinefact.be/brands/76/" \
  -X PUT \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
  -d '{
        "name":"Apple",
      }'
```

> The above command returns JSON structured like this:

```json
{
    "brand_id":"76",
    "name":"Apple",
    "datemodified":"2022-10-25 11:47:14"
}
```

This endpoint updates a specific brand.

### HTTPS Request

`PUT https://api.onlinefact.be/brands/<ID>`

### URL Parameters

Parameter | Description
--------- | -----------
ID | The ID of the brand to update


## Delete a Brand

```php
$ch = curl_init("https://api.onlinefact.be/brands/76/");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "api_key_here:api_secret_here");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

print_r($result);
```

```shell
curl "https://api.onlinefact.be/brands/76/" \
  -X DELETE \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
```


> The above command returns JSON structured like this:

```json
{
  "brand_id": "76",
  "deleted" : "success",
  "datemodified":"2022-10-25 11:47:14"
}
```

This endpoint deletes a specific brand.

### HTTPS Request

`DELETE https://api.onlinefact.be/brands/<ID>`

### URL Parameters

Parameter | Description
--------- | -----------
ID | The ID of the brand to delete
