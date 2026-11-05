<?php

namespace App\Http\Controllers\SemuaDivisi;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemDivEvaluationController extends Controller
{
    /**
     * Menampilkan daftar evaluasi yang relevan (Divisi saya ATAU Untuk saya).
     */
    public function index()
    {
        $user = Auth::user();

        // Query Gila: Ambil yang ditujukan ke USER_ID saya
        // ATAU yang ditujukan ke DIVISION_ID saya
        $evaluations = Evaluation::with(['author', 'division'])
            ->where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere('division_id', $user->division_id);
            })
            ->latest()
            ->paginate(10);

        return view('semuadivisi.evaluation.index', compact('evaluations'));
    }

    /**
     * Detail Evaluasi & Tandai Terbaca
     */
    public function show($id)
    {
        $user = Auth::user();
        $evaluation = Evaluation::findOrFail($id);

        // Keamanan: Cek apakah user berhak liat (Cek ID atau Cek Divisi)
        $isOwner = $evaluation->user_id == $user->id;
        $isSameDivision = $evaluation->division_id == $user->division_id;

        if (!$isOwner && !$isSameDivision) {
            abort(403, 'Anda tidak memiliki akses ke catatan evaluasi ini.');
        }

        // Tandai terbaca (Optional: hanya jika ini evaluasi personal)
        if ($isOwner && !$evaluation->is_read) {
            $evaluation->update(['is_read' => true]);
        }

        return view('semuadivisi.evaluation.show', compact('evaluation'));
    }
}
