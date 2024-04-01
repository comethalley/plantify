<?php

namespace App\Console\Commands;
use App\Models\Stock;

use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\OutOfStockNotification;
class CheckOutOfStockItems extends Command
{
    protected $signature = 'check:out-of-stock-items';

    protected $description = 'Check for out-of-stock items';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $outOfStockItems = Stock::where('available_seed', '<=', 5)->get();
        $users = User::where('role_id', 3)->get();
        
    
    foreach ($users as $user) {
        foreach ($outOfStockItems as $item) {
            $user->notify(new OutOfStockNotification($item));
        }
    }
   
}
}
