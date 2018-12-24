<?php

namespace App\Http\Controllers;

use Auth;
use \App\User;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('profile', [
            'user' => Auth::user()
        ]);
        
    }

    public function update(Request $request) {
        
        $name = $request->input('name');
        $surname = $request->input('surname');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $postal_code = $request->input('postal');


        $data = $request->validate([
            'name' => 'required|max:255',
            'surname' => 'nullable|max:255',
            'phone' => 'nullable|integer|min:100000000|max:999999999',
            'address' => 'nullable|string|max:255',
            'postal' => 'nullable|exists:postal_codes,id',
        ]);

        $user = Auth::user();

        $user->name = $name;
        $user->surname = $surname;
        $user->phone = $phone;
        $user->address = $address;
        $user->postal_code = $postal_code;
        

        $user->save();

        return redirect('/profile');

    }
}
