<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Supplyseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tools = [
            'Shovel',
            'Pitchfork',
            'Hoe',
            'Rake',
            'Pruning Shears',
            'Hand Trowel',
            'Gardening Gloves',
            'Wheelbarrow',
            'Hand Cultivator',
            'Pruning Saw',
            'Weeding Tool',
            'Watering Can'
        ];
    
        $seedlings = [
            'Mango Seedlings',
            'Papaya Seedlings',
            'Coconut Seedlings',
            'Banana Seedlings',
            'Pineapple Seedlings',
            'Calamansi Seedlings',
            'Guava Seedlings',
            'Avocado Seedlings',
            'Jackfruit Seedlings',
            'Guyabano Seedlings'
        ];
    
        foreach ($tools as $tool) {
            DB::table('supply_type_tbl')->insert([
                'type' => $tool,
                'supply_id' => '1'
            ]);
        }
    
        foreach ($seedlings as $seedling) {
            DB::table('supply_type_tbl')->insert([
                'type' => $seedling,
                'supply_id' => '2'
            ]);
        }
    }
    
}
