<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReturnedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function via($notifiable)
    {
        return ['database'];
    }
    
    public function toDatabase($notifiable)
{
    return [
        'message' => 'Your request has been returned.',
        'action_url' => '/instructions',
    ];
}
}
