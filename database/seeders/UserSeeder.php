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

        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'remember_token' => Str::random(20),
                'level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'bambang',
                'email' => 'bambang@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('bambang123'),
                'remember_token' => Str::random(20),
                'level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'raisa',
                'email' => 'raisa4321@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('raisa1234'),
                'remember_token' => Str::random(20),
                'level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'syahroni',
                'email' => 'syahroni@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('syahroni123'),
                'remember_token' => Str::random(20),
                'level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ani',
                'email' => 'ani1234@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('ani1234ani123'),
                'remember_token' => Str::random(20),
                'level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        // Insert data menggunakan DB facade
        DB::table('users')->insert($users);
    }
}
