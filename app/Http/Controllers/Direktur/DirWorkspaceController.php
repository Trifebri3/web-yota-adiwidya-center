<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DirWorkspaceController extends Controller
{
    /**
     * Tampilkan semua Workspace yang aktif.
     */
    public function index()
    {
        $workspaces = Workspace::with(['creator', 'users'])
            ->withCount(['tasks', 'tasks as completed_tasks_count' => function($query) {
                $query->where('status', 'acc');
            }])
            ->latest()
            ->paginate(9);

        return view('direktur.workspace.index', compact('workspaces'));
    }

    /**
     * Form pembuatan Workspace baru.
     */
    public function create()
    {
        // Ambil semua user untuk dipilih menjadi anggota (Invite Member)
        $users = User::where('id', '!=', Auth::id())->get();
        return view('direktur.workspace.create', compact('users'));
    }

    /**
     * Simpan Workspace dan sinkronisasi anggota.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_ids'    => 'required|array', // Anggota yang diundang
            'general_instruction_link' => 'nullable|url',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $workspace = Workspace::create([
                    'name'        => $request->name,
                    'description' => $request->description,
                    'general_instruction_link' => $request->general_instruction_link,
                    'created_by'  => Auth::id(),
                    'status'      => 'active',
                ]);

                // Sinkronisasi anggota ke tabel pivot workspace_user
                $workspace->users()->attach($request->user_ids);
            });

            return redirect()->route('direktur.workspace.index')
                ->with('success', 'Workspace Strategis berhasil diinisialisasi.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal membuat workspace: ' . $e->getMessage());
        }
    }

    /**
     * Detail Workspace: Melihat progres tugas dan daftar anggota.
     */
    public function show(Workspace $workspace)
    {
        $workspace->load(['users', 'tasks.assignee', 'tasks.creator']);
        return view('direktur.workspace.show', compact('workspace'));
    }

    /**
     * Form Edit Workspace.
     */
    public function edit(Workspace $workspace)
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $currentMemberIds = $workspace->users->pluck('id')->toArray();

        return view('direktur.workspace.edit', compact('workspace', 'users', 'currentMemberIds'));
    }

    /**
     * Update data Workspace dan anggota.
     */
    public function update(Request $request, Workspace $workspace)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'status'   => 'required|in:active,archived,completed',
            'user_ids' => 'required|array',
        ]);

        try {
            DB::transaction(function () use ($request, $workspace) {
                $workspace->update($request->only(['name', 'description', 'general_instruction_link', 'status']));

                // Update anggota (tambah/hapus yang tidak ada di list baru)
                $workspace->users()->sync($request->user_ids);
            });

            return redirect()->route('direktur.workspace.index')
                ->with('success', 'Konfigurasi Workspace berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui workspace: ' . $e->getMessage());
        }
    }

    /**
     * Hapus permanen Workspace.
     */
    public function destroy(Workspace $workspace)
    {
        $workspace->delete(); // Cascade akan menghapus pivot dan tugas di dalamnya
        return back()->with('success', 'Workspace telah dihapus secara permanen.');
    }
}
