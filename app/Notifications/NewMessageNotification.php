<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Events\NewMessageReceived;

class NewMessageNotification extends Notification
{
    protected $message;
    protected $threadLink;

    public function __construct($message, $threadLink)
    {
        $this->message = $message;
        $this->threadLink = $threadLink;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
        'thread_link' => $this->threadLink,
            // Add any other relevant data
        ];
    }
}
