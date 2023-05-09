<?php

use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentsController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController; 

use App\Services\Newsletter; 
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/posts/{post:slug}', [PostController::class, 'show']);
Route::post('/posts/{post:slug}/comment', [PostCommentsController::class, 'store']);

// REGISTER
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest'); // MIDDLEWARE: a piece of logic, that will run, whenever a new request comes in
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

// LOGOUT
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

// LOGIN
Route::get('/login', [SessionController::class, 'create'])->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');


Route::post('/newsletter', function(Newsletter $newsletter){
    request()->validate([
        'email' => 'bail|required|email'
    ]);

    try{
        $newsletter->subscribe(request('email'));
    } catch(\Exception $e){
        throw ValidationException::withMessages([
            'email' => 'This email could not be added to our newsletter list.'
        ]);
    }

    return back()
        ->with('success', 'You are now signed up, for our newsletter!');
});