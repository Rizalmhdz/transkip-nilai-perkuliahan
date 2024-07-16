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
                'nip' => '1271928121902910229',
                'nama' => 'syahroni',
                'email_dosen' => 'syahroni@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
                // 'timestamps' => now(),
            ],
            [
                'nip' => '1271928121902910231',
                'nama' => "Ani",
                'email_dosen' => 'ani1234@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
                // 'timestamps' => now(),
            ],
            
        ];

        // Insert data menggunakan DB facade
        DB::table('dosens')->insert($dosens);
    }
}
