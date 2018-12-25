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
        $this->middleware('auth');
    }

    public function setStatus($order_id, $status) {
        Order::find($order_id)->changeStatus($status);
        return redirect('/order');
    }

    public function getDescriptionStatus($status) {
        switch($status) {
            case('active'):
                return "Oddano, čaka na pregled";
            case('fullfilled'):
                return "Potrjeno";
            case('cancelled'):
                return "Preklicano";

        }
    }

    public function show() {
        $user = Auth::user();


        return view('orders', [
            'orders' => $user->orders()->get()
        ]);
    }

    public function showByStatus($status) {
        $user = Auth::user();


        return view('orders', [
            'orders' => $user->orders($status)->get()
        ]);
    }

    public function showOrder($order_id) {
        $user = Auth::user();


        return view('order', [
            'order' => $user->orders()->get()->find($order_id)
        ]);
    }
}
