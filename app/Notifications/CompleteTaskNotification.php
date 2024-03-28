<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompleteTaskNotification extends Notification
{
    use Queueable;

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

            'message' => 'Your task is completed ',
        ];
    }
}
