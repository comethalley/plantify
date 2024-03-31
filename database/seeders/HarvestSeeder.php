<?php

namespace Database\Seeders;

use App\Models\Harvest;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HarvestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('harvests')->insert([
            ['amount' => 150.50, 'month' => 'January'],
            ['amount' => 110.50, 'month' => 'February'],
            ['amount' => 50, 'month' => 'March'],
            ['amount' => 70, 'month' => 'April'],

            // ... More seed data
        ]);
    }
     
}