<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMatkul extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori', 'kode_kategori',
    ];

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'kategori_matkul', 'kode_kategori');
    }
}
