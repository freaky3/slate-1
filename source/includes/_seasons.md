# Seasons

Parameter | Type | Description
--------- | ------- | -----------
season_id | integer | Unique identifier for the resource. `[read-only]`
name | string | Name of season.
datemodified | date-time | date and time of last modification `[read-only]`

## Get All Seasons

```php

$ch = curl_init('https://api.onlinefact.be/seasons/');
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
curl "https://api.onlinefact.be/seasons/" \
  -X GET \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
```

> The above command returns JSON structured like this:

```json
[
   {
      "season_id":"1",
      "name":"Summer",
      "datemodified":"2022-10-25 11:47:14"
   },
   {
      "season_id":"2",
      "name":"Winter",
      "datemodified":"2022-10-25 11:47:15"
   }
]
```

This endpoint retrieves all seasons.

### HTTPS Request

`GET https://api.onlinefact.be/seasons/`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | 100 | limit results (max 1000).
page | 1 | page number of result.


## Get a Specific Season

```php

$ch = curl_init('https://api.onlinefact.be/seasons/2/');
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
curl "https://api.onlinefact.be/seasons/2/" \
  -X GET \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
```

> The above command returns JSON structured like this:

```json
{
    "season_id":"2",
    "name":"Winter",
    "datemodified":"2022-10-25 11:47:14"
}
```

This endpoint retrieves a specific season.

### HTTPS Request

`GET https://api.onlinefact.be/seasons/<ID>`

### URL Parameters

Parameter | Description
--------- | -----------
ID | The ID of the season to retrieve


## Add a Season

```php

$data_string = '{
                  "name":"Spring"
                }'; //JSON String

$ch = curl_init("https://api.onlinefact.be/seasons/");
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
curl "https://api.onlinefact.be/seasons/" \
  -X POST \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
  -d '{
        "name":"Spring"
      }'
```

> The above command returns JSON structured like this:

```json
{
    "season_id":"3",
    "name":"Spring",
    "datemodified":"2022-10-25 11:47:14"
}
```

This endpoint adds a season.

### HTTPS Request

`POST https://api.onlinefact.be/seasons/`

### Parameters

Parameter | Description
--------- | -----------
name | name of the season


## Update a Season

```php

$data_string = '{
                  "name":"Autumn"
                }'; //JSON String

$ch = curl_init("https://api.onlinefact.be/seasons/3/");
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
curl "https://api.onlinefact.be/seasons/3/" \
  -X PUT \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
  -d '{
        "name":"Autumn"
      }'
```

> The above command returns JSON structured like this:

```json
{
    "season_id":"3",
    "name":"Autumn",
    "datemodified":"2022-10-25 11:47:14"
}
```

This endpoint updates a specific season.

### HTTPS Request

`PUT https://api.onlinefact.be/seasons/<ID>`

### URL Parameters

Parameter | Description
--------- | -----------
ID | The ID of the season to update


## Delete a Season

```php
$ch = curl_init("https://api.onlinefact.be/seasons/3/");
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
curl "https://api.onlinefact.be/seasons/3/" \
  -X DELETE \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
```

> The above command returns JSON structured like this:

```json
{
  "season_id": "3",
  "deleted": 1
}
```

This endpoint deletes a specific season.

### HTTPS Request

`DELETE https://api.onlinefact.be/seasons/<ID>`

### URL Parameters

Parameter | Description
--------- | -----------
ID | The ID of the season to delete
