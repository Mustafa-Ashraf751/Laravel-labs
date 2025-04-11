<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample users with consistent data
        $users = [
            [
                'name' => 'Ahmed',
                'email' => 'ahmed@gmail.com',
                'password' => Hash::make('password1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mohamed',
                'email' => 'mohamed@gmail.com',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ali',
                'email' => 'ali@gmail.com',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mustafa',
                'email' => 'mustafa@gmail.com',
                'password' => Hash::make('password4'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hassan',
                'email' => 'hassan@gmail.com',
                'password' => Hash::make('password5'),
                'created_at' => now(),
                'updated_at' => now(),

            ]
        ];

        // Insert all users
        DB::table('users')->insert($users);
    }
}
