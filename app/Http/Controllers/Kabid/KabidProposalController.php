<?php

namespace App\Http\Controllers\Kabid;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KabidProposalController extends Controller
{
    /**
     * Tampilkan semua pengajuan proposal dari divisi Kabid
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil proposal yang diajukan oleh user ini atau dalam divisi yang sama
        $proposals = Proposal::with(['user', 'reviewer', 'approver'])
            ->where('division_id', $user->division_id)
            ->latest()
            ->paginate(10);

        return view('kabid.proposal.index', compact('proposals'));
    }

    /**
     * Form pengajuan proposal baru
     */
    public function create()
    {
        return view('kabid.proposal.create');
    }

    /**
     * Simpan pengajuan proposal
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:budget,program,inventory,human_resource,other',
            'description' => 'required|string',
            'document_url' => 'nullable|url',
            // Jika kategori budget, estimated_cost wajib diisi
            'estimated_cost' => $request->category === 'budget' ? 'required|numeric|min:0' : 'nullable|numeric|min:0',
        ]);

        try {
            // GENERATOR NOMOR REFERENSI: PROP/KODE-DIVISI/TGL/RANDOM
            $divCode = strtoupper(Str::limit(Auth::user()->division->name, 3, ''));
            $refNumber = "PROP/" . $divCode . "/" . now()->format('Ymd') . "/" . strtoupper(Str::random(4));

            Proposal::create([
                'user_id' => Auth::id(),
                'division_id' => Auth::user()->division_id,
                'reference_number' => $refNumber,
                'title' => $request->title,
                'category' => $request->category,
                'description' => $request->description,
                'estimated_cost' => $request->estimated_cost,
                'document_url' => $request->document_url,
                'status' => 'pending',
            ]);

            return redirect()->route('kabid.proposal.index')
                ->with('success', 'Proposal ' . $refNumber . ' berhasil diajukan dan menunggu review.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal mengajukan proposal: ' . $e->getMessage());
        }
    }

    /**
     * Lihat detail status dan feedback (dari Reviewer/Direktur)
     */
    public function show(Proposal $proposal)
    {
        // Security check: Hanya bisa lihat proposal divisi sendiri
        if ($proposal->division_id !== Auth::user()->division_id) {
            abort(403, 'Akses ditolak.');
        }

        return view('kabid.proposal.show', compact('proposal'));
    }

    /**
     * Edit Proposal (Hanya bisa jika status masih pending atau revised)
     */
    public function edit(Proposal $proposal)
    {
        if (!in_array($proposal->status, ['pending', 'revised'])) {
            return back()->with('error', 'Proposal yang sedang diproses tidak dapat diubah.');
        }

        return view('kabid.proposal.edit', compact('proposal'));
    }

    /**
     * Update Proposal
     */
    public function update(Request $request, Proposal $proposal)
    {
        // Validasi sama seperti store...
        $proposal->update($request->all());

        // Jika diupdate setelah revisi, kembalikan status ke pending/review
        $proposal->update(['status' => 'pending']);

        return redirect()->route('kabid.proposal.index')->with('success', 'Proposal diperbarui.');
    }

    /**
     * Batalkan/Hapus Proposal
     */
    public function destroy(Proposal $proposal)
    {
        if ($proposal->status === 'approved') {
            return back()->with('error', 'Proposal yang sudah disetujui tidak dapat dihapus.');
        }

        $proposal->delete();
        return back()->with('success', 'Proposal berhasil ditarik.');
    }
}
