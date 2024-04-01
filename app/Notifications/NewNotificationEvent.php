<?php

namespace App\Notifications;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNotificationEvent extends Notification
{
    use Queueable;
public  $event;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($event)
    {
      $this->events = $event;
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


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
   


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title'=>$this->events['title'],
            'created_at' => now()->diffForHumans(),
        ];
    }
}
