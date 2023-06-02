<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    // PARENT: category, CHILD: post
    public function posts(){
        return $this->hasMany(Post::class);
    }    

    // DELETE relations
    public function delete() {
        $this->posts()->delete();
        parent::delete();
    }

    // SCOPES
    public function scopeSlug($query, $name){
        return $this->createSlug($query, $name);
    } 

    protected function createSlug($query, $name, $slug = ""){
        $slug = Str::slug($name . $slug);

        $slugExists = $this->slugExists($query, $slug);
        if($slugExists){
            return $this->createSlug($name, $slug);
        }

        return $slug;
    }

    protected function slugExists($query, $slug): bool{
        $exists = $query->when($slug ?? false, fn($query, $slug) => 
            $query->where(fn($query) => 
                $query->where('slug', 'like', '%' . $slug)
            )
        )->exists();

        return $exists;
    }
}
