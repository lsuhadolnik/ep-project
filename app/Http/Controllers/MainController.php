<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
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
            'products' => Product::where('status', 'active')->get(),
            'topProducts' => Product::topRated(5)

        ]);
    }

    public function search(Request $request) {
        $query = $request->input('search');
        return view('index', [
            'products' => Product::search($query),
            'topProducts' => Product::topRated(5),
            'message' => "Rezultati iskanja za niz: ".$query
        ]);
    }


}
