<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use \App\Product;
use \App\Http\Controllers\Controller;

class ProductsController extends Controller
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
        $prods = Product::where(["status" => "active"])->get();   
        foreach($prods as $p)
        {
            $p->setAppends(['rating']);
        }
        return $prods;
    }

    public function show(Request $req, $product_id)
    {
        $p = Product::find($product_id);
        $p->setAppends(['rating']);
        return $p;
    }

    public function mostWanted(Request $req, $n = 5){
        return Product::mostWanted($n);
    }

    public function topRated(Request $req, $n = 5) {
        return Product::topRated($n);
    }




}
