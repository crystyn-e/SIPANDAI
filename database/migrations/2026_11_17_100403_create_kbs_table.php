<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kbs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posyandu_id')->constrained('posyandus')->onDelete('cascade');
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->string('nama_peserta');
            $table->integer('umur');
            $table->string('nama_suami')->nullable();
            $table->string('jenis_kontrasepsi'); // Pil, Suntik, IUD, Implant, Kondom, MOW/MOP
            $table->date('tanggal_mulai');
            $table->date('jadwal_ulang')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kbs');
    }
};
