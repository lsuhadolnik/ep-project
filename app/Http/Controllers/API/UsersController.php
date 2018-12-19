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
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function updateMe(Request $request)
    {
        $user = Auth::user();
        $user->update($request->all());
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

    public function rateProduct(Request $request, $product)
    {
        $data = $request->all();
        if(isset($data['rating']) && !empty($data['rating']))
        {
            Auth::user()->rateProduct($product, $data['rating']);
            return response()->json(["status"=>"OK"], 200);
        }
        return response()->json("Error. Please provide rating in the request body.", 400);
    }

    public function shoppingCart(Request $request) 
    {
        $user = Auth::user();
        return response()->json($user->shoppingCart());
    }

    public function cartProduct(Request $request, $product_id) 
    {
        $user = Auth::user();
        $o = $u->shoppingCart();
        
        return response()->json($user->shoppingCart());
    }

}
