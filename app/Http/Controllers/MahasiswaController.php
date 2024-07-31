<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $prodi_id = $request->input('prodi');
        $dosen_id = $request->input('dosen');
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $page = $request->input('page', 1);

        $prodis = Prodi::all();
        $dosens = Dosen::all();

        $user = Auth::user();
        $query = Mahasiswa::query();

        if ($prodi_id) {
            $query->where('prodi', $prodi_id);
        }

        if ($dosen_id) {
            $query->where('dosen_akademik', $dosen_id);
        }

        if ($searchKeyword) {
            $query->where(function($q) use ($searchKeyword) {
                $q->where('nama_lengkap', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('nim', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('tempat_lahir', 'LIKE', "%{$searchKeyword}%");
            });
        }

        $mahasiswas = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);

        if ($mahasiswas->isEmpty() && $page > 1) {
            $page--;
            $mahasiswas = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);
        }

        $total = $mahasiswas->total();

        return view('mahasiswa_page', compact('mahasiswas', 'prodis', 'prodi_id', 'dosens', 'dosen_id', 'total', 'sort', 'direction', 'searchKeyword', 'page'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        $prodis = Prodi::all();
        return view('mahasiswa_page', compact('dosens', 'prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric|digits:10',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'angkatan' => 'required|integer|digits:4',
            'dosen_akademik' => 'required|string|max:10',
            'prodi' => 'required|integer',
            'tahun_lulus' => 'nullable|integer|digits:4',
            'tanggal_yudisium' => 'nullable|date',
        ]);

        try {
            $data = $request->all();
            Mahasiswa::create($data);
            $page = ceil(Mahasiswa::count() / 20);
            return redirect()->route('mahasiswa.index', ['page' => $page])->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $dosens = Dosen::all();
        $prodis = Prodi::all();
        return view('mahasiswa_page', compact('mahasiswa', 'dosens', 'prodis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|numeric|digits:10',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'angkatan' => 'required|integer|digits:4',
            'dosen_akademik' => 'required|string|max:10',
            'prodi' => 'required|integer',
            'tahun_lulus' => 'nullable|integer|digits:4',
            'tanggal_yudisium' => 'nullable|date',
        ]);

        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $data = $request->all();
            $mahasiswa->update($data);
            $page = ceil(Mahasiswa::where('id', '<=', $id)->count() / 20);
            return redirect()->route('mahasiswa.index', ['page' => $page])->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $page = $request->input('page', 1);

        try {
            $mahasiswa->delete();
            $totalPages = ceil(Mahasiswa::count() / 20);

            if ($page > $totalPages) {
                $page = $totalPages > 0 ? $totalPages : 1;
            }

            return redirect()->route('mahasiswa.index', ['page' => $page])->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
