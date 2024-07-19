<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $users = User::all();

        foreach ($users as $user) {
            Dosen::create([
                'nama' => $user->name . ', S2',  // Menggunakan nama dari tabel users
                'nidn' => $faker->unique()->numerify('##########'),
                'email_dosen' => $user->email,
            ]);
        }
    }
}
