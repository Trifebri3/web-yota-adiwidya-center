<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use App\Models\WorkspaceTask;
use App\Models\WorkspaceComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenWorkspaceController extends Controller
{
    /**
     * Menampilkan semua workspace yang diikuti oleh user yang login.
     */
public function index()
{
    $user = Auth::user();

    if ($user->isDirektur()) {
        // Direktur melihat SEMUA Workspace yang ada di PT YOTA
        $workspaces = Workspace::with(['creator'])
            ->withCount('tasks')
            ->latest()
            ->get();
    } else {
        // Anggota hanya melihat Workspace yang terhubung di pivot table
        $workspaces = $user->workspaces()
            ->with(['creator'])
            ->withCount('tasks')
            ->latest()
            ->get();
    }

    return view('generalfitur.workspace.index', compact('workspaces'));
}

    /**
     * Masuk ke dalam detail Workspace (Melihat Board & Tugas).
     */
public function show($id)
{
    $workspace = Workspace::with(['tasks.assignee', 'users', 'tasks.comments.user'])->findOrFail($id);
    $user = Auth::user();

    // Jika bukan Direktur DAN tidak terdaftar di workspace, maka dilarang masuk
    if (!$user->isDirektur() && !$workspace->users->contains($user->id)) {
        abort(403, 'Anda tidak memiliki akses ke Workspace ini.');
    }

    return view('generalfitur.workspace.show', compact('workspace'));
}

    /**
     * Menampilkan detail tugas spesifik dan memicu 'last_viewed_at'.
     */
    public function showTask(WorkspaceTask $task)
    {
        // Update jejak digital (kapan terakhir dilihat)
        if ($task->assignee_id == Auth::id()) {
            $task->update(['last_viewed_at' => now()]);
        }

        $task->load(['comments.user', 'workspace']);

        return view('generalfitur.workspace.task_detail', compact('task'));
    }

    /**
     * Mengupdate status tugas (Update Progres Kerja).
     */
    public function updateTaskStatus(Request $request, WorkspaceTask $task)
    {
        $request->validate([
            'status' => 'required|in:to-do,doing,submitted,revision,acc',
            'submission_link' => 'nullable|url'
        ]);

        $task->update([
            'status' => $request->status,
            'submission_link' => $request->submission_link ?? $task->submission_link
        ]);

        return back()->with('success', 'Status tugas berhasil diperbarui.');
    }

    /**
     * Fitur Diskusi: Menambahkan komentar pada tugas.
     */
    public function storeComment(Request $request, WorkspaceTask $task)
    {
        $request->validate(['comment' => 'required|string']);

        WorkspaceComment::create([
            'workspace_task_id' => $task->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Komentar ditambahkan.');
    }

    /**
 * Fitur Pin Priority (Toggle)
 */
public function togglePriority(Workspace $workspace)
{
    $workspace->update([
        'is_priority' => !$workspace->is_priority
    ]);

    return back()->with('success', 'Status prioritas diperbarui.');
}

/**
 * Update Status Workspace (Active/Archived/Completed)
 */
public function updateStatus(Request $request, Workspace $workspace)
{
    $request->validate(['status' => 'required|in:active,archived,completed']);

    $workspace->update(['status' => $request->status]);

    return back()->with('success', 'Workspace berhasil dipindahkan.');
}
public function createTask($workspace_id)
{
    $workspace = Workspace::findOrFail($workspace_id);

    // Ambil anggota workspace ini untuk dipilih sebagai assignee
    $members = $workspace->users;

    return view('generalfitur.workspace.task_create', compact('workspace', 'members'));
}

/**
 * Menyimpan tugas baru ke database
 */
public function storeTask(Request $request)
{
    $request->validate([
        'workspace_id' => 'required|exists:workspaces,id',
        'assignee_id'  => 'required|exists:users,id',
        'title'        => 'required|string|max:255',
        'due_date'     => 'required|date',
        'category'     => 'required|string',
    ]);

    WorkspaceTask::create([
        'workspace_id'    => $request->workspace_id,
        'assignee_id'     => $request->assignee_id,
        'creator_id'      => Auth::id(), // Pengirim tugas (Siapa saja bisa)
        'title'           => $request->title,
        'description'     => $request->description,
        'category'        => $request->category,
        'instruction_link'=> $request->instruction_link,
        'due_date'        => $request->due_date,
        'status'          => 'to-do',
    ]);

    return redirect()->route('general.workspace.show', $request->workspace_id)
        ->with('success', 'Tugas baru berhasil ditambahkan ke board.');
}
}
