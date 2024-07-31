<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direktur;
use App\Models\Dosen;

class DirekturController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'nidn');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $page = $request->input('page', 1);

        $query = Direktur::query();

        if ($searchKeyword) {
            $query->where('nidn', 'LIKE', "%{$searchKeyword}%")
                  ->orWhereHas('dosen', function($query) use ($searchKeyword) {
                      $query->where('nama', 'LIKE', "%{$searchKeyword}%");
                  });
        }

        $direkturs = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);

        if ($direkturs->isEmpty() && $page > 1) {
            $page--;
            $direkturs = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);
        }

        $total = $direkturs->total();
        $dosens = Dosen::all();

        return view('direktur_page', compact('direkturs', 'total', 'sort', 'direction', 'searchKeyword', 'dosens', 'page'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        return view('direktur_page', compact('dosens'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nidn' => 'required|string|max:10',
        ]);

        try {
            Direktur::create($validatedData);
            $page = ceil(Direktur::count() / 20);
            return redirect()->route('direktur.index', ['page' => $page])->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('direktur.index')->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit(Direktur $direktur)
    {
        $dosens = Dosen::all();
        return view('direktur_page', compact('direktur', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $direktur = Direktur::findOrFail($id);

        $validatedData = $request->validate([
            'nidn' => 'required|string|max:10',
        ]);

        try {
            $direktur->update($validatedData);
            $page = ceil(Direktur::where('id', '<=', $id)->count() / 20);
            return redirect()->route('direktur.index', ['page' => $page])->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('direktur.index')->with('error', 'Gagal mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $direktur = Direktur::findOrFail($id);
        $page = $request->input('page', 1);

        try {
            $direktur->delete();
            $totalPages = ceil(Direktur::count() / 20);

            if ($page > $totalPages) {
                $page = $totalPages > 0 ? $totalPages : 1;
            }

            return redirect()->route('direktur.index', ['page' => $page])->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('direktur.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
