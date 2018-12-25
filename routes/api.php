<?php

use Illuminate\Http\Request;

use \App\User;
use \App\Product;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* User routes */
Route::post('user', 'API\UsersController@store')->middleware('https')->middleware('check-recaptcha');

Route::group(['middleware' => ['https', 'auth.basic.once']], function() {

    Route::get('user', 'API\UsersController@showMe');
    Route::put('user', 'API\UsersController@updateMe');
    Route::put('user/rate/{product_id}', 'API\UsersController@rateProduct');
    Route::get('user/rate/{product_id}', 'API\UsersController@getRating');
    Route::get('user/shoppingCart', 'API\UsersController@shoppingCart');
    Route::put('user/shoppingCart/{product_id}', 'API\UsersController@modifyOrderProduct');
    Route::delete('user/shoppingCart/{product_id}', 'API\UsersController@deleteOrderProduct');
    Route::get('user/orders', 'API\UsersController@getOrders');
    Route::get('user/order/{order}/products', 'API\UsersController@getOrderProducts');
    
    Route::post('user/shoppingCart/submit', 'API\UsersController@submitShoppingCart');

});


/* Product routes */
Route::get('products', 'API\ProductsController@index');// Seznam vseh AKTIVNIH produktov.')
Route::get('products/search/{query}', 'API\ProductsController@search');// Iskanje po produktih in proizvajalcih
Route::get('product/{id}', 'API\ProductsController@show'); // Informacije o produktu.
Route::get('products/mostWanted/{n?}', 'API\ProductsController@mostWanted'); // Pridobi n najbolje prodajanih produktov. Upošteva tudi košarice.
Route::get('products/topRated/{n?}', 'API\ProductsController@topRated'); // Pridobi n najbolje ocenjenih produktov.