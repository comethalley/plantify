<?php

namespace App\Console\Commands;
use App\Models\CalendarPlanting;
use App\Notifications\HarvestTodayNotification;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;

class NotifyHarvestToday extends Command
{
    protected $signature = 'notify:harvest-today';
    protected $description = 'Notify users about harvest happening today.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        
        $todayharvest = CalendarPlanting::whereDate('end', now()->toDateString())
        ->get();
        $users = User::whereIn('role_id', [3, 4])->get();

        foreach ($users as $user) {
            foreach ($todayharvest as $harvest) {
                $user->notify(new HarvestTodayNotification($harvest));
            }
        }
    }
}
