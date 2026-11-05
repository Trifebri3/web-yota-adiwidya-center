<?php

namespace App\Http\Controllers\Kabid;

use App\Http\Controllers\Controller;
use App\Models\KabidDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KabidDokumenController extends Controller
{
    public function index()
    {
        $documents = KabidDokumen::where('division_id', Auth::user()->division_id)
            ->latest()
            ->get();
        return view('kabid.dokumen.index', compact('documents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link_url' => 'required|url',
            'category' => 'required'
        ]);

        KabidDokumen::create([
            'division_id' => Auth::user()->division_id,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'link_url' => $request->link_url,
            'description' => $request->description,
            'category' => $request->category,
        ]);

        return back()->with('success', 'Aset Digital berhasil diterbitkan!');
    }

    /**
     * Update Dokumen (Proses Simpan Perubahan)
     */
    public function update(Request $request, $id)
    {
        $doc = KabidDokumen::where('division_id', Auth::user()->division_id)->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'link_url' => 'required|url',
            'category' => 'required'
        ]);

        $doc->update([
            'title' => $request->title,
            'link_url' => $request->link_url,
            'description' => $request->description,
            'category' => $request->category,
        ]);

        return back()->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $doc = KabidDokumen::where('division_id', Auth::user()->division_id)->findOrFail($id);
        $doc->delete();
        return back()->with('success', 'Dokumen berhasil dihapus.');
    }
}
