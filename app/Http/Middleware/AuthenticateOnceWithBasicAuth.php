<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

class AuthenticateOnceWithBasicAuth
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
        $r = Auth::onceBasic() ?: $next($request);
        if($r){
            if(Auth::user()->status == 'disabled'){
                Auth::logout();
                abort(401, "Uporabnik je blokiran");
            }
        }
        return $r;
    }

}