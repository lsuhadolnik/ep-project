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
Route::post('/search', 'MainController@search');

/*tukaj mora priti se id od orderja*/
Route::get('/order', function() {
    return view('order');
});

/*tukaj mora priti se id od uporabnika / prodajalca?*/
Route::get('/order/{id}', 'OrderController@showOrder');
Route::post('/order/{id}/{status}', 'OrderController@setStatus');

Route::get('/orders', 'OrderController@show')->name('showorders');
Route::get('/orders/{status}', 'OrderController@showByStatus')->name('filterorders');


/*tukaj mora priti se id od userja?*/
Route::get('/cart', 'ShoppingCartController@show')->name('showcart');
Route::post('/cart', 'ShoppingCartController@add')->name('cart');
Route::delete('/cart/{id}', 'ShoppingCartController@delete')->name('delcart');

Route::get('/profile', 'ProfileController@show')->name('showprofile');
Route::post('/profile', 'ProfileController@update')->name('profile');
Route::post('/resetPassword', 'ProfileController@resetPassword')->name('reset');

Route::get('/users', function() {
    return view('users');
});

Route::get('/product/{id}', 'ProductController@show')->name('showproduct');
Route::post('/product/{id}/rating', 'ProductController@rate')->name('rate');

Route::get('/management/products', 'ManagementController@showProducts');
Route::get('/management/addProduct', 'ManagementController@showAddProduct');
Route::post('/management/addProduct', 'ManagementController@addProduct');
Route::get('/management/updateProduct', 'ManagementController@showUpdateProduct');
Route::post('/management/updateProduct', 'ManagementController@updateProduct');

Route::get('/management', 'ManagementController@show')->name('management');
Route::get('/management/order/{id}', 'ManagementController@showOrder');
Route::get('/management/orders/{status}', 'ManagementController@showByStatus')->name('ordersmanagement');
Route::post('/management/order/{id}/{status}', 'ManagementController@setStatus');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


/**---------------- FUUUJ! --------------------*/
Auth::routes(['verify' => true, 'reset'=>false]);
/* Vse to samo zato, da lahko dodam ReCaptcha pregledovanje **/
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email')->middleware('check-recaptcha');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');