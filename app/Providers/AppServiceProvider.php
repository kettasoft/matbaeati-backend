<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Chats\Entities\Chat;
use Modules\Chats\Entities\Observers\ChatObserver;

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
        Chat::observe(ChatObserver::class);
    }
}
