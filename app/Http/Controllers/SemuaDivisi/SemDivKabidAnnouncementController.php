<?php

namespace App\Http\Controllers\SemuaDivisi;

use App\Http\Controllers\Controller;
use App\Models\KabidPengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemDivKabidAnnouncementController extends Controller
{
    /**
     * Menampilkan daftar pengumuman dari Kabid untuk divisi user yang login.
     */
    public function index()
    {
        $user = Auth::user();

        // Pastikan user punya divisi sebelum query
        if (!$user->division_id) {
            $announcements = collect(); // Kirim koleksi kosong jika belum ada divisi
        } else {
            $announcements = KabidPengumuman::with(['user', 'division'])
                ->active() // Menggunakan scopeActive dari model
                ->byDivision($user->division_id) // Menggunakan scopeByDivision dari model
                ->latest()
                ->paginate(10);
        }

        return view('semuadivisi.kabid_announcement.index', compact('announcements'));
    }

    /**
     * Menampilkan detail pengumuman Kabid.
     */
    public function show(KabidPengumuman $kabidPengumuman)
    {
        $user = Auth::user();

        // Keamanan: Cek apakah pengumuman aktif dan milik divisi user tersebut
        if (!$kabidPengumuman->is_active || $kabidPengumuman->division_id !== $user->division_id) {
            abort(403, 'Anda tidak memiliki akses ke pengumuman ini.');
        }

        return view('semuadivisi.kabid_announcement.show', [
            'announcement' => $kabidPengumuman
        ]);
    }
}
