<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{   
    // CREATE
    public function create(){
        $categories = Category::orderBy('name')->get();
                        
        return view('posts.create')
            ->with(['categories' => $categories]);
    }

    public function store(){
        request()->validate([
            'title' => 'bail|required',
            'excerpt' => 'nullable|required',
            'body' => 'bail|required',
            'category' => 'bail|required|integer|exists:categories,id'
        ]);

        
    }

    // READ
    public function index(){
        // request()->only('search');
        
        $posts = Post::latest()
            ->filter(request(['search', 'category', 'author']))
            ->paginate(9)->withQueryString(); 

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post){ 
        return view('posts.show', [
            'post' => $post
        ]);
    }

    // UPDATE

    // DELETE
}
