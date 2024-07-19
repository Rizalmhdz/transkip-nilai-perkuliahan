<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenProdi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nidn',
        'prodi',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi', 'id');
    }
}
