<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ToolsAvailableNotification extends Notification
{
    use Queueable;

    protected $tool;

    public function __construct($tool)
    {
        $this->tool = $tool;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'tool_id' => $this->tool->id,
            'message' => 'The tool ' . $this->tool->name . ' is now available.',
        ];
    }
   
}
