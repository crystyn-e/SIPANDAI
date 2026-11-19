<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanAnak extends Model
{
    protected $guarded = [];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
}
