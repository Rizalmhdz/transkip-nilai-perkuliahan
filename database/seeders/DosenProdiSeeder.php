<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\DosenProdi;

class DosenProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosens = Dosen::all();
        $prodis = Prodi::all();

        foreach ($dosens as $dosen) {
            DosenProdi::create([
                'nidn' => $dosen->nidn,
                'prodi' => $prodis->random()->id,
            ]);
        }

        // $dosen_prodis = [
        //     [
        //         'nidn' => '1234567890',
        //         'prodi' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nidn' => '0123456789',
        //         'prodi' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nidn' => '0133456789',
        //         'prodi' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nidn' => '0113456789',
        //         'prodi' => 3,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
            
        // ];

        // // Insert data menggunakan DB facade
        // DB::table('dosen_prodis')->insert($dosen_prodis);
    }
    
}
