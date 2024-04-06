<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OutOfStockNotification extends Notification
{
    use Queueable;
    protected $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function via($notifiable)
    {
        return ['database']; // Store the notification in the database
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Item ' . $this->item->supplier_seeds_id. ' is out of stock.',
            'created_at' => now()->diffForHumans(),
        ];
    }

}