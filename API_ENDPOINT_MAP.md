# Onlinefact API Endpoint Map

Doel: centrale referentie om API-implementatie en Slate-documentatie synchroon te houden.

## Routering

- URL rewrite (`api_onlinefact/.htaccess`): `/{request_page}/{id?}` -> `index.php?request_page={...}&id={...}`
- Dispatcher (`api_onlinefact/index.php`): include `api2/{request_page}.php`

## Gedocumenteerde endpoint families (Slate)

- `products`
  - `GET /products/`
  - `GET /products/<ID>`
  - `POST /products/`
  - `PUT /products/<ID>`
  - `DELETE /products/<ID>`
- `categories`
  - `GET /categories/`
  - `GET /categories/<ID>`
  - `POST /categories/`
  - `PUT /categories/<ID>`
  - `DELETE /categories/<ID>`
- `brands`
  - `GET /brands/`
  - `GET /brands/<ID>`
  - `POST /brands/`
  - `PUT /brands/<ID>`
  - `DELETE /brands/<ID>`
- `customers`
  - `GET /customers/`
  - `GET /customers/<ID>`
  - `POST /customers/`
  - `PUT /customers/<ID>`
  - `DELETE /customers/<ID>`
- `vouchers`
  - `GET /vouchers/`
  - `GET /vouchers/<ID>`
  - `POST /vouchers/`
  - `PUT /vouchers/<ID>`
  - `DELETE /vouchers/<ID>`
- `documents`
  - `GET /documents/`
  - `GET /documents/<ID>`
  - `POST /documents/`
  - `PUT /documents/<ID>`
- `payments`
  - `GET /payments/`
  - `GET /payments/<ID>`
  - `POST /payments/`
  - `DELETE /payments/<ID>`
- `reports`
  - `GET /reports/documents/`
  - `GET /reports/saletotals/`
  - `GET /reports/salesperproduct/`
  - `GET /reports/salesperrelation/`

## API-bestanden met extra/ondersteunende endpoints

Deze bestaan in code en moeten expliciet gedocumenteerd of bewust intern gehouden worden:

- `api2/info.php`
- `api2/payments.php` (`GET`, `POST`, `PUT`=not supported, `DELETE`)
- `api2/dopayment.php`
- `api2/dopayments/*.php`

## Verplichte sync-checklist bij elke API wijziging

1. Bepaal impacted endpoint(s) in `api2/**/*.php`.
2. Pas bijhorende sectie(s) aan in `source/includes/_*.md`.
3. Verifieer endpoint URL en HTTP-methodes exact tegen code.
4. Verifieer parameters, responsevelden en foutcases.
5. Controleer `source/index.html.md` includes voor nieuwe secties.

## Release-gate voor API changes

Een API wijziging is niet klaar wanneer:
- docs ontbreken voor een nieuw endpoint,
- voorbeeldpayloads niet meer kloppen,
- URL/methode in docs niet overeenkomt met implementatie.
