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
Route::get('/search', 'MainController@search');



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



Route::get('/product/{id}', 'ProductController@show')->name('showproduct');
Route::post('/product/{id}/rating', 'ProductController@rate')->name('rate');

Route::get('/secure/products', 'ManagementController@showProducts');
Route::get('/secure/addProduct', 'ManagementController@showAddProduct');
Route::post('/secure/addProduct', 'ManagementController@addProduct');
Route::get('/secure/updateProduct/{id}', 'ManagementController@showUpdateProduct');
Route::post('/secure/updateProduct/{id}', 'ManagementController@updateProduct');
Route::delete('secure/deleteProductImage/{product_id}/{image_id}', 'ManagementController@deleteImage');
Route::post('/secure/product/{id}/changeStatus', 'ManagementController@productChangeStatus');

Route::get('/secure/management', 'ManagementController@show')->name('management');
Route::get('/secure/order/{id}', 'ManagementController@showOrder');
Route::get('/secure/orders/{status}', 'ManagementController@showByStatus')->name('ordersmanagement');
Route::post('/secure/order/{id}/{status}', 'ManagementController@setStatus');

Route::get('/secure/users', 'ManagementController@showUsers');
Route::post('/secure/user/{id}/changeStatus', 'ManagementController@userChangeStatus');


Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


/**---------------- FUUUJ! --------------------*/
Auth::routes(['verify' => true, 'reset'=>false]);
/* Vse to samo zato, da lahko dodam ReCaptcha pregledovanje **/
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email')->middleware('check-recaptcha');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');