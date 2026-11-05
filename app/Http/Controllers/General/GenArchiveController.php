<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenArchiveController extends Controller
{
    /**
     * Tampilkan daftar arsip link (Milik sendiri + Publik)
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Archive::with('user')
            ->where(function($q) use ($user) {
                // Syarat: Milik sendiri ATAU ditandai publik
                $q->where('user_id', $user->id)
                  ->orWhere('is_public', true);
            });

        // Filter kategori jika ada pencarian
        if ($request->filled('category')) {
            $query->where('category', 'LIKE', '%' . $request->category . '%');
        }

        $archives = $query->latest()->paginate(15);

        return view('general.archive.index', compact('archives'));
    }

    /**
     * Simpan Arsip Link Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|max:50',
            'link_url'    => 'required|url', // WAJIB URL valid
            'label_color' => 'nullable|string|max:7',
            'description' => 'nullable|string',
        ]);

        Archive::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'label_color' => $request->label_color ?? '#64748b',
            'link_url'    => $request->link_url,
            'is_public'   => $request->has('is_public'),
            'status'      => 'active',
        ]);

        return back()->with('success', 'Link berhasil disimpan ke arsip digital!');
    }

    /**
     * Update Data Link
     */
    public function update(Request $request, Archive $archive)
    {
        // Proteksi: Hanya pemilik yang bisa edit
        if ($archive->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki otoritas mengedit link ini.');
        }

        $request->validate([
            'title'    => 'required|string|max:255',
            'link_url' => 'required|url',
        ]);

        $archive->update($request->all());

        // Handle checkbox is_public
        $archive->is_public = $request->has('is_public');
        $archive->save();

        return back()->with('success', 'Detail link berhasil diperbarui.');
    }

    /**
     * Hapus Link dari Arsip
     */
    public function destroy(Archive $archive)
    {
        if ($archive->user_id !== Auth::id()) {
            abort(403, 'Aksi ditolak.');
        }

        $archive->delete();

        return back()->with('success', 'Link telah dihapus dari arsip.');
    }
}
