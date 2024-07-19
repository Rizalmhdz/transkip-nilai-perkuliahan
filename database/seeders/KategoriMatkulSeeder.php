<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriMatkul;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class KategoriMatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            KategoriMatkul::create([
                'nama_kategori' => $faker->word,
                'kode_kategori' => 'M' . strtoupper($faker->unique()->lexify('??')),
            ]);
        }
    }
}
