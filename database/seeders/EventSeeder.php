<?php

namespace Database\Seeders;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    Event::create([
        'title' => 'Sample Event',
        'start' => now()->addDays(3),
        'end' => now()->addDays(5),
    ]);
}
}
