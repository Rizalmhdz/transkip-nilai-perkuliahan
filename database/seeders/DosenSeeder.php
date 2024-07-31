<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // $faker = Faker::create('id_ID');

        // $domains = ['@gmail.com', '@yahoo.com', '@outlook.com'];

        // for ($i = 0; $i < 40; $i++) {
        //     $email = $faker->unique()->userName . $faker->randomElement($domains);

        //     Dosen::create([
        //         'nama' => $faker->name,
        //         'nidn' => $faker->unique()->numerify('##########'),
        //        'email_dosen' => $email,
        //     ]);
        // }

        $dosens = [
            [
                'nidn' => '1124016601',
                'nama' => 'NOOR IDEAL SE., MM.',
                'email_dosen' => '----',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '9911005007',
                'nama' => "ABDUL HARIST ISLAMY S.Pd.",
                'email_dosen' => '----',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '1123097302',
                'nama' => "HERRY HERMAWAN S.Kom., m.Cs.",
                'email_dosen' => '----',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '9911000983',
                'nama' => "H ILHAN S.E., MM.",
                'email_dosen' => '----',
                'created_at' => now(),
                'updated_at' => now(),
            ],
           [
                'nidn' => '9911621969',
                'nama' => "MASLIANOR S.Pd.",
                'email_dosen' => '----',
                'created_at' => now(),
                'updated_at' => now(),
            ],
           [
                'nidn' => '1108038501',
                'nama' => "SISKA DEWI LESTARI S.SI., M.Cs.",
                'email_dosen' => '----',
                'created_at' => now(),
                'updated_at' => now(),
            ],
           [
                'nidn' => '9911004371',
                'nama' => "CHRISTOPEL S.Pd., M.Pd.",
                'email_dosen' => '----',
                'created_at' => now(),
                'updated_at' => now(),
            ],
           [
                'nidn' => '9911000864',
                'nama' => "ABDUL PAIJAH S.E.",
                'email_dosen' => '----',
                'created_at' => now(),
                'updated_at' => now(),
            ],
           [
                'nidn' => '9990184138',
                'nama' => "DEWI YULIANA S.Kom.",
                'email_dosen' => '----',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nidn' => '0602048501',
                'nama' => "HARTINI S.Kom., M.Kom",
                'email_dosen' => '----',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];



        // Insert data menggunakan DB facade
        DB::table('dosens')->insert($dosens);

        
    }
}
