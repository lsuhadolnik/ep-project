<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use \App\Order;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'https']);
    }

    public function addOrder($order_id) {
        Order::find($order_id)->changeStatus("active");
        return redirect('/orders/active');
    }

    public function getDescriptionStatus($status) {
        switch($status) {
            case('active'):
                return "Oddano, čaka na pregled";
            case('fulfilled'):
                return "Potrjeno";
            case('cancelled'):
                return "Preklicano";

        }
    }

    public function show() {
        /*$user = Auth::user();


        return view('orders', [
            'orders' => $user->orders()->get()
        ]); */
        return redirect('/orders/active');
    }

    public function showByStatus($status) {
        $user = Auth::user();
        $orders = $user->orders($status)->get();

        for($i=0; $i<count($orders); $i++) {
            $orders[$i]->opisniStatus=$this->getDescriptionStatus($orders[$i]->status);
        }
        return view('orders', [
            'orders' => $orders
        ]);
    }

    public function showOrder($order_id) {
        $user = Auth::user();
        $order = $user->orders()->get()->find($order_id);
        $order->opisniStatus=$this->getDescriptionStatus($order->status);

        return view('order', [
            'order' => $order
        ]);
    }

    public function invoice() {
        $user = Auth::user();
        $order = $user->shoppingCart();

        return view('invoice', [
            'order' => $order
        ]);
    }
}
