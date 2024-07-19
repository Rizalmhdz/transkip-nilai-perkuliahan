<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriMatkul;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\MataKuliah;
use Faker\Factory as Faker;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $kategoriMatkuls = KategoriMatkul::all();
        $dosens = Dosen::all();
        $prodis = Prodi::all();

        for ($i = 0; $i < 50; $i++) {
            MataKuliah::create([
                'nama_mata_kuliah' => $faker->word,
                'sks' => $faker->numberBetween(2, 4),
                'kategori_matkul' => $kategoriMatkuls->random()->kode_kategori,
                'dosen_pengampu' => $dosens->random()->nidn,
                'prodi' => $prodis->random()->id,
            ]);
        }
    }
}
