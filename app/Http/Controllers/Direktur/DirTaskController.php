<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirTaskController extends Controller
{
    /**
     * Tampilkan semua daftar tugas yang didelegasikan.
     */
public function index()
{
    // Mengambil semua tugas untuk Kalender & Stats
    $allTasks = Task::with('division')->get();

    // Mengambil tugas untuk List (dengan Pagination)
    $tasks = Task::with(['division', 'author'])
        ->latest()
        ->paginate(12);

    // Hitung Stats untuk Monitoring Direktur
    $stats = [
        'total'     => $allTasks->count(),
        'completed' => $allTasks->where('status', 'completed')->count(),
        'revision'  => $allTasks->where('status', 'revision')->count(),
        'pending'   => $allTasks->where('status', 'pending')->count(),
        // Hitung rata-rata progres organisasi
        'avg_progress' => $allTasks->count() > 0
            ? round(($allTasks->where('status', 'completed')->count() / $allTasks->count()) * 100)
            : 0
    ];

    return view('direktur.task.index', compact('tasks', 'allTasks', 'stats'));
}

    /**
     * Form pembuatan tugas/delegasi baru.
     */
    public function create()
    {
        $divisions = Division::all();
        return view('direktur.task.create', compact('divisions'));
    }

    /**
     * Simpan tugas baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'deadline'         => 'required|date|after:today',
            'division_id'      => 'required|exists:divisions,id',
            'instruction_link' => 'nullable|url',
        ]);

        try {
            Task::create([
                'title'            => $request->title,
                'description'      => $request->description,
                'deadline'         => $request->deadline,
                'instruction_link' => $request->instruction_link,
                'division_id'      => $request->division_id,
                'author_id'        => Auth::id(),
                'status'           => 'pending',
            ]);

            return redirect()->route('direktur.task.index')
                ->with('success', 'Delegasi tugas berhasil dikirim ke divisi terkait.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal membuat tugas: ' . $e->getMessage());
        }
    }

    /**
     * Pantau progres tugas secara detail.
     */
    public function show(Task $task)
    {
        return view('direktur.task.show', compact('task'));
    }

    /**
     * Form edit data tugas.
     */
    public function edit(Task $task)
    {
        $divisions = Division::all();
        return view('direktur.task.edit', compact('task', 'divisions'));
    }

    /**
     * Update data tugas atau beri feedback/revisi.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'status'      => 'required|in:pending,read,doing,submitted,revision,completed',
            'director_note' => 'nullable|string',
        ]);

        try {
            $task->update($request->all());

            return redirect()->route('direktur.task.index')
                ->with('success', 'Data tugas dan feedback berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui tugas: ' . $e->getMessage());
        }
    }

    /**
     * Hapus delegasi tugas.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Tugas telah ditarik/dihapus.');
    }

    /**
     * Shortcut untuk ACC (Complete) Tugas
     */
    public function approve(Task $task)
    {
        $task->update([
            'status' => 'completed',
            'director_note' => 'Approved by Director at ' . now()->format('d/m/Y H:i')
        ]);

        return back()->with('success', 'Tugas telah di-ACC dan selesai.');
    }
}
