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
                    'nim' => '123456789876543210',
                    'nama_lengkap' => 'Bambang Santoso',
                    'tanggal_lahir' => '2001-01-01',
                    'alamat' => 'Banjarmasin',
                    'angkatan' => '2019',
                    'email_mhs' =>'bambang@gmail.com',
                    'dosen_akademik' => '1271928121902910229',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nim' => '123456789876545381',
                    'nama_lengkap' => 'raisa',
                    'tanggal_lahir' => '2004-01-01',
                    'alamat' => 'Banjarmasin',
                    'angkatan' => '2022',
                    'email_mhs' =>'raisa4321@gmail.com',
                    'dosen_akademik' => '1271928121902910231',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                
            ];
    
            // Insert data menggunakan DB facade
            DB::table('mahasiswas')->insert($mahasiswas);
    }
}
