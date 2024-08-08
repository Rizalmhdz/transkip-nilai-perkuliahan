<?php

namespace App\Http\Controllers;

use App\Models\Direktur;
use Illuminate\Http\Request;
use App\Models\HasilStudi;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;

class HasilStudiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $isPrint = $request->input('isPrint', false);
        $sort = $request->input('sort', 'id'); // Default sort column set to 'id'
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $prodi_id = $request->input('prodi');
        $mata_kuliah_id = $request->input('mata_kuliah');
        $nim = $request->input('nim');
        $nilai = $request->input('nilai');
        $filter_type = $request->input('filter_type');
        $page = $request->input('page', 1);
        $user_dosen_id = null;

        $query = HasilStudi::query();

        if ($searchKeyword) {
            $query->whereHas('mahasiswa', function($query) use ($searchKeyword) {
                $query->where('nama_lengkap', 'LIKE', "%{$searchKeyword}%");
            })->orWhereHas('mataKuliah', function($query) use ($searchKeyword) {
                $query->where('nama_mata_kuliah', 'LIKE', "%{$searchKeyword}%");
            })->orWhere('nim', 'LIKE', "%{$searchKeyword}%");
        }

        if ($prodi_id) {
            $query->whereHas('mataKuliah', function($query) use ($prodi_id) {
                $query->where('prodi', $prodi_id);
            });
        }

        if ($mata_kuliah_id) {
            $query->where('id_mata_kuliah', $mata_kuliah_id);
        }

        if ($nim) {
            $query->where('nim', $nim);
        }

        if ($nilai) {
            $query->where('nilai', $nilai);
        }

        $hasil_studis = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);

        if ($hasil_studis->isEmpty() && $page > 1) {
            $page--;
            $hasil_studis = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);
        }

        $total = $hasil_studis->total();
        $mata_kuliahs = MataKuliah::all();
        // $mahasiswas = Mahasiswa::whereIn('nim', function($query) {
        //     $query->select('nim')->from('hasil_studis');
        // })->get();
        $mahasiswas = Mahasiswa::all();

        $totalNilai = 0;
        $totalSks = 0;

        if ($nim) {
            $hasil_studi_nim = HasilStudi::where('nim', $nim)->get();
            foreach ($hasil_studi_nim as $hasilStudi) {
                $mataKuliah = $hasilStudi->mataKuliah;
                $totalNilai += $hasilStudi->nilai * $mataKuliah->sks;
                $totalSks += $mataKuliah->sks;
            }
        }

        $ipk = $totalSks ? round($totalNilai / $totalSks, 2) : 0;
        $prodis = Prodi::all();

        return view('hasil_studi_page', compact('hasil_studis', 'total', 'sort', 'direction', 'searchKeyword', 'mata_kuliahs', 'mahasiswas', 'prodis', 'prodi_id', 'mata_kuliah_id', 'nim', 'nilai', 'filter_type', 'user', 'user_dosen_id', 'isPrint', 'totalSks', 'ipk', 'nim', 'page'));
    }

    public function create()
    {
        $mata_kuliahs = MataKuliah::all();
        $mahasiswas = Mahasiswa::all();
        return view('hasil_studi_page', compact('mata_kuliahs', 'mahasiswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:10',
            'id_mata_kuliah' => 'required|integer',
            'nilai' => 'required|integer|between:0,4',
        ]);

        try {
            HasilStudi::create($request->all());
            $page = ceil(HasilStudi::count() / 20);
            return redirect()->route('hasil-studi.index', ['page' => $page])->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('hasil-studi.index')->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit(HasilStudi $hasilStudi)
    {
        $mata_kuliahs = MataKuliah::all();
        $mahasiswas = Mahasiswa::all();
        $user = Auth::user();

        return view('hasil_studi_page', compact('hasilStudi', 'mata_kuliahs', 'mahasiswas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|string|max:10',
            'id_mata_kuliah' => 'required|integer',
            'nilai' => 'required|integer|between:0,4',
        ]);

        try {
            $hasilStudi = HasilStudi::findOrFail($id);
            $hasilStudi->update($request->all());
            return redirect()->route('hasil-studi.index', ['page' => $request->input('page', 1)])->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('hasil-studi.index', ['page' => $request->input('page', 1)])->with('error', 'Gagal mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $hasilStudi = HasilStudi::findOrFail($id);
        $page = $request->input('page', 1);

        try {
            $hasilStudi->delete();
            $totalPages = ceil(HasilStudi::count() / 20);

            if ($page > $totalPages) {
                $page = $totalPages > 0 ? $totalPages : 1;
            }

            return redirect()->route('hasil-studi.index', ['page' => $page])->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('hasil-studi.index', ['page' => $page])->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function cetakTranskrip($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        $hasil_studi = HasilStudi::where('nim', $nim)->get();
        $jumlah_sks = $hasil_studi->sum(function ($hasil) {
            return $hasil->mataKuliah->sks;
        });
        $IPK = $hasil_studi->average('nilai');
        $predikat = $this->hitungPredikat($IPK);
        $judul_karya_tulis = $mahasiswa->karyaTulis ? $mahasiswa->karyaTulis->judul : '-';
        $dosen = $mahasiswa->dosenAkademik;
        $direktur = Direktur::all()->first();

        return view('cetak_transkrip', compact('mahasiswa', 'hasil_studi', 'jumlah_sks', 'IPK', 'predikat', 'judul_karya_tulis', 'dosen', 'direktur'));
    }

    private function hitungPredikat($IPK)
    {
        if ($IPK >= 3.51) {
            return 'Cum Laude';
        } elseif ($IPK >= 3.01) {
            return 'Sangat Memuaskan';
        } elseif ($IPK >= 2.76) {
            return 'Memuaskan';
        } else {
            return 'Cukup';
        }
    }
}
