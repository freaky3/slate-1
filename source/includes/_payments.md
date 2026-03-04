# Payments

Parameter | Type | Description
--------- | ------- | -----------
payment_id | integer | Unique identifier for the payment. `[read-only]`
type | integer | ID of payment method.
method | string | Name of payment method.
amount | decimal | Payment amount.
date | date | Date of payment (`YYYY-MM-DD`).
comment | string | Comment of payment.
zreport_id | integer | Z-report id when linked (`0` when not linked). `[read-only]`
documents | object | Linked documents for this payment. Key is the document id.

**Payments - types**

Type ID | Payment method
--------- | -----------
1 | Not payd
2 | Cash
3 | Banktransfer
4 | Creditcard
5 | Cheque
6 | Bancontact
8 | Webshop
11 | Paypal
99 | Voucher

**Payments - documents**

Parameter | Type | Description
--------- | ------- | -----------
{document_id} | object | Document details for this linked document.

**Payments - documents object**

Parameter | Type | Description
--------- | ------- | -----------
document_id | integer | Document id.
document_type | integer | Document type id.
customer_ref | string | Customer reference from document.
customer_name | string | Customer name from document.
document_date | date | Document date (`YYYY-MM-DD`).

## Get All Payments

```php

$api_key = "api_key_here";
$api_secret = "api_secret_here";

$ch = curl_init('https://api.onlinefact.be/payments/?limit=2&page=1');
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
curl "https://api.onlinefact.be/payments/?limit=2&page=1" \
  -X GET \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
```

> The above command returns JSON structured like this:

```json
[
   {
      "payment_id":"245",
      "type":"2",
      "method":"Cash",
      "amount":"34.60",
      "date":"2026-03-04",
      "comment":"Ticket 2026/24",
      "zreport_id":"0",
      "documents":{
         "321":{
            "document_id":321,
            "document_type":3,
            "customer_ref":"C0001",
            "customer_name":"Demo Customer",
            "document_date":"2026-03-04"
         },
         "322":{
            "document_id":322,
            "document_type":3,
            "customer_ref":"C0001",
            "customer_name":"Demo Customer",
            "document_date":"2026-03-04"
         }
      }
   },
   {
      "payment_id":"246",
      "type":"3",
      "method":"Banktransfer",
      "amount":"120.00",
      "date":"2026-03-04",
      "comment":"Invoice 2026/101",
      "zreport_id":"0",
      "documents":{
         "410":{
            "document_id":410,
            "document_type":3,
            "customer_ref":"C0101",
            "customer_name":"Example NV",
            "document_date":"2026-03-04"
         }
      }
   }
]
```

This endpoint retrieves all payments.

### HTTPS Request

`GET https://api.onlinefact.be/payments/`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | 100 | limit results (max 1000).
page | 1 | page number of result.
document_id | | only payments linked to this document id.

## Get a Specific Payment

```php

$api_key = "api_key_here";
$api_secret = "api_secret_here";
$payment_id = 245;

$ch = curl_init('https://api.onlinefact.be/payments/'.$payment_id.'/');
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
curl "https://api.onlinefact.be/payments/245/" \
  -X GET \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
```

> The above command returns JSON structured like this:

```json
{
   "payment_id":"245",
   "type":"2",
   "method":"Cash",
   "amount":"34.60",
   "date":"2026-03-04",
   "comment":"Ticket 2026/24",
   "zreport_id":"0",
   "documents":{
      "321":{
         "document_id":321,
         "document_type":3,
         "customer_ref":"C0001",
         "customer_name":"Demo Customer",
         "document_date":"2026-03-04"
      },
      "322":{
         "document_id":322,
         "document_type":3,
         "customer_ref":"C0001",
         "customer_name":"Demo Customer",
         "document_date":"2026-03-04"
      }
   }
}
```

This endpoint retrieves a specific payment.

### HTTPS Request

`GET https://api.onlinefact.be/payments/<ID>`

### URL Parameters

Parameter | Description
--------- | -----------
ID | The ID of the payment to retrieve.

## Add a Payment

```php

$api_key = "api_key_here";
$api_secret = "api_secret_here";

$data_string = '{
   "document_id":321,
   "type":2,
   "amount":"34.60",
   "date":"2026-03-04",
   "comment":"Ticket 2026/24",
   "document_ids":[322,330]
}'; // JSON String

$ch = curl_init('https://api.onlinefact.be/payments/');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $api_key.":".$api_secret);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

print_r($result);
```

```shell
curl "https://api.onlinefact.be/payments/" \
  -X POST \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
  -d '{
      "document_id":321,
      "type":2,
      "amount":"34.60",
      "date":"2026-03-04",
      "comment":"Ticket 2026/24",
      "document_ids":[322,330]
   }'
```

> The above command returns JSON structured like this:

```json
{
   "payment_id":"245",
   "type":"2",
   "method":"Cash",
   "amount":"34.60",
   "date":"2026-03-04",
   "comment":"Ticket 2026/24",
   "zreport_id":"0",
   "documents":{
      "321":{
         "document_id":321,
         "document_type":3,
         "customer_ref":"C0001",
         "customer_name":"Demo Customer",
         "document_date":"2026-03-04"
      },
      "322":{
         "document_id":322,
         "document_type":3,
         "customer_ref":"C0001",
         "customer_name":"Demo Customer",
         "document_date":"2026-03-04"
      },
      "330":{
         "document_id":330,
         "document_type":2,
         "customer_ref":"REG",
         "customer_name":"Cash Register",
         "document_date":"2026-03-04"
      }
   }
}
```

This endpoint adds a payment.

### HTTPS Request

`POST https://api.onlinefact.be/payments/`

### Body Parameters

Parameter | Required | Description
--------- | -------- | -----------
document_id | yes | main document where payment is created on.
type | yes | payment method id.
amount | yes | payment amount.
date | yes | payment date (`YYYY-MM-DD`).
comment | no | custom comment.
document_ids | no | extra linked document ids.

<aside class="notice">
`document_ids` is optional input for linking to extra documents.  
Response always returns the linked documents in `documents`.
</aside>

## Delete a Payment

```php

$api_key = "api_key_here";
$api_secret = "api_secret_here";
$payment_id = 245;

$ch = curl_init('https://api.onlinefact.be/payments/'.$payment_id.'/');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $api_key.":".$api_secret);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

print_r($result);
```

```shell
curl "https://api.onlinefact.be/payments/245/" \
  -X DELETE \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
```

> The above command returns JSON structured like this:

```json
{
   "payment_id":245,
   "deleted":1
}
```

This endpoint deletes the full payment and all linked document/bank links.

### HTTPS Request

`DELETE https://api.onlinefact.be/payments/<ID>`

### URL Parameters

Parameter | Description
--------- | -----------
ID | The ID of the payment to delete.

## Update a Payment

Updating payments is intentionally not supported.

```php

$api_key = "api_key_here";
$api_secret = "api_secret_here";
$payment_id = 245;

$data_string = '{
   "amount":"10.00"
}'; // JSON String

$ch = curl_init('https://api.onlinefact.be/payments/'.$payment_id.'/');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $api_key.":".$api_secret);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

print_r($result);
```

```shell
curl "https://api.onlinefact.be/payments/245/" \
  -X PUT \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
  -d '{
      "amount":"10.00"
   }'
```

> The above command returns JSON structured like this:

```json
{
   "success":0,
   "error":"Update payment is not supported"
}
```
