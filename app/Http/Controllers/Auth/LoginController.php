<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Login;

use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {

        Login::note(['type'=>'logout']);

        Auth::logout();
        return redirect('/');
    }
    protected function attemptLogin(Request $request)
    {
        $attempt = Auth::attempt(
            $this->credentials($request) + ["status" => 'active']
        );

        if($attempt){ 
            Login::note(['type'=>'login']);
        }

        return $attempt;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            "email" => ["Geslo ni pravilno, ali pa je uporabnik blokiran."],
        ]);
    }

}
