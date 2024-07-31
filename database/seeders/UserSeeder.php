<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $faker = Faker::create('id_ID');

        // $domains = ['@gmail.com', '@yahoo.com', '@outlook.com'];

        // for ($i = 0; $i < 50; $i++) {
        //     $email = $faker->unique()->userName . $faker->randomElement($domains);
        //     User::create([
        //         'name' => $faker->name,
        //         'email' => $email,
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'), // Sesuaikan password default
        //         // 'level' => 2,
        //         'remember_token' => Str::random(10),
        //     ]);
        // }

        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'remember_token' => Str::random(20),
                // 'level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // // Insert data menggunakan DB facade
        DB::table('users')->insert($users);

        
    }
}
