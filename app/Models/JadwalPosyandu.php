<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    // Mengizinkan semua kolom diisi
    protected $guarded = [];

    // Relasi ke tabel Posyandu
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class);
    }
}
