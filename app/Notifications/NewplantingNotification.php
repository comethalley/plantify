<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewplantingNotification extends Notification
{
    use Queueable;
    public  $planting;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($planting)
    {
        $this->plantings = $planting;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */

     public function via($ntoifiable)
     {
         return ['database','broadcast'];
     }


    public function toDatabase($planting)
    {
        return [
           
            'title'=>$this->plantings['title']
        ];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            
            'created_at' => now()->diffForHumans(),
        ];
    }
}