<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JadwalPosyandu;
use App\Models\User;
use App\Notifications\JadwalPosyanduReminder;
use Carbon\Carbon;

class KirimPengingatPosyandu extends Command
{
    // Nama perintah yang akan dipanggil di scheduler
    protected $signature = 'posyandu:kirim-pengingat';
    protected $description = 'Mengirim notifikasi pengingat jadwal posyandu H-3';

    public function handle()
    {
        // Cari tanggal 3 hari dari sekarang
        $tigaHariLagi = Carbon::now()->addDays(3)->format('Y-m-d');

        // Ambil jadwal yang jatuh tempo 3 hari lagi
        $jadwals = JadwalPosyandu::with('posyandu')->whereDate('tanggal', $tigaHariLagi)->get();

        if ($jadwals->isEmpty()) {
            $this->info('Tidak ada jadwal untuk 3 hari ke depan.');
            return;
        }

        foreach ($jadwals as $jadwal) {
            // Cari semua orang tua yang terdaftar di posyandu ini
            $orangtuas = User::role('orangtua')->where('posyandu_id', $jadwal->posyandu_id)->get();

            foreach ($orangtuas as $orangtua) {
                // Kirim notifikasi
                $orangtua->notify(new JadwalPosyanduReminder($jadwal));
            }
            $this->info('Notifikasi terkirim untuk Posyandu: ' . $jadwal->posyandu->nama);
        }
    }
}
