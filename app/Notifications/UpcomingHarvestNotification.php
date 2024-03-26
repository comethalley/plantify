<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpcomingHarvestNotification extends Notification
{
    use Queueable;

    protected $title;

    public function __construct($title)
    {
        $this->plantName = $title;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
          
            'event_id' => $this->plantName->id,
            'event_name' => $this->plantName->title,
            'message' => 'Upcoming event: ' . $this->plantName->title . ' on ' . $this->plantName->end,
        ];
    }
}
