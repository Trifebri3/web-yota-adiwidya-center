<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompleted
{

public function handle(Request $request, Closure $next): Response
{
    $user = $request->user();

    // ROLE YANG DIKECUALIKAN (BYPASS)
    // Admin, Pembina, dan Pengawas tidak perlu kunci profil lengkap
    $bypassedRoles = [
        \App\Enums\UserRole::ADMIN->value,
        \App\Enums\UserRole::PEMBINA->value,
        \App\Enums\UserRole::PENGAWAS->value,
    ];

    if (in_array($user->role->value, $bypassedRoles)) {
        return $next($request);
    }


    // WAJIB: Cek apakah kolom foto (avatar) sudah terisi
    if (empty($user->avatar)) {
        return redirect()->route('profile.complete')
            ->with('warning', 'Anda wajib mengunggah foto profil resmi sebelum dapat mengakses Dashboard.');
    }
    // Daftar kolom wajib untuk Anggota, Kabid, OMC, dan Direktur
    $requiredFields = ['nickname', 'phone_number', 'gender', 'pob', 'dob', 'domicile_address'];

    foreach ($requiredFields as $field) {
        if (empty($user->$field)) {
            return redirect()->route('profile.complete')
                ->with('warning', 'Akses dashboard terkunci. Silakan lengkapi profil Anda terlebih dahulu.');
        }
    }

    return $next($request);
}

}
