<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\PostTag;

class PostTagController extends Controller
{
    // CREATE
    public function store($postId, $tagIds){
        if(count($tagIds) > 0){
            foreach ($tagIds as $tagId) {
                $this->storeTag($postId, $tagId);
            }
    
            // delete
            $this->destroy($tagIds, $postId);
        }
    }

    private function storeTag($postId, $tagId){
        PostTag::firstOrCreate(
            [
                'post_id' => $postId,
                'tag_id' => $tagId
            ]
        );
    }

    // DELETE
    private function destroy($tagIds, $postId){
        PostTag::whereNotIn('tag_id', $tagIds)
            ->where('post_id', $postId)
            ->delete();
    }
}
