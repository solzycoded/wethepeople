<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    // CREATE
    public function create(){
        return view('account.login.login');
    }

    public function store(){
        // authentication is failing
        // I don't know what to do...

        $attributes = request()->validate([
            'email' => 'required|email', 
            'password' => 'required'
        ]);

        // check if user exists AND do some stuff
        if(Auth::attempt($attributes)){
            // to prevent an attack, via session
            session()->regenerate();

            return redirect('/')->with('success', 'Welcome Back!');
        }

        // authentication failed
        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified.'
        ]);
    }

    // READ
    
    // UPDATE

    // DELETE
    public function destroy(){
        $name = auth()->user()->name;

        auth()->logout();

        return back()->with('success', 'Goodbye, ' . $name . '!');
    }
}