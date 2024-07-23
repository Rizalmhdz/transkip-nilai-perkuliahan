<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Dosen;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'nama_prodi');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');

        $query = Prodi::query();

        if ($searchKeyword) {
            $query->where('nama_prodi', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('ketua_prodi', 'LIKE', "%{$searchKeyword}%");
        }

        $prodis = $query->orderBy($sort, $direction)->paginate(20);
        $total = $prodis->total();
        $dosens = Dosen::all();
        $ketua_prodi = [];
        foreach($prodis as $prodi){
            $ketua_prodi[$prodi->ketua_prodi] = Dosen::where('nidn', $prodi->ketua_prodi)->first();
        }
       

        return view('prodi_page', compact('prodis', 'total', 'sort', 'direction', 'searchKeyword', 'dosens', 'ketua_prodi'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        return view('prodi_page', compact('dosens'));
    }

    public function store(Request $request)
    {
        Prodi::create($request->all());

        return redirect()->route('prodi.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Prodi $prodi)
    {
        $dosens = Dosen::all();
        return view('prodi_page', compact('prodi', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->all());

        return redirect()->route('prodi.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect()->route('prodi.index')->with('success', 'Data berhasil dihapus');
    }
}
