<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\KabidTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgtTugasController extends Controller
{
    /**
     * Tampilkan daftar tugas yang HANYA untuk user ini atau TIM user ini.
     */
public function index()
{
    $user = Auth::user();

    $query = KabidTask::where(function($q) use ($user) {
        $q->where('user_id', $user->id);
        if ($user->team_id) {
            $q->orWhere('team_id', $user->team_id);
        }
    });

    $tasks = $query->latest()->paginate(12);

    // Hitung Stats untuk Anggota
    $stats = [
        'total'     => $query->count(),
        'pending'   => $query->whereIn('status', ['pending', 'revised'])->count(),
        'submitted' => $query->where('status', 'submitted')->count(),
        'completed' => $query->where('status', 'completed')->count(),
    ];

    return view('anggota.tasks.index', compact('tasks', 'stats'));
}

    /**
     * Detail tugas - Proteksi Berlapis agar tidak bocor via URL
     */
    public function show($id)
    {
        $user = Auth::user();
        $task = KabidTask::with(['team', 'kabid'])->findOrFail($id);

        // LOGIC ANTI-BOCOR:
        // Jika tugas untuk personal, tapi bukan ID dia -> BLOKIR
        if ($task->user_id && $task->user_id !== $user->id) {
            abort(403, 'Anda dilarang mengakses tugas personal orang lain.');
        }

        // Jika tugas untuk tim, tapi bukan TIM dia -> BLOKIR
        if ($task->team_id && $task->team_id !== $user->team_id) {
            abort(403, 'Anda dilarang mengakses tugas tim divisi lain.');
        }

        // Antisipasi jika data kotor (tidak punya target)
        if (!$task->user_id && !$task->team_id) {
            abort(404, 'Data tugas tidak valid.');
        }

        return view('anggota.tasks.show', compact('task'));
    }

    /**
     * Update Submission - Sama ketatnya dengan Show
     */
public function submit(Request $request, $id)
{
    $user = Auth::user();
    $task = KabidTask::findOrFail($id);

    // Proteksi akses
    $isPersonalTarget = $task->user_id === $user->id;
    $isTeamTarget = $user->team_id && ($task->team_id === $user->team_id);

    if (!$isPersonalTarget && !$isTeamTarget) {
        abort(403, 'Aksi ilegal.');
    }

    $request->validate([
        'submission_link' => 'required|url',
        'submission_notes' => 'nullable|string'
    ]);

    // Update manual
    $task->submission_link = $request->submission_link;
    $task->submission_notes = $request->submission_notes;
    $task->status = 'submitted';
    // Kita tambahkan pencatatan waktu submit (pastikan ada di migration/fillable)
    $task->updated_at = now();

    if($task->save()) {
        return back()->with('success', 'Laporan tugas berhasil dikirim ke Kabid!');
    }

    return back()->with('error', 'Gagal menyimpan laporan.');
}
}
