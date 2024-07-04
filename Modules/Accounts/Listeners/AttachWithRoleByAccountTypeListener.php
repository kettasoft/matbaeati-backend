<?php

namespace Modules\Accounts\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Accounts\Events\Registered;

class AttachWithRoleByAccountTypeListener
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
    public function handle(Registered $event): void
    {
        $account = $event->account;

        $account->addRole($account->type);
    }
}
