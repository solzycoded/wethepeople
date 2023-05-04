<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class RegisterController extends Controller
{
    // CREATE
    public function create(){
        return view('account.register.create');
    }

    public function store(){
        // if validation is successful, the validated data, will be saved, as an array
        $attributes = request()->validate([
            'name' => 'required|min:1|max:150',
            'username' => 'required|unique:users,username|min:2|max:50',
            'email' => 'required|unique:users,email|email|min:5|max:120',
            'password' => 'required|min:8|max:255'
        ]);
        
        $user = User::create($attributes); // create the user
        auth()->login($user); // login the user

        return redirect('/')->with('success', 'Your account has been created'); // this is an alternative to session()->flash(message);
    }

    // READ
    // UPDATE
    // DELETE
}
