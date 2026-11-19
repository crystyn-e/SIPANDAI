<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    protected $guarded = [];

    // Relasi ke Orang Tua (User)
    public function orangtua()
    {
        return $this->belongsTo(User::class, 'orangtua_id');
    }

    // Relasi ke Posyandu
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class);
    }

    // Relasi ke Desa
    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function pemeriksaans()
    {
        return $this->hasMany(PemeriksaanAnak::class);
    }

    public function imunisasis()
    {
        return $this->hasMany(Imunisasi::class);
    }
}
