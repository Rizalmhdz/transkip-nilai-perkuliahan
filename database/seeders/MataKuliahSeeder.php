<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;
use App\Models\KategoriMatkul;
use App\Models\Dosen;
use App\Models\Prodi;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    public function run()
    {
        // $faker = Faker::create('id_ID');
        // $kategoriMatkuls = KategoriMatkul::all();
        // $prodis = Prodi::all();
        // $dosens = Dosen::all();

        // foreach ($prodis as $prodi) {
        //     for ($i = 0; $i < 50; $i++) {
        //         $dosen = $dosens->random();

        //         MataKuliah::create([
        //             'nama_mata_kuliah' => $faker->word,
        //             'sks' => $faker->numberBetween(2, 4),
        //             'kategori_matkul' => $kategoriMatkuls->random()->kode_kategori,
        //             'dosen_pengampu' => $dosen->nidn,
        //             'prodi' => $prodi->id,
        //         ]);
        //     }
        // }

        $dosens = DB::table('dosens')->pluck('nidn')->toArray();

        $mata_kuliahs = [
            ['nama_mata_kuliah' => 'Agama', 'sks' => 2, 'kategori_matkul' => 'MPK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Pancasila', 'sks' => 2, 'kategori_matkul' => 'MPK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Kewarganegaraan', 'sks' => 2, 'kategori_matkul' => 'MPK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Bahasa Indonesia', 'sks' => 2, 'kategori_matkul' => 'MPK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Bahasa Inggris Terapan I', 'sks' => 2, 'kategori_matkul' => 'MPK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Bahasa Inggris Terapan II', 'sks' => 2, 'kategori_matkul' => 'MPK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Aplikasi Komputer Terapan I', 'sks' => 2, 'kategori_matkul' => 'MPK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Aplikasi Komputer Terapan II', 'sks' => 2, 'kategori_matkul' => 'MPK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Statistika dan Probabilitas', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Fisika Terapan', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Kimia Terapan', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Matematika Terapan', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Pengantar Teknologi Mineral', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Perpetaan', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Kristalografi & Mineralogi', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Mekanika Batuan', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Bahan Galian Industri', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Geologi Dasar', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Geologi Struktur', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Geologi Teknik', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Hidrogeologi', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Genesa Bahan Galian', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Geofisika', 'sks' => 3, 'kategori_matkul' => 'MKK', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Pengolahan Bahan Galian', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Batubara I', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Batubara II', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Perencanaan Tambang', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Ilmu Ukur Tambang', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Alat Berat dan PTM', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Eksplorasi Bahan Galian', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Teknik Eksplorasi', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Teknik Peledakan', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Pemboran & Penggalian Tambang', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Peralatan Tambang', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Hidrologi', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Stratigrafi', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Tata Tulis Karya Ilmiah', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Pengetahuan Lingkungan Tambang', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Sistem Pembabatan', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Kewirausahaan', 'sks' => 3, 'kategori_matkul' => 'MKB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Undang-Undang Tambang', 'sks' => 2, 'kategori_matkul' => 'MPB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Ekonomi Bahan Galian', 'sks' => 2, 'kategori_matkul' => 'MPB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Reklamasi Tambang', 'sks' => 2, 'kategori_matkul' => 'MPB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'AMDAL', 'sks' => 2, 'kategori_matkul' => 'MPB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Keselamatan dan Kesehatan Kerja (K3)', 'sks' => 2, 'kategori_matkul' => 'MPB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Praktek Kerja Lapangan (PKL)', 'sks' => 6, 'kategori_matkul' => 'MBB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
            ['nama_mata_kuliah' => 'Tugas Akhir (TA)', 'sks' => 24, 'kategori_matkul' => 'MBB', 'dosen_pengampu' => $dosens[array_rand($dosens)], 'prodi' => 1],
        ];

        DB::table('mata_kuliahs')->insert($mata_kuliahs);
    }
}
