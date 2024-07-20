<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $prodi_id = $request->input('prodi');
        $dosen_id = $request->input('dosen');
        $sort = $request->input('sort', 'nama_lengkap');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');

        $prodis = Prodi::all();
        $dosens = Dosen::all();

        $user = Auth::user();
        $authority_level = $user->level;

        if ($authority_level == 1) {
            $query = Mahasiswa::query();

            if ($prodi_id) {
                $query->where('prodi', $prodi_id);
            }

            if ($dosen_id) {
                $query->where('dosen_akademik', $dosen_id);
            }

            if ($searchKeyword) {
                $query->where(function($q) use ($searchKeyword) {
                    $q->where('nama_lengkap', 'LIKE', "%{$searchKeyword}%")
                      ->orWhere('nim', 'LIKE', "%{$searchKeyword}%")
                      ->orWhere('tempat_lahir', 'LIKE', "%{$searchKeyword}%");
                });
            }

            $mahasiswas = $query->orderBy($sort, $direction)->paginate(20);
        } else if ($authority_level == 2) {
            $dosen = Dosen::where('email_dosen', $user->email)->first();
            $mahasiswas = Mahasiswa::where('dosen_akademik', $dosen->nidn)->paginate(20);
        } else {
            $mahasiswas = collect(); // Empty collection
        }

        $total = $mahasiswas->total();

        return view('mahasiswa_page', compact('mahasiswas', 'prodis', 'prodi_id', 'dosens', 'dosen_id', 'total', 'sort', 'direction', 'searchKeyword', 'authority_level'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        $prodis = Prodi::all();

        return view('mahasiswa_page', compact('dosens', 'prodis'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['tahun_lulus'] = $data['angkatan'];
        Mahasiswa::create($data);

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $dosens = Dosen::all();
        $prodis = Prodi::all();

        return view('mahasiswa_page', compact('mahasiswa', 'dosens', 'prodis'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $data = $request->all();
        if (is_null($data['tahun_lulus'])) {
            $data['tahun_lulus'] = $mahasiswa->angkatan;
        }
        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus');
    }
}
