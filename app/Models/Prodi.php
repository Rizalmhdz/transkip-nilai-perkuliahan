<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_prodi',
        'ketua_prodi',
    ];

    public function ketua()
    {
        return $this->belongsTo(Dosen::class, 'ketua_prodi', 'nidn');
    }

    public function dosenProdis()
    {
        return $this->hasMany(DosenProdi::class, 'prodi', 'id');
    }

    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class, 'prodi', 'id');
    }
}
