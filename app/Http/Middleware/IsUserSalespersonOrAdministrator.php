<?php

namespace App\Http\Middleware;

use \App\User;
use Illuminate\Support\Facades\Auth;

class IsUserSalespersonOrAdministrator
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
        $u = Auth::user();
        if($u->role->id <= 2)
            return $next($request);
        else abort(403, 'This action is available to salespresons only. You are not a salesperson.');
    }

}
