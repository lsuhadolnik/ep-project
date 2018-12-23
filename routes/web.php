<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@show');

/*tukaj mora priti se id od orderja*/
Route::get('/order', function() {
    return view('order');
});

/*tukaj mora priti se id od uporabnika / prodajalca?*/
Route::get('/orders', function() {
    return view('orders');
});

/*tukaj mora priti se id od userja?*/
Route::get('/cart', 'ShoppingCartController@show')->name('showcart');
Route::post('/cart', 'ShoppingCartController@add')->name('cart');

/*tukaj mora priti se id od userja*/
Route::get('/profile', function() {
    return view('profile');
});

Route::get('/users', function() {
    return view('users');
});

Route::get('/product/{id}', 'ProductController@show')->name('showproduct');

Route::get('/addProduct', function() {
    return view('add-product');
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');