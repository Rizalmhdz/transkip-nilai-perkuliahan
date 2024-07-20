<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'angkatan', 'prodi', 'dosen_akademik', 'tahun_lulus',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi', 'id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_akademik', 'nidn');
    }

    public function hasilStudis()
    {
        return $this->hasMany(HasilStudi::class, 'nim', 'nim');
    }
}
