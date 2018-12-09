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

Route::middleware('auth.basic')->group(function () {

    Route::get('users', 'UsersController@index');
    Route::get('users/{user}', 'UsersController@show');
    Route::post('users', 'UsersController@store');
    Route::put('users/{user}', 'UsersController@update');
    Route::delete('users/{user}', 'UsersController@delete');

});


