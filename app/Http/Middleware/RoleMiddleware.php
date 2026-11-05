<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle(Request $request, Closure $next, ...$roles): Response
{
    // 1. Cek apakah user sudah login
    if (!Auth::check()) {
        return redirect('login');
    }

    // 2. Ambil role user (karena lo pake Enum, ambil .value nya)
    $userRole = Auth::user()->role->value;

    // 3. LOGIKA MULTI-ROLE (Kuncinya di sini!)
    // Kita cek apakah role user saat ini ada di dalam daftar roles yang diizinkan
    if (!in_array($userRole, $roles)) {
        abort(403, 'Akses Ditolak: Anda login sebagai ' . $userRole . '. Halaman ini khusus untuk: ' . implode(', ', $roles));
    }

    // 4. Logika Switch Mode (Tetap gue pertahankan sesuai kode lo)
    $mode = session('role_mode', 'direktur');

    if ($mode == 'anggota' && $request->is('direktur/*')) {
        return redirect()->route('anggota.dashboard');
    }

    return $next($request);
}


}
