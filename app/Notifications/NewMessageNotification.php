<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Events\NewMessageReceived;

class NewMessageNotification extends Notification
{
    use Queueable;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @param $reply
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database']; // You can also use other channels like 'mail', 'broadcast', etc.
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message_id' => $this->message->id,
            'message' => 'You have received a new message.'
            // Add any other data you want to pass to the notification
        ];
    }
}
