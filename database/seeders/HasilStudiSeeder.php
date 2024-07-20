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
        $mataKuliahs = MataKuliah::all();
        $mahasiswas = Mahasiswa::all();

        foreach ($mahasiswas as $mahasiswa) {
            foreach ($mataKuliahs->random(5) as $mataKuliah) {
                HasilStudi::create([
                    'id_mata_kuliah' => $mataKuliah->id,
                    'nim' => $mahasiswa->nim,
                    'nilai' => $faker->numberBetween(0, 4),
                ]);
            }
        }
    }
}
