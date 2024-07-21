<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
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
        $sort = $request->input('sort', 'nama_mata_kuliah'); // Default sort column
        $direction = $request->input('direction', 'asc'); // Default sort direction
        $searchKeyword = $request->input('searchKeyword');

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
            $mata_kuliahs = $query->orderBy($sort, $direction)->paginate(20);
       

        $total = $mata_kuliahs->total(); // Total number of records

        return view('mata_kuliah_page', compact('mata_kuliahs', 'prodis', 'prodi_id', 'dosens', 'dosen_id', 'kategori_matkuls', 'kode_kategori', 'total', 'sort', 'direction', 'searchKeyword'));
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
        // Validasi dan simpan data
        MataKuliah::create($request->all());

        return redirect()->route('mata-kuliah.index')->with('success', 'Data berhasil ditambahkan');
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
        // Validasi dan update data
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->update($request->all());

        return redirect()->route('mata-kuliah.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        // Hapus data
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->delete();

        return redirect()->route('mata-kuliah.index')->with('success', 'Data berhasil dihapus');
    }
}
