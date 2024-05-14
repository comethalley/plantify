<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WaitingForApprovalNotification extends Notification
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
        'message' => 'Your request is currently pending approval.',
        'action_url' => '/instructions',
    ];
}
}
