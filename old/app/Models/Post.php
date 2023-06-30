<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $with = ['category', 'author', 'postTags', 'status', 'bookmarks'];

    // i added this, cos i wanted to use the "diffForHumans()" function, in the view for (post)
    protected $dates = ['created_at', 'updated_at', 'published_at'];

    // DELETE relations
    public function delete() {
        $this->comments()->delete();
        $this->postTags()->delete();
        parent::delete();
    }

    // CHILD OF
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }   

    public function status(){
        return $this->belongsTo(Status::class);
    }   

    // PARENT TO
    public function comments(){
        return $this->hasMany(Comment::class);
    }   

    public function postTags(){
        return $this->hasMany(PostTag::class);
    }

    public function bookmarks(){
        return $this->hasMany(Bookmark::class);
    }

    // SCOPES
    public function scopeBookmarks($query, $userId){
        // status
        $this->filterQuery($query, 'bookmarks', $userId ?? false, 'user_id');
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, fn($query, $search) => 
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

        // ?tag=query
        if(isset($filters['tag'])){
            $query->join('post_tags', 'post_tags.post_id', 'posts.id')
                ->join('tags', 'tags.id', 'post_tags.tag_id')
                ->where('tags.slug', $filters['tag']);
        }

        // ?categroy=query
        $this->filterQuery($query, 'category', $filters['category'] ?? false, 'slug');
        // ?author=query
        $this->filterQuery($query, 'author', $filters['author'] ?? false, 'username');
        // status
        $this->filterQuery($query, 'status', $filters['status'] ?? false, 'name');
    }  

    protected function filterQuery($query, $table, $filter, $column){
        return $query->when($filter ?? false, 
            fn($query, $filter) => 
                $query->whereHas($table, 
                    fn($query) => 
                        $query->where($column, $filter)
            )
        );
    }

    // OTHERS
    public function countViews() {
        $this->views_count++;

        return $this->save();
    }
}