<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserLoginLogoutListener implements ShouldQueue
{
    /**
     * Handle user login events.
     */
    public function onUserLogin(Login $event)
    {
        $user = $event->user;
        \Log::info("User {$user->id} logged in.");  // Add this line
        $user->isOnline = true;
        $user->save();
    }
    
    public function onUserLogout(Logout $event)
    {
        $user = $event->user;
        \Log::info("User {$user->id} logged out.");  // Add this line
        $user->isOnline = false;
        $user->save();
    }

    /**
     * Handle the events.
     *
     * @param  object  $event
     * @return void
     */
    public function __invoke($event)
    {
        if ($event instanceof Login) {
            $this->onUserLogin($event);
        } elseif ($event instanceof Logout) {
            $this->onUserLogout($event);
        }
    }

    /**
     * Register the listeners for the subscriber.
     */
    public function subscribe($events)
    {
        $events->listen(
            Login::class,
            'App\Listeners\UserLoginLogoutListener@onUserLogin'
        );

        $events->listen(
            Logout::class,
            'App\Listeners\UserLoginLogoutListener@onUserLogout'
        );
    }
}