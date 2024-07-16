<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HasilStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hasil_studis = [
            [
                'id' => '1',
                'kode_mata_kuliah' => 'MK001',
                'id_rencana_studi' => 1,
                'nilai' => '70',
                'status' => 'lulus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2',
                'kode_mata_kuliah' => 'MK002',
                'id_rencana_studi' => 5,
                'nilai' => '85',
                'status' => 'lulus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3',
                'kode_mata_kuliah' => 'MK003',
                'id_rencana_studi' => 5,
                'nilai' => '75',
                'status' => 'lulus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
            
        ];

        // Insert data menggunakan DB facade
        DB::table('hasil_studis')->insert($hasil_studis);
    }
}
