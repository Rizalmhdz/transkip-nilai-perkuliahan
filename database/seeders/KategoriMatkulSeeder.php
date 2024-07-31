<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriMatkul;
use Faker\Factory as Faker;

class KategoriMatkulSeeder extends Seeder
{
    public function run()
    {
        // $faker = Faker::create('id_ID');
        // for ($i = 0; $i < 20; $i++) {
        //     KategoriMatkul::create([
        //         'nama_kategori' => $faker->word,
        //         'kode_kategori' => 'M' . strtoupper($faker->unique()->bothify('##')),
        //     ]);
        // }

        $kategori_matkuls = [
            ['nama_kategori' => 'MPK', 'kode_kategori' => 'MPK'],
            ['nama_kategori' => 'MKK', 'kode_kategori' => 'MKK'],
            ['nama_kategori' => 'MKB', 'kode_kategori' => 'MKB'],
            ['nama_kategori' => 'MPB', 'kode_kategori' => 'MPB'],
            ['nama_kategori' => 'MBB', 'kode_kategori' => 'MBB'],
        ];

        DB::table('kategori_matkuls')->insert($kategori_matkuls);

        
    }
}
