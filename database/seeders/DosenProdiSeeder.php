<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dosen_prodis = [
            [
                'nidn' => '1234567890',
                'prodi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '0123456789',
                'prodi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '0133456789',
                'prodi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '0113456789',
                'prodi' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        // Insert data menggunakan DB facade
        DB::table('dosen_prodis')->insert($dosen_prodis);
    }
    
}
