<?php

namespace Modules\Subscriptions\Events;

use Illuminate\Queue\SerializesModels;

class WhenAttachSubscriptionWithAccountEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should be broadcast on.
     */
    public function broadcastOn(): array
    {
        return [];
    }
}
