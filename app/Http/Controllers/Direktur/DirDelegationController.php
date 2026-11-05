<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\Delegation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirDelegationController extends Controller
{
    /**
     * Tampilkan semua mandat yang telah diberikan.
     */
    public function index()
    {
        $delegations = Delegation::with(['user', 'director'])
            ->where('director_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('direktur.delegation.index', compact('delegations'));
    }

    /**
     * Form pemberian mandat baru.
     */
    public function create()
    {
        // Ambil semua user kecuali direktur sendiri
        $users = User::where('id', '!=', Auth::id())->get();
        return view('direktur.delegation.create', compact('users'));
    }

    /**
     * Simpan dan kirim mandat ke user terpilih.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'                  => 'required|string|max:255',
            'instruction'            => 'required',
            'deadline'               => 'required|date|after:now',
            'user_id'                => 'required|exists:users,id',
            'instruction_attachment' => 'nullable|url',
        ]);

        try {
            Delegation::create([
                'title'                  => $request->title,
                'instruction'            => $request->instruction,
                'instruction_attachment' => $request->instruction_attachment,
                'deadline'               => $request->deadline,
                'user_id'                => $request->user_id,
                'director_id'            => Auth::id(),
                'status'                 => 'sent',
            ]);

            return redirect()->route('direktur.delegation.index')
                ->with('success', 'Mandat personal telah berhasil dikirim.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal mengirim mandat: ' . $e->getMessage());
        }
    }

    /**
     * Detail pantauan mandat.
     */
    public function show(Delegation $delegation)
    {
        return view('direktur.delegation.show', compact('delegation'));
    }

    /**
     * Form perubahan detail mandat.
     */
    public function edit(Delegation $delegation)
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('direktur.delegation.edit', compact('delegation', 'users'));
    }

    /**
     * Update data mandat atau status (misal: minta revisi).
     */
    public function update(Request $request, Delegation $delegation)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'status'   => 'required|in:sent,read,in_progress,submitted,revision,completed',
            'deadline' => 'required|date',
        ]);

        $data = $request->all();

        // Jika status diubah ke completed, set waktunya
        if ($request->status == 'completed' && !$delegation->completed_at) {
            $data['completed_at'] = now();
        }

        $delegation->update($data);

        return redirect()->route('direktur.delegation.index')
            ->with('success', 'Detail mandat berhasil diperbarui.');
    }

    /**
     * Tarik kembali atau hapus mandat.
     */
    public function destroy(Delegation $delegation)
    {
        $delegation->delete();
        return back()->with('success', 'Mandat telah ditarik dan dihapus dari sistem.');
    }

    /**
     * Fungsi instan untuk memberikan ACC (Completed) pada mandat.
     */
public function complete(Delegation $delegation)
{
    $delegation->status = 'completed';
    $delegation->completed_at = now();
    $delegation->save();

    return back()->with('success', 'Mandat ACC Selesai!');
}
}
