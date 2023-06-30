<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

use App\Models\Tag;

class TagController extends Controller
{
    // CREATE
    public function create(){
        return view('admin.tags.create');
    }

    public function store(){
        $attributes = $this->validateInput();
        
        Tag::create($attributes);

        return redirect('/admin/tags')
            ->with('success', 'Tag (' . $attributes['name'] . ') Created, successfully!');; // this will change, LATER
    }
    
    // READ
    public function index(){
        return view('admin.tags.index', [
            'tags' => Tag::orderBy('name')->get() 
        ]);
    }

    // UPDATE
    public function edit(Tag $tag){
        return view(
            'admin.tags.edit',
            [
                'tag' => $tag
            ]
        );
    }

    public function update(Tag $tag){
        $attributes = $this->validateInput($tag);
        
        $tag->update($attributes);

        return back()->with('success', 'Tag Updated!');
    }

    // DELETE
    public function destroy(Tag $tag){
        $name = $tag->name;
        $tag->delete();

        return back()->with('success', 'Tag #' . $name . ' Deleted, successfully!');
    }

    // OTHERS
    protected function validateInput(?Tag $tag = null): array{
        $tag ??= new Tag();

        $attributes = request()->validate([
            'name' => [
                'bail', 
                'required', 
                'max:100',
                Rule::unique('tags', 'name')->ignore($tag)
            ]
        ]);
        $attributes['slug'] = $this->slug($attributes['name'], $tag);

        return $attributes;
    }
}
