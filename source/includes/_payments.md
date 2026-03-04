# Payments

Parameter | Type | Description
--------- | ------- | -----------
payment_id | integer | Unique identifier for the payment. `[read-only]`
type | integer | Payment method ID.
method | string | Payment method name.
amount | decimal | Payment amount.
date | date | Payment date (`YYYY-MM-DD`).
comment | string | Optional free text comment.
document_ids | array | Linked document IDs.
zreport_id | integer | Linked Z-report id (`0` means none). `[read-only]`

## Get All Payments

```shell
curl "https://api.onlinefact.be/payments?limit=50&page=1" \
  -X GET \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json"
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
    "document_ids":[321,322]
  }
]
```

This endpoint retrieves all payments.

### HTTPS Request

`GET https://api.onlinefact.be/payments/`

### Query Parameters

Parameter | Default | Description
--------- | ------- | -----------
limit | 100 | Limit results (max 1000).
page | 1 | Page number.
document_id | | Only payments linked to this document.

## Get a Specific Payment

```shell
curl "https://api.onlinefact.be/payments/245/" \
  -X GET \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json"
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
  "document_ids":[321,322]
}
```

### HTTPS Request

`GET https://api.onlinefact.be/payments/<ID>`

## Add a Payment

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
  "document_ids":[321,322,330]
}
```

This endpoint adds a payment and links it to the provided document.  
Optional `document_ids` links the same payment to extra documents.

### HTTPS Request

`POST https://api.onlinefact.be/payments/`

## Delete a Payment

```shell
curl "https://api.onlinefact.be/payments/245/" \
  -X DELETE \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json"
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

## Update a Payment

Updating payments is intentionally not supported.

```shell
curl "https://api.onlinefact.be/payments/245/" \
  -X PUT \
  -u "api_key_here:api_secret_here" \
  -H "Content-Type: application/json" \
  -d '{"amount":"10.00"}'
```

```json
{
  "success":0,
  "error":"Update payment is not supported"
}
```
