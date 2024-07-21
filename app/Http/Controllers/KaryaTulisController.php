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

        $sort = $request->input('sort', 'judul');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');

      

       
            $query = KaryaTulis::query();
            
            if ($searchKeyword) {
            $query->where('judul', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('nim', 'LIKE', "%{$searchKeyword}%");
            }
            
           
            $karya_tuliss = $query->orderBy($sort, $direction)->paginate(20);
            
       
       
        $mahasiswas = Mahasiswa::all();
        $total = $karya_tuliss->total();
        $dosens = Dosen::all();

        return view('karya_tulis_page', compact('karya_tuliss', 'total', 'sort', 'direction', 'searchKeyword', 'dosens', 'mahasiswas'));
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
