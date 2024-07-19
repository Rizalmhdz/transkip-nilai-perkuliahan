<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaryaTulis;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class KaryaTulisController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
        $authority_level = $user->level;

        $sort = $request->input('sort', 'judul');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');

      

        if ($authority_level == 1) {
            $query = KaryaTulis::query();
            
            if ($searchKeyword) {
            $query->where('judul', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('nim', 'LIKE', "%{$searchKeyword}%");
            }
            
           
            $karya_tuliss = $query->orderBy($sort, $direction)->paginate(20);
            
        } else if ($authority_level == 2) {
            $dosen = Dosen::where('email_dosen', $user->email)->first();
            $karya_tuliss = KaryaTulis::where('pembimbing', $dosen->nidn)->paginate(20);
        } else {
            $karya_tuliss = collect(); // Empty collection
        }

       
        $mahasiswas = Mahasiswa::all();
        $total = $karya_tuliss->total();
        $dosens = Dosen::all();

        return view('karya_tulis_page', compact('karya_tuliss', 'total', 'sort', 'direction', 'searchKeyword', 'dosens', 'authority_level', 'mahasiswas'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        return view('karya_tulis_page', compact('dosens'));
    }

    public function store(Request $request)
    {
        KaryaTulis::create($request->all());

        return redirect()->route('karya-tulis.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(KaryaTulis $karyaTulis)
    {
        $dosens = Dosen::all();
        return view('karya_tulis_page', compact('karyaTulis', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $karyaTulis = KaryaTulis::findOrFail($id);
        $karyaTulis->update($request->all());

        return redirect()->route('karya-tulis.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $karyaTulis = KaryaTulis::findOrFail($id);
        $karyaTulis->delete();

        return redirect()->route('karya-tulis.index')->with('success', 'Data berhasil dihapus');
    }
}
