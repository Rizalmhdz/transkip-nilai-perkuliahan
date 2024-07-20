<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;
use App\Models\KategoriMatkul;
use App\Models\Dosen;
use App\Models\Prodi;
use Faker\Factory as Faker;

class MataKuliahSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $kategoriMatkuls = KategoriMatkul::all();
        $prodis = Prodi::all();
        $dosens = Dosen::all();

        foreach ($prodis as $prodi) {
            for ($i = 0; $i < 50; $i++) {
                $dosen = $dosens->random();

                MataKuliah::create([
                    'nama_mata_kuliah' => $faker->word,
                    'sks' => $faker->numberBetween(2, 4),
                    'kategori_matkul' => $kategoriMatkuls->random()->kode_kategori,
                    'dosen_pengampu' => $dosen->nidn,
                    'prodi' => $prodi->id,
                ]);
            }
        }
    }
}
