<?php

namespace App\Http\Controllers;

use App\Models\HasilStudi;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\User;
use App\Models\KaryaTulis;
use App\Models\DosenProdi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
            $totalDosens = Dosen::count();
            $totalProdis = Prodi::count();
            $totalMahasiswas = Mahasiswa::count();
            $totalKaryaTuliss = KaryaTulis::count();
            $totalMataKuliahs = MataKuliah::count();
            $totalHasilStudis = HasilStudi::count();
        
            $prodiStats = Prodi::withCount(['dosens', 'mahasiswas', 'mataKuliahs', 'mahasiswas as mahasiswa_lulus' => function ($query) {
                $query->whereNotNull('tahun_lulus');
            }])->get()->mapWithKeys(function ($prodi) {
                return [
                    $prodi->nama_prodi => [
                        'prodi_id' => $prodi->id,
                        'dosens' => $prodi->dosens_count,
                        'mahasiswas' => $prodi->mahasiswas_count,
                        'mata_kuliahs' => $prodi->mata_kuliahs_count,
                        'mahasiswa_lulus' => $prodi->mahasiswa_lulus,
                    ],
                ];
            });
        
            return view('dashboard', compact(
                'totalUsers',
                'totalDosens',
                'totalProdis',
                'totalMahasiswas',
                'totalKaryaTuliss',
                'totalMataKuliahs',
                'totalHasilStudis',
                'prodiStats'
            ));
        }
}