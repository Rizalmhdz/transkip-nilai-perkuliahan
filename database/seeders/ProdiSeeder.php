<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Prodi;
use App\Models\Dosen;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $prodis = ['Manajemen Informatika', 'Teknik Pertambangan', 'Teknik Pengolahan Hasil Perkebunan'];
        $dosens = Dosen::all();

        foreach ($prodis as $prodi) {
            Prodi::create([
                'nama_prodi' => $prodi,
                'ketua_prodi' => $dosens->random()->nidn,
            ]);
        }
        // $prodis = [
        //     [
        //         'nama_prodi' => 'manajemen informatika',
        //         'ketua_prodi' => '1234567890',
        //     ],
        //     [
        //         'nama_prodi' => 'teknik pertambangan',
        //         'ketua_prodi' => '0123456789',
        //     ],
        //     [
        //         'nama_prodi' => 'teknik pengolahan hasil perkebunan',
        //         'ketua_prodi' => '0113456789',
        //     ],
            
        // ];

        // // Insert data menggunakan DB facade
        // DB::table('prodis')->insert($prodis);
    }
}
