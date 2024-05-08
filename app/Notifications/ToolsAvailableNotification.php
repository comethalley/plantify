<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ToolsAvailableNotification extends Notification
{
    use Queueable;
    protected $requestItem;

    public function __construct($requestItem)
    {
        $this->requestItem = $requestItem;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'request_id' => $this->requestItem->id,
            'message' => 'The status of your request has been updated to ' . $this->requestItem->status,
        ];
    }
   
}
