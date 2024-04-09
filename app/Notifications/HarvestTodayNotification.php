<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HarvestTodayNotification extends Notification
{
    use Queueable;
  

    public $harvest;

    public function __construct($harvest)
    {
        $this->event = $harvest;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            
           
            'message' => 'Veggie Harvest Today! Enjoy Your Homegrown Goodness!',
        ];
    }
}
