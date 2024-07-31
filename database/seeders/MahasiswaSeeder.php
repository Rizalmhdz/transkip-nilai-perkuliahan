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

        foreach ($prodis as $prodi) {
            $mahasiswaCount = Mahasiswa::where('prodi', $prodi->id)->count();

            for ($i = 0; $i < 20; $i++) {
                $dosen = $dosens->random();
                $angkatan = $faker->numberBetween(2016, 2024);

                // Hitung selisih tahun antara tahun angkatan dan tahun sekarang
                $yearDifference = $currentYear - $angkatan;

                // Tentukan tahun lulus dan tanggal yudisium berdasarkan selisih tahun
                if ($yearDifference < 3.5) {
                    $tahun_lulus = null;
                    $tanggal_yudisium = null;
                } else {
                    $tahun_lulus = $angkatan + $faker->numberBetween(4, 7); // Minimal 3.5 tahun dari angkatan

                    if ($tahun_lulus > $currentYear) {
                        $tahun_lulus = null;
                        $tanggal_yudisium = null;
                    } else {
                        // Jika tahun lulus ada, tentukan tanggal yudisium di tahun yang sama dengan tahun lulus
                        $tanggal_yudisium = $tahun_lulus
                            ? $faker->dateTimeBetween($tahun_lulus . '-01-01', $tahun_lulus . '-12-31')->format('Y-m-d')
                            : null;
                        
                        // Jika tanggal yudisium melewati tanggal sekarang, set tanggal_yudisium menjadi null
                        if ($tanggal_yudisium && $tanggal_yudisium > $currentDate) {
                            $tanggal_yudisium = null;
                        }
                    }
                }

                // Format tahun angkatan menjadi dua digit terakhir
                $tahunAngkatan = substr($angkatan, -2);

                // Generate urutan mahasiswa
                $urutanMahasiswa = str_pad($mahasiswaCount + $i + 1, 3, '0', STR_PAD_LEFT);

                // Format NIM
                $nim = sprintf('314%02d%s%s', $prodi->id + 1, $tahunAngkatan, $urutanMahasiswa);

                Mahasiswa::create([
                    'nim' => $nim,
                    'nama_lengkap' => $faker->name,
                    'tempat_lahir' => $faker->city,
                    'tanggal_lahir' => $faker->dateTimeBetween('1998-01-01', '2005-12-31')->format('Y-m-d'),
                    'angkatan' => $angkatan,
                    'prodi' => $prodi->id,
                    'dosen_akademik' => $dosen->nidn,
                    'tahun_lulus' => $tahun_lulus,
                    'tanggal_yudisium' => $tanggal_yudisium,
                ]);

                // Update jumlah mahasiswa untuk prodi
                $mahasiswaCount++;
            }
        }
    }
}
