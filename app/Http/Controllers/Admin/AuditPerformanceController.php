<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AgendaPresence;
use App\Models\Evaluation;
use App\Models\Division;
use Illuminate\Http\Request;

class AuditPerformanceController extends Controller
{
    /**
     * Monitoring Kedisiplinan & Evaluasi Global
     */
    public function index()
    {
        // Statistik Absensi Global
        $presenceStats = [
            'total_hadir' => AgendaPresence::where('status', 'hadir')->count(),
            'total_alpha' => AgendaPresence::where('status', 'alpha')
                            ->orWhere(function($q) {
                                $q->where('status', 'pending')->whereHas('agenda', function($a) {
                                    $a->where('start_time', '<', now());
                                });
                            })->count(),
            'total_izin'  => AgendaPresence::whereIn('status', ['izin', 'sakit'])->count(),
        ];

        // Ambil Evaluasi Terbaru dari Direksi/Kabid
        $latestEvaluations = Evaluation::with(['author', 'user', 'division'])
                            ->latest()
                            ->paginate(10);

        return view('admin.audit.performance.index', compact('presenceStats', 'latestEvaluations'));
    }

    /**
     * Tracing Kedisiplinan Per User (Absensi Lengkap)
     */
    public function userPerformance(User $user)
    {
        $user->load(['division', 'identity']);

        // Ambil semua riwayat absensi user ini
        $presences = AgendaPresence::with('agenda')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get();

        // Ambil semua catatan evaluasi untuk user ini
        $evaluations = Evaluation::where('user_id', $user->id)
                      ->with('author')
                      ->latest()
                      ->get();

        return view('admin.audit.performance.user-trace', compact('user', 'presences', 'evaluations'));
    }

    /**
     * Review Lampiran Izin/Sakit (Read-Only untuk Pengawas)
     */
    public function reviewAttachment(AgendaPresence $presence)
    {
        // Memastikan pengawas bisa melihat bukti surat sakit/izin
        return view('admin.audit.performance.view-attachment', compact('presence'));
    }
    /**
 * Dashboard TIMSOKS: Melihat Efektivitas Kolektif Per Divisi
 */

}
