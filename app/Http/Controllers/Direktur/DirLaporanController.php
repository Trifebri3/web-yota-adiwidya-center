<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\LaporanBidang;
use App\Models\Division;
use Illuminate\Http\Request;

class DirLaporanController extends Controller
{
    /**
     * Dashboard Pemantauan Seluruh Bidang
     */
    public function index(Request $request)
    {
        // Query Dasar dengan Eager Loading agar ringan
        $query = LaporanBidang::with(['division', 'user']);

        // Filter Berdasarkan Divisi (Jika Direktur ingin fokus ke satu bidang)
        if ($request->has('division_id') && $request->division_id != '') {
            $query->where('division_id', $request->division_id);
        }

        // Filter Berdasarkan Status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $reports = $query->latest()->paginate(15);
        $divisions = Division::all(); // Untuk dropdown filter

        return view('direktur.laporan.index', compact('reports', 'divisions'));
    }

    /**
     * Detail Laporan untuk Review Mendalam
     */
    public function show($id)
    {
        $report = LaporanBidang::with(['division', 'user'])->findOrFail($id);
        return view('direktur.laporan.show', compact('report'));
    }

    /**
     * Proses Validasi (ACC/Reject) & Feedback
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'feedback' => 'required|string|min:5',
        ]);

        $report = LaporanBidang::findOrFail($id);

        $report->update([
            'status' => $request->status,
            'feedback' => $request->feedback,
            'reviewed_at' => now(),
        ]);

        $message = $request->status == 'approved'
            ? 'Laporan telah disetujui (ACC).'
            : 'Laporan telah ditolak dan dikembalikan untuk revisi.';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Opsional: Fitur Edit jika Direktur ingin memperbaiki judul/kategori laporan
     */
    public function update(Request $request, $id)
    {
        $report = LaporanBidang::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'report_type' => 'required'
        ]);

        $report->update($request->only(['title', 'report_type', 'description']));

        return redirect()->back()->with('success', 'Informasi laporan berhasil diperbarui.');
    }

    /**
     * Menghapus laporan (Hanya jika diperlukan oleh Direktur)
     */
    public function destroy($id)
    {
        $report = LaporanBidang::findOrFail($id);
        $report->delete();

        return redirect()->route('direktur.laporan.index')->with('success', 'Laporan telah dihapus dari sistem.');
    }
}
