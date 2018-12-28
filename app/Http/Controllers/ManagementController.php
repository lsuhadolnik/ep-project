<?php

namespace App\Http\Controllers;

use Auth;
use \App\Order;
use \App\Product;
use \App\User;
use \App\Producer;

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

    public function showProducts() {
        return view('products', [
            'products' => Product::all()
        ]);
    }
    public function showAddProduct() {
        return view('add-product', [
            'producers' => Producer::all()
        ]);
    }
    public function addProduct(Request $request) {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1023',
            'producer' => 'required|max:255',
            'price' => 'required|numeric'
        ]);
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        $producer_name = $request->input('producer');
        $producer = Producer::where('name', $producer_name)->get()->first();
        if( $producer == null) {
            $producer = new Producer();
            $producer->name = $producer_name;
            $producer->save();
        }
        $product->producer_id = $producer->id;
        $product->save();

        return redirect('/management/products');
    }

    public function showUsers() {
        $user = Auth::user();

        $users = User::where('role_id', 3)->get();
        
        if($user->role_id == 1) {
            $users = User::where('role_id', [2,3])->get(); 
        }
        return view('users', [
            "users" => $users
        ]);
        
    }

    public function userChangeStatus($id) {
        $user = User::find($id);
        if($user->status == "active") {
            $user->status = "disabled";
        } else {
            $user->status="active";
        }
        
        $user->save();
        
        return redirect('/management/users');
    }

    public function productChangeStatus($id) {
        $product = Product::find($id);
        if($product->status == "active") {
            $product->status = "disabled";
        } else {
            $product->status="active";
        }
        
        $product->save();
        
        return redirect('/management/products');
    }
}