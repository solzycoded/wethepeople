<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\AdminPostController;

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController; 

use App\Http\Controllers\NewsletterController;

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
// ADMIN
Route::middleware('can:admin')->group(function(){
    // DASHBOARD
    // Route::get('/admin', [AdminPostController::class, 'index']);

    // POSTS
    Route::get('/admin/posts', [AdminPostController::class, 'index']);
    Route::get('/admin/posts/create', [AdminPostController::class, 'create']);
    Route::post('/admin/posts', [AdminPostController::class, 'store']);
    Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    Route::patch('/admin/posts/{post}', [AdminPostController::class, 'update']);
    Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destroy']);
    
    // CATEGORIES
    Route::get('/admin/categories/create', [AdminCategoryController::class, 'create']);
    Route::post('/admin/categories', [AdminCategoryController::class, 'store']);

    // all of the stuff above, can be replace with THIS
    // Route::resource('/admin/posts', AdminPostController::class)->except('show');
});

// SUBSCRIPTION
Route::post('/newsletter', NewsletterController::class);

// HOME
Route::get('/', [PostController::class, 'index'])->name('home');

// REGISTER & LOGIN
Route::middleware('guest')->group(function(){ 
    // REGISTER
    Route::get('/register', [RegisterController::class, 'create']); // MIDDLEWARE: a piece of logic, that will run, whenever a new request comes in
    Route::post('/register', [RegisterController::class, 'store']);

    // LOGIN
    Route::get('/login', [SessionController::class, 'create']);
    Route::post('/login', [SessionController::class, 'store']);
});

// POSTS
Route::get('/posts/{post:slug}', [PostController::class, 'show']);
Route::post('/posts/{post:slug}/comment', [PostCommentsController::class, 'store']);

// LOGOUT
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');