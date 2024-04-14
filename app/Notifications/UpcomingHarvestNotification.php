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
        $formattedDate = date('F jS, Y', strtotime($this->plantName->end));
        
        return [
            'message' => 'Soon to be harvested: ' . $this->plantName->title . ' on ' . $formattedDate,
            'created_at' => now()->diffForHumans(),
        ];
    }
}
