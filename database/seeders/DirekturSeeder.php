<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Direktur;
use App\Models\Dosen;
use Faker\Factory as Faker;

class DirekturSeeder extends Seeder
{
    public function run()
    {
        // $faker = Faker::create();

        $dosen = Dosen::All()->first();

        Direktur::create([
            'nidn' => $dosen->nidn,
        ]);

        // for ($i = 0; $i < 40; $i++) {
        //     $dosen = Dosen::inRandomOrder()->first();

        //     Direktur::create([
        //         'nidn' => $dosen->nidn,
        //     ]);
        // }
    }
}
