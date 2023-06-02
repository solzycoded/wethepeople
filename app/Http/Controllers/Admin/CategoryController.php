<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
 
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use App\Models\Category;

class CategoryController extends Controller
{
    // CREATE
    public function create(){
        return view('admin.categories.create');
    }
    
    public function store(){
        $attributes = $this->validateInput();
        
        Category::create($attributes);

        return redirect('/admin/categories'); // this will change, LATER
    }

    // READ
    public function index(){
        return view('admin.categories.index', [
            'categories' => Category::orderBy('name')->get()
        ]);
    }

    // UPDATE
    public function edit(Category $category){
        return view(
            'admin.categories.edit',
            [
                'category' => $category
            ]
        );
    }
    
    public function update(Category $category){
        $attributes = $this->validateInput($category);
        
        $category->update($attributes);

        return back()->with('success', 'Category Updated!');
    }

    // DELETE
    public function destroy(Category $category){
        $category->delete();

        return back()->with('success', 'Category Deleted!');
    }
    
    // parent::boot();

    // static::deleting(function($model)
    // {
    //     if ($model->forceDeleting) {
    //         $model->roles()->detach();
    //     }
    // });

    // OTHERS
    protected function validateInput(?Category $category = null): array{
        $category ??= new Category();

        $attributes = request()->validate([
            'name' => [
                'bail', 
                'required', 
                Rule::unique('categories', 'name')->ignore($category)
            ]
        ]);
        $attributes['slug'] = Category::slug($attributes['name']);

        return $attributes;
    }
}