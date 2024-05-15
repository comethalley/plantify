<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserLoginNotification extends Notification
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $roleName = '';

    switch ($this->user->role_id) {
        case 1:
            $roleName = 'Super Admin';
            break;
        case 2:
            $roleName = 'Admin';
            break;
        case 3:
            $roleName = 'Farmer';
            break;
        case 4:
         $roleName = 'Farmer Leader';
         break;
        // Add more cases for other role_ids as needed
        default:
            $roleName = 'Unknown';
    }

    return [
        'firstname' => $this->user->firstname,
        'lastname' => $this->user->lastname,
        'role_name' => $roleName,
    ];
    }
}
