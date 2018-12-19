# API dokumentacija

Metode API-ja so na rutah /api/*

## Avtentikacija
Nekatere metode zahtevajo avtentikacijo uporabnika.
Na API se povežeš z uporabo HTTP basic auth. Zraven **vsake zahteve** pošlji uporabniško ime in geslo.
Dodati moraš request header Authorization, ki ima vrednost "Basic <Base64 username:password>".
Primer: 
```
Authorization: Basic cHJvZEBlcC5zaTpoZWxsbyE=
```
Če odkodiraš cHJvZEBlcC5zaTpoZWxsbyE= z BASE64 decoderjem dobiš string `prod@ep.si:hello!`

## Implementirane lokacije

- **GET /api/user** (HTTPS, AUTH) Vrne informacije o trenutnem uporabniku
- **POST /api/user** (HTTPS) Dodajanje nove stranke. Poslati mora tudi CAPTCHA field (google captcha) [TODO]
- **PUT /api/user** (HTTPS, AUTH) Popravljanje uporabnika.
- **PUT /api/user/rate/(product_id)** (HTTPS, AUTH) Oceni produkt
- **GET /api/user/shoppingCart** (HTTPS, AUTH) Pregled košarice uporabnika


## Lokacije, ki bodo implementirane



- **PUT /api/user/shoppingCart/(product_id)** (HTTPS, AUTH) Doda produkt v košarico uporabnika. Lahko tudi popravljaš količino (mora biti pozitivna).
- **DELETE /api/user/shoppingCart/(product_id)** (HTTPS, AUTH) Odstrani produkt iz košarice uporabnika
- **GET /api/user/orders** (HTTPS, AUTH) Pregled naročil uporabnika

- **GET /api/products/** Seznam vseh AKTIVNIH produktov.
- **GET /api/products/(id)** Informacije o produktu.
- **GET /api/products/mostWanted/(n)** Pridobi n najbolje prodajanih produktov
- **GET /api/products/topRated/(n)** Pridobi n najbolje ocenjenih produktov
