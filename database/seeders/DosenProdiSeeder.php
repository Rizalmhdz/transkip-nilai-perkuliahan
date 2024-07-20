<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DosenProdi;
use App\Models\Dosen;
use App\Models\Prodi;

class DosenProdiSeeder extends Seeder
{
    public function run()
    {
        $dosens = Dosen::all();
        $prodis = Prodi::all();

        foreach ($dosens as $dosen) {
            DosenProdi::create([
                'nidn' => $dosen->nidn,
                'prodi' => $prodis->random()->id,
            ]);
        }
    }
}
