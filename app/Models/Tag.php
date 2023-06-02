<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // PARENT TO
    public function postTags(){
        return $this->hasMany(PostTag::class);
    }
}
