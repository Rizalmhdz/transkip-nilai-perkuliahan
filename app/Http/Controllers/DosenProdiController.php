<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DosenProdi;
use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;

class DosenProdiController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'nidn');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $prodi_id = $request->input('prodi');
        $dosen_id = $request->input('dosen');
        $page = $request->input('page', 1);

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

        $dosen_prodis = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);

        if ($dosen_prodis->isEmpty() && $page > 1) {
            $page--;
            $dosen_prodis = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);
        }

        $total = $dosen_prodis->total();
        $dosens = Dosen::all();
        $prodis = Prodi::all();

        return view('dosen_prodi_page', compact('dosen_prodis', 'total', 'sort', 'direction', 'searchKeyword', 'dosens', 'prodis', 'prodi_id', 'dosen_id', 'page'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nidn' => 'required|string|max:10',
            'prodi' => 'required|integer',
        ]);

        try {
            DosenProdi::create($validatedData);
            $page = ceil(DosenProdi::count() / 20);
            return redirect()->route('dosen-prodi.index', ['page' => $page])->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('dosen-prodi.index')->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $dosenProdi = DosenProdi::findOrFail($id);

        $validatedData = $request->validate([
            'nidn' => 'required|string|max:10',
            'prodi' => 'required|integer',
        ]);

        try {
            $dosenProdi->update($validatedData);
            $page = ceil(DosenProdi::where('id', '<=', $id)->count() / 20);
            return redirect()->route('dosen-prodi.index', ['page' => $page])->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('dosen-prodi.index')->with('error', 'Gagal mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $dosenProdi = DosenProdi::findOrFail($id);
        $page = $request->input('page', 1);

        try {
            $dosenProdi->delete();
            $totalPages = ceil(DosenProdi::count() / 20);

            if ($page > $totalPages) {
                $page = $totalPages > 0 ? $totalPages : 1;
            }

            return redirect()->route('dosen-prodi.index', ['page' => $page])->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('dosen-prodi.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
