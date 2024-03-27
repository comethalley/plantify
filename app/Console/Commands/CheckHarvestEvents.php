<?php

namespace App\Console\Commands;
use App\Models\CalendarPlanting;
use App\Notifications\UpcomingHarvestNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\User;
class CheckHarvestEvents extends Command
{
    protected $signature = 'harvests:check';
    protected $description = 'Check for upcoming harvests and send notifications';

    public function handle()
    {
        $upcomingHarvests = CalendarPlanting::whereDate('end', '=', Carbon::today()->addDays(3)->toDateString())
        ->get();
    
    $users = User::all();
    
    foreach ($users as $user) {
        foreach ($upcomingHarvests as $harvest) {
            $user->notify(new UpcomingHarvestNotification($harvest));
        }
    }
    
    $this->info('Upcoming harvests checked.');
    }
}
