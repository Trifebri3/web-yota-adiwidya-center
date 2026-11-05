<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenTodoController extends Controller
{
    /**
     * Tampilkan daftar to-do user yang login.
     */
    public function index()
    {
        $todos = Todo::where('user_id', Auth::id())
            ->orderBy('is_completed', 'asc') // Tugas belum selesai di atas
            ->orderByRaw("FIELD(priority, 'top', 'medium', 'chill')") // Urutkan prioritas
            ->latest()
            ->get();

        return view('general.todo.index', compact('todos'));
    }

    /**
     * Simpan to-do baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
            'priority' => 'required|in:top,medium,chill',
        ]);

        Todo::create([
            'user_id' => Auth::id(),
            'task' => $request->task,
            'priority' => $request->priority,
            'is_completed' => false,
        ]);

        return back()->with('status', 'Target baru berhasil ditambahkan ke daftar!');
    }

    /**
     * Update status selesai/belum.
     */
    public function toggle(Todo $todo)
    {
        // Security check
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);

        return back()->with('status', 'Status tugas diperbarui.');
    }

    /**
     * Hapus tugas dari daftar.
     */
    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        $todo->delete();

        return back()->with('status', 'Tugas berhasil dihapus.');
    }
}
