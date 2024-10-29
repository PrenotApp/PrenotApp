<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use MailerSend\MailerSend;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Mail::extend('mailersend', function () {
            return new MailerSend([
                'api_key' => env('MAILERSEND_API_KEY'),
            ]);
        });
    }
}
