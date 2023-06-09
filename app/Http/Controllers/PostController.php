<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{   
    // CREATE

    // READ
    public function index(){
        $posts = Post::latest()
            ->filter(request(['search', 'category', 'author', 'tag']))
            ->select(['posts.*'])
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
