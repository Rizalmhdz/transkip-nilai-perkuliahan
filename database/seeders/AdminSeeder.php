<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DosenSeeder::class,
            MataKuliahSeeder::class,
            MahasiswaSeeder::class,
            RencanaStudiSeeder::class,
            HasilStudiSeeder::class,
        ]);
    }
}
