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

Route::get('/', function () {
    return view('index');
});

/*tukaj mora priti se id od orderja*/
Route::get('/order', function() {
    return view('order');
});

/*tukaj mora priti se id od uporabnika / prodajalca?*/
Route::get('/orders', function() {
    return view('orders');
});

/*tukaj mora priti se id od userja?*/
Route::get('/cart', function() {
    return view('shopping-cart');
});
/*tukaj mora priti se id od userja*/
Route::get('/profile', function() {
    return view('profile');
});

Route::get('/users', function() {
    return view('users');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/verifyCert1', function(Request $req){

        $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");

        if ($client_cert == null) {
            abort(403, 'err: Spremenljivka SSL_CLIENT_CERT ni nastavljena.');
        }

        $authorized_users = ['admin@ep.si'];

        $cert_data = openssl_x509_parse($client_cert);
        $commonname = (is_array($cert_data['subject']['E']) ? $cert_data['subject']['E'][0] : $cert_data['subject']['E']);
        
        var_dump($cert_data);
        
        if (in_array($commonname, $authorized_users)) {
            echo "$commonname je avtoriziran uporabnik... " . date("H:i");
        } else {
            echo "$commonname ni avtoriziran uporabnik.";
        }


});

Route::get('/verifyCert2', function(Request $req){

    return response()->json($_SERVER);

    $client_email = filter_input(INPUT_SERVER, "SSL_CLIENT_S_DN_Email");

    if ($client_email == null) {
        abort(403, 'err: Spremenljivka SSL_CLIENT_S_DN_Email ni nastavljena.');
    }

    $authorized_users = ['admin@ep.si'];
    
    if (in_array($client_email, $authorized_users)) {
        echo "$client_email je avtoriziran uporabnik... " . date("H:i");
    } else {
        echo "$client_email ni avtoriziran uporabnik.";
    }

});