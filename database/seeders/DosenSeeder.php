<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dosens = [
            [
                'nip' => "1271928121902910229",
                'nama' => "Ahmad Syahroni",
                'timestamps' => now(),
            ],
            
        ];

        // Insert data menggunakan DB facade
        DB::table('dosens')->insert($dosens);
    }
}
