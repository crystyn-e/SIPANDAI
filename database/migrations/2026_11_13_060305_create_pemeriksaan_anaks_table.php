<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemeriksaan_anaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('anaks')->onDelete('cascade');
            $table->date('tanggal_periksa');
            $table->decimal('berat_badan', 5, 2); // Contoh: 12.50 kg
            $table->decimal('tinggi_badan', 5, 2); // Contoh: 85.20 cm
            $table->decimal('lingkar_kepala', 5, 2)->nullable();
            $table->string('status_gizi')->nullable(); // Normal, Stunting, dll
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_anaks');
    }
};
