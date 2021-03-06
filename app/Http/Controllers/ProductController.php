<?php

namespace App\Http\Controllers;

use Auth;
use \App\Product;
use \App\Order;
use Illuminate\Routing\Route;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        //$this->middleware(['auth', 'https'])->except('show');
    }

    public function show($product_id)
    {
        $quantity = 0;

        $user = Auth::user();
        if ($user != null) {
            $user_id = $user->id;
            if(isset(Order::shoppingCart($user_id)->id)) {
            $k = Order::shoppingCart($user_id);
            $product = Order::find($k->id)->products->find($product_id);
            if ($product != null) {
                $quantity = $product->quantity;
            }
            
        }
        }
        
        return view('product', [
            'product' => Product::find($product_id),
            'quantity' => $quantity
        ]);
        
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

    public function rate($product_id, Request $request) {
        
        $user = Auth::user();
        $rating = $request->input('rating');
        
        $user->rateProduct($product_id, $rating);

        return redirect('/product/'.$product_id);
    }
}
