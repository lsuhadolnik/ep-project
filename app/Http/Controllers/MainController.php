<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Product;

use \App\Http\Controllers\Controller;

class MainController extends Controller
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
    public function show()
    {
        return view('index', [
            'products' => Product::all(),
            'topProducts' => Product::topRated(5)
        ]);
    }


}
