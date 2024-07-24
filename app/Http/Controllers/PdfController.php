<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Mahasiswa;
use App\Models\KategoriMatkul;
use App\Models\Prodi;
use App\Models\HasilStudi;
use App\Models\Dosen;
use App\Models\KaryaTulis;

class PdfController extends Controller
{
    public function generatePdf(Request $request)
    {
        function getLabelNilai($nilai){
            $label = '';
            switch ($nilai) {
                case 4:
                    $label = 'A';
                    break;
                case 3:
                    $label = 'B';
                    break;
                case 2:
                    $label = 'C';
                    break;
                case 1:
                    $label = 'D';
                    break;
                case 0:
                    $label = 'E';
                    break;
                
                default:
                    $label = '';
                    break;
            }
            return $label;
        }

        $nim = $request->input('nim');

        
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        $prodi = Prodi::where('id', $mahasiswa->prodi)->first();
        
        // Ambil data hasil studi mahasiswa
        

        // Ambil data kaprodi dan direktur
        $kaprodi_nidn = Prodi::find($mahasiswa->prodi)->ketua_prodi;
        $kaprodi = Dosen::where('nidn', $kaprodi_nidn)->first();
        $direktur = Dosen::whereHas('direktur')->first();

        $totalNilai = 0;
        $totalSks = 0;

        $karya_tulis_nim = KaryaTulis::where('nim', $nim);
        $karya_tulis = KaryaTulis::where('nim', $nim)->first();
        $jumlah_karya_tulis = $karya_tulis_nim->count();
        $hasilStudi = HasilStudi::with('mataKuliah.kategoriMatkul')->where('nim', $nim)->get();

// Kelompokkan hasil studi berdasarkan kategori mata kuliah
$hasilStudiByKategori = [];
foreach ($hasilStudi as $studi) {
    $kategori = $studi->mataKuliah->kategoriMatkul->nama_kategori;
    $hasilStudiByKategori[$kategori][] = $studi;
}

$rekap = [];
$totalNilai = 0;
$totalSks = 0;

foreach ($hasilStudiByKategori as $kategori => $hasilStudi) {
    foreach ($hasilStudi as $hasilStudiIteration) {
        $mataKuliah = $hasilStudiIteration->mataKuliah;
        // Pastikan array kategori sudah ada
        if (!isset($rekap[$kategori])) {
            $rekap[$kategori] = [];
        }
        // Tambahkan mata kuliah ke dalam kategori yang sesuai
        $rekap[$kategori][] = [
            "kategori" => $mataKuliah->kategori_matkul,
            "mata_kuliah" => $mataKuliah->nama_mata_kuliah,
            "n" => $hasilStudiIteration->nilai,
            "h" => getLabelNilai($hasilStudiIteration->nilai),
            "k" => $mataKuliah->sks
        ];

        $totalNilai += $hasilStudiIteration->nilai * $mataKuliah->sks;
        $totalSks += $mataKuliah->sks;
    }
}

// Hitung jumlah total item dalam semua kategori (termasuk kategori sebagai satu item tambahan)
$totalItems = 0;
foreach ($rekap as $kategori => $items) {
    $totalItems += count($items) + 1; // Tambahkan 1 untuk kategori
}

// Tentukan target jumlah item di setiap row, dengan mempertimbangkan tambahan row untuk footer di row2
$targetRowSize = ceil(($totalItems + 1) / 2); // Tambahkan 1 untuk footer di row2

// Bagi item ke dalam dua row dengan mendekati jumlah item yang seimbang
$row1 = [];
$row2 = [];
$currentRowSize = 0;

foreach ($rekap as $kategori => $items) {
    if ($currentRowSize + count($items) + 1 <= $targetRowSize) { // Tambahkan 1 untuk kategori
        $row1 = array_merge($row1, $items);
        $currentRowSize += count($items) + 1; // Tambahkan 1 untuk kategori
    } else {
        $row2 = array_merge($row2, $items);
    }
}

        $ipk = $totalSks ? round($totalNilai / $totalSks, 2) : 0;

        // Data untuk halaman pertama
        $pageData = compact('mahasiswa', 'jumlah_karya_tulis', 'row1','nim', 'row2','rekap', 'totalNilai', 'karya_tulis', 'totalSks', 'ipk', 'hasilStudiByKategori', 'kaprodi', 'direktur', 'prodi');

        // Generate halaman kedua (sesuaikan query data tambahan sesuai kebutuhan)
        $graduates = [];
        $wakil1 = [];
        $tahun_ajaran = date('Y');
        // Generate halaman pertama
        $page1 = view('rekap_1', $pageData)->render();

      
        // $page2Data = compact('graduates', 'wakil1', 'kaprodi', 'tahun_ajaran', 'mahasiswa', 'prodi');
        $page2Data = $pageData;
        $page2 = view('rekap_2', $page2Data)->render();

        // Gabungkan konten dari dua halaman
        // $html = $page1 . '<div style="page-break-after: always;"></div>' . $page2;
        $html = $page1 . $page2;

        // Inisialisasi DomPDF
        $pdf = Pdf::loadHTML($html)
                    ->setPaper('A4', 'portrait');

        return $pdf->stream('transkrip-nilai-'.$nim.'.pdf');
    }
}
