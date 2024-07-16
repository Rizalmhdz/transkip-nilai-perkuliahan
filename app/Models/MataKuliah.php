<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliahs'; // Nama tabel di database

    protected $fillable = [
        'kode_mata_kuliah',
        'nama_mata_kuliah',
        'sks',
        'semester',
        'dosen_pengampu',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pengampu', 'nip');
    }

    public function hasilStudis()
    {
        return $this->hasMany(HasilStudi::class, 'kode_mata_kuliah', 'kode_mata_kuliah');
    }
}
