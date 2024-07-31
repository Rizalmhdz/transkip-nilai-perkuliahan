<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriMatkul;

class KategoriMatkulController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $page = $request->input('page', 1);

        $query = KategoriMatkul::query();

        if ($searchKeyword) {
            $query->where('nama_kategori', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('kode_kategori', 'LIKE', "%{$searchKeyword}%");
        }

        $kategori_matkuls = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);

        if ($kategori_matkuls->isEmpty() && $page > 1) {
            $page--;
            $kategori_matkuls = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);
        }

        $total = $kategori_matkuls->total();

        return view('kategori_matkul_page', compact('kategori_matkuls', 'total', 'sort', 'direction', 'searchKeyword', 'page'));
    }

    public function create()
    {
        return view('kategori_matkul_page');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'kode_kategori' => 'required|string|max:255',
        ]);

        try {
            KategoriMatkul::create($validatedData);
            $page = ceil(KategoriMatkul::count() / 20);
            return redirect()->route('kategori-matkul.index', ['page' => $page])->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('kategori-matkul.index')->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit(KategoriMatkul $kategoriMatkul)
    {
        return view('kategori_matkul_page', compact('kategoriMatkul'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'kode_kategori' => 'required|string|max:255',
        ]);

        $kategoriMatkul = KategoriMatkul::findOrFail($id);

        try {
            $kategoriMatkul->update($validatedData);
            $page = ceil(KategoriMatkul::where('id', '<=', $id)->count() / 20);
            return redirect()->route('kategori-matkul.index', ['page' => $page])->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('kategori-matkul.index')->with('error', 'Gagal mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $kategoriMatkul = KategoriMatkul::findOrFail($id);
        $page = $request->input('page', 1);

        try {
            $kategoriMatkul->delete();
            $totalPages = ceil(KategoriMatkul::count() / 20);

            if ($page > $totalPages) {
                $page = $totalPages > 0 ? $totalPages : 1;
            }

            return redirect()->route('kategori-matkul.index', ['page' => $page])->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('kategori-matkul.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
