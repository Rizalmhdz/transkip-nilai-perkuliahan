<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Direktur;
use App\Models\Dosen;

class DirekturSeeder extends Seeder
{
    public function run()
    {
        $dosen = Dosen::inRandomOrder()->first();

        Direktur::create([
            'nidn' => $dosen->nidn,
        ]);
    }
}
