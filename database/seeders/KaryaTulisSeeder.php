<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\KaryaTulis;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Faker\Factory as Faker;

class KaryaTulisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();

        foreach ($mahasiswas as $mahasiswa) {
            KaryaTulis::create([
                'judul' => $faker->unique()->sentence . ' di Indonesia',
                'nim' => $mahasiswa->nim,
                'pembimbing' => $dosens->random()->nidn,
            ]);
        }
    }   
    
}
