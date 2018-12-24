<?php

namespace App\Http\Middleware;

use \App\User;
use Illuminate\Support\Facades\Auth;

class CheckReCaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, $next)
    {

        $data = $request->all();
        if(isset($data["g-recaptcha-response"])) {

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
                return abort(403, "Zahtevek ReCaptcha ni bil uspešen.");
            
            $body = json_decode($res->getBody()->getContents());
            if($body->success)
            {
                return $next($request);
            }

        }
        
        else abort(403, "Zahtevano je preverjanje ReCaptcha");
    }
}