<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'nidn', 'email_dosen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email_dosen', 'email');
    }

    public function prodis()
    {
        return $this->hasMany(DosenProdi::class, 'nidn', 'nidn');
    }

    public function ketuaProdi()
    {
        return $this->hasOne(Prodi::class, 'ketua_prodi', 'nidn');
    }

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'dosen_pengampu', 'nidn');
    }
}
