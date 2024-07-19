<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

           
        $faker = Faker::create('id_ID');
        $dosens = Dosen::all();

        for ($i = 0; $i < 200; $i++) {
            Mahasiswa::create([
                'nim' => $faker->unique()->numerify('##########'),
                'nama_lengkap' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->dateTimeBetween('1998-01-01', '2005-12-31')->format('Y-m-d'),
                'angkatan' => $faker->numberBetween(2016, 2024),
                'dosen_akademik' => $dosens->random()->nidn,
            ]);
        }
    }
}
