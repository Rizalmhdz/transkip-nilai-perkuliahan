<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;
use App\Models\Dosen;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        $prodis = ['Manajemen Informatika', 'Teknik Pertambangan', 'Teknik Pengolahan Hasil Perkebunan'];
        
        foreach ($prodis as $namaProdi) {
            $dosen = Dosen::inRandomOrder()->first();

            Prodi::create([
                'nama_prodi' => $namaProdi,
                'ketua_prodi' => $dosen->nidn,
            ]);
        }
    }
}
