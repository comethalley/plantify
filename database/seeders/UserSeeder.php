<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $emails = [
            'superadmin@example.com',
            'admin@example.com',
            'farmleader@example.com',
            'farmers@example.com',
            'publicuser@example.com',
        ];

        // Loop through and create users
        foreach ($emails as $index => $email) {
            DB::table('users')->insert([
                'firstname' => Str::random(10),
                'lastname' => Str::random(10),
                'email' => $email,
                'password' => Hash::make('password'),
                'role_id' => $index + 1,
                'email_verified_at' => Date::now(),
                'status' => 1
            ]);
        }
    }
}
