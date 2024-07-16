<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilStudi extends Model
{
    use HasFactory;

    protected $table = 'hasil_studis'; // Nama tabel di database

    protected $fillable = [
        'kode_mata_kuliah',
        'id_rencana_studi',
        'nilai',
        'status',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mata_kuliah', 'kode_mata_kuliah');
    }

    public function rencanaStudi()
    {
        return $this->belongsTo(RencanaStudi::class, 'id_rencana_studi', 'id');
    }
}
