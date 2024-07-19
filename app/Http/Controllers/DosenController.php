<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\User;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'nama');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');

        $query = Dosen::query();

        if ($searchKeyword) {
            $query->where('nama', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('nidn', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('email_dosen', 'LIKE', "%{$searchKeyword}%");
        }

        $dosens = $query->orderBy($sort, $direction)->paginate(20);
        $total = $dosens->total();
        $availableEmails = User::whereDoesntHave('dosen')->pluck('email');

        return view('dosen_page', compact('dosens', 'total', 'sort', 'direction', 'searchKeyword', 'availableEmails'));
    }

    public function create()
    {
        $availableEmails = User::whereDoesntHave('dosen')->pluck('email');
        return view('dosen_page', compact('availableEmails'));
    }

    public function store(Request $request)
    {
        Dosen::create($request->all());

        return redirect()->route('dosen.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Dosen $dosen)
    {
        $availableEmails = User::whereDoesntHave('dosen')->pluck('email')->push($dosen->email_dosen);
        return view('dosen_page', compact('dosen', 'availableEmails'));
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->update($request->all());

        return redirect()->route('dosen.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Data berhasil dihapus');
    }
}
