<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HasilStudi;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use Faker\Factory as Faker;

class HasilStudiSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $mahasiswas = Mahasiswa::all();

        foreach ($mahasiswas as $mahasiswa) {
            // Ambil semua mata kuliah untuk prodi mahasiswa
            $mataKuliahs = MataKuliah::where('prodi', $mahasiswa->prodi)->get();

            foreach ($mataKuliahs as $mataKuliah) {
                HasilStudi::create([
                    'id_mata_kuliah' => $mataKuliah->id,
                    'nim' => $mahasiswa->nim,
                    'nilai' => $faker->numberBetween(1, 4), // Nilai antara 1 sampai 4
                ]);
            }
        }
    }
}
