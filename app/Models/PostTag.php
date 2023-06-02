<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;
    
    // CHILD OF
    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }

    // RELATIONS
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }
}
