<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    public function index()
    {
        // Ambil semua data mata kuliah dari database
        $mataKuliahs = MataKuliah::all();

        // Return view dengan data mata kuliah
        return view('mata_kuliah_page', compact('mataKuliahs'));
    }

    public function edit($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        return response()->json($mataKuliah);
    }

    public function update(Request $request, $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->update($request->all());
        return redirect()->route('mata-kuliah')->with('success', 'Mata Kuliah berhasil diupdate');
    }

    public function destroy($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->delete();
        return redirect()->route('mata-kuliah')->with('success', 'Mata Kuliah berhasil dihapus');
    }
}
