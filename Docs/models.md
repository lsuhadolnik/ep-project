# Popis modelov



*** Pomembno! ***

V primerih poizvedb so zraven zapisani tudi tipi modelov, ki jih vračajo metode. Recimo `User::find(1)` vrača tudi polje role, ki je v resnici svoja instanca modela Role, nad katero lahko kličeš vse metode, ki jih tudi sicer lahko kličeš nad tem modelom...



Vse podatke iz vrstic dobiš s puščico. Primer: Imam poizvedbo User::find(1). Če hočem dobiti ime, kličem 

```PHP
$u = User::find(1);
$ime = $u->name; // Dobim ime
$priimek = $u->surname;

$role = $u->role;
$id_role = $role->id;
```







## User

- **Podatki o uporabniku**

`User::find($id)`

Vrne podatke o uporabniku. Vključuje naziv role.

Primer:

```JSON
User::find(1);
=> App\User {
     id: 1,
     name: "Administrator",
     surname: null,
     address: null,
     email: "admin@ep.si",
     phone: null,
     status: "active",
     email_verified_at: null,
     created_at: "2018-12-01 22:08:38",
     updated_at: null,
     postal_code: 1000,
     role: App\Role {
       id: 1,
       name: "Administrator",
     },
   }
```



- **Košarica uporabnika**

`User::find($id)->shoppingCart()`

Vrne draft order uporabnika skupaj s produkti in slikami. To so stvari, ki so v uporabnikovi košarici. Vedno vrne rezultat, tudi če košarica še ne obstaja. Če košarica ne obstaja, je ne shrani, dokler ni potrebno.

```JSON
User::find(2)->shoppingCart()
=> App\Order {
     id: 1,
     status: "draft",
     user_id: 2,
     created_at: "2018-12-05 00:00:00",
     updated_at: null,
     products: [
         App\Product {
           id: 4,
           name: "Hladilnik",
           description: "Prva kvaliteta. Odlična izbira zlasti za najzahtevnejše.",
           producer_id: 4,
           status: "active",
           price: 804.33,
           created_at: "2018-12-05 00:00:00",
           updated_at: null,
           quantity: 9,
           producer: App\Producer {
             id: 4,
             name: "Zanussi",
             description: null,
           },
           images: [
               App\Image {
                 id: 4,
                 name: "Hladilnik, beli",
                 description: "Hladilnik",
                 path: "/slike/hladilnik_1.jpg",
               },
           ],
    ]
}
```







- **Vsa naročila uporabnika**

  `User::find($id)->orders($status)->get()`

  Vrne seznam modelov Order. 

  ```JSON
  User::find(2)->orders()->get()
  => [
         App\Order {
           id: 1,
           status: "draft",
           user_id: 2,
           created_at: "2018-12-05 00:00:00",
           updated_at: null,
           products: [
               App\Product {...},
  		 ],
  		},
  	...
  ]       
  ```




- Ustvarjanje novega uporabnika

```php
$u = new User();
$u->name = 'Janez';
$u->surname = 'Velkavrh';
$u->address = 'Cesta na Vrhovce 12\n1000 Ljubljana';
$u->email = "hello@ep.si";
$u->phone = "+38631332958";
$u->password = $u->password = Hash::make("111_111");
$u->role_id = 3; // Stranka
$u->save();
```



- `User::all()`

  Vrne seznam vseh uporabnikov

```JSON
User::all()
=> [
       App\User {
         id: 1,
         name: "Administrator",
         surname: null,
         address: null,
         email: "admin@ep.si",
         phone: null,
         status: "active",
         email_verified_at: null,
         created_at: "2018-12-01 22:08:38",
         updated_at: null,
         role: App\Role {
           id: 1,
           name: "Administrator",
         },
   ....
```



- **Ocenjevanje produkta**

```PHP
$u = User::find($userID);
$u->rateProduct($productID, $rating);
```

Vrne (objekt Rating)/false odvisno od tega, ali je poizvedba uspela.

- **Popravljanje lastnosti uporabnika**

```PHP
$u = User::find(5);
$u->name = "Petra";
$u->save();
```

Vrne true/false če je poizvedba uspela.



- **Nastavljanje vloge uporabnika (set role)**

```PHP
User::find($id)->setRole("Administrator");
```

Vrne true/false če je poizvedba uspela.



- **Brisanje uporabnika**

```
User::find($id)->delete();
```

Vrne true/false če je poizvedba uspela.


- **Informacije o poštni številki**

```php
User::find($id)->postalCode()->get();
```


## Product

