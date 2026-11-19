<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemeriksaan_anaks', function (Blueprint $table) {
            $table->foreignId('jadwal_posyandu_id')->nullable()->constrained('jadwal_posyandus')->nullOnDelete();
        });
    }
    public function down(): void
    {
        Schema::table('pemeriksaan_anaks', function (Blueprint $table) {
            $table->dropForeign(['jadwal_posyandu_id']);
            $table->dropColumn('jadwal_posyandu_id');
        });
    }
};
