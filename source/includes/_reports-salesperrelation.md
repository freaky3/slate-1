## Sales per relation

```php

$ch = curl_init('https://api.onlinefact.be/reports/salesperrelation/?min_date=2022-07-27&max_date=2022-07-28');
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
curl "https://api.onlinefact.be/reports/salesperrelation/?min_date=2022-07-27&max_date=2022-07-28" \
  -X GET \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
```

> The above command returns JSON structured like this:

```json
[
   {
      "customer_id":186,
      "customer_reference":"118464",
      "taxnr":"",
      "name":"Kristof Moons",
      "name2":"",
      "address":"Schootstraat 191",
      "address2":"",
      "zip":"3550",
      "city":"Heusden-Zolder",
      "country_id":21,
      "country":"Belgium",
      "mobile":"",
      "phone":"",
      "email":"kristof@onlinefact.be",
      "type":"Customer",
      "birthdate":"",
      "product_id":8039,
      "product_reference":"P8039.S",
      "product_reference2":"",
      "barcode":"1584796623647",
      "description":"Bloemenkleed",
      "category":"",
      "subcategory":"",
      "brand":"",
      "supplier":"",
      "stock":5,
      "sum_qty":1,
      "average_price_excl":41.321,
      "average_price_incl":43.8,
      "total_price_excl":41.32,
      "total_price_incl":43.8
   },
   {
      "customer_id":197,
      "customer_reference":"K197",
      "taxnr":"BE012456789",
      "name":"Vanessa Cristiano",
      "name2":null,
      "address":"Schootstraat 191",
      "address2":null,
      "zip":"3550",
      "city":"Heusden-Zolder",
      "country_id":21,
      "country":"Belgium",
      "mobile":"0472123456",
      "phone":"011743319",
      "email":"info@onlinefact.be",
      "type":"Customer",
      "birthdate":"",
      "product_id":8025,
      "product_reference":"KAA25LAV",
      "product_reference2":"",
      "barcode":"1972141885855",
      "description":"Geurkaars 25cm Lavendel",
      "category":null,
      "subcategory":"",
      "brand":"",
      "supplier":"SPAAS",
      "stock":5,
      "sum_qty":20,
      "average_price_excl":8.223,
      "average_price_incl":9.95,
      "total_price_excl":164.46,
      "total_price_incl":199
   }
]
```

This endpoint retrieves the total products sold in a period to a specific relation.

### HTTPS Request

`GET https://api.onlinefact.be/reports/salesperrelation/`

### Query Parameters

Parameter | Type | Description
--------- | ------- | -----------
min_date | date | Return sales for a specific start date, the date need to be in the YYYY-MM-DD format `[mandatory]`
max_date | date | Return sales until specific end date, the date need to be in the YYYY-MM-DD format `[mandatory]`
document_type | integer |1 = offer, 2 = client order, 3 = invoice, 4 = creditnote, 5 = deliverynote, 8 = ticket
opendocuments | integer | 0 = all documents, 1 = only from open documents
filter | string | Filter result with string data *(relation reference/name, product reference/name, supplier, category name)*

### Result Parameters

Parameter | Type | Description
--------- | ------- | -----------

