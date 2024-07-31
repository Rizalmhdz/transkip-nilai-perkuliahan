<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;
use App\Models\Dosen;
use Faker\Factory as Faker;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        // $faker = Faker::create();
        
        $prodis = ['Teknik Pertambangan', 'Manajemen Informatika', 'Teknik Pengolahan Hasil Perkebunan'];
        
        foreach ($prodis as $namaProdi) {
            $dosen = Dosen::where('id', '!=', 0)->inRandomOrder()->first();


            Prodi::create([
                'nama_prodi' => $namaProdi,
                'ketua_prodi' => $dosen->nidn,
            ]);
        }
        
        // for ($i = 0; $i < 40; $i++) {
        //     $dosen = Dosen::inRandomOrder()->first();

        //     Prodi::create([
        //         'nama_prodi' => $faker->words(2, true), // Generate a fake program name
        //         'ketua_prodi' => $dosen->nidn,
        //     ]);
        // }
    }
}
