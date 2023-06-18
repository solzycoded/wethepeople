<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\Follower;

use App\Services\Phpmailer\Mail;

class FollowerController extends Controller
{
    // CREATE
    private function store($attributes){
        return Follower::firstOrCreate($attributes);
    }

    public function sendMailToSubscribers($userId){
        echo $userId;
    }

    // UPDATE
    public function update(){
        $attributes = $this->validateInput();

        $saved = false;

        if($attributes['follow']){
            unset($attributes['follow']);
            $follower = $this->store($attributes);

            $saved = isset($follower->id);
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
        return Follower::where('follower_id', $attributes['follower_id'])
            ->where('followee_id', $attributes['followee_id'])
            ->delete();
    }

    // OTHERS
    protected function validateInput(){
        $validation =  'bail|required|integer:exists:users,id';

        // IF follow attribute is "true", set follow to 1, ELSE set it to 0
        request()->merge([
            'follow' => (request('follow')=='true' ? 1 : 0)
        ]);
        // validate attributes
        $attributes = request()->validate([
            'follower_id' => $validation,
            'followee_id' => $validation,
            'follow'   => 'bail|required|boolean'
        ]);

        return $attributes;
    }
}