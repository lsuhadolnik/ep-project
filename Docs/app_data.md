# Kako se dobi podatke, ki jih potrebuje spletna aplikacija

# NI ŠE VSE IMPLEMENTIRANO


- podatki o prijavljenem uporabniku: `Auth::user()`
- most wanted products: `Product::mostWanted($n)`
- all products: `Product::all()` ali `Product::where(...podaj filter...)->get()`
- info o košarici: `Auth::user()->shoppingCart()`
- Dodajanje/odstranjevanje/popravljanje produktov v košarici
```php
$c = Auth::user()->shoppingCart();
$c->modifyOrderProduct($product_id, $quantity);
```

- [TODO] Iskanje: `Product::search($query)`
- Oddaja naročila / Sprememba statusa naročila: `Order::find(1)->changeStatus($status)`


- Pregled informacij o naročilu: `Order::find($id)`
- Pregled produktov naročila: `Order::find($id)->products`

- Seznam vseh naročil: `Order::all()` ali `Order::where(...podaj filter...)->get()`  

- Seznam vseh uporabnikov: `User::all()` ali `User::where(...podaj filter...)->get()`
- Urejanje uporabnika: 
```php
$u = User::find($id);
$u->... = "new value";
...
$u->password = "PLAINTEXT"; # Hash se ustvari samodejno
$u->save();
```

- Urejanje artikla: 
```php
$p = Product::find($id);
$p -> name = '...'
...
$p->save();
```
- Brisanje artikla: `Product::find($id)->delete()`

- Proizvajalci:
```php
$p = Producer::create(["name"=>"Dell", "description" => "Takle mamo..."]);

$pid = $p->id; // Dobiš id

// Urejanje
$p->description = "Hello!";
$p->save(); // Shrani

$p->delete();
```

- Dodajanje slik: `Image::create(['name'=>'', 'description'=>'', 'path' => ''])`
- Dodajanje slik na produkt: 
```php
Product::find($id)->images()->attach($image_id, [
    'place_index' => $place  // (neobvezno)
]);
```
- Odstranjevanje slik iz produkta: `Product::find($id)->images()->detach($image_id)`
- Brisanje slik `Image::find($id)->delete()`