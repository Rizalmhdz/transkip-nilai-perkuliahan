<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas'; // Nama tabel di database

    protected $fillable = [
        'nim',
        'nama_lengkap',
        'tanggal_lahir',
        'alamat',
        'angkatan',
        'email_mhs',
        'dosen_akademik',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_akademik', 'nip');
    }

    public function rencanaStudis()
    {
        return $this->hasMany(RencanaStudi::class, 'nim', 'nim');
    }
}
