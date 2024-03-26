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
        $upcomingevents = Event::whereDate('end', '=', Carbon::today()->addDays(3)->toDateString())->get();
            $users = User::all();
            
            foreach ($users as $user) {
                foreach ($upcomingevents as $events) {
                    $user->notify(new UpcomingHarvestNotification($events));
                }
            }
            
            }
}
