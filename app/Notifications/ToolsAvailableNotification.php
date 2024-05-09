<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ToolsAvailableNotification extends Notification
{
    use Queueable;
    protected $status;

    public function __construct($status)
    {
        $this->requestItem = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            
            'message' => 'The status of your request has been updated to ' . $this->requestItem->status,
        ];
    }
   
}
