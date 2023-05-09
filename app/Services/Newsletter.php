<?php 

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter 
{
    public function subscribe(string $email){
        $mailchimp = new ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us21'
        ]);
    
        $response = $mailchimp->lists->addListMember(config('services.mailchimp.lists.subscribers'), [
            'email_address' => $email,
            'status'        => 'subscribed'
        ]);

        return $response;
    }
}