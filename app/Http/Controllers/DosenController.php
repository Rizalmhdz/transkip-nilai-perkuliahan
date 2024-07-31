<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $page = $request->input('page', 1);

        $query = Dosen::query();

        if ($searchKeyword) {
            $query->where('nama', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('nidn', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('email_dosen', 'LIKE', "%{$searchKeyword}%");
        }

        $dosens = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);
        $total = $dosens->total();

        if ($dosens->isEmpty() && $page > 1) {
            $page--;
            $dosens = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);
        }

        return view('dosen_page', compact('dosens', 'total', 'sort', 'direction', 'searchKeyword', 'page'));
    }

    public function create()
    {
        return view('dosen_page');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:10|unique:dosens,nidn',
            'email_dosen' => 'required|string|email|max:255|unique:dosens,email_dosen',
        ]);

        try {
            $dosen = Dosen::create($validatedData);
            $page = ceil(Dosen::count() / 20);
            return redirect()->route('dosen.index', ['page' => $page, 'sort' => 'created_at', 'direction' => 'asc'])->with('success', "Data berhasil ditambahkan: {$dosen->nama}");
        } catch (\Exception $e) {
            return redirect()->route('dosen.index')->with('error', "Gagal menambahkan data: {$e->getMessage()}");
        }
    }

    public function edit(Dosen $dosen)
    {
        return view('dosen_page', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:10|unique:dosens,nidn,' . $dosen->id,
            'email_dosen' => 'required|string|email|max:255|unique:dosens,email_dosen,' . $dosen->id,
        ]);

        try {
            $dosen->update($validatedData);
            $page = ceil(Dosen::where('id', '<=', $id)->count() / 20);
            return redirect()->route('dosen.index', ['page' => $page, 'sort' => 'created_at', 'direction' => 'asc'])->with('success', "Data berhasil diubah: {$dosen->nama}");
        } catch (\Exception $e) {
            return redirect()->route('dosen.index')->with('error', "Gagal mengubah data: {$e->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);

        try {
            $dosen->delete();
            $page = ceil((Dosen::count() - 1) / 20);
            return redirect()->route('dosen.index', ['page' => $page, 'sort' => 'created_at', 'direction' => 'asc'])->with('success', "Data berhasil dihapus: {$dosen->nama}");
        } catch (\Exception $e) {
            return redirect()->route('dosen.index')->with('error', "Gagal menghapus data: {$e->getMessage()}");
        }
    }
} 
