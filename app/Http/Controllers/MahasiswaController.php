<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'nama_lengkap');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $dosens = Dosen::all();


        $user = Auth::user();
        $authority_level = $user->level;

        if ($authority_level == 1) {
            $query = Mahasiswa::query();

            if ($searchKeyword) {
                $query->where('nama_lengkap', 'LIKE', "%{$searchKeyword}%")
                      ->orWhere('nim', 'LIKE', "%{$searchKeyword}%")
                      ->orWhere('tempat_lahir', 'LIKE', "%{$searchKeyword}%");
            }
    
            $mahasiswas = $query->orderBy($sort, $direction)->paginate(20);
            
        } else if ($authority_level == 2) {
            $dosen = Dosen::where('email_dosen', $user->email)->first();
            $mahasiswas = Mahasiswa::where('dosen_akademik', $dosen->nidn)->paginate(20);
        } else {
            $mahasiswas = collect(); // Empty collection
        }

        $total = $mahasiswas->total();

        return view('mahasiswa_page', compact('mahasiswas', 'total', 'sort', 'direction', 'searchKeyword', 'dosens', 'authority_level'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        return view('mahasiswa_page', compact('dosens'));
    }

    public function store(Request $request)
    {
        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $dosens = Dosen::all();
        return view('mahasiswa_page', compact('mahasiswa', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus');
    }
}
