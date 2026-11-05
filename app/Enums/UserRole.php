<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case DIREKTUR = 'direktur';
    case PEMBINA = 'pembina';
    case PENGAWAS = 'pengawas';
    case KABID = 'kabid';
    case ANGGOTA = 'anggota';
    case OMC = 'omc';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Admin Utama',
            self::DIREKTUR => 'Direktur',
            self::PEMBINA => 'Pembina',
            self::PENGAWAS => 'Pengawas',
            self::KABID => 'Kepala Divisi',
            self::ANGGOTA => 'Anggota & Relawan',
            self::OMC => 'Official Media Center',
        };
    }
}
