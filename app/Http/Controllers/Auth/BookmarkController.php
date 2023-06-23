<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\Bookmark;

class BookmarkController extends Controller
{
    // CREATE
    private function store($attributes){
        return Bookmark::firstOrCreate($attributes);
    }

    // UPDATE
    public function update(){
        $attributes = $this->validateInput();

        $saved = false;

        if($attributes['bookmark']){
            unset($attributes['bookmark']);
            $bookmark = $this->store($attributes);
            
            $saved = isset($bookmark->id);
        }
        else{
            $saved = $this->destroy($attributes) ? true : false;
        }

        return response()->json(
            [
                'success' => $saved
            ], 
            200
        );
    }

    // DESTROY
    private function destroy($attributes){
        return Bookmark::where('post_id', $attributes['post_id'])
            ->where('user_id', $attributes['user_id'])
            ->delete();
    }

    // OTHERS
    protected function validateInput(){
        // IF bookmark attribute is "true", set bookmark to 1, ELSE set it to 0
        request()->merge([
            'bookmark' => (request('bookmark')=='true' ? 1 : 0)
        ]);

        // validate attributes
        $attributes = request()->validate([
            'post_id' => 'bail|required|integer|exists:posts,id',
            'bookmark'   => 'bail|required|boolean'
        ]);
        $attributes['user_id'] = auth()->user()->id;

        return $attributes;
    }
}
