<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter){ 
        request()->validate([
            'email' => 'bail|required|email'
        ]);
     
        $email = request('email');
    
        try{
            $newsletter->subscribe($email);
        } catch(\Exception $e){
            throw ValidationException::withMessages([
                'email' => '"' . $email . '" could not be added to our newsletter list.'
            ]);
        }
    
        return back()
            ->with('success', 'You are now signed up, for our newsletter!');
    }
}
