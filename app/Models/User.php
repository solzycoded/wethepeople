<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'username',
    //     'password',
    // ];

    protected $table = 'users';
    protected $guarded = [];

    protected $with = ['followers', 'bookmarks'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // MUTATOR
    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

    // CHILD: post
    public function posts(){
        return $this->hasMany(Post::class);
    }

    // CHILD: followers
    public function followers(){ // all of the people that have followed a particular user
        return $this->hasMany(Follower::class, 'followee_id');
    }

    public function followees(){ // of the the people a particular user have followed
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function bookmarks(){
        return $this->hasMany(Bookmark::class);
    }

    // SCOPES
    public function scopeFollowing($query, $followerId){
        return $this->parametersExists($query, 
            $followerId, 
            'followers', 
            ['one' => 'follower_id', 'two' => 'followee_id']
        );
    }

    public function scopeSavedPost($query, $postId){
        return $this->parametersExists($query, 
            $postId, 
            'bookmarks', 
            ['one' => 'post_id', 'two' => 'user_id']
        );
    }

    // OTHERS
    protected function parametersExists($query, $value, $table, $columns){
        return $query->when($value ?? false, 
            fn($query, $value) => 
                $query->whereHas($table, 
                    fn($query) => $query
                            ->where($columns['one'], $value)
                            ->where($columns['two'], $this->id)
            )
        )->exists();
    }
}