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

Route::group(['middleware' => ['https', 'auth.basic.once']], function() {
    
    Route::get('user', 'API\UsersController@showMe');
    Route::get('user', 'API\UsersController@showMe');

})



Route::get('users/{user}', 'API\UsersController@show');


Route::middleware('auth.basic.once')->group(function () {

    Route::get('users', 'API\UsersController@index')->middleware('https')->middleware('auth.basic.once')->middleware('auth.x509')->middleware('is-salesperson');
    Route::post('users', 'API\UsersController@store');
    Route::put('users/{user}', 'API\UsersController@update');
    Route::delete('users/{user}', 'API\UsersController@delete');

});



Route::get('/secure', function(Request $req){

    return "HELLO!";

})->middleware('https')->middleware('auth.basic.once')->middleware('cert');

