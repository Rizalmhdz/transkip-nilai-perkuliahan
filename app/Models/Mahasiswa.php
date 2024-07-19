<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'angkatan',
        'dosen_akademik',
    ];

    public function dosenAkademik()
    {
        return $this->belongsTo(Dosen::class, 'dosen_akademik', 'nidn');
    }

    public function hasilStudi()
    {
        return $this->hasMany(HasilStudi::class, 'nim', 'nim');
    }
}
