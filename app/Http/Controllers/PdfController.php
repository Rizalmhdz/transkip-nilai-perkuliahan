<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Barryvdh\DomPDF\PDF;
use App\Models\Mahasiswa;
use App\Models\KategoriMatkul;
use App\Models\Prodi;

class PdfController extends Controller
{
    public function generatePdf(Request $request)
    {


        $nim = $request->input('nim', '1111111111');
        $html1 = view('rekap_1')->render();
        $html2 = view('rekap_2')->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $mahasiswa =  Mahasiswa::where('nim', $nim);
        $kategori_matkuls = KategoriMatkul::whereIn('nim', $nim);
        $kaprodi = Prodi::where('id', $mahasiswa->prodi);
        $direktur = // Query Direktur data
        $graduates = // Query graduates data
        $wakil1 = // Query Wakil 1 data
        $tahun_ajaran = // Tahun Ajaran data

        // Generate halaman pertama
        $page1 = view('rekap_1', compact('student', 'categories', 'kaprodi', 'direktur'))->render();

        // Generate halaman kedua
        $page2 = view('rekap_2', compact('graduates', 'wakil1', 'kaprodi', 'tahun_ajaran'))->render();

        // Inisialisasi DomPDF
        $pdf = PDF::loadHTML($page1)
                    ->setPaper('A4', 'portrait');

        // Tambah halaman kedua
        $pdf->addPage($page2);

        return $pdf->stream('transcript.pdf');
     // Ambil data mahasiswa berdasarkan NIM
        $nim = $request->input('nim');
        $student = Mahasiswa::where('nim', $nim)->first();

        // Ambil data hasil studi mahasiswa
        $hasilStudi = HasilStudi::with('mataKuliah.kategoriMatkul')->where('nim', $nim)->get();

        // Kelompokkan mata kuliah berdasarkan kategori
        $kategoriMatkuls = KategoriMatkul::with(['mataKuliahs' => function ($query) use ($nim) {
            $query->whereHas('hasilStudi', function ($query) use ($nim) {
                $query->where('nim', $nim);
            });
        }])->get();

        // Ambil data kaprodi dan direktur
        $kaprodi = Prodi::find($mahasiswa->prodi_id)->ketua_prodi;
        $direktur = // Direktur data

        // Generate halaman pertama
        $page1 = view('transcript_page1', compact('student', 'hasilStudi', 'kategoriMatkuls', 'kaprodi', 'direktur'))->render();

        // Generate halaman kedua
        $graduates = // Data graduates
        $wakil1 = // Data Wakil 1
        $tahun_ajaran = // Data tahun ajaran
        $page2 = view('transcript_page2', compact('graduates', 'wakil1', 'kaprodi', 'tahun_ajaran'))->render();

        // Inisialisasi DomPDF
        $pdf = PDF::loadHTML($page1)
                    ->setPaper('A4', 'portrait');

        // Tambah halaman kedua
        $pdf->addPage($page2);

        return $pdf->stream('transkrip-nilai-'+ $nim +'.pdf');
    }
    
}
