<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// routes/web.php

// Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboard');
// Route::get('/mata-kuliah', [MataKuliahController::class, 'view'])->name('mata-kuliah');
// Route::get('/dosen', [DosenController::class, 'view'])->name('dosen');
// Route::get('/mahasiswa', [MahasiswaController::class, 'view'])->name('mahasiswa');
// Route::get('/report', [ReportController::class, 'view'])->name('report');
// Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');



Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])->name('mata-kuliah');
Route::get('/mata-kuliah/{id}/edit', [MataKuliahController::class, 'edit'])->name('mata-kuliah.edit');
Route::put('/mata-kuliah/{id}', [MataKuliahController::class, 'update'])->name('mata-kuliah.update');
Route::delete('/mata-kuliah/{id}', [MataKuliahController::class, 'destroy'])->name('mata-kuliah.destroy');

Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
// Route::get('/mata-kuliah', function () {
//             return view('mata_kuliah_page');
//         })->name('mata-kuliah');
Route::get('/dosen', function () {
            return view('dashboard');
        })->name('dosen');
Route::get('/mahasiswa', function () {
            return view('dashboard');
        })->name('mahasiswa');
Route::get('/report', function () {
            return view('dashboard');
        })->name('report');
