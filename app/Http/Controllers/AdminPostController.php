<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\PostTagController;

use Illuminate\Validation\Rule;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class AdminPostController extends Controller
{
    // CREATE
    public function create(){
        return view('admin.posts.create')
            ->with(
                [
                    'categories' => $this->categoryIndex(),
                    'tags' => Tag::orderBy('name')->get()
                ]
            );
    }

    public function store(){
        $attributes = $this->validateInput(); // validate user input
        $attributes['user_id'] = auth()->user()->id; // get the user id, of the currently logged in user
        $tagIds = $this->getTagIds($attributes);

        $post = Post::create($attributes);

        (new PostTagController())->store($post->id, $tagIds);

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
                'categories' => $this->categoryIndex(),
                'tags' => Tag::orderBy('name')->get()
            ]
        );
    }

    public function update(Post $post){
        $attributes = $this->validateInput($post);
        
        $tagIds = $this->getTagIds($attributes);

        $post->update($attributes);

        // dd($tagIds);

        (new PostTagController())->store($post->id, $tagIds);

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

        $attributes = request()->validate([
            'title'       => ['bail', 'required', Rule::unique('posts', 'title')->ignore($post)],
            'thumbnail'   => $post->exists ? ['bail', 'image'] : ['bail', 'required', 'image'], // it's retreiving the file properties from the "file input" tag
            'excerpt'     => 'nullable|required',
            'body'        => 'bail|required',
            'category_id' => 'bail|required|integer|exists:categories,id',
            'tag_ids' => 'array',
            'tag_ids.*' => 'bail|integer|distinct|exists:tags,id'
        ]);
        $attributes = $this->storeThumbnail($attributes); // store thumbnail (DELETE THE PREVIOUS IMAGE, FROM THE DIRECTORY... IF A PREVIOUS IMAGE, EXISTS)
        $attributes['tag_ids'] = isset($attributes['tag_ids']) ? $attributes['tag_ids'] : []; // set the default attribute of tag_ids, to "[]", if tag_ids isn't set, after validation
        $attributes['slug'] = $this->slug($attributes['title'], $post);

        return $attributes;
    }

    private function storeThumbnail($attributes){
        if(isset($attributes['thumbnail'])){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails'); // store file, in "thumbnails" folder and return the file path
        }

        return $attributes;
    }

    private function getTagIds(&$attributes){
        $tagIds = $attributes['tag_ids'];
        unset($attributes['tag_ids']);

        return $tagIds;
    }
}