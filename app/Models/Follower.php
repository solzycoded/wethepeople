<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    
    protected $fillable = ['followee_id', 'follower_id', 'subscribed'];

    // CHILD OF
    public function followee(){
        return $this->belongsTo(User::class, 'followee_id');
    }
    
    public function follower(){
        return $this->belongsTo(User::class, 'follower_id');
    }

    // PARENT TO
    public function followees(){
        return $this->hasMany(User::class, 'followee_id');
    }
    
    public function followers(){
        return $this->belongsTo(User::class, 'follower_id');
    }
}
