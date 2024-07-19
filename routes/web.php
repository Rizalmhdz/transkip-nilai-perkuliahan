<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\DosenProdiController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HasilStudiController;
use App\Http\Controllers\KaryaTulisController;
use App\Http\Controllers\KategoriMatkulController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PdfController;

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


#================================================== Mata Kuliah
Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])->name('mata-kuliah.index');
Route::get('/mata-kuliah/create', [MataKuliahController::class, 'create'])->name('mata-kuliah.create');
Route::post('/mata-kuliah', [MataKuliahController::class, 'store'])->name('mata-kuliah.store');
Route::get('/mata-kuliah/{mataKuliah}/edit', [MataKuliahController::class, 'edit'])->name('mata-kuliah.edit');
Route::put('/mata-kuliah/{mataKuliah}', [MataKuliahController::class, 'update'])->name('mata-kuliah.update');
Route::delete('/mata-kuliah/{mataKuliah}', [MataKuliahController::class, 'destroy'])->name('mata-kuliah.destroy');


#================================================== Dosen 

Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
Route::get('/dosen/{dosen}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
Route::get('/dosen/{dosen}', [DosenController::class, 'show'])->name('dosen.show');

// Store and update routes using POST and PUT methods
Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
Route::put('/dosen/{dosen}', [DosenController::class, 'update'])->name('dosen.update');
Route::delete('/dosen/{dosen}', [DosenController::class, 'destroy'])->name('dosen.destroy');

#================================================== Users
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

#================================================== Dosen
Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
Route::get('/dosen/{dosen}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
Route::put('/dosen/{dosen}', [DosenController::class, 'update'])->name('dosen.update');
Route::delete('/dosen/{dosen}', [DosenController::class, 'destroy'])->name('dosen.destroy');

#================================================== Prodi
Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi.create');
Route::post('/prodi', [ProdiController::class, 'store'])->name('prodi.store');
Route::get('/prodi/{prodi}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
Route::put('/prodi/{prodi}', [ProdiController::class, 'update'])->name('prodi.update');
Route::delete('/prodi/{prodi}', [ProdiController::class, 'destroy'])->name('prodi.destroy');

#================================================== Dosen Prodi
Route::get('/dosen-prodi', [DosenProdiController::class, 'index'])->name('dosen-prodi.index');
Route::get('/dosen-prodi/create', [DosenProdiController::class, 'create'])->name('dosen-prodi.create');
Route::post('/dosen-prodi', [DosenProdiController::class, 'store'])->name('dosen-prodi.store');
Route::get('/dosen-prodi/{dosenProdi}/edit', [DosenProdiController::class, 'edit'])->name('dosen-prodi.edit');
Route::put('/dosen-prodi/{dosenProdi}', [DosenProdiController::class, 'update'])->name('dosen-prodi.update');
Route::delete('/dosen-prodi/{dosenProdi}', [DosenProdiController::class, 'destroy'])->name('dosen-prodi.destroy');

#================================================== Direktur
Route::get('/direktur', [DirekturController::class, 'index'])->name('direktur.index');
Route::get('/direktur/create', [DirekturController::class, 'create'])->name('direktur.create');
Route::post('/direktur', [DirekturController::class, 'store'])->name('direktur.store');
Route::get('/direktur/{direktur}/edit', [DirekturController::class, 'edit'])->name('direktur.edit');
Route::put('/direktur/{direktur}', [DirekturController::class, 'update'])->name('direktur.update');
Route::delete('/direktur/{direktur}', [DirekturController::class, 'destroy'])->name('direktur.destroy');

#================================================== Kategori Matkul
Route::get('/kategori-matkul', [KategoriMatkulController::class, 'index'])->name('kategori-matkul.index');
Route::get('/kategori-matkul/create', [KategoriMatkulController::class, 'create'])->name('kategori-matkul.create');
Route::post('/kategori-matkul', [KategoriMatkulController::class, 'store'])->name('kategori-matkul.store');
Route::get('/kategori-matkul/{kategoriMatkul}/edit', [KategoriMatkulController::class, 'edit'])->name('kategori-matkul.edit');
Route::put('/kategori-matkul/{kategoriMatkul}', [KategoriMatkulController::class, 'update'])->name('kategori-matkul.update');
Route::delete('/kategori-matkul/{kategoriMatkul}', [KategoriMatkulController::class, 'destroy'])->name('kategori-matkul.destroy');

#================================================== Mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

#================================================== Karya Tulis
Route::get('/karya-tulis', [KaryaTulisController::class, 'index'])->name('karya-tulis.index');
Route::get('/karya-tulis/create', [KaryaTulisController::class, 'create'])->name('karya-tulis.create');
Route::post('/karya-tulis', [KaryaTulisController::class, 'store'])->name('karya-tulis.store');
Route::get('/karya-tulis/{karyaTulis}/edit', [KaryaTulisController::class, 'edit'])->name('karya-tulis.edit');
Route::put('/karya-tulis/{karyaTulis}', [KaryaTulisController::class, 'update'])->name('karya-tulis.update');
Route::delete('/karya-tulis/{karyaTulis}', [KaryaTulisController::class, 'destroy'])->name('karya-tulis.destroy');

#================================================== Hasil Studi
Route::get('/hasil-studi', [HasilStudiController::class, 'index'])->name('hasil-studi.index');
Route::get('/hasil-studi/create', [HasilStudiController::class, 'create'])->name('hasil-studi.create');
Route::post('/hasil-studi', [HasilStudiController::class, 'store'])->name('hasil-studi.store');
Route::get('/hasil-studi/{hasilStudi}/edit', [HasilStudiController::class, 'edit'])->name('hasil-studi.edit');
Route::put('/hasil-studi/{hasilStudi}', [HasilStudiController::class, 'update'])->name('hasil-studi.update');
Route::delete('/hasil-studi/{hasilStudi}', [HasilStudiController::class, 'destroy'])->name('hasil-studi.destroy');


// =======================  generate PDF

Route::get('/generate-pdf', [PdfController::class, 'generatePdf']);