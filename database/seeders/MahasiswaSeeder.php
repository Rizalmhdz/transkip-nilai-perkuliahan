<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            $mahasiswas = [
                [
                    'nim' => '1234567891',
                    'nama_lengkap' => 'Bambang Santoso',
                    'tempat_lahir' => 'Banjarmasin',
                    'tanggal_lahir' => '2001-01-01',
                    'angkatan' => '2019',
                    'dosen_akademik' => '1234567890',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nim' => '1234567892',
                    'nama_lengkap' => 'raisa',
                    'tempat_lahir' => 'Muara Teweh',
                    'tanggal_lahir' => '2004-01-01',
                    'angkatan' => '2022',
                    'dosen_akademik' => '0123456789',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                
            ];
    
            // Insert data menggunakan DB facade
            DB::table('mahasiswas')->insert($mahasiswas);
    }
}
