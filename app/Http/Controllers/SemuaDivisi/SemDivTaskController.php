<?php

namespace App\Http\Controllers\SemuaDivisi;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemDivTaskController extends Controller
{
    /**
     * Menampilkan semua tugas yang didelegasikan ke DIVISI user tersebut.
     */
    public function index()
    {
        $user = Auth::user();

        // Hanya ambil tugas yang division_id nya sama dengan divisi si user
        $tasks = Task::with(['author', 'division'])
            ->where('division_id', $user->division_id)
            ->latest()
            ->paginate(12);

        return view('semuadivisi.task.index', compact('tasks'));
    }

    /**
     * Detail tugas dan update status otomatis saat dibuka (Read).
     */
    public function show($id)
    {
        $user = Auth::user();
        $task = Task::findOrFail($id);

        // Security: Pastikan user berasal dari divisi yang benar
        if ($task->division_id !== $user->division_id) {
            abort(403, 'Tugas ini bukan untuk divisi Anda.');
        }

        // Jika status masih pending, ubah ke 'read' secara otomatis
        if ($task->status === 'pending') {
            $task->update([
                'status' => 'read',
                'opened_at' => now()
            ]);
        }

        return view('semuadivisi.task.show', compact('task'));
    }

    /**
     * Update progress pengerjaan tugas (Submit hasil).
     */
public function submit(Request $request, $id)
{
    $task = Task::findOrFail($id);
    $user = Auth::user();

    // Pastikan user punya divisi
    if (!$user->division_id) {
        return back()->with('error', 'Akun Anda belum terdaftar di divisi manapun.');
    }

    // Security
    if ((int) $task->division_id !== (int) $user->division_id) {
        abort(403, 'Akses ditolak.');
    }

    $request->validate([
        'submission_link' => 'required|url',
        'status' => 'required|in:doing,submitted'
    ]);

    // Force Update Manual
    $task->submission_link = $request->submission_link;
    $task->status = $request->status;

    if ($task->save()) {
        return back()->with('success', 'Progress tugas tim berhasil diperbarui!');
    }

    return back()->with('error', 'Gagal menyimpan ke database.');
}
}
