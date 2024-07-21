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
        $sort = $request->input('sort', 'nidn');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $prodi_id = $request->input('prodi');
        $dosen_id = $request->input('dosen');

        $query = DosenProdi::query();

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

        

        $mahasiswaBimbinganAkademik = Mahasiswa::all()->count();
                $mataKuliahDiampu = MataKuliah::all()->count();
                $mahasiswaBimbinganKaryaTulis = KaryaTulis::all()->count();
        
        $total = $dosen_prodis->total();
        $dosens = Dosen::all();
        $prodis = Prodi::all();

        return view('dosen_prodi_page', compact('dosen_prodis', 'total', 'sort', 'direction', 'searchKeyword', 'dosens', 'prodis', 'prodi_id', 'dosen_id', 'mahasiswaBimbinganAkademik', 'mataKuliahDiampu', 'mahasiswaBimbinganKaryaTulis'));
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
