<?php

namespace App\Http\Controllers\SemuaDivisi;

use App\Http\Controllers\Controller;
use App\Models\Delegation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemDivDelegationController extends Controller
{
    /**
     * Menampilkan daftar mandat yang masuk ke user yang sedang login.
     */
    public function index()
    {
        $delegations = Delegation::with(['director'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('semuadivisi.delegation.index', compact('delegations'));
    }

    /**
     * Menampilkan detail mandat dan mengubah status menjadi 'read' otomatis saat dibuka.
     */
    public function show(Delegation $delegation)
    {
        // Pastikan mandat ini memang milik user tersebut
        if ($delegation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke mandat ini.');
        }

        // Jika status masih 'sent', ubah otomatis jadi 'read'
        if ($delegation->status === 'sent') {
            $delegation->update(['status' => 'read']);
        }

        return view('semuadivisi.delegation.show', compact('delegation'));
    }

    /**
     * Mengupdate progress mandat (Ubah ke In Progress atau Kirim Hasil Kerja).
     */
public function updateProgress(Request $request, $id)
{
    // Cari data
    $delegation = Delegation::findOrFail($id);

    // Validasi
    $request->validate([
        'status' => 'required|in:in_progress,submitted',
        'result_notes' => 'nullable|string',
        'submission_link' => 'nullable|url',
    ]);

    // UPDATE MANUAL SATU-SATU (ANTI GAGAL)
    $delegation->status = $request->status;
    $delegation->result_notes = $request->result_notes;
    $delegation->submission_link = $request->submission_link;

    if (!$delegation->read_at) {
        $delegation->read_at = now();
    }

    // Eksekusi Simpan
    if($delegation->save()) {
        return back()->with('success', 'Progress Mandat Berhasil Disimpan!');
    } else {
        return back()->with('error', 'Gagal menyimpan ke database!');
    }
}
}
