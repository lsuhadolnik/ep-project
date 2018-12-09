<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use \App\Order;
use \App\User;

use \App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('api:auth');
    }

    
    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(Request $request)
    {
        $user = User::create($user->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $user->update($user->all());
        return response()->json($user, 200);
    }

    public function delete(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }


}
