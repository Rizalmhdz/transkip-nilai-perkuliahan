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

        $query = Direktur::query();

        if ($searchKeyword) {
            $query->where('nidn', 'LIKE', "%{$searchKeyword}%")
                  ->orWhereHas('dosen', function($query) use ($searchKeyword) {
                      $query->where('nama', 'LIKE', "%{$searchKeyword}%");
                  });
        }

        $direkturs = $query->orderBy($sort, $direction)->paginate(20);
        $total = $direkturs->total();
        $dosens = Dosen::all();

        return view('direktur_page', compact('direkturs', 'total', 'sort', 'direction', 'searchKeyword', 'dosens'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        return view('direktur_page', compact('dosens'));
    }

    public function store(Request $request)
    {
        Direktur::create($request->all());

        return redirect()->route('direktur.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Direktur $direktur)
    {
        $dosens = Dosen::all();
        return view('direktur_page', compact('direktur', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $direktur = Direktur::findOrFail($id);
        $direktur->update($request->all());

        return redirect()->route('direktur.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $direktur = Direktur::findOrFail($id);
        $direktur->delete();

        return redirect()->route('direktur.index')->with('success', 'Data berhasil dihapus');
    }
}
