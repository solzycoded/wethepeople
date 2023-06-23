<?php

namespace App\Http\Controllers;


class BookmarkController extends Controller
{
    // READ
    public function index(){
        $posts = (new PostController())->posts()
            ->bookmarks(auth()->user()->id)
            ->select(['posts.*'])
            ->paginate(9)
            ->withQueryString();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }
}
