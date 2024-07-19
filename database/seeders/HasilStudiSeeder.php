<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\HasilStudi;
use Faker\Factory as Faker;

class HasilStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create('id_ID');
        $mataKuliahs = MataKuliah::all();
        $mahasiswas = Mahasiswa::all();

        foreach ($mahasiswas as $mahasiswa) {
            foreach ($mataKuliahs as $mataKuliah) {
                HasilStudi::create([
                    'id_mata_kuliah' => $mataKuliah->id,
                    'nim' => $mahasiswa->nim,
                    'nilai' => $faker->randomFloat(2, 0, 4),
                ]);
            }
        }
    }
}
