<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RencanaStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $rencana_studis = [
            [
                'id' => '1',
                'nim' => '123456789876543210',
                'tahun_ajaran' => '2019/2020',
                'semester' => 'ganjil',
                'status' => 'disetujui',
                'sks_tersedia' => '24',
                'sks_selanjutnya' => '24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2',
                'nim' => '123456789876543210',
                'tahun_ajaran' => '2019/2020',
                'semester' => 'genap',
                'status' => 'disetujui',
                'sks_tersedia' => '24',
                'sks_selanjutnya' => '24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3',
                'nim' => '123456789876543210',
                'tahun_ajaran' => '2019/2020',
                'semester' => 'ganjil',
                'status' => 'disetujui',
                'sks_tersedia' => '24',
                'sks_selanjutnya' => '24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '4',
                'nim' => '123456789876545381',
                'tahun_ajaran' => '2023/2024',
                'semester' => 'genap',
                'status' => 'dibatalkan',
                'sks_tersedia' => '24',
                'sks_selanjutnya' => '24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '5',
                'nim' => '123456789876545381',
                'tahun_ajaran' => '2023/2024',
                'semester' => 'genap',
                'status' => 'disetujui',
                'sks_tersedia' => '24',
                'sks_selanjutnya' => '24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '6',
                'nim' => '123456789876545381',
                'tahun_ajaran' => '2024/2025',
                'semester' => 'ganjil',
                'status' => 'diajukan',
                'sks_tersedia' => '24',
                'sks_selanjutnya' => '24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        // Insert data menggunakan DB facade
        DB::table('rencana_studis')->insert($rencana_studis);
    }
}
