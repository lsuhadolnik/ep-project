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
        //$this->middleware(['auth', 'https']);
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
                'id' => $k->id,
                'price' => $k->totalPrice
            ]);
        }
        else {
            return view('shopping-cart', [
                'empty' => "Košarica je prazna",
                'price' => 0,
                'products' => []
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

    public function delete($id) {
        $user = Auth::user()->id;
        $cart = Order::shoppingCart($user)->id;
        Order::find($cart)->modifyOrderProduct($id, 0);
        return redirect('/cart');
    }


}