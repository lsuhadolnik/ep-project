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

- **GET /api/user** (HTTPS, AUTH) Vrne informacije o trenutnem prijavljenem uporabniku
Response:
```json
{
    "id": 1,
    "name": "Administrator",
    "surname": "--",
    "address": "--",
    "email": "admin@ep.si",
    "phone": "--",
    "status": "active",
    "email_verified_at": null,
    "created_at": "2018-12-20 15:13:36",
    "updated_at": "2018-12-20 15:13:36",
    "postal_code": null,
    "role": {
        "id": 1,
        "name": "Administrator"
    }
}
```
- **POST /api/user** (HTTPS) Dodajanje nove stranke. Poslati mora tudi CAPTCHA field (google captcha) [TODO]
Body: 
```json
{
	"name":"Ignac",
	"surname":"Jeromen",
	"address":"Zgornja Kungota 54",
	"postal_code":"3342",
	"email":"ignac@kungota.si",
	"password": "zajec2",
	"role_id": 1,
	"status": "disabled"
}
```
Response:
```json
{
    "status": "active",
    "phone": null,
    "surname": "Jeromen",
    "name": "Ignac",
    "postal_code": null,
    "address": "Zgornja Kungota 54",
    "email": "ignac@kungota.si",
    "updated_at": "2018-12-21 11:24:52",
    "created_at": "2018-12-21 11:24:52",
    "id": 8,
    "role": {
        "id": 3,
        "name": "Stranka"
    }
}
```
Atributa status in role_id se ne da vnesti na roke. Upoštevata se default vrednosti 'active' in 3 (stranka)

- **PUT /api/user** (HTTPS, AUTH) Popravljanje uporabnika.
Body: 
```json
{
	"name": "JOHNY!<script src=\"google.com\""
}
```
Response: 
```json
{
    "id": 5,
    "name": "JOHNY!&lt;script src=&quot;google.com&quot;",
    "surname": "Janežič",
    "address": "Zgornja Kungota 50",
    "email": "johana@kungota.si",
    "phone": null,
    "status": "active",
    "email_verified_at": null,
    "created_at": "2018-12-21 11:20:25",
    "updated_at": "2018-12-21 11:37:52",
    "postal_code": null,
    "role": {
        "id": 3,
        "name": "Stranka"
    }
}
```
- **PUT /api/user/rate/(product_id)** (HTTPS, AUTH) Oceni produkt
Če večkrat kličeš metodo z istim user in product id-jem, se posodobi obstoječa ocena.
Body:
```json
{
	"rating": 9
}
```
Rating je lahko realno število od 0 do 5. Če je manj od 0, postane 0. Če je večje od 5, postane 5.

Response:
```json
{
    "status": {
        "rating": 5
    }
}
```

- **PUT /api/user/shoppingCart/(product_id)** (HTTPS, AUTH) Doda/odstrani ali popravi količino artikla v košarici. Če je količina 0 ali manj, bo produkt odstranjen.
Body:
```json
{
	"quantity": 4
}
```

Response:
```json
{
    "status": "Količina posodobljena.",
    "action": "Change quantity of order product 2."
}
```

- **GET /api/user/shoppingCart** (HTTPS, AUTH) Pregled košarice uporabnika
Response:
```json
{
    "id": 1,
    "status": "draft",
    "user_id": 4,
    "created_at": "2018-12-21 14:53:42",
    "updated_at": "2018-12-21 14:53:42",
    "totalPrice": 60.099999999999994,
    "products": [
        {
            "id": 2,
            "name": "Test",
            "description": "Test test",
            "price": 12.02,
            "images": [],
            "rating": {
                "num_ratings": 3,
                "rating": "6.3333"
            },
            "quantity": 5
        }
    ]
}
```

- **DELETE /api/user/shoppingCart/(product_id)** (HTTPS, AUTH) Odstrani produkt iz košarice uporabnika
Response:
```json
{
    "status": "Odstranjeno.",
    "action": "Remove order product 2."
}
```

- **GET /api/user/orders** (HTTPS, AUTH) Pregled naročil uporabnika
Response:
```json
[
    {
        "id": 1,
        "status": "draft",
        "user_id": 4,
        "created_at": "2018-12-21 14:53:42",
        "updated_at": "2018-12-21 14:53:42",
        "totalPrice": 60.099999999999994
    }
]
```

- **GET /api/user/order/{order_id}/products** (HTTPS, AUTH) Pregled produktov naročila uporabnika
Response:
```json
[
    {
        "id": 2,
        "name": "Test",
        "description": "Test test",
        "price": 12.02,
        "images": [],
        "rating": {
            "num_ratings": 3,
            "rating": "6.3333"
        },
        "quantity": 5
    }
]
```

- **GET /api/products/** Seznam vseh AKTIVNIH produktov.
Response:
```json
[
    {
        "id": 2,
        "name": "Test",
        "description": "Test test",
        "price": 12.02,
        "rating": {
            "num_ratings": 3,
            "rating": "6.3333"
        },
        "images": []
    }
]
```

- **GET /api/products/(id)** Informacije o produktu.
Response:
```json
{
    "id": 2,
    "name": "Test",
    "description": "Test test",
    "price": 12.02,
    "rating": {
        "num_ratings": 3,
        "rating": "6.3333"
    },
    "images": []
}
```
- **GET /api/products/mostWanted/(n)** Pridobi n najbolje prodajanih produktov
- **GET /api/products/topRated/(n)** Pridobi n najbolje ocenjenih produktov

- **PUT /api/user/shoppingCart/submit** (HTTPS, AUTH) Oddaj naročilo

Response:
```json
{
    "status": "Uspešno sem spremenil stanje naročila."
}
```

# Lokacije, ki še bodo implementirane

- **GET /api/products/search/($query)** Poišči produkte



### Vse informacije artikla
```json
[
    {
        "id": 2,
        "name": ...,
        "description": ...,
        "price": ...,
        "images": <Array slik>,
        "producerName": ...,
        "rating": {
            "num_ratings": ...,
            "rating": ...
        },
        "quantity": ...To ignoriraj, kjer nima smisla,
        "times_bought": ...
    }
]
```
