<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaStudi extends Model
{
    use HasFactory;

    protected $table = 'rencana_studis'; // Nama tabel di database

    protected $fillable = [
        'nim',
        'tahun_ajaran',
        'semester',
        'status',
        'sks_tersedia',
        'sks_selanjutnya',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function hasilStudis()
    {
        return $this->hasMany(HasilStudi::class, 'id_rencana_studi', 'id');
    }
}
