<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTaskAssignNotification extends Notification
{
    use Queueable;

    use Queueable;
    public  $tasks;
  
    public function __construct($tasks)
    {
      $this->task = $tasks;
    }

   
    public function via($ntoifiable)
    {
        return ['database','broadcast'];
    }

    public function toArray($notifiable)
    {
        return [

            'message' => 'You have new task assign ',
        ];
    }
}
