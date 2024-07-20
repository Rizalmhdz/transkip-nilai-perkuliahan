<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriMatkul;
use Faker\Factory as Faker;

class KategoriMatkulSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            KategoriMatkul::create([
                'nama_kategori' => $faker->word,
                'kode_kategori' => 'M' . strtoupper($faker->unique()->bothify('##')),
            ]);
        }
    }
}
