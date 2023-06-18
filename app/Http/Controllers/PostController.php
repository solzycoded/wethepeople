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
            ->filter(
                array_merge(
                    request(['search', 'category', 'author', 'tag']), 
                    ['status' => 'published']
                )
            )
            ->select(['posts.*'])
            ->paginate(9)
            ->withQueryString(); 

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post){ 
        $post->countViews(); // count no of times, this page was viewed

        return view('posts.show', [
            'post' => $post
        ]);
    }

    // UPDATE

    // DELETE
}
