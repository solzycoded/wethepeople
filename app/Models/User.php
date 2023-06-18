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

    protected $with = ['followers'];

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
    public function followers(){
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function followees(){
        return $this->hasMany(Follower::class, 'followee_id');
    }

    // SCOPES
    public function scopeFollowing($query, $followerId){
        return $query->when($followerId ?? false, 
            fn($query, $followerId) => 
                $query->whereHas('followers', 
                    fn($query) => 
                        $query
                            ->where('follower_id', $followerId)
                            ->where('followee_id', $this->id)
            )
        )->exists();
    }
}
