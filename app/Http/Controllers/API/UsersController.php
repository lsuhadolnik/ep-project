<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \App\Order;
use \App\User;

use \App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    
    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function showMe()
    {
        return Auth::user();
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function updateMe(Request $request)
    {
        $user = Auth::user();
        if(!$user){
            $user->update($request->all());
            return response()->json($user, 200);
        }
        return ["message" => "Uporabnik ni prijavljen ali ne obstaja."];
    }

    public function update(Request $request, User $user)
    {
        $user->update($user->all());
        return response()->json($user, 200);
    }

    public function delete(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function rateProduct(Request $request, $product)
    {
        $data = $request->all();
        if(isset($data['rating']) && !empty($data['rating']))
        {
            $resp = Auth::user()->rateProduct($product, $data['rating']);
            return response()->json(["status" => $resp], 200);
        }
        return response()->json(["status"=>"Napaka. Prosim podaj oceno v telesu zahtevka."], 400);
    }

    public function getRating(Request $request, $product)
    {
        $r = Auth::User()->getRating($product);
        return response()->json($r);
    }

    public function shoppingCart(Request $request) 
    {
        $user = Auth::user();
        $s = $user->shoppingCart();
        $s->setHidden([]);
        $s->setVisible(["id", "status", "updated_at", "products", "totalPrice"]);
        
        return response()->json($s->append("products")->toArray());
    }

    public function modifyOrderProduct(Request $request, $product_id) 
    {
        $data = $request->all();
        if(isset($data['quantity']) && !empty($data['quantity']))
        {
            $quantity = $data['quantity'];
            $resp = Auth::user()->shoppingCart()->modifyOrderProduct($product_id, $quantity);
            return response()->json($resp, 200);
        }
        return response()->json(["status"=>"Napaka. Prosim podaj količino v telesu zahtevka."], 400);
    }

    public function deleteOrderProduct(Request $req, $product_id){

        $resp = Auth::user()->shoppingCart()->modifyOrderProduct($product_id, -1);
        return response()->json($resp, 200);

    }

    public function getOrders(Request $req)
    {
        // - **GET /api/user/orders** (HTTPS, AUTH) Pregled naročil uporabnika
        return Order::where(["user_id" => Auth::user()->id])->get();
    }

    public function getOrderProducts(Request $req, $order_id)
    {

        $order = Order::where(["id" => $order_id, "user_id"=> Auth::user()->id])->first();
        if(!$order)
        {
            return [];
        }

        $products = $order->products;
        return response()->json($products);
    }

    public function submitShoppingCart(Request $req) {

        if(!Auth::user()->shoppingCart()->id)
            return ["status" => "V košarici ni nobenega artikla."];

        return Auth::user()->shoppingCart()->changeStatus('active');
    }

}
