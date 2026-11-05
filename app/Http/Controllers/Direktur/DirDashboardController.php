<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DirDashboardController extends Controller
{
    /**
     * Mengganti mode tampilan header (Direktur vs Umum)
     * Disimpan dalam session agar persisten di seluruh halaman
     */
    public function switchHeaderMode($mode)
    {
        // Validasi agar hanya mode yang diizinkan yang diproses
        if (in_array($mode, ['direktur', 'umum'])) {
            session(['header_mode' => $mode]);

            $message = $mode === 'direktur'
                ? 'Kembali ke Navigasi Otoritas Direktur.'
                : 'Beralih ke Workspace Mode Umum.';

            return back()->with('status', $message);
        }

        return back()->with('error', 'Mode navigasi tidak dikenali.');
    }
}
