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


## Lokacije

- **GET /api/secure/users** (HTTPS, AUTH, CERT, ADMIN-ONLY) Seznam vseh uporabnikov
- **GET /api/users/(id)** (HTTPS, AUTH) Podatki o določenem uporabniku. Vsak lahko vidi svoj profil, administrator pa kateregakoli.
- **POST /api/users** (HTTPS) Dodajanje novega uporabnika. Doda se lahko samo uporabnik stranka. (Treba bo rešit še CAPTCHA verification)
- **PUT /api/users/(id)** (HTTPS, AUTH) Popravljanje uporabnika. Vsak lahko popravlja samo sebe, ADMIN lahko popravlja vse.
- **DELETE /api/secure/users/(id)** (HTTPS, AUTH, CERT, ADMIN-ONLY)
- **GET /api/users/(id)/shoppingCart** (HTTPS, AUTH) Pregled košarice uporabnika


- **GET /api/producers**

- **GET /api/images**

- **GET /api/products/** Seznam vseh AKTIVNIH produktov.
- **GET /api/products/(id)** Informacije o produktu.
- **POST /api/secure/products** (HTTPS, AUTH, CERT, SALES+) Dodajanje novega produkta
- **POST /api/secure/products/(id)/image** (HTTPS, AUTH, CERT, SALES+) Dodajanje slike produkta
