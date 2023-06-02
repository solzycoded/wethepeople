<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $guarded = ['id'];

    protected $with = ['category', 'author'];

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
    
    // DELETE relations
    public function delete() {
        $this->posts()->comments();
        $this->posts()->postTags();
        parent::delete();
    }

    // CHILD OF
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }   

    // PARENT TO
    public function comments(){
        return $this->hasMany(Comment::class);
    }   

    // PARENT TO
    public function postTags(){
        return $this->hasMany(PostTag::class);
    }

    // scopes
    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, fn($query, $search) => 
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            )
        ); 

        $query->when($filters['category'] ?? false, 
            fn($query, $category) => 
                $query->whereHas('category', 
                    fn($query) => 
                        $query->where('slug', $category)
            )
        );

        $query->when($filters['author'] ?? false, 
            fn($query, $author) => 
                $query->whereHas('author', 
                    fn($query) => 
                        $query->where('username', $author)
            )
        );
    }     
}
