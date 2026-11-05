<?php

namespace App\Http\Controllers\Kabid;

use App\Http\Controllers\Controller;
use App\Models\KabidTask;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class KabidTugasController extends Controller
{
    /**
     * Tampilkan semua tugas yang pernah dibuat oleh Kabid ini
     */
    public function index()
    {
        $tasks = KabidTask::with(['team', 'user'])
            ->where('kabid_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('kabid.tasks.index', compact('tasks'));
    }

    /**
     * Halaman form buat tugas (TugasDariKabid)
     */
    public function create()
    {
        $divisionId = auth()->user()->division_id;

        // Ambil Tim yang ada di divisi Kabid
        $teams = Team::where('division_id', $divisionId)->get();

        // Ambil User yang ada di divisi Kabid (untuk tugas personal)
        $members = User::where('division_id', $divisionId)
                       ->where('id', '!=', auth()->id())
                       ->get();

        return view('kabid.tasks.create', compact('teams', 'members'));
    }

    /**
     * Simpan Tugas Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'deadline' => 'required|date',
            'target_type' => 'required|in:team,personal',
        ]);

        $taskData = [
            'kabid_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => 'pending',
        ];

        // Tentukan apakah targetnya Tim atau Individu
        if ($request->target_type == 'team') {
            $taskData['team_id'] = $request->team_id;
        } else {
            $taskData['user_id'] = $request->user_id;
        }

        KabidTask::create($taskData);

        return redirect()->route('kabid-tugas.index')->with('success', 'Tugas berhasil didistribusikan!');
    }

    /**
     * Lihat detail pengumpulan tugas staf
     */
    public function show(KabidTask $kabid_tuga) // Laravel binding menggunakan nama route param
    {
        $task = $kabid_tuga->load(['team', 'user']);
        return view('kabid.tasks.show', compact('task'));
    }

    /**
     * Edit Tugas (Jika belum dikerjakan)
     */
    public function edit(KabidTask $kabid_tuga)
    {
        $task = $kabid_tuga;
        $divisionId = auth()->user()->division_id;
        $teams = Team::where('division_id', $divisionId)->get();
        $members = User::where('division_id', $divisionId)->get();

        return view('kabid.tasks.edit', compact('task', 'teams', 'members'));
    }

    /**
     * Update Tugas
     */
    public function update(Request $request, KabidTask $kabid_tuga)
    {
        $kabid_tuga->update($request->all());
        return redirect()->route('kabid-tugas.index')->with('success', 'Data tugas diperbarui!');
    }

    /**
     * Logic REVISI: Kabid menolak kiriman staf
     */
    public function revise(Request $request, KabidTask $task)
    {
        $request->validate(['revision_notes' => 'required']);

        $task->update([
            'status' => 'revised',
            'revision_notes' => $request->revision_notes,
            'submission_link' => null, // Reset link agar staf kirim ulang yang baru
        ]);

        return back()->with('success', 'Tugas dikembalikan untuk direvisi.');
    }

    /**
     * Logic SELESAI: Kabid menyetujui tugas
     */
    public function complete(KabidTask $task)
    {
        $task->update(['status' => 'completed']);
        return back()->with('success', 'Tugas dinyatakan Selesai/Completed!');
    }

    /**
     * Hapus Tugas
     */
    public function destroy(KabidTask $kabid_tuga)
    {
        $kabid_tuga->delete();
        return back()->with('success', 'Tugas berhasil dihapus.');
    }
}
