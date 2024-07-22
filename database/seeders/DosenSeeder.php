<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $faker = Faker::create('id_ID');

        $domains = ['@gmail.com', '@yahoo.com', '@outlook.com'];

        for ($i = 0; $i < 20; $i++) {
            $email = $faker->unique()->userName . $faker->randomElement($domains);

            Dosen::create([
                'nama' => $faker->name,
                'nidn' => $faker->unique()->numerify('##########'),
               'email_dosen' => $email,
            ]);
        }

        // foreach ($users as $user) {
        //     Dosen::create([
        //         'nama' => $user->name,
        //         'nidn' => $faker->unique()->numerify('##########'),
        //         'email_dosen' => $user->email,
        //     ]);
        // }

        // $dosens = [
        //     [
        //         'nidn' => '1234567890',
        //         'nama' => 'syahroni',
        //         'email_dosen' => 'syahroni@gmail.com',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nidn' => '0123456789',
        //         'nama' => "Ani",
        //         'email_dosen' => 'ani1234@gmail.com',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nidn' => '0133456789',
        //         'nama' => "Handoko",
        //         'email_dosen' => 'Handoko@gmail.com',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nidn' => '0113456789',
        //         'nama' => "Noval",
        //         'email_dosen' => 'Noval@gmail.com',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
            
        // ];

        // // Insert data menggunakan DB facade
        // DB::table('dosens')->insert($dosens);
    }
}
