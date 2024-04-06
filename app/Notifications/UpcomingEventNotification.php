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
        return [
            'title' => $this->event->title,
            'message' => 'Are you ready for the event: ' . $this->event->title . ' on ' . $this->event->start,
            'created_at' => now()->diffForHumans(),
        ];
    }
}
