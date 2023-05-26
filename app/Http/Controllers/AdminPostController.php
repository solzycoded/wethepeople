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
        $attributes = $this->validateInput(); // validate user input
        $attributes['user_id'] = auth()->user()->id; // get the user id, of the currently logged in user 
        $attributes = $this->storeThumbnail($attributes); // store thumbnail

        Post::create($attributes);

        return redirect('/admin/posts');
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
        $attributes = $this->validateInput($post);
        $attributes = $this->storeThumbnail($attributes); // store thumbnail (DELETE THE PREVIOUS IMAGE, FROM THE DIRECTORY... IF A PREVIOUS IMAGE, EXISTS)
        
        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    // DELETE
    public function destroy(Post $post){
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }

    // OTHERS (MY CUSTOM CODE... to follow DRY)
    private function categoryIndex(){
        return Category::orderBy('name')->get();
    }

    protected function validateInput(?Post $post = null): array{
        $post ??= new Post();

        // create a slug, from title
        // $attributes['slug'] = Str::slug($attributes['title']); 

        $attributes = request()->validate([
            'title'       => ['bail', 'required', Rule::unique('posts', 'title')->ignore($post)],
            'slug'        => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'thumbnail'   => $post->exists ? ['bail', 'image'] : ['bail', 'required', 'image'], // it's retreiving the file properties from the "file input" tag
            'excerpt'     => 'nullable|required',
            'body'        => 'bail|required',
            'category_id' => 'bail|required|integer|exists:categories,id'
        ]);

        return $attributes;
    }

    private function storeThumbnail($attributes){
        if(isset($attributes['thumbnail'])){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails'); // store file, in "thumbnails" folder and return the file path
        }

        return $attributes;
    }
}
