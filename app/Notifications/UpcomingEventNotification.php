<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class UpcomingEventNotification extends Notification 
{
    use Queueable;

    protected $events;

    public function __construct($events)
    {
        $this->event = $events;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

 
    public function toArray($notifiable)
    {
        $formattedDate = date('F jS, Y', strtotime($this->event->start));
        return [
            
            'message' => 'Get ready for our upcoming event happening' . ' on ' .   $formattedDate,
            'created_at' => now()->diffForHumans(),
        ];
    }
}
