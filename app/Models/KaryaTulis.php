<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaTulis extends Model
{
    use HasFactory;
    protected $table = "karya_tuliss";

    protected $fillable = [
        'judul', 'nim', 'pembimbing',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing', 'nidn');
    }
}
