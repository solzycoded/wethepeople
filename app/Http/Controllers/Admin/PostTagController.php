<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\PostTag;

class PostTagController extends Controller
{
    // CREATE
    public function store($postId, $tagIds){
        // YOU MIGHT NEED TO delete a POSTTAG

        foreach ($tagIds as $tagId) {
            $this->storeTag($postId, $tagId);
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
}
