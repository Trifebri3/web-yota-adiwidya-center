<?php

namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Models\ImpactReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImpactReportController extends Controller
{
    /**
     * Menampilkan daftar laporan dampak untuk admin.
     */
    public function index()
    {
        $reports = ImpactReport::latest()->paginate(10);
        return view('omc.impact.index', compact('reports'));
    }

    /**
     * Form untuk membuat laporan dampak baru.
     */
    public function create()
    {
        return view('omc.impact.create');
    }

    /**
     * Menyimpan laporan dampak baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title.id' => 'required|string|max:255',
            'category' => 'required',
            'pdf_path' => 'nullable|url',
            'cover'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Handle Upload Cover
        if ($request->hasFile('cover')) {
            $data['cover_image'] = $request->file('cover')->store('impact/covers', 'public');
        }

        // Slug otomatis dibuat di Model (boot method),
        // tapi pastikan input title dikirim sebagai array
        ImpactReport::create($data);

        return redirect()->route('omc.impact.index')->with('success', 'Impact Report berhasil diterbitkan.');
    }

    /**
     * Form edit laporan dampak.
     */
    public function edit(ImpactReport $impact)
    {
        return view('omc.impact.edit', compact('impact'));
    }

    /**
     * Memperbarui data laporan dampak.
     */
    public function update(Request $request, ImpactReport $impact)
    {
        $request->validate([
            'title.id' => 'required|string|max:255',
            'pdf_path' => 'nullable|url',
            'cover'    => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            // Hapus cover lama
            if ($impact->cover_image) {
                Storage::disk('public')->delete($impact->cover_image);
            }
            $data['cover_image'] = $request->file('cover')->store('impact/covers', 'public');
        }

        $impact->update($data);

        return redirect()->route('omc.impact.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Menghapus laporan dampak.
     */
    public function destroy(ImpactReport $impact)
    {
        if ($impact->cover_image) {
            Storage::disk('public')->delete($impact->cover_image);
        }

        $impact->delete();

        return redirect()->route('omc.impact.index')->with('success', 'Laporan berhasil dihapus.');
    }

    /**
     * Tampilan Publik (Show Detail)
     */
    public function showPublic($slug)
    {
        $report = ImpactReport::where('slug', $slug)
            ->where('is_verified', true)
            ->firstOrFail();

        return view('public.impact.show', compact('report'));
    }
}
