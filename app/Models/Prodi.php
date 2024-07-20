<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_prodi', 'ketua_prodi'
    ];

    public function ketuaProdi()
    {
        return $this->belongsTo(Dosen::class, 'ketua_prodi', 'nidn');
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi');
    }

    public function dosens()
    {
        return $this->hasMany(DosenProdi::class, 'prodi');
    }

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'prodi');
    }
}
