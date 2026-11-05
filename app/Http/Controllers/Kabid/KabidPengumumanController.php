<?php

namespace App\Http\Controllers\Kabid;

use App\Http\Controllers\Controller;
use App\Models\KabidPengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KabidPengumumanController extends Controller
{
    /**
     * Menampilkan daftar pengumuman khusus divisi kabid tersebut
     */
    public function index()
    {
        $divisionId = Auth::user()->division_id;

        // Ambil pengumuman internal divisi, urutkan dari yang terbaru
        $announcements = KabidPengumuman::where('division_id', $divisionId)
            ->with('user') // Eager loading untuk tahu siapa pembuatnya
            ->latest()
            ->paginate(10);

        return view('kabid.pengumuman.index', compact('announcements'));
    }

    /**
     * Menyimpan pengumuman baru (Blast ke divisi)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'priority' => 'required|in:normal,urgent,critical',
        ]);

        KabidPengumuman::create([
            'division_id' => Auth::user()->division_id,
            'user_id'      => Auth::id(),
            'title'       => $request->title,
            'content'     => $request->content,
            'priority'    => $request->priority,
            'is_active'   => true,
        ]);

        return redirect()->back()->with('success', 'Pengumuman internal berhasil disebarkan!');
    }

    /**
     * Update status pengumuman (Aktif/Non-aktif)
     */
    public function toggleStatus($id)
    {
        $pengumuman = KabidPengumuman::where('division_id', Auth::user()->division_id)
            ->findOrFail($id);

        $pengumuman->update([
            'is_active' => !$pengumuman->is_active
        ]);

        return redirect()->back()->with('info', 'Status pengumuman berhasil diubah.');
    }

    /**
     * Menghapus pengumuman
     */
    public function destroy($id)
    {
        $pengumuman = KabidPengumuman::where('division_id', Auth::user()->division_id)
            ->findOrFail($id);

        $pengumuman->delete();

        return redirect()->back()->with('success', 'Pengumuman telah ditarik kembali.');
    }
}
