<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriMatkul;
use App\Models\Prodi;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mata_kuliah',
        'sks',
        'kategori_matkul',
        'dosen_pengampu',
        'prodi',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pengampu', 'nidn');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriMatkul::class, 'kategori_matkul', 'kode_kategori');
    }
    
}
