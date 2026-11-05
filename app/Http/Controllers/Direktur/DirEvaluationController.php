<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirEvaluationController extends Controller
{
    /**
     * Tampilkan semua daftar evaluasi.
     */
    public function index(Request $request)
    {
        $query = Evaluation::with(['division', 'user', 'author']);

        // Filter berdasarkan Tipe (Division/User) jika ada
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $evaluations = $query->latest()->paginate(10);

        return view('direktur.evaluation.index', compact('evaluations'));
    }

    /**
     * Form pembuatan evaluasi baru.
     */
    public function create()
    {
        $divisions = Division::all();
        // Ambil user yang bukan admin/direktur agar evaluasi tepat sasaran
        $users = User::whereNotIn('role', ['admin', 'direktur'])->get();

        return view('direktur.evaluation.create', compact('divisions', 'users'));
    }

    /**
     * Simpan evaluasi (Bisa ke Divisi atau Perorangan).
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
            'type'    => 'required|in:division,user',
            'label'   => 'required|in:improvement,warning,praise,general',
            // Validasi kondisional: jika type division maka division_id wajib, dst.
            'division_id' => 'required_if:type,division|nullable|exists:divisions,id',
            'user_id'     => 'required_if:type,user|nullable|exists:users,id',
        ]);

        try {
            Evaluation::create([
                'title'       => $request->title,
                'content'     => $request->content,
                'type'        => $request->type,
                'division_id' => $request->type == 'division' ? $request->division_id : null,
                'user_id'     => $request->type == 'user' ? $request->user_id : null,
                'label'       => $request->label,
                'author_id'   => Auth::id(),
                'is_read'     => false,
            ]);

            return redirect()->route('direktur.evaluation.index')
                ->with('success', 'Catatan evaluasi berhasil diterbitkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan evaluasi: ' . $e->getMessage());
        }
    }

    /**
     * Lihat detail evaluasi.
     */
    public function show(Evaluation $evaluation)
    {
        return view('direktur.evaluation.show', compact('evaluation'));
    }

    /**
     * Form edit evaluasi.
     */
    public function edit(Evaluation $evaluation)
    {
        $divisions = Division::all();
        $users = User::whereNotIn('role', ['admin', 'direktur'])->get();

        return view('direktur.evaluation.edit', compact('evaluation', 'divisions', 'users'));
    }

    /**
     * Update data evaluasi.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
            'label'   => 'required',
        ]);

        $evaluation->update($request->all());

        return redirect()->route('direktur.evaluation.index')
            ->with('success', 'Evaluasi berhasil diperbarui.');
    }

    /**
     * Hapus evaluasi.
     */
    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        return back()->with('success', 'Catatan evaluasi telah dihapus.');
    }
}
