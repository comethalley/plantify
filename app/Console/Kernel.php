<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('check:out-of-stock-items')->everyMinute();
        $schedule->command('harvests:check')->everyMinute();
        $schedule->command('notify:upcoming-events')->everyMinute();
    }
    

  
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected $commands = [
        Commands\CheckOutOfStockItems::class,
        Commands\CheckHarvestEvents::class,
        Commands\CheckUpcomingEvents::class,
    ];
    
}
