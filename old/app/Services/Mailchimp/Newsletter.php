<?php 

namespace App\Services\Mailchimp;

use App\Services\Newsletter as NewsletterInterface;

use MailchimpMarketing\ApiClient;

class Newsletter implements NewsletterInterface
{
    public function __construct(protected ApiClient $client){
        // 
    }

    public function subscribe(string $email, string $list = null){
        $mailchimp = $this->client;
        $list ??= config('services.mailchimp.lists.subscribers');
        
        $response = $mailchimp->lists->addListMember($list, [
            'email_address' => $email,
            'status'        => 'subscribed' 
        ]);

        return $response;
    }
}


