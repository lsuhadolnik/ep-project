<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        
    }

    
    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function showMe()
    {
        return Auth::user();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = new User();
        $user->name = $data->name;
        $user->surname = $data->surname;
        $user->address = $data->address;
        $user->email = $data->email;
        $user->phone = $data->phone;
        $user->role_id = Role::where("name", 'Stranka')->id;
        $user->postal_code = $data->postal_code;
        $user->password = Hash::make($data->password);
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function updateMe(Request $request, User $user)
    {
        Auth::user()->update($user->all());
        return response()->json($user, 200);
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
