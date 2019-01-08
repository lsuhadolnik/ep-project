<?php

namespace App\Http\Controllers;

use Auth;
use \App\Order;
use \App\Product;
use \App\User;
use \App\Producer;
use \App\Login;
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
        //$this->middleware(['auth', 'https', 'cert']);
    }

    public function show() {
        return view('management-dir');
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

    public function showOrder($order_id) {
        $order = Order::find($order_id);
        $order->opisniStatus=$this->getDescriptionStatus($order->status);
        return view('order', [
            'order' => $order
        ]);
    }

    public function showByStatus($status) {
        $orders = Order::where('status', $status)->get();
        for($i=0; $i<count($orders); $i++) {
            $orders[$i]->opisniStatus=$this->getDescriptionStatus($orders[$i]->status);
        }
        return view('orders', [
            'orders' => $orders
        ]);
    }

    public function setStatus($order_id, $status) {
        Order::find($order_id)->changeStatus($status);
        return redirect('/secure/orders/active');
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
        

        

        return redirect('/secure/products');
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

        return redirect('/secure/products');
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
            $users = User::whereIn('role_id', [2,3])->get(); 
        }
        return view('users', [
            "users" => $users
        ]);
        
    }

    public function userChangeStatus($id) {
        $user = User::find($id);

        if(Auth::user()->role_id < $user->role_id) {
            if($user->status == "active") {
                $user->status = "disabled";
            } else {
                $user->status="active";
            }
            
            $user->save();
        }
        
        
        return redirect('/secure/users');
    }

    public function showUser($id)
    {
        $user = User::find($id);
        if(Auth::user()->role_id < $user->role_id) {
            return view('profile', [
                'user' => $user
            ]);
        }
        else {
            return redirect('/secure/users');
        }
        
        
    }

    public function updateUser(Request $request, $user_id) {
        
        $name = $request->input('name');
        $surname = $request->input('surname');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $postal_code = $request->input('postal');


        $data = $request->validate([
            'name' => 'required|max:255',
            'surname' => 'nullable|max:255',
            'phone' => 'nullable|regex:/[0-9]+/',
            'address' => 'nullable|string|max:255',
            'postal' => 'nullable|exists:postal_codes,id',
        ]);

        $user = User::find($user_id);

        if(Auth::user()->role_id < $user->role_id) {
            $user->name = $name;
            $user->surname = $surname;
            $user->phone = $phone;
            $user->address = $address;
            $user->postal_code = $postal_code;
            

            $user->save();
        }

        

        return redirect('/secure/users');

    }

    public function changeRole(Request $request, $user_id) {

        if(Auth::user()->role_id == 1) {
            $user = User::find($user_id);
            $role = $request->input('role');
            $user->setRole($role);
            $user->save();

            return redirect('/secure/user/'.$user_id)->with([
                'message' => "Vloga je bila uspešno spremenjena"
            ]);
        } 
        else {
            return redirect('/secure/users');
        }
        
    }

    public function productChangeStatus($id) {
        $product = Product::find($id);
        if($product->status == "active") {
            $product->status = "disabled";
        } else {
            $product->status="active";
        }
        
        $product->save();
        
        return redirect('/secure/products');
    }

    public function createUserForm() {
        return view('create-user-form');
    }

    public function createUser(Request $request) {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');


        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $u = new User();
        $u->name = $name;
        $u->email = $email;
        $u->password = $password;

        $role_id = 3;
        if(Auth::user()->role_id == 1) {
            if($role == "Prodajalec") {
                $role_id = 2;
            } 
        } 
        $u->role_id = $role_id; 
        $u->save();

        return redirect('/secure/users');
    }

    public function logs() {
        $logs = Login::all();
        for($i=0; $i<count($logs); $i++) {
            $logs[$i]->user = User::find($logs[$i]->user_id);
        }
        if(Auth::user()->role_id == 1) {
            return view('logs',  [
                "logs" => $logs
            ]);
        }
        else {
            return redirect('/secure/management');
        }
    }

    
}
