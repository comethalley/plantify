<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ToolsAvailableNotification extends Notification
{
    use Queueable;
    protected $admin;


    public function __construct($request)
    {
        $this->request = $request;
    }
    public function via($notifiable)
    {
        return ['database'];
    }

    // Define the notification message and any additional data
    public function toArray($notifiable)
    {
        return [
            'message' => 'The tools you requested are now available.',
            // Add any additional data you want to include in the notification
        ];
    }
   
}
