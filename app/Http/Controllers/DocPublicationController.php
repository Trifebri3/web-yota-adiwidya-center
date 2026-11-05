<?php

namespace App\Http\Controllers;

use App\Models\DocPublication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DocPublicationController extends Controller
{
    /**
     * Tampilan List untuk Admin
     */
    public function index()
    {
        $docs = DocPublication::latest()->paginate(10);
        return view('omc.docs.index', compact('docs'));
    }

    /**
     * Form Tambah Data
     */
    public function create()
    {
        return view('omc.docs.create');
    }

    /**
     * Proses Simpan (Store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'category'    => 'required|in:annual_report,policy_brief,official_statement',
            'description' => 'required',
            'pdf_path'    => 'required|url', // Validasi harus format link/URL
            'cover'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('docs/covers', 'public');
        }

        DocPublication::create([
            'title'        => $request->title,
            'category'     => $request->category,
            'description'  => $request->description,
            'pdf_path'     => $request->pdf_path, // Menyimpan link eksternal
            'cover_image'  => $coverPath,
            'published_at' => $request->published_at ?? now(),
            'is_verified'  => true,
        ]);

        return redirect()->route('omc.docs.index')->with('success', 'Dokumen berhasil diterbitkan!');
    }

    /**
     * Form Edit Data
     */
    public function edit(DocPublication $doc)
    {
        return view('omc.docs.edit', compact('doc'));
    }

    /**
     * Proses Update
     */
    public function update(Request $request, DocPublication $doc)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'category'    => 'required',
            'pdf_path'    => 'required|url',
            'cover'       => 'nullable|image|max:2048',
        ]);

        $data = [
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'pdf_path'    => $request->pdf_path,
            'published_at'=> $request->published_at,
        ];

        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($doc->cover_image) {
                Storage::disk('public')->delete($doc->cover_image);
            }
            $data['cover_image'] = $request->file('cover')->store('docs/covers', 'public');
        }

        $doc->update($data);

        return redirect()->route('omc.docs.index')->with('success', 'Dokumen berhasil diperbarui!');
    }

    /**
     * Hapus Data
     */
    public function destroy(DocPublication $doc)
    {
        if ($doc->cover_image) {
            Storage::disk('public')->delete($doc->cover_image);
        }

        $doc->delete();

        return redirect()->route('omc.docs.index')->with('success', 'Dokumen berhasil dihapus!');
    }

    /**
     * Tampilan untuk Publik (Index)
     */
    public function publicIndex(Request $request)
    {
        $query = DocPublication::verified();

        if ($request->category) {
            $query->byCategory($request->category);
        }

        $docs = $query->latest()->get();

        return view('public.docs.index', compact('docs'));
    }
}
