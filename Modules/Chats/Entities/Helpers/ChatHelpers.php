<?php

declare(strict_types=1);

namespace Modules\Chats\Entities\Helpers;

use Illuminate\Http\Request;
use Modules\Chats\Entities\Chat;
use Modules\Accounts\Entities\Account;

trait ChatHelpers
{
    public function sendMessage(Account|int $receiver, Account|int $sender, string $message): self
    {
        /**
         * @var Chat
         */
        $chat = $this;

        return $chat->create([
            'receiver_id' => is_int($receiver) ? $receiver : $receiver->id,
            'sender_id' => is_int($sender) ? $sender : $sender->id,
            'message' => $message
        ]);
    }

    public function sendMessageFromRequest(Request $request): self
    {
        /**
         * @var Chat
         */
        $chat = $this;

        return $chat->create([
            'receiver_id' => $request->receiver_id,
            'sender_id' => $request->sender_id,
            'message' => $request->message
        ]);
    }

    public function read(): bool
    {
        /**
         * @var Chat
         */
        $chat = $this;

        return $chat->updateOrFail([
            'read_at' => now()
        ]);
    }
}
