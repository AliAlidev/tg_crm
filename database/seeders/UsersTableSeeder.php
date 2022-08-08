<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // // admin
        // User::updateOrCreate(
        //     [
        //         'email' => "me@alifouad91.com"
        //     ],
        //     [
        //         'name' => 'ali fouad',
        //         'email' => "me@alifouad91.com",
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('QAZxSwdtr'), // password
        //         'role_id' => '1'
        //     ]
        // );

        // admin
        User::updateOrCreate(
            [
                'email' => "admin@start-tech.ae"
            ],
            [
                'name' => 'admin',
                'email' => "admin@start-tech.ae",
                'email_verified_at' => now(),
                'password' => Hash::make('v4Y5AehKd'), // password
                'role_id' => '1'
            ]
        );

        // // agnet
        User::updateOrCreate(
            [
                'email' => "Rita@start-tech.ae"
            ],
            [
                'name' => 'Rita',
                'email' => "Rita@start-tech.ae",
                'email_verified_at' => now(),
                'password' => Hash::make('12345'), // password
                'role_id' => '3'
            ]
        );

        // agnet
        User::updateOrCreate(
            [
                'email' => "Yara@start-tech.ae"
            ],
            [
                'name' => 'Yara',
                'email' => "Yara@start-tech.ae",
                'email_verified_at' => now(),
                'password' => Hash::make('123456'), // password
                'role_id' => '3'
            ]
        );

        // // agnet
        // User::updateOrCreate(
        //     [
        //         'email' => "Mohamad@start-tech.ae"
        //     ],
        //     [
        //         'name' => 'Mohamad',
        //         'email' => "Mohamad@start-tech.ae",
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('5F342Deqw'), // password
        //         'role_id' => '3'
        //     ]
        // );

        // consultant agent
        // User::updateOrCreate(
        //     [
        //         'email' => "Dhia.B@wowproperties.ae"
        //     ],
        //     [
        //         'name' => 'Dhiaeddine Bourezg',
        //         'email' => "Dhia.B@wowproperties.ae",
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('V8X7aRWjG'), // password
        //         'role_id' => '2,3'
        //     ]
        // );
    }
}
