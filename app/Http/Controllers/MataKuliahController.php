<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\KategoriMatkul;
use Illuminate\Support\Facades\Auth;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $prodi_id = $request->input('prodi');
        $dosen_id = $request->input('dosen');
        $kode_kategori = $request->input('kategori');
        $sort = $request->input('sort', 'id'); // Default sort column set to 'id'
        $direction = $request->input('direction', 'asc'); // Default sort direction
        $searchKeyword = $request->input('searchKeyword');
        $page = $request->input('page', 1);

        $prodis = Prodi::all();
        $dosens = Dosen::all();
        $kategori_matkuls = KategoriMatkul::all();

        $user = Auth::user();
        $query = MataKuliah::query();

        if ($prodi_id) {
            $query->where('prodi', $prodi_id);
        }

        if ($dosen_id) {
            $query->where('dosen_pengampu', $dosen_id);
        }

        if ($kode_kategori) {
            $query->where('kategori_matkul', $kode_kategori);
        }

        if ($searchKeyword) {
            $query->where(function($q) use ($searchKeyword) {
                $q->where('nama_mata_kuliah', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('sks', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('kategori_matkul', 'LIKE', "%{$searchKeyword}%")
                  ->orWhereHas('dosen', function($query) use ($searchKeyword) {
                      $query->where('nama', 'LIKE', "%{$searchKeyword}%");
                  })
                  ->orWhereHas('prodi', function($query) use ($searchKeyword) {
                      $query->where('nama_prodi', 'LIKE', "%{$searchKeyword}%");
                  });
            });
        }

        $mata_kuliahs = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);

        if ($mata_kuliahs->isEmpty() && $page > 1) {
            $page--;
            $mata_kuliahs = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);
        }

        $total = $mata_kuliahs->total();

        return view('mata_kuliah_page', compact('mata_kuliahs', 'prodis', 'prodi_id', 'dosens', 'dosen_id', 'kategori_matkuls', 'kode_kategori', 'total', 'sort', 'direction', 'searchKeyword', 'page'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        $prodis = Prodi::all();
        $kategori_matkuls = KategoriMatkul::all();
        return view('mata_kuliah_page', compact('dosens', 'prodis', 'kategori_matkuls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mata_kuliah' => 'required|string|max:255',
            'sks' => 'required|integer',
            'kategori_matkul' => 'required|string|max:10',
            'dosen_pengampu' => 'required|string|max:10',
            'prodi' => 'required|integer',
        ]);

        try {
            $data = $request->all();
            MataKuliah::create($data);
            $page = ceil(MataKuliah::count() / 20);
            return redirect()->route('mata-kuliah.index', ['page' => $page])->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('mata-kuliah.index')->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit(MataKuliah $mataKuliah)
    {
        $dosens = Dosen::all();
        $prodis = Prodi::all();
        $kategori_matkuls = KategoriMatkul::all();
        return view('mata_kuliah_page', compact('mataKuliah', 'dosens', 'prodis', 'kategori_matkuls'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mata_kuliah' => 'required|string|max:255',
            'sks' => 'required|integer',
            'kategori_matkul' => 'required|string|max:10',
            'dosen_pengampu' => 'required|string|max:10',
            'prodi' => 'required|integer',
        ]);

        try {
            $mataKuliah = MataKuliah::findOrFail($id);
            $data = $request->all();
            $mataKuliah->update($data);
            return redirect()->route('mata-kuliah.index', ['page' => $request->input('page', 1)])->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('mata-kuliah.index', ['page' => $request->input('page', 1)])->with('error', 'Gagal mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $page = $request->input('page', 1);

        try {
            $mataKuliah->delete();
            $totalPages = ceil(MataKuliah::count() / 20);

            if ($page > $totalPages) {
                $page = $totalPages > 0 ? $totalPages : 1;
            }

            return redirect()->route('mata-kuliah.index', ['page' => $page])->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('mata-kuliah.index', ['page' => $page])->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
