<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KaryaTulis;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Prodi;
use Faker\Factory as Faker;

class KaryaTulisSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $mahasiswas = Mahasiswa::whereNotNull('tahun_lulus')->get();
        $dosens = Dosen::all();

        // Daftar judul umum per prodi
        $judulPerProdi = [
            'Teknik Pertambangan' => [
                'Analisis Kestabilan Lereng dalam Penambangan Terbuka',
                'Studi Pengaruh Teknik Eksplorasi terhadap Lingkungan',
                'Teknologi Terbaru dalam Pengolahan Mineral',
                'Penerapan Teknik Reklamasi pada Tambang Terbuka',
                'Pengelolaan Sumber Daya Alam Berkelanjutan',
                'Studi Kasus: Efektivitas Metode Penambangan Modern',
                'Teknik Analisis Kualitas Mineral',
                'Evaluasi Metode Penambangan Bawah Tanah',
                'Studi Pengaruh Pengolahan Air Tambang terhadap Lingkungan',
                'Pengembangan Teknologi Pemulihan Logam Langka',
                'Analisis Resiko Kesehatan dan Keselamatan Kerja di Tambang',
                'Evaluasi Efisiensi Energi dalam Proses Penambangan',
                'Studi Kasus: Pengelolaan Limbah Tambang',
                'Pengembangan Teknologi Baru dalam Eksplorasi Mineral',
                'Manajemen Sumber Daya Mineral dan Energi',
                'Studi Pengaruh Perubahan Iklim terhadap Aktivitas Penambangan',
                'Penerapan Teknologi Geofisika dalam Eksplorasi Tambang',
                'Analisis Dampak Penambangan Terhadap Ekosistem',
                'Pengembangan Metode Penambangan Berkelanjutan',
                'Teknik Pengendalian Polusi di Industri Pertambangan'
            ],
            'Teknik Pengolahan Hasil Perkebunan' => [
                'Optimalisasi Proses Pengolahan Minyak Kelapa Sawit',
                'Studi Efisiensi Teknologi Pengolahan Kakao',
                'Pengembangan Produk Olahan Berbasis Kelapa',
                'Analisis Kualitas Produk pada Pengolahan Hasil Perkebunan',
                'Inovasi dalam Pengolahan Kopi Arabika',
                'Teknologi Pengeringan untuk Hasil Perkebunan',
                'Pengelolaan Limbah dari Industri Pengolahan Perkebunan',
                'Studi Kasus: Pengembangan Produk Olahan Cokelat',
                'Pengembangan Sistem Pengolahan Hasil Pertanian',
                'Efisiensi Proses Pembuatan Minyak Esensial',
                'Studi Kasus: Pengolahan Hasil Perkebunan Berbasis Teknologi',
                'Pengembangan Produk Baru dalam Industri Pengolahan Kakao',
                'Analisis Teknologi Pengolahan Beras',
                'Penerapan Metode Fermentasi dalam Pengolahan Hasil Pertanian',
                'Pengembangan Sistem Kontrol Kualitas dalam Pengolahan Hasil Perkebunan',
                'Studi Efektivitas Teknologi Pengemasan untuk Produk Perkebunan',
                'Pengembangan Teknologi Pengolahan Hasil Tani untuk Pasar Internasional',
                'Analisis Penggunaan Energi dalam Industri Pengolahan Perkebunan',
                'Inovasi dalam Pengolahan Minyak Jarak',
                'Teknologi Pengolahan Minyak Zaitun untuk Pasar Lokal'
            ],
            'Manajemen Informatika' => [
                'Analisis Sistem Informasi untuk Bisnis Modern',
                'Pengembangan Aplikasi Mobile untuk E-commerce',
                'Studi Kasus: Implementasi ERP di Perusahaan Kecil',
                'Keamanan Jaringan dalam Era Digital',
                'Pengelolaan Proyek Teknologi Informasi',
                'Evaluasi Sistem Keamanan Data pada Startup Teknologi',
                'Pengembangan Website untuk E-commerce',
                'Optimalisasi Sistem Database untuk Aplikasi Web',
                'Analisis Big Data dalam Bisnis',
                'Studi Pengaruh Teknologi Cloud Computing terhadap Efisiensi Operasional',
                'Pengembangan Sistem CRM untuk Perusahaan Kecil',
                'Studi Kasus: Implementasi Teknologi Blockchain',
                'Evaluasi Performa Aplikasi Mobile pada Platform iOS dan Android',
                'Manajemen Risiko dalam Proyek TI',
                'Penggunaan AI dalam Analisis Data Bisnis',
                'Pengembangan Platform E-learning untuk Pendidikan Tinggi',
                'Studi Kasus: Implementasi Sistem Informasi Manufaktur',
                'Pengembangan Aplikasi Berbasis Web untuk Kesehatan',
                'Pengaruh Teknologi Internet of Things (IoT) pada Sistem Informasi',
                'Evaluasi Sistem Keamanan Siber dalam Perusahaan Teknologi'
            ]
        ];

        $usedTitles = [];

        foreach ($mahasiswas as $mahasiswa) {
            // Ambil prodi mahasiswa
            $prodi = Prodi::find($mahasiswa->prodi);
            if (!$prodi) {
                continue; // Jika prodi tidak ditemukan, lanjutkan ke mahasiswa berikutnya
            }
            
            $prodiName = $prodi->nama_prodi;

            if (!isset($judulPerProdi[$prodiName])) {
                continue; // Jika prodi tidak ada dalam daftar judul, lanjutkan ke mahasiswa berikutnya
            }

            $availableTitles = array_diff($judulPerProdi[$prodiName], $usedTitles);

            // Jika judul tidak mencukupi, tambahkan lebih banyak judul dari prodi yang sama
            if (count($availableTitles) < 20) {
                $additionalTitles = array_merge($availableTitles, array_slice($judulPerProdi[$prodiName], 0, 20 - count($availableTitles)));
                $availableTitles = array_unique($additionalTitles);
            }

            // Pilih judul yang belum digunakan
            $judulKaryaTulis = array_shift($availableTitles);
            if (!$judulKaryaTulis) {
                continue; // Jika tidak ada judul yang bisa dipilih, lanjutkan ke mahasiswa berikutnya
            }

            $usedTitles[] = $judulKaryaTulis;

            // Pilih dosen pembimbing secara acak
            $pembimbing = $dosens->random()->nidn;

            KaryaTulis::create([
                'judul' => $judulKaryaTulis,
                'nim' => $mahasiswa->nim,
                'pembimbing' => $pembimbing,
            ]);
        }
    }
}
