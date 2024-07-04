<?php

namespace Modules\Chats\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Chats\Entities\Chat;

class SendNewMessageNotification extends Notification
{
    use Queueable;

    protected Chat $chat;

    /**
     * Create a new notification instance.
     */
    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['database', 'broadcase'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'id' => $this->chat->id,
            'message' => $this->chat->message,
            'resevier' => $this->chat->receiver_id,
            'sender' => $this->chat->sender_id,
            'read_at' => $this->chat->read_at,
        ];
    }
}
