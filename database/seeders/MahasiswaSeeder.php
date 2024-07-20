<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Prodi;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $dosens = Dosen::all();
        $prodis = Prodi::all();

        for ($i = 0; $i < 200; $i++) {
            $dosen = $dosens->random();
            $prodi = $prodis->random();

            Mahasiswa::create([
                'nim' => $faker->unique()->numerify('##########'),
                'nama_lengkap' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->dateTimeBetween('1998-01-01', '2005-12-31')->format('Y-m-d'),
                'angkatan' => $faker->numberBetween(2016, 2024),
                'prodi' => $prodi->id,
                'dosen_akademik' => $dosen->nidn,
                'tahun_lulus' => null,
            ]);
        }
    }
}
