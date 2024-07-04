<?php

namespace Modules\Chats\Listeners;

use Modules\Accounts\Entities\Account;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Chats\Events\SendMessageEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Chats\Notifications\SendNewMessageNotification;

class BroadcastingMessageToOtherParty
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMessageEvent $event): void
    {
        /**
         * @var Account
         */
        $account = $event->chat->recevier;

        $account->notify(new SendNewMessageNotification($event->chat));
    }
}
