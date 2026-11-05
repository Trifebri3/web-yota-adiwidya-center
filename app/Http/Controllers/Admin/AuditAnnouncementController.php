<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditAnnouncementController extends Controller
{
    /**
     * Menampilkan daftar pengumuman khusus dari sudut pandang Audit/Oversight.
     */
    public function index()
    {
        $announcements = Announcement::with(['division', 'author'])
            ->latest()
            ->paginate(10);

        return view('admin.audit.announcement.index', compact('announcements'));
    }

    /**
     * Form buat instruksi baru dari Pembina/Pengawas.
     */
    public function create()
    {
        $divisions = Division::all();
        return view('admin.audit.announcement.create', compact('divisions'));
    }

    /**
     * Simpan instruksi kebijakan ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'required',
            'priority'   => 'required|in:low,medium,high,urgent',
            'division_id'=> 'nullable|exists:divisions,id',
            'expires_at' => 'nullable|date|after:now',
        ]);

        try {
            Announcement::create([
                'title'       => $request->title,
                'content'     => $request->content,
                'priority'    => $request->priority,
                'division_id' => $request->division_id,
                'expires_at'  => $request->expires_at,
                'author_id'   => Auth::id(), // ID Pembina/Pengawas
                'is_active'   => true,
            ]);

            return redirect()->route('audit.announcement.index')
                ->with('success', 'Instruksi strategis berhasil diterbitkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function edit(Announcement $announcement)
    {
        $divisions = Division::all();
        return view('admin.audit.announcement.edit', compact('announcement', 'divisions'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required',
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $announcement->update($data);

        return redirect()->route('audit.announcement.index')
            ->with('success', 'Instruksi telah diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Pengumuman berhasil ditarik dari sistem.');
    }

    public function toggleStatus(Announcement $announcement)
    {
        $announcement->update([
            'is_active' => !$announcement->is_active
        ]);

        return back()->with('success', 'Status visibilitas berhasil diubah.');
    }
}
