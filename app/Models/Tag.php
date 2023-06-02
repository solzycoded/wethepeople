<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

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
}
