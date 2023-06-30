<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// use App\Services\Phpmailer\Mail as ;

use Illuminate\Support\Facades\Mail;

use App\Mail\NewPost;

class MailerController extends Controller
{
    public function newPostAlert($post){
        // get all of the followers of the "author of the post"
        $author    = $post->author;
        $followers = $author->followers;
        
        // send a mail to each of them, using the title and excerpt to draw them, to the website.
        foreach ($followers as $value) {
            $follower = $value->follower;

            Mail::to($follower)->send(new NewPost($post));
            // $this->sendMail($follower->email);
        }
    }

    // send mail alert to the subscribers of the author, who just created a new post (as long as it's published)
    private function sendMail($followerEmail){
        // $mail = new Mail($followerEmail, 'new post from "author"', 'testing testing');
        // dd($mail->send());

        // Hi "follower", 
        // One of the authors you follow on "wethepeople", "followee",
        // just published a new post
        // PostTitle
        // Post Excerpt ... // Read the rest, here (link)

        // TASK (design a template)
    }
}
