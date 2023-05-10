<?php 

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter 
{
    public function __construct(protected ApiClient $client){
        // 
    }

    public function subscribe(string $email, string $list = null){ 
        $mailchimp = $this->client();
        $list ??= config('services.mailchimp.lists.subscribers');
        
        $response = $mailchimp->lists->addListMember($list, [
            'email_address' => $email,
            'status'        => 'subscribed' 
        ]);

        return $response;
    }

    public function client(){
        // $mailchimp = new ApiClient();
        $this->client->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us21'
        ]);

        return $mailchimp;
    }
}


