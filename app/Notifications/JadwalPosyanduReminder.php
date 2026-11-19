<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class JadwalPosyanduReminder extends Notification
{
    use Queueable;

    protected $jadwal;

    public function __construct($jadwal)
    {
        $this->jadwal = $jadwal;
    }

    // Kita hanya menggunakan channel database (In-App)
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    // Data yang akan disimpan ke tabel notifications
    public function toArray(object $notifiable): array
    {
        return [
            'judul' => 'Pengingat Jadwal Posyandu',
            'pesan' => 'Jangan lupa, tanggal ' . \Carbon\Carbon::parse($this->jadwal->tanggal)->format('d M Y') . ' ada kegiatan ' . $this->jadwal->kegiatan . ' di ' . $this->jadwal->posyandu->nama . '.',
            'url' => route('dashboard.orangtua'),
        ];
    }
}
