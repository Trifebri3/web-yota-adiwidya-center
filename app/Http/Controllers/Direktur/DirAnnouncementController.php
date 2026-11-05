<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirAnnouncementController extends Controller
{
    /**
     * INDEX: Menampilkan semua pengumuman yang telah dibuat.
     */
    public function index()
    {
        $announcements = Announcement::with(['division', 'author'])
            ->latest()
            ->paginate(10);

        return view('direktur.announcement.index', compact('announcements'));
    }

    /**
     * CREATE: Form pembuatan instruksi/pengumuman baru.
     */
    public function create()
    {
        $divisions = Division::all(); // Untuk pilihan target pengumuman
        return view('direktur.announcement.create', compact('divisions'));
    }

    /**
     * STORE: Menyimpan pengumuman ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'required',
            'priority'   => 'required|in:low,medium,high,urgent',
            'division_id'=> 'nullable|exists:divisions,id', // Null berarti untuk umum
            'expires_at' => 'nullable|date|after:now',
        ]);

        try {
            Announcement::create([
                'title'       => $request->title,
                'content'     => $request->content,
                'priority'    => $request->priority,
                'division_id' => $request->division_id,
                'expires_at'  => $request->expires_at,
                'author_id'   => Auth::id(), // Direktur yang login
                'is_active'   => $request->has('is_active') ? true : true,
            ]);

            return redirect()->route('direktur.announcement.index')
                ->with('success', 'Pengumuman resmi berhasil diterbitkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menerbitkan pengumuman: ' . $e->getMessage());
        }
    }

    /**
     * SHOW: Detail pengumuman (Jika diperlukan preview).
     */
    public function show(Announcement $announcement)
    {
        return view('direktur.announcement.show', compact('announcement'));
    }

    /**
     * EDIT: Mengubah isi instruksi yang sudah ada.
     */
    public function edit(Announcement $announcement)
    {
        $divisions = Division::all();
        return view('direktur.announcement.edit', compact('announcement', 'divisions'));
    }

    /**
     * UPDATE: Memperbarui data pengumuman.
     */
  public function update(Request $request, Announcement $announcement)
{
    $request->validate([
        'title'    => 'required|string|max:255',
        'content'  => 'required',
        'priority' => 'required|in:low,medium,high,urgent',
    ]);

    // Ambil semua data input
    $data = $request->all();

    // Konversi nilai checkbox 'on' menjadi boolean true/false
    $data['is_active'] = $request->has('is_active');

    $announcement->update($data);

    return redirect()->route('direktur.announcement.index')
        ->with('success', 'Pengumuman telah diperbarui.');
}

    /**
     * DESTROY: Menghapus pengumuman (Tarik kembali instruksi).
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Pengumuman berhasil dihapus dari sistem.');
    }

    /**
     * TOGGLE STATUS: Menonaktifkan pengumuman tanpa menghapus.
     */
    public function toggleStatus(Announcement $announcement)
    {
        $announcement->update([
            'is_active' => !$announcement->is_active
        ]);

        return back()->with('success', 'Status visibilitas pengumuman berhasil diubah.');
    }
}
