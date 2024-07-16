<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriMatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori_matkuls = [
        [
            'nama_kategori' => 'MPK',
            'kode_kategori' => 'MPK',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_kategori' => 'MKK',
            'kode_kategori' => 'MKK',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_kategori' => 'MKB',
            'kode_kategori' => 'MKB',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_kategori' => 'MPB',
            'kode_kategori' => 'MPB',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_kategori' => 'MBB',
            'kode_kategori' => 'MBB',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ];
    
    // Insert data menggunakan DB facade
    DB::table('kategori_matkuls')->insert($kategori_matkuls);

    }
}
