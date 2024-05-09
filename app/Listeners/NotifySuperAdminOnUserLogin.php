<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\UserLoginNotification;

class NotifySuperAdminOnUserLogin implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(Login $event)
    {
        $user = $event->user;

        if (in_array($user->role_id, [2, 3, 4])) {
            $superAdmin = User::where('role_id', 1)->first();

            if ($superAdmin) {
                $superAdmin->notify(new UserLoginNotification($user));
            }
        }
    }
}

