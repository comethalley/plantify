<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notification;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use App\Notifications\UpcomingEventNotification;
class CheckUpcomingEvents extends Command
{ 
    protected $signature = 'notify:upcoming-events';

    protected $description = 'Notify if there are upcoming events in the calendar';

    public function handle()
    {
        $today = Carbon::today();
        $notificationDays = [1, 3, 5]; // Days before harvest to send notification
        $notificationDates = array_map(function($days) use ($today) {
            return $today->copy()->addDays($days)->toDateString();
        }, $notificationDays);
     
        $upcomingevents = Event::where('status', 1)
        ->whereIn('start', $notificationDates)->get();
            $users = User::all();
            
            foreach ($users as $user) {
                foreach ($upcomingevents as $events) {
                    $user->notify(new UpcomingEventNotification($events));
                }
            }
            
            }
}
