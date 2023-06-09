<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $with = ['postTags'];

    // PARENT TO
    public function postTags(){
        return $this->hasMany(PostTag::class);
    }
    
    // DELETE relations
    public function delete() {
        $this->postTags()->delete();
        parent::delete();
    }

    // SCOPES
    public function scopeTagExists($query, $postId){ // i'm likely going to change this, later... i think there's a better way to do it
        return $query->when($postId ?? false,
            fn($query, $postId) => 
                $query->whereHas('postTags', 
                    fn($query) => 
                        $query->where('post_id', $postId)
                            ->where('tag_id', $this->id)
            )
        )->exists();
    }
}
