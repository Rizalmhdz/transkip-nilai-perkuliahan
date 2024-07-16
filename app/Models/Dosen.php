<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosens'; // Nama tabel di database

    protected $fillable = [
        'nip',
        'email_dosen',
        'nama',
    ];

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'dosen_pengampu', 'nip');
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_akademik', 'nip');
    }
}
