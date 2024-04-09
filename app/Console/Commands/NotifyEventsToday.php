<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EventTodayNotification;
class NotifyEventsToday extends Command
{
    protected $signature = 'notify:events-today';
    protected $description = 'Notify users about events happening today.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        
        $todayEvents = Event::where('status', 1)
        ->whereDate('start', now()->toDateString())
        ->get();
        $users = User::all();

        foreach ($users as $user) {
            foreach ($todayEvents as $event) {
                $user->notify(new EventTodayNotification($event));
            }
        }
    }
}
