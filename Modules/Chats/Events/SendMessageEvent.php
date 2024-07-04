<?php

namespace Modules\Chats\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Chats\Entities\Chat;

class SendMessageEvent
{
    use SerializesModels;

    public Chat $chat;

    /**
     * Create a new event instance.
     */
    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }
}
