<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DosenSeeder::class,
            ProdiSeeder::class,
            DosenProdiSeeder::class,
            DirekturSeeder::class,
            KategoriMatkulSeeder::class,
            MahasiswaSeeder::class,
            KaryaTulisSeeder::class,
            MataKuliahSeeder::class,
            HasilStudiSeeder::class,
        ]);
    }
}
