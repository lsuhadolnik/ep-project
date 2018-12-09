<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use \App\Product;
use \App\Order;
use \App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::all();
    }

	public function shoppingCart($user_id)
	{
		return Order::shoppingCart($user_id);
	}

}
