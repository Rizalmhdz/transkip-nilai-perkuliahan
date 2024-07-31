<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Dosen;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $page = $request->input('page', 1);

        $query = Prodi::query();

        if ($searchKeyword) {
            $query->where('nama_prodi', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('ketua_prodi', 'LIKE', "%{$searchKeyword}%");
        }

        $prodis = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);
        $total = $prodis->total();
        $dosens = Dosen::all();
        $ketua_prodi = [];
        foreach ($prodis as $prodi) {
            $ketua_prodi[$prodi->ketua_prodi] = Dosen::where('nidn', $prodi->ketua_prodi)->first();
        }

        if ($prodis->isEmpty() && $page > 1) {
            $page--;
            $prodis = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);
        }

        return view('prodi_page', compact('prodis', 'total', 'sort', 'direction', 'searchKeyword', 'dosens', 'ketua_prodi', 'page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255',
            'ketua_prodi' => 'required|string|max:10|exists:dosens,nidn',
        ]);

        try {
            Prodi::create($request->all());
            $page = ceil(Prodi::count() / 20);
            return redirect()->route('prodi.index', ['page' => $page, 'sort' => 'created_at', 'direction' => 'asc'])->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('prodi.index')->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255',
            'ketua_prodi' => 'required|string|max:10|exists:dosens,nidn',
        ]);

        $prodi = Prodi::findOrFail($id);
        $data = $request->all();

        try {
            $prodi->update($data);
            $page = ceil(Prodi::where('id', '<=', $id)->count() / 20);
            return redirect()->route('prodi.index', ['page' => $page, 'sort' => 'created_at', 'direction' => 'asc'])->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('prodi.index')->with('error', 'Gagal mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);
        $currentPage = $request->input('page', 1);

        try {
            $prodi->delete();
            $totalPages = ceil(Prodi::count() / 20);

            if ($currentPage > $totalPages) {
                $currentPage = $totalPages > 0 ? $totalPages : 1;
            }

            return redirect()->route('prodi.index', ['page' => $currentPage, 'sort' => 'created_at', 'direction' => 'asc'])->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('prodi.index', ['page' => $currentPage, 'sort' => 'created_at', 'direction' => 'asc'])->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
