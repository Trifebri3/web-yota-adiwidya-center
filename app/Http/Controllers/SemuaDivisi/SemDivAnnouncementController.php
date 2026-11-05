<?php

namespace App\Http\Controllers\SemuaDivisi;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemDivAnnouncementController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil pengumuman yang AKTIF dan ditujukan untuk UMUM atau DIVISI user tersebut
        $announcements = Announcement::with(['author'])
            ->where('is_active', true)
            ->where(function($query) use ($user) {
                $query->whereNull('division_id')
                      ->orWhere('division_id', $user->division_id);
            })
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->latest()
            ->paginate(8);

        return view('semuadivisi.announcement.index', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        // Keamanan: Pastikan pengumuman aktif dan sesuai divisi sebelum ditampilkan
        if (!$announcement->is_active ||
           ($announcement->division_id !== null && $announcement->division_id !== Auth::user()->division_id)) {
            abort(403, 'Pengumuman tidak tersedia atau telah kedaluwarsa.');
        }

       return view('semuadivisi.announcement.show', compact('announcement')); // Pake kutip, bukan variabel
    }
}
