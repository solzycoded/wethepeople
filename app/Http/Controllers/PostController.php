<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    // read
    public function index(){
        // request()->only('search');
        
        $posts = Post::latest()
            ->filter(request(['search', 'category', 'author']))
            ->paginate(1)->withQueryString(); 

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post){ 
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
