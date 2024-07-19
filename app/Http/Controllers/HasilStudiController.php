<?php

namespace App\Http\Controllers;

use App\Models\Direktur;
use Illuminate\Http\Request;
use App\Models\HasilStudi;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;

class HasilStudiController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id_mata_kuliah');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $prodi_id = $request->input('prodi');
        $mata_kuliah_id = $request->input('mata_kuliah');
        $nim = $request->input('nim');
        $filter_nilai = $request->input('nilai');

        $user = Auth::user();
        $authority_level = $user->level;
        
        $query = HasilStudi::query();

        if ($authority_level == 2) {
            $dosen = Dosen::where('email_dosen', $user->email)->first();
            if ($dosen) {
                // Filter by mata kuliah taught by the dosen
                $query->where(function ($q) use ($dosen) {
                    $q->whereHas('mataKuliah', function ($q) use ($dosen) {
                        $q->where('dosen_pengampu', $dosen->nidn);
                    });
                });

                // Filter by mahasiswa advised by the dosen
                $query->orWhereHas('mahasiswa', function ($q) use ($dosen) {
                    $q->where('dosen_akademik', $dosen->nidn);
                });
            }
        } else {
            if ($prodi_id) {
                $query->whereHas('mataKuliah', function ($q) use ($prodi_id) {
                    $q->where('prodi', $prodi_id);
                });
            }

            if ($mata_kuliah_id) {
                $query->where('id_mata_kuliah', $mata_kuliah_id);
            }

            if ($nim) {
                $query->where('nim', $nim);
            }

            if ($filter_nilai !== null) {
                $query->where('nilai', $filter_nilai);
            }

            if ($searchKeyword) {
                $query->where(function ($q) use ($searchKeyword) {
                    $q->where('nilai', 'LIKE', "%{$searchKeyword}%")
                        ->orWhereHas('mataKuliah', function ($query) use ($searchKeyword) {
                            $query->where('nama_mata_kuliah', 'LIKE', "%{$searchKeyword}%");
                        })
                        ->orWhereHas('mahasiswa', function ($query) use ($searchKeyword) {
                            $query->where('nama_lengkap', 'LIKE', "%{$searchKeyword}%");
                        });
                });
            }
        }

        $hasil_studis = $query->orderBy($sort, $direction)->paginate(20);
        $total = $hasil_studis->total();
        $mata_kuliahs = MataKuliah::all();
        $mahasiswas = Mahasiswa::all();
        $prodis = Prodi::all();

        return view('hasil_studi_page', compact('hasil_studis', 'total', 'sort', 'direction', 'searchKeyword', 'mata_kuliahs', 'mahasiswas', 'authority_level', 'prodis', 'prodi_id', 'mata_kuliah_id', 'nim', 'filter_nilai'));
    }

    public function create()
    {
        $mata_kuliahs = MataKuliah::all();
        $mahasiswas = Mahasiswa::all();
        return view('hasil_studi_page', compact('mata_kuliahs', 'mahasiswas'));
    }

    public function store(Request $request)
    {
        HasilStudi::create($request->all());

        return redirect()->route('hasil-studi.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(HasilStudi $hasilStudi)
    {
        $mata_kuliahs = MataKuliah::all();
        $mahasiswas = Mahasiswa::all();
        $user = Auth::user();
        $authority_level = $user->level;

        return view('hasil_studi_page', compact('hasilStudi', 'mata_kuliahs', 'mahasiswas', 'authority_level'));
    }

    public function update(Request $request, $id)
    {
        $hasilStudi = HasilStudi::findOrFail($id);
        $hasilStudi->update($request->all());

        return redirect()->route('hasil-studi.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $hasilStudi = HasilStudi::findOrFail($id);
        $hasilStudi->delete();

        return redirect()->route('hasil-studi.index')->with('success', 'Data berhasil dihapus');
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
