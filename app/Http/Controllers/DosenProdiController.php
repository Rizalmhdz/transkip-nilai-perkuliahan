<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DosenProdi;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\KaryaTulis;
use Illuminate\Support\Facades\Auth;

class DosenProdiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $authority_level = $user->level;
        $sort = $request->input('sort', 'nidn');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $prodi_id = $request->input('prodi');
        $dosen_id = $request->input('dosen');

        $query = DosenProdi::query();

        if ($authority_level == 1) {
            if ($searchKeyword) {
                $query->where('nidn', 'LIKE', "%{$searchKeyword}%")
                    ->orWhereHas('dosen', function($query) use ($searchKeyword) {
                        $query->where('nama', 'LIKE', "%{$searchKeyword}%");
                    })
                    ->orWhereHas('prodi', function($query) use ($searchKeyword) {
                        $query->where('nama_prodi', 'LIKE', "%{$searchKeyword}%");
                    });
            }

            if ($prodi_id) {
                $query->where('prodi', $prodi_id);
            }

            if ($dosen_id) {
                $query->where('nidn', $dosen_id);
            }

            $dosen_prodis = $query->orderBy($sort, $direction)->paginate(20);

        } else if ($authority_level == 2) {
            $dosen = Dosen::where('email_dosen', $user->email)->first();
            if ($dosen) {
                $dosen_prodis = DosenProdi::where('nidn', $dosen->nidn)->paginate(20);

                // Informasi tambahan untuk dashboard
                $mahasiswaBimbinganAkademik = Mahasiswa::where('dosen_akademik', $dosen->nidn)->count();
                $mataKuliahDiampu = MataKuliah::where('dosen_pengampu', $dosen->nidn)->count();
                $mahasiswaBimbinganKaryaTulis = KaryaTulis::where('pembimbing', $dosen->nidn)->count();
            } else {
                $dosen_prodis = collect(); // Empty collection if dosen not found
                $mahasiswaBimbinganAkademik = 0;
                $mataKuliahDiampu = 0;
                $mahasiswaBimbinganKaryaTulis = 0;
            }
        } else {
            $dosen_prodis = collect(); // Empty collection for other authority levels
            $mahasiswaBimbinganAkademik = 0;
            $mataKuliahDiampu = 0;
            $mahasiswaBimbinganKaryaTulis = 0;
        }

        $mahasiswaBimbinganAkademik = Mahasiswa::all()->count();
                $mataKuliahDiampu = MataKuliah::all()->count();
                $mahasiswaBimbinganKaryaTulis = KaryaTulis::all()->count();
        
        $total = $dosen_prodis->total();
        $dosens = Dosen::all();
        $prodis = Prodi::all();

        return view('dosen_prodi_page', compact('dosen_prodis', 'total', 'sort', 'direction', 'searchKeyword', 'dosens', 'prodis', 'authority_level', 'prodi_id', 'dosen_id', 'mahasiswaBimbinganAkademik', 'mataKuliahDiampu', 'mahasiswaBimbinganKaryaTulis'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        $prodis = Prodi::all();
        return view('dosen_prodi_page', compact('dosens', 'prodis'));
    }

    public function store(Request $request)
    {
        DosenProdi::create($request->all());

        return redirect()->route('dosen-prodi.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(DosenProdi $dosenProdi)
    {
        $dosens = Dosen::all();
        $prodis = Prodi::all();
        return view('dosen_prodi_page', compact('dosenProdi', 'dosens', 'prodis'));
    }

    public function update(Request $request, $id)
    {
        $dosenProdi = DosenProdi::findOrFail($id);
        $dosenProdi->update($request->all());

        return redirect()->route('dosen-prodi.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $dosenProdi = DosenProdi::findOrFail($id);
        $dosenProdi->delete();

        return redirect()->route('dosen-prodi.index')->with('success', 'Data berhasil dihapus');
    }
}
