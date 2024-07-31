<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaryaTulis;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class KaryaTulisController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $page = $request->input('page', 1);

        $query = KaryaTulis::query();

        if ($searchKeyword) {
            $query->where('judul', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('nim', 'LIKE', "%{$searchKeyword}%");
        }

        $karya_tuliss = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);

        if ($karya_tuliss->isEmpty() && $page > 1) {
            $page--;
            $karya_tuliss = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);
        }

        $mahasiswas = Mahasiswa::all();
        $total = $karya_tuliss->total();
        $dosens = Dosen::all();

        return view('karya_tulis_page', compact('karya_tuliss', 'total', 'sort', 'direction', 'searchKeyword', 'dosens', 'mahasiswas', 'page'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        return view('karya_tulis_page', compact('dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'nim' => 'required|string|max:10|exists:mahasiswas,nim',
            'pembimbing' => 'required|string|max:10|exists:dosens,nidn',
        ]);

        try {
            KaryaTulis::create($request->all());
            $page = ceil(KaryaTulis::count() / 20);
            return redirect()->route('karya-tulis.index', ['page' => $page, 'sort' => 'id', 'direction' => 'asc'])->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('karya-tulis.index')->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'nim' => 'required|string|max:10|exists:mahasiswas,nim',
            'pembimbing' => 'required|string|max:10|exists:dosens,nidn',
        ]);

        $karyaTulis = KaryaTulis::findOrFail($id);
        $data = $request->all();

        try {
            $karyaTulis->update($data);
            $page = ceil(KaryaTulis::where('id', '<=', $id)->count() / 20);
            return redirect()->route('karya-tulis.index', ['page' => $page, 'sort' => 'id', 'direction' => 'asc'])->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('karya-tulis.index')->with('error', 'Gagal mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $karyaTulis = KaryaTulis::findOrFail($id);
        $currentPage = $request->input('page', 1);

        try {
            $karyaTulis->delete();
            $totalPages = ceil(KaryaTulis::count() / 20);

            if ($currentPage > $totalPages) {
                $currentPage = $totalPages > 0 ? $totalPages : 1;
            }

            return redirect()->route('karya-tulis.index', ['page' => $currentPage, 'sort' => 'id', 'direction' => 'asc'])->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('karya-tulis.index', ['page' => $currentPage, 'sort' => 'id', 'direction' => 'asc'])->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
