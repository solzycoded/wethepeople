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
}
