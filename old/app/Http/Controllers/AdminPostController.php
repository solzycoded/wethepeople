<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\PostTagController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\MailerController;

use Illuminate\Validation\Rule;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Status;
use Illuminate\Mail\Mailer;

class AdminPostController extends Controller
{
    // CREATE
    public function create(){
        return view('admin.posts.create')
            ->with(
                $this->postsData()
            );
    }

    public function store(){
        // $attributes = $this->validateInput(); // validate user input
        // $attributes['user_id'] = auth()->user()->id; // get the user id, of the currently logged in user
        // $tagIds = $this->getTagIds($attributes);

        // $post = Post::create($attributes);

        // $this->updatePublishDate($post->status_id, $post->id);
        // (new PostTagController())->store($post->id, $tagIds);

        // send mail to subscribers of the author, about the recent post
        (new MailerController())->newPostAlert(Post::join('users', 'users.id', 'posts.user_id')->firstWhere('username', 'solzy'));

        return redirect('/admin/posts');
    }

    // READ
    public function index(){
        $posts = Post::orderBy('title')
            ->filter(request(['status']))
            ->paginate(50)
            ->withQueryString(); 

        return view('admin.posts.index', [
            'posts' => $posts
        ]);
    }

    // UPDATE
    public function edit(Post $post){
        return view( 
            'admin.posts.edit',
            array_merge(
                ['post' => $post], 
                $this->postsData()
            )
        );
    }

    public function update(Post $post){
        $attributes = $this->validateInput($post); // validate input and store data
        $tagIds = $this->getTagIds($attributes); // get tag ids

        $post->update($attributes);

        $this->updatePublishDate($post->status_id, $post->id);
        (new PostTagController())->store($post->id, $tagIds); // store posts, with tag

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
            'title'       => ['bail', 'required', 'max:120', 'string', Rule::unique('posts', 'title')->ignore($post)],
            'thumbnail'   => $post->exists ? ['bail', 'image'] : ['bail', 'required', 'image'], // it's retreiving the file properties from the "file input" tag
            'excerpt'     => 'nullable|string',
            'body'        => 'bail|required',
            'category_id' => 'bail|required|integer|exists:categories,id',
            'status_id' => 'bail|required|integer|exists:status,id',
            'tag_ids' => 'array',
            'tag_ids.*' => 'bail|integer|distinct|exists:tags,id'
        ]);
        $attributes = $this->storeThumbnail($attributes); // store thumbnail (DELETE THE PREVIOUS IMAGE, FROM THE DIRECTORY... IF A PREVIOUS IMAGE, EXISTS)
        $attributes['tag_ids'] = isset($attributes['tag_ids']) ? $attributes['tag_ids'] : []; // set the default attribute of tag_ids, to "[]", if tag_ids isn't set, after validation
        $attributes['slug'] = $this->slug($attributes['title'], $post);
        $attributes['excerpt'] = empty($attributes['excerpt']) ? substr($attributes['body'], 0, 20) : $attributes['excerpt'];

        return $attributes;
    }

    private function storeThumbnail($attributes){
        if(isset($attributes['thumbnail'])){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails'); // store file, in "thumbnails" folder and return the file path
        }

        return $attributes;
    }

    private function getTagIds(&$attributes): array{
        $tagIds = $attributes['tag_ids'];
        unset($attributes['tag_ids']);

        return $tagIds;
    }

    private function postsData(): array{
        return [
            'categories' => $this->categoryIndex(),
            'tags' => Tag::orderBy('name')->get(),
            'status' => Status::orderBy('name')->get()
        ];
    }

    private function updatePublishDate($statusId, $postId){
        $isPublished = (new StatusController())->checkStatus($statusId, 'published');

        $post = Post::find($postId);
        $post->published_at = $isPublished ? now() : null;
        $post->save();
    }
}