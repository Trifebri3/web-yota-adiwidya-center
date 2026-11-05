<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\DivisionAgenda;
use App\Models\Archive;
use App\Models\Timeline;
use App\Models\Division;
use App\Models\Evaluation;
use App\Models\AgendaPresence;
use Illuminate\Http\Request;

class AuditResourceController extends Controller
{
    /**
     * Dashboard Laporan Sumber Daya & Perencanaan
     */
    public function index()
    {
        // 1. Ambil Timeline yang sedang berjalan (Monitoring Progres)
        $timelines = Timeline::with('stages')->latest()->get();

        // 2. Ambil Agenda Pusat & Divisi mendatang
        $globalAgendas = Agenda::where('start_time', '>=', now())->orderBy('start_time')->take(5)->get();
        $divisionAgendas = DivisionAgenda::with('division')->where('start_time', '>=', now())->orderBy('start_time')->take(5)->get();

        // 3. Statistik Arsip
        $archiveStats = [
            'total' => Archive::count(),
            'public' => Archive::where('is_public', true)->count(),
            'private' => Archive::where('is_public', false)->count(),
        ];

        return view('admin.audit.resources.index', compact('timelines', 'globalAgendas', 'divisionAgendas', 'archiveStats'));
    }

    /**
     * Melihat Detail Timeline & Progres Tahapan
     */
    public function showTimeline(Timeline $timeline)
    {
        $timeline->load('stages');
        return view('admin.audit.resources.timeline-detail', compact('timeline'));
    }

    /**
     * Eksplorasi Arsip Digital (Database File & Link)
     */
    public function archiveDirectory(Request $request)
    {
        $query = Archive::with('user');

        if ($request->has('category')) {
            $query->inCategory($request->category);
        }

        $archives = $query->latest()->paginate(20);
        return view('admin.audit.resources.archive-index', compact('archives'));
    }
    public function timsoks()
{
    // Mengambil semua divisi dengan hitungan kehadiran dan evaluasi
    $divisions = Division::withCount(['members', 'reports'])->get();

    // Menghitung performa rata-rata (Contoh logic sederhana)
    $teamPerformance = $divisions->map(function($div) {
        return [
            'name' => $div->name,
            'member_count' => $div->members_count,
            // Misal: Ambil rata-rata kehadiran member di divisi ini
            'presence_rate' => AgendaPresence::whereIn('user_id', $div->members->pluck('id'))
                                ->where('status', 'hadir')->count(),
            'evaluation_score' => Evaluation::where('division_id', $div->id)->count()
        ];
    });

    return view('admin.audit.performance.timsoks', compact('teamPerformance'));
}
}
