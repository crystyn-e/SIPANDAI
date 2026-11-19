<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Posyandu;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        $kecamatan = Kecamatan::create(['nama' => 'Kecamatan Sukamaju']);

        $desa1 = Desa::create(['kecamatan_id' => $kecamatan->id, 'nama' => 'Desa Sukamakmur']);
        $desa2 = Desa::create(['kecamatan_id' => $kecamatan->id, 'nama' => 'Desa Sukasejahtera']);

        Posyandu::create(['desa_id' => $desa1->id, 'nama' => 'Posyandu Melati']);
        Posyandu::create(['desa_id' => $desa2->id, 'nama' => 'Posyandu Mawar']);
    }
}
