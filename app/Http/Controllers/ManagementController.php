<?php

namespace App\Http\Controllers;

use Auth;
use \App\Order;
use \App\Product;
use \App\User;
use \App\Producer;
use App\Image as Image2;

use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class ManagementController extends Controller
{
    private $photos_path;
 
    public function __construct() {
        $this->photos_path = public_path('/images');
        $this->middleware('auth');
    }

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

        /* photos */

        $photos = $request->file('file');
 
        if ($photos) {
           if (!is_array($photos)) {
                $photos = [$photos];
            }
    
            if (!is_dir($this->photos_path)) {
                mkdir($this->photos_path, 0777);
            }
    
            for ($i = 0; $i < count($photos); $i++) {
                $photo = $photos[$i];
                $name = sha1(date('YmdHis') . str_random(30));
                $save_name = $name . '.' . $photo->getClientOriginalExtension();
                $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
    
                Image::make($photo)
                    ->resize(250, null, function ($constraints) {
                        $constraints->aspectRatio();
                    })
                    ->save($this->photos_path . '/' . $resize_name);
    
                $photo->move($this->photos_path, $save_name);

                $image = new Image2();
                $image->name = $save_name;
                $image->path = '/images/'.$save_name;
                $image->save();

                $product->images()->attach($image->id); 
            } 
        }
        

        

        return redirect('/management/products');
    }

    public function showUpdateProduct($id) {
        return view('update-product', [
            'product' => Product::find($id),
            'producers' => Producer::all()
        ]);
    }

    public function updateProduct($product_id, Request $request) {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1023',
            'producer' => 'required|max:255',
            'price' => 'required|numeric'
        ]);

        $product = Product::find($product_id);
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

        /* photos */

        $photos = $request->file('file');
 
        if ($photos) {
           if (!is_array($photos)) {
                $photos = [$photos];
            }
    
            if (!is_dir($this->photos_path)) {
                mkdir($this->photos_path, 0777);
            }
    
            for ($i = 0; $i < count($photos); $i++) {
                $photo = $photos[$i];
                $name = sha1(date('YmdHis') . str_random(30));
                $save_name = $name . '.' . $photo->getClientOriginalExtension();
                $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();
    
                Image::make($photo)
                    ->resize(250, null, function ($constraints) {
                        $constraints->aspectRatio();
                    })
                    ->save($this->photos_path . '/' . $resize_name);
    
                $photo->move($this->photos_path, $save_name);

                $image = new Image2();
                $image->name = $save_name;
                $image->path = '/images/'.$save_name;
                $image->save();

                $product->images()->attach($image->id); 
            } 
        }

        return redirect('/management/products');
    }

    public function deleteImage($product_id, $image_id) {
        $product = Product::find($product_id);
        $product->images()->detach($image_id);
        Image2::find($image_id)->delete();

        return Redirect::back();
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
