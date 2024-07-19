<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriMatkul;

class KategoriMatkulController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'nama_kategori');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');

        $query = KategoriMatkul::query();

        if ($searchKeyword) {
            $query->where('nama_kategori', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('kode_kategori', 'LIKE', "%{$searchKeyword}%");
        }

        $kategori_matkuls = $query->orderBy($sort, $direction)->paginate(20);
        $total = $kategori_matkuls->total();

        return view('kategori_matkul_page', compact('kategori_matkuls', 'total', 'sort', 'direction', 'searchKeyword'));
    }

    public function create()
    {
        return view('kategori_matkul_page');
    }

    public function store(Request $request)
    {
        KategoriMatkul::create($request->all());

        return redirect()->route('kategori-matkul.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(KategoriMatkul $kategoriMatkul)
    {
        return view('kategori_matkul_page', compact('kategoriMatkul'));
    }

    public function update(Request $request, $id)
    {
        $kategoriMatkul = KategoriMatkul::findOrFail($id);
        $kategoriMatkul->update($request->all());

        return redirect()->route('kategori-matkul.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $kategoriMatkul = KategoriMatkul::findOrFail($id);
        $kategoriMatkul->delete();

        return redirect()->route('kategori-matkul.index')->with('success', 'Data berhasil dihapus');
    }
}
