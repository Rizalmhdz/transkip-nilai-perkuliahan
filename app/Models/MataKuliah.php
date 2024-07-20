<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mata_kuliah', 'sks', 'kategori_matkul', 'dosen_pengampu', 'prodi',
    ];

    public function kategoriMatkul()
    {
        return $this->belongsTo(KategoriMatkul::class, 'kategori_matkul', 'kode_kategori');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pengampu', 'nidn');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi', 'id');
    }

    public function hasilStudis()
    {
        return $this->hasMany(HasilStudi::class, 'id_mata_kuliah', 'id');
    }
}
