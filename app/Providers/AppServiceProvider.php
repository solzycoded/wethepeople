<?php

namespace App\Providers;

// use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

use App\Services\Newsletter as Newsletter; 
use App\Services\Mailchimp\Newsletter as MailchimpNewsletter; 

use MailchimpMarketing\ApiClient;

use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class, function(){        
            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'), 
                'server' => 'us21'
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //  Paginator::useBootstrap();
        Model::unguard();

        Gate::define('admin', function (User $user){
            return ($user->username=='solzy');
        });

        // blade directive
        // Blade::if('admin', function(){
        //     return request()->user()?->can('admin');
        // });
    }
}
