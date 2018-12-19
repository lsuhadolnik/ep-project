<?php

namespace App\Http\Middleware;

use \App\User;
use Illuminate\Support\Facades\Auth;

class VerifyCert
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

        $client_email = filter_input(INPUT_SERVER, "SSL_CLIENT_S_DN_Email");

        if ($client_email == null) {
            abort(403, 'Za dostop do tega mesta potrebujete veljaven certifikat. Vaš brskalnik ga ni posredoval.');
        }
    
        $u = Auth::user();

        if ($client_email === $u->email) {
            return $next($request);
        }

        abort(403, 'E-poštni naslov certifikata se ne ujema z naslovom prijavljenega uporabnika.');
        
    }

}