<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Dosen;
use App\Models\Direktur;

class DirekturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosen = Dosen::inRandomOrder()->first();

        Direktur::create([
            'nidn' => $dosen->nidn,
        ]);

        // $direkturs = [
        // [
        //     'nidn' => '0133456789',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ],
        
    // ];

    // // Insert data menggunakan DB facade
    // DB::table('direkturs')->insert($direkturs);

    }
}