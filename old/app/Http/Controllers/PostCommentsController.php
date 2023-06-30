<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostCommentsController extends Controller
{
    // CREATE
    public function store(Post $post){
        // validate
        request()->validate([
            'body' => 'bail|required|string|min:1'
        ]);

        // perform action
        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => request('body')
        ]);

        // re-direct
        return back();
    }

    // READ
    // UPDATE
    // DELETE
}
