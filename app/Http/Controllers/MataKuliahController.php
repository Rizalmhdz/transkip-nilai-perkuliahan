<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matakuliahs = MataKuliah::all(); // Ambil semua data mata kuliah dari database
        return view('matakuliah.index', compact('matakuliahs'));
    }
}
