<?php

namespace App\Http\Controllers\Kabid;

use App\Http\Controllers\Controller;
use App\Models\LaporanBidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KabLaporanBidangController extends Controller
{
    /**
     * Menampilkan daftar laporan yang telah dikirim dan statusnya
     */
    public function index()
    {
        $divisionId = Auth::user()->division_id;

        // Ambil laporan khusus divisi ini, urutkan dari yang terbaru
        $reports = LaporanBidang::where('division_id', $divisionId)
            ->latest()
            ->paginate(10);

        return view('kabid.laporan.index', compact('reports'));
    }

    /**
     * Form untuk mengirim laporan baru
     */
    public function create()
    {
        // Biasanya Kabid akan melihat instruksi/template di sini
        return view('kabid.laporan.create');
    }

    /**
     * Menyimpan laporan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'report_type'  => 'required|in:Bulanan,Program,Tahunan,Khusus',
            'report_date'  => 'required|date',
            'report_link'  => 'required|url',
            'description'  => 'nullable|string',
        ]);

        LaporanBidang::create([
            'division_id' => Auth::user()->division_id,
            'user_id'      => Auth::id(),
            'title'       => $request->title,
            'report_type' => $request->report_type,
            'report_date' => $request->report_date,
            'description' => $request->description,
            'report_link' => $request->report_link,
            'status'      => 'pending', // Default status saat baru dikirim
        ]);

        return redirect()->route('kabid.laporan.index')
            ->with('success', 'Laporan berhasil dikirim dan sedang menunggu review Direktur.');
    }

    /**
     * Melihat detail laporan, feedback dari direktur, dsb.
     */
    public function show($id)
    {
        $report = LaporanBidang::where('division_id', Auth::user()->division_id)
            ->findOrFail($id);

        return view('kabid.laporan.show', compact('report'));
    }

    /**
     * Menghapus laporan jika statusnya masih pending
     */
    public function destroy($id)
    {
        $report = LaporanBidang::where('division_id', Auth::user()->division_id)
            ->where('status', 'pending') // Hanya bisa hapus jika belum di-ACC/Review
            ->findOrFail($id);

        $report->delete();

        return redirect()->back()->with('success', 'Laporan berhasil ditarik kembali.');
    }
    /**
     * Memperbarui laporan yang sudah ada
     */
    public function update(Request $request, $id)
    {
        // Temukan laporan milik divisi user, dan pastikan belum di-ACC (Approved)
        $report = LaporanBidang::where('division_id', Auth::user()->division_id)
            ->where('status', '!=', 'approved') // Mencegah edit jika sudah di-ACC
            ->findOrFail($id);

        $request->validate([
            'title'        => 'required|string|max:255',
            'report_type'  => 'required|in:Bulanan,Program,Tahunan,Khusus',
            'report_date'  => 'required|date',
            'report_link'  => 'required|url',
            'description'  => 'nullable|string',
        ]);

        $report->update([
            'title'       => $request->title,
            'report_type' => $request->report_type,
            'report_date' => $request->report_date,
            'description' => $request->description,
            'report_link' => $request->report_link,
            'status'      => 'pending', // Set kembali ke pending jika setelah revisi
        ]);

        return redirect()->route('kabid.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }
}
