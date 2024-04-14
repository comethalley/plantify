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
        $today = Carbon::today();
$notificationDays = [1, 3, 7]; // Days before harvest to send notification
$notificationDates = array_map(function($days) use ($today) {
    return $today->copy()->addDays($days)->toDateString();
}, $notificationDays);

$upcomingHarvests = CalendarPlanting::whereIn('end', $notificationDates)->get();

    
        $users = User::whereIn('role_id', [3, 4])->get();
    
    foreach ($users as $user) {
        foreach ($upcomingHarvests as $harvest) {
            $user->notify(new UpcomingHarvestNotification($harvest));
        }
    }
    
    $this->info('Upcoming harvests checked.');
    }
}
