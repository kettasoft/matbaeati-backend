<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Modules\Accounts\Events\Registered;
use Modules\Chats\Events\SendMessageEvent;
use Modules\Accounts\Listeners\AttachWithRoleByAccountTypeListener;
use Modules\Chats\Listeners\BroadcastingMessageToOtherParty;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AttachWithRoleByAccountTypeListener::class
        ],

        SendMessageEvent::class => [
            BroadcastingMessageToOtherParty::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
