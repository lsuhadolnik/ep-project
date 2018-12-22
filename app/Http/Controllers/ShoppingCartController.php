<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use \App\Product;
use \App\Order;

use \App\Http\Controllers\Controller;

class ShoppingCartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user()->id;

        if(isset(Order::shoppingCart($user)->id)) {
            $k = Order::shoppingCart($user);
            return view('shopping-cart', [
                'products' => $k->products,
                'price' => $k->totalPrice
            ]);
        }
        else {
            return view('shopping-cart', [
                'empty' => "Košarica je prazna"
            ]); 
        }
        
    }

    public function add(Request $request) {
        $user = Auth::user()->id;

        if(!isset(Order::shoppingCart($user)->id)) {
            $k = Order::shoppingCart($user);
            $k->save();
        }

        $cart = Order::shoppingCart($user)->id;
        $product = $request->input('product_id');
        $quantity = $request->input('quantity');
        
        Order::find($cart)->modifyOrderProduct($product, $quantity);

        return redirect('/cart');

    }


}