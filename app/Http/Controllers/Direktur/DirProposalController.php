<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirProposalController extends Controller
{
    /**
     * Tampilkan semua proposal yang masuk ke meja Direktur
     */
    public function index()
    {
        // Direktur melihat semua proposal dari semua divisi
        $proposals = Proposal::with(['user', 'division', 'reviewer'])
            ->latest()
            ->paginate(15);

        return view('direktur.proposal.index', compact('proposals'));
    }

    /**
     * Detail proposal untuk bahan pertimbangan Direktur
     */
    public function show(Proposal $proposal)
    {
        return view('direktur.proposal.show', compact('proposal'));
    }

    /**
     * Logic ACC / Setujui Proposal
     */
    public function approve(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        $request->validate([
            'notes_from_director' => 'nullable|string|max:500',
        ]);

        $proposal->update([
            'status' => 'approved',
            'approver_id' => Auth::id(),
            'notes_from_director' => $request->notes_from_director ?? 'Proposal disetujui untuk dilaksanakan.',
            'approved_at' => now(),
        ]);

        return redirect()->route('direktur.proposal.index')
            ->with('success', 'Proposal ' . $proposal->reference_number . ' telah DISETUJUI.');
    }

    /**
     * Logic TOLAK Proposal
     */
    public function reject(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        // Direktur WAJIB memberikan alasan jika menolak
        $request->validate([
            'notes_from_director' => 'required|string|max:500',
        ]);

        $proposal->update([
            'status' => 'rejected',
            'approver_id' => Auth::id(),
            'notes_from_director' => $request->notes_from_director,
            'approved_at' => now(), // Waktu keputusan diambil
        ]);

        return redirect()->route('direktur.proposal.index')
            ->with('error', 'Proposal ' . $proposal->reference_number . ' telah DITOLAK.');
    }

    /**
     * Logic REVISI (Kembalikan ke Kabid)
     */
    public function revise(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        $request->validate([
            'notes_from_director' => 'required|string',
        ]);

        $proposal->update([
            'status' => 'revised',
            'notes_from_director' => $request->notes_from_director,
        ]);

        return redirect()->route('direktur.proposal.index')
            ->with('info', 'Proposal dikembalikan ke Kabid untuk revisi.');
    }
}
