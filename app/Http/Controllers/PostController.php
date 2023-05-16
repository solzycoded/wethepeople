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
        

        $attributes = request()->validate([
            'title'       => 'bail|required',
            'slug'        => 'bail|required|unique:posts,slug',
            'thumbnail'   => 'bail|required|image', // it's retreiving the file properties from the "file input" tag
            'excerpt'     => 'nullable|required',
            'body'        => 'bail|required',
            'category_id' => 'bail|required|integer|exists:categories,id'
        ]);

        // $attributes['slug'] = Str::slug($attributes['title']); // create a slug, from title
        $attributes['user_id'] = auth()->user()->id; // get the user id, of the currently logged in user 
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails'); // store file, in "thumbnails" folder and return the file path

        Post::create($attributes);

        return redirect('/');
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
