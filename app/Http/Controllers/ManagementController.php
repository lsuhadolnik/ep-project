<?php

namespace App\Http\Controllers;

use Auth;
use \App\Order;

use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function show() {
        return view('management-dir');
    }

    public function showOrder($order_id) {
        return view('order', [
            'order' => Order::find($order_id)
        ]);
    }

    public function showByStatus($status) {
        return view('orders', [
            'orders' => Order::where('status', $status)->get()
        ]);
    }

    public function setStatus($order_id, $status) {
        Order::find($order_id)->changeStatus($status);
        return redirect('/management/orders/active');
    }
}