- `Product::find($id)`

  Vrne podatke o produktu z ID-jem. Vrne tudi združeno oceno in število ocen.

  ```JSON
  Product::find(1)
  => App\Product {
       id: 1,
       name: "Test",
       description: "Test test",
       producer_id: null,
       status: "active",
       price: 12.02,
       created_at: "2018-12-20 00:00:00",
       updated_at: null,
       producer: null,
       quantity: 0,
       rating: {
  		"num_ratings": 1,
  		"rating": "2.0000"
  	 },
       images: [
           App\Image {
             id: 2,
             name: "Slika 2",
             description: "SKodelice.",
             path: "/slike/skodelice.png",
           },
       ],
  }
  ```


- `Product::mostWanted($n)`

  Vrne `$n` največ naročenih artiklov - upošteva se tudi količina:

  ​	5 kupcev naroči en po kos artikla A

  ​	1 kupec  naroči 10 kosov artikla B

  ​         => Artikel B bo bolj zaželen kot artikel A.

  Ne upošteva košaric uporabnikov.



- `Product::topRated($n)`

Vrne `$n` najbolje ocenjenih produktov.



- **Ustvarjanje novih artiklov**

```PHP
$p = new Product();
$p->name = "Test";
$p->description = "Test test";
$p->producer_id = 1;
$p->price = 12.02;
$p->save();
```

- **Uredi obstoječega**

```PHP
$p = Product::find(1);
$p->name = "Test";
$p->producer_id = 1;
$p->price = 133.023;
$p->save();
```

- **Izbriši obstoječega**

```
Product::find($id)->delete();
```



## Producer

Proizvajalci...

- `Producer::find($id)`

Podatki o proizvajalcu z ID-jem $id.

- **Ustvari novega**

```PHP
$p = new Producer();
$p->name = 'WWF';
$p->description = 'Avstrijski proizvajalec posode';
$p->save();

// ALI
$p = Producer::create([
	'name' => 'Ime',
    'description' => 'Opis'
]);
```

- **Uredi obstoječega**

```PHP
$p = Producer::where('name', 'Gorenje');
$p->description = 'Slovenski proizvajalec bele tehnike';
$p->save();
```

- **Izbriši obstoječega**

```PHP
Producer::find($id)->delete();
```



## PostalCode

Poštne številke...

- `PostalCode::find($id)`

Podatki o poštni številki z ID-jem $id.



## Image

Slika produkta/Uporabnika

- **Informacije o sliki**

```JSON
Image::find(1)
=> App\Image {
    id: 1,
    name: "Slika testa",
    description: "Test ima tudi svojo sliko.",
    path: "/slike/test1.png",
}
```

- **Nova slika / uredi informacije**

```php
$i = new Image();
$i->name = "Slika testa";
$i->description: "Test ima tudi svojo sliko.";
$i->path: "/slike/test1.png";
$i->save();
```

- **Izbriši sliko**

```php
Image::find($id)->delete();
```

- **Nastavi kot sliko produkta**

```PHP
// Dodaj sliko
Product::find($product_id)->images()->attach($image_id)
    
// Odstrani sliko
Product::find($product_id)->images()->detach($image_id)    
```

- **Direktno ustvari sliko produkta**

```PHP
Product::find($product_id)
    ->images()
    ->create([
        'name'=>'Hello!', 
        'description' => 'Opis slike',
        'path'=>'/slike/hello.png'
    ]);
```



## Order

- `Order::find($id)`

  Vrne podatke o naročilu. Tudi skupno ceno artiklov.

```JSON
=> App\Order {
     id: 1,
     status: "draft",
     user_id: 2,
     created_at: "2018-12-05 00:00:00",
     updated_at: null,
     totalPrice: 2728.649999999999,
     products: [
         App\Product {...},
		 ...
     ]
}
```



Order products

```php
$o = Order::find(1);
$products = $o->products();
```





- **Seznam naročil**

  ```PHP
  $o = Order::where('user_id', 1)->get();
  Order::all(); // Vrne vsa naročila vseh uporabnikov
  ```



- **Dobi/Ustvari košarico za uporabnika**

```php
Order::shoppingCart($user_id);
```

Ko kličeš to metodo še ni nujno, da naročilo obstaja.

To preveriš tako, da pogledaš njegov ID:

```PHP
isset(Order::shoppingCart(35)->id)
```

Če `isset` vrne true, potem obstaja, sicer še ni shranjen v bazo. Shraniš ga z 

```PHP
$k = Order::shoppingCart(35);
$k->save();
```

- **Dodaj/Odstrani produkt na/iz naročilo/a**

```PHP
// Dodaj produkt
Order::find($order_id)->products()->attach($product_id);

// Odstrani produkt
Order::find($order_id)->products()->detach($product_id);
```

