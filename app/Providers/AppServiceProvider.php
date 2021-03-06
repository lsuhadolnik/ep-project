<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('checkReCaptcha', function($attribute, $value, $parameters) {
            
            
            $secret_key = "6LdffoQUAAAAAHKcPTq3RXkRNOLBgJrqpMZ6frhU";

            //abort(400, "Sec: $secret_key, Val: $value");

            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
                'headers' => [
                    'Accept'     => 'application/json; charset=utf8',
                ],
                'form_params' => [
                    'response' => $value,
                    'secret' => $secret_key
                ]
            ]);
            
            if($res->getStatusCode() != 200)
                return false;
            
            $body = json_decode($res->getBody()->getContents());
            return $body->success;
        }, "Preverjanje ReCaptcha ni bilo uspešno.");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
