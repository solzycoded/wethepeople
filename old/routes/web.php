<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\AdminPostController;

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TagController as AdminTagController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController; 

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Auth\FollowerController;
use App\Http\Controllers\Auth\BookmarkController as AuthBookmarkController;
use App\Http\Controllers\BookmarkController;

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
    Route::get('/admin/categories', [AdminCategoryController::class, 'index']);
    Route::get('/admin/categories/create', [AdminCategoryController::class, 'create']);
    Route::post('/admin/categories', [AdminCategoryController::class, 'store']);
    Route::get('/admin/categories/{category}/edit', [AdminCategoryController::class, 'edit']);
    Route::patch('/admin/categories/{category}', [AdminCategoryController::class, 'update']);
    Route::delete('/admin/categories/{category}', [AdminCategoryController::class, 'destroy']);

    // TAGS
    Route::get('/admin/tags', [AdminTagController::class, 'index']);
    Route::get('/admin/tags/create', [AdminTagController::class, 'create']);
    Route::post('/admin/tags', [AdminTagController::class, 'store']);
    Route::get('/admin/tags/{tag}/edit', [AdminTagController::class, 'edit']);
    Route::patch('/admin/tags/{tag}', [AdminTagController::class, 'update']);
    Route::delete('/admin/tags/{tag}', [AdminTagController::class, 'destroy']);

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

// FOLLOW or UNFOLLOW AUTHOR
Route::post('/follow-author', [FollowerController::class, 'update'])->middleware('auth');

// BOOKMARK
Route::post('/bookmark-post', [AuthBookmarkController::class, 'update'])->middleware('auth');
Route::get('/bookmarks', [BookmarkController::class, 'index']);

// LOGOUT
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

// WILL REMOVE SOON
// Route::get('/new-post-alert', function(){
//     $post = \App\Models\Post::join('users', 'users.id', 'posts.user_id')->firstWhere('username', 'solzy');

//     return view('admin.posts.mail.new-post')->with([
//         'title' => $post->title,
//         'excerpt' => $post->excerpt,
//         'slug' => $post->slug,
//         'author' => $post->author
//     ]);
// });