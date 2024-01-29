<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class xfarmseeder extends Seeder
{
    public function run()
    {
        $barangayNames = ['BagBag', 'Capri', 'Fairview', 'Gulod', 'Greater Lagro', 'Kaligayahan', 
        'Nagkaisang Nayon', 'North Fairview', 'Novaliches Proper', 'Pasong Putik Proper', 'San Agustin'
        , 'San Bartolome', 'Sta. Lucia', 'Sta. Monica' ];

        foreach ($barangayNames as $barangayName) {
            DB::table('barangays')->insert([
                'barangay_name' => $barangayName,
            ]);
        }
    }

}
