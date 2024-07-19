<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{

    use HasFactory;

    protected $fillable = [
        'nama',
        'nidn',
        'email_dosen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email_dosen', 'email');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($dosen) {
            $user = User::where('email', $dosen->email_dosen)->first();
            if ($user) {
                $dosen->nama = $user->name;
            }
        });
    }

    public function prodi()
    {
        return $this->hasOne(Prodi::class, 'ketua_prodi', 'nidn');
    }

    public function dosenProdis()
    {
        return $this->hasMany(DosenProdi::class, 'nidn', 'nidn');
    }

    public function direkturs()
    {
        return $this->hasMany(Direktur::class, 'nidn', 'nidn');
    }

    public function mahasiswaAkademik()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_akademik', 'nidn');
    }

    public function karyaTulis()
    {
        return $this->hasMany(KaryaTulis::class, 'pembimbing', 'nidn');
    }

    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class, 'dosen_pengampu', 'nidn');
    }
    
}
