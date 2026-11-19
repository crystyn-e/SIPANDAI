<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ibu_hamils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posyandu_id')->constrained('posyandus')->onDelete('cascade');
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->integer('umur');
            $table->string('nama_suami')->nullable();
            $table->string('no_hp')->nullable();

            $table->date('hpht')->nullable(); // Hari Pertama Haid Terakhir
            $table->date('hpl')->nullable(); // Hari Perkiraan Lahir
            $table->integer('gravida')->default(0); // Kehamilan ke-
            $table->integer('para')->default(0); // Jumlah anak lahir hidup
            $table->integer('abortus')->default(0); // Jumlah keguguran

            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('lingkar_lengan_atas', 5, 2)->nullable(); // LILA
            $table->string('status_risiko')->default('Normal'); // Normal, Risiko Tinggi

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ibu_hamils');
    }
};
