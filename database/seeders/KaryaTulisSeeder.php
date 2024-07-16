<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryaTulisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $karya_tuliss = [
            [
                'judul' => 'Judul 1',
                'nim' => '1234567891',
                'pembimbing' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Judul 2',
                'nim' => '1234567892',
                'pembimbing' => '0123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        // Insert data menggunakan DB facade
        DB::table('karya_tuliss')->insert($karya_tuliss);
    
    }
        
    
}
