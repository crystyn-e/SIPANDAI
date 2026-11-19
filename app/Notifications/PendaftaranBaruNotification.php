<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PendaftaranBaruNotification extends Notification
{
    use Queueable;

    protected $namaUser;

    public function __construct($namaUser)
    {
        $this->namaUser = $namaUser;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'judul' => 'Pendaftaran Akun Baru',
            'pesan' => 'Ada pendaftar baru bernama ' . $this->namaUser . '. Silakan verifikasi di menu Verifikasi Akun.',
            'url' => route('kader.verifikasi.index'),
        ];
    }
}
