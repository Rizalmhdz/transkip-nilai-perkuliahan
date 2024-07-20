<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KaryaTulis;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Faker\Factory as Faker;

class KaryaTulisSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();

        foreach ($mahasiswas as $mahasiswa) {
            KaryaTulis::create([
                'judul' => $faker->unique()->sentence,
                'nim' => $mahasiswa->nim,
                'pembimbing' => $dosens->random()->nidn,
            ]);
        }
    }
}
