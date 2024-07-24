<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Prodi;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $dosens = Dosen::all();
        $prodis = Prodi::all();

        $currentYear = (int) date('Y');
        $currentDate = date('Y-m-d');

        for ($i = 0; $i < 200; $i++) {
            $dosen = $dosens->random();
            $prodi = $prodis->random();

            $angkatan = $faker->numberBetween(2016, 2024);

            // Hitung selisih tahun antara tahun angkatan dan tahun sekarang
            $yearDifference = $currentYear - $angkatan;

            // Tentukan tahun lulus dan tanggal yudisium berdasarkan selisih tahun
            if ($yearDifference < 3.5) {
                $tahun_lulus = null;
                $tanggal_yudisium = null;
            } else {
                $tahun_lulus = $angkatan + $faker->numberBetween(4, 7); // Minimal 3.5 tahun dari angkatan
                
                // Jika tahun lulus lebih dari tahun sekarang, set tahun_lulus dan tanggal_yudisium menjadi null
                if ($tahun_lulus > $currentYear) {
                    $tahun_lulus = null;
                    $tanggal_yudisium = null;
                } else {
                    // Ambil tanggal yudisium acak di tahun lulus
                    $tanggal_yudisium = $faker->dateTimeBetween($tahun_lulus . '-01-01', $tahun_lulus . '-12-31')->format('Y-m-d');
                    
                    // Jika tanggal yudisium melewati tanggal sekarang, set tanggal_yudisium menjadi null
                    if ($tanggal_yudisium > $currentDate) {
                        $tahun_lulus = null;
                        $tanggal_yudisium = null;
                    }
                }
            }

            Mahasiswa::create([
                'nim' => $faker->unique()->numerify('##########'),
                'nama_lengkap' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->dateTimeBetween('1998-01-01', '2005-12-31')->format('Y-m-d'),
                'angkatan' => $angkatan,
                'prodi' => $prodi->id,
                'dosen_akademik' => $dosen->nidn,
                'tahun_lulus' => $tahun_lulus,
                'tanggal_yudisium' => $tanggal_yudisium,
            ]);
        }
    } 
}
