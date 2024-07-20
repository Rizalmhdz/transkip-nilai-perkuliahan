<?php

namespace App\Http\Controllers;

use App\Models\HasilStudi;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\DosenProdi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $authority_level = $user->level;
        
        $mahasiswaBimbinganAkademik = 0;
        $mataKuliahDiampu = 0;
        $mahasiswaBimbinganKaryaTulis = 0;
        // $karya_tulis = 

        if ($authority_level == 2) {
            $dosen = Dosen::where('email_dosen', $user->email)->first();
            $mahasiswaBimbinganAkademik = Mahasiswa::where('dosen_akademik', $dosen->nidn)->count();
            $mataKuliahDiampu = MataKuliah::where('dosen_pengampu', $dosen->nidn)->count();
            // $mahasiswaBimbinganKaryaTulis = Mahasiswa::whereHas('nim', function ($query) use ($dosen) {
            //     $query->where('pembimbing', $dosen->nidn);
            // })->count();
        }

        $total = DosenProdi::count();
        $dosen_prodis = DosenProdi::paginate(20);
        $dosens = Dosen::all();
        $prodis = Prodi::all();

        return view('dashboard', compact(
            'mahasiswaBimbinganAkademik', 
            'mataKuliahDiampu', 
            'mahasiswaBimbinganKaryaTulis', 
            'dosen_prodis', 
            'dosens', 
            'prodis', 
            'total', 
            'authority_level'
        ));
    }
}
