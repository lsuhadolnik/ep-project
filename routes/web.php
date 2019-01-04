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
Route::get('/product/{id}', 'ProductController@show')->name('showproduct');

Route::group(['middleware' => ['https', 'auth']], function() {
    Route::get('/order/{id}', 'OrderController@showOrder');
    Route::post('/order/{id}', 'OrderController@addOrder');

    Route::get('/orders', 'OrderController@show')->name('showorders');
    Route::get('/orders/{status}', 'OrderController@showByStatus')->name('filterorders');

    Route::post('/invoice', 'OrderController@invoice');
    Route::get('/cart', 'ShoppingCartController@show')->name('showcart');
    Route::post('/cart', 'ShoppingCartController@add')->name('cart');
    Route::delete('/cart/{id}', 'ShoppingCartController@delete')->name('delcart');

    Route::get('/profile', 'ProfileController@show')->name('showprofile');
    Route::post('/profile', 'ProfileController@update')->name('profile');
    Route::post('/resetPassword', 'ProfileController@resetPassword')->name('reset');

    Route::post('/product/{id}/rating', 'ProductController@rate')->name('rate');
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
});

Route::group(['middleware' => ['https', 'auth', 'cert']], function() {


    Route::get('/secure/management', 'ManagementController@show')->name('management');

    Route::get('/secure/products', 'ManagementController@showProducts');
    Route::get('/secure/addProduct', 'ManagementController@showAddProduct');
    Route::post('/secure/addProduct', 'ManagementController@addProduct');
    Route::get('/secure/updateProduct/{id}', 'ManagementController@showUpdateProduct');
    Route::post('/secure/updateProduct/{id}', 'ManagementController@updateProduct');
    Route::delete('secure/deleteProductImage/{product_id}/{image_id}', 'ManagementController@deleteImage');
    Route::post('/secure/product/{id}/changeStatus', 'ManagementController@productChangeStatus');

    Route::get('/secure/order/{id}', 'ManagementController@showOrder');
    Route::get('/secure/orders/{status}', 'ManagementController@showByStatus')->name('ordersmanagement');
    Route::post('/secure/order/{id}/{status}', 'ManagementController@setStatus');

    Route::get('/secure/users', 'ManagementController@showUsers');
    Route::get('/secure/user', 'ManagementController@createUserForm');
    Route::post('/secure/user', 'ManagementController@createUser');
    Route::post('/secure/user/{id}/changeStatus', 'ManagementController@userChangeStatus');
    Route::get('/secure/user/{id}', 'ManagementController@showUser');
    Route::post('/secure/user/{id}', 'ManagementController@updateUser');
    Route::post('/secure/changeRole/{id}', 'ManagementController@changeRole');
    Route::get('/secure/logs', 'ManagementController@logs');
});
    





/**---------------- FUUUJ! --------------------*/
Route::group(['middleware' => ['https']], function() {
    Auth::routes(['verify' => true, 'reset'=>false]);
    /* Vse to samo zato, da lahko dodam ReCaptcha pregledovanje **/
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email')->middleware('check-recaptcha');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
});