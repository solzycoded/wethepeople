<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;
    
    // protected $with = ['tag'];

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

    // SCOPES
    // public function scopeTagExists($query, $tagId){
    //     return $query->when($tagId ?? false, fn($query, $tagid) => 
    //         $query->where('tag_id', $tagid)
    //     )->exists();
    // }
}