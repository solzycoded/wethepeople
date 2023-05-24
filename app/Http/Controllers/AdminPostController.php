<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Post;
use App\Models\Category;

class AdminPostController extends Controller
{
    // CREATE
    public function create(){
        return view('admin.posts.create')
            ->with(['categories' => $this->categoryIndex()]);
    }

    public function store(){
        $attributes = $this->validateInput();

        // $attributes['slug'] = Str::slug($attributes['title']); // create a slug, from title
        $attributes['user_id'] = auth()->user()->id; // get the user id, of the currently logged in user 
        $this->storeThumbnail($attributes); // store thumbnail

        Post::create($attributes);

        return redirect('/');
    }

    private function categoryIndex(){
        return Category::orderBy('name')->get();
    }

    public function validateInput($slug = 'bail|required|unique:posts,slug'){
        $attributes = request()->validate([
            'title'       => 'bail|required',
            'slug'        => $slug,
            'thumbnail'   => 'bail|image', // it's retreiving the file properties from the "file input" tag
            'excerpt'     => 'nullable|required',
            'body'        => 'bail|required',
            'category_id' => 'bail|required|integer|exists:categories,id'
        ]);

        return $attributes;
    }

    private function storeThumbnail(&$attributes){
        if(isset($attributes['thumbnail'])){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails'); // store file, in "thumbnails" folder and return the file path
        }
    }

    // READ
    public function index(){
        return view('admin.posts.index', [
            'posts' => Post::orderBy('title')->paginate(50)
        ]);
    }

    // UPDATE
    public function edit(Post $post){
        return view(
            'admin.posts.edit',
            [
                'post' => $post,
                'categories' => $this->categoryIndex()
            ]
        );
    }

    public function update(Post $post){
        $slug = ['required', Rule::unique('posts', 'slug')->ignore($post->id)];
        $attributes = $this->validateInput($slug);
        $this->storeThumbnail($attributes); // store thumbnail (DELETE THE PREVIOUS IMAGE, FROM THE DIRECTORY... IF A PREVIOUS IMAGE, EXISTS)
        
        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    // DELETE
    public function destroy(Post $post){
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }
}
