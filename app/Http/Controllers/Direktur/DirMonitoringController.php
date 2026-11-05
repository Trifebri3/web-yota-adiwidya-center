<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\DivisionAgenda;
use App\Models\KabidDokumen;
use App\Models\KabidPengumuman;
use App\Models\KabidTask;
use App\Models\Division;
use Illuminate\Http\Request;

class DirMonitoringController extends Controller
{
    /**
     * Dashboard Monitoring Utama untuk Direktur
     */
public function index()
{
    $stats = [
        'total_tasks' => KabidTask::count(),
        'pending_tasks' => KabidTask::where('status', 'pending')->count(),
        'completed_tasks' => KabidTask::where('status', 'completed')->count(),
        'total_documents' => KabidDokumen::count(),
        'active_announcements' => \App\Models\KabidPengumuman::where('is_active', true)->count(),
    ];

    // Tambahkan withCount agar data angka muncul di tabel
    $divisions = Division::withCount(['agendas'])->get();

    return view('direktur.monitoring.index', compact('stats', 'divisions'));
}

    /**
     * Pantau Seluruh Agenda/Kalender Perusahaan
     */
    public function agenda(Request $request)
    {
        $query = DivisionAgenda::with(['division', 'creator']);

        // Filter berdasarkan divisi jika dipilih
        if ($request->has('division_id') && $request->division_id != '') {
            $query->where('division_id', $request->division_id);
        }

        $events = $query->get()->map(function($event) {
            return [
                'id'    => $event->id,
                'title' => '[' . $event->division->name . '] ' . $event->title,
                'start' => $event->start_time->toIso8601String(),
                'end'   => $event->end_time->toIso8601String(),
                'backgroundColor' => $event->color,
                'extendedProps'   => [
                    'division' => $event->division->name,
                    'type'     => $event->type,
                    'location' => $event->location
                ]
            ];
        });

        return view('direktur.monitoring.agenda', compact('events'));
    }

    /**
     * Monitoring Tugas/Proyek Seluruh Divisi
     */
    public function tasks(Request $request)
    {
        $tasks = KabidTask::with(['kabid', 'team', 'user', 'kabid.division'])
            ->when($request->division_id, function($q) use ($request) {
                return $q->whereHas('kabid', function($query) use ($request) {
                    $query->where('division_id', $request->division_id);
                });
            })
            ->when($request->status, function($q) use ($request) {
                return $q->where('status', $request->status);
            })
            ->latest()
            ->paginate(15);

        return view('direktur.monitoring.tasks', compact('tasks'));
    }

    /**
     * Lihat Library Dokumen/Aset Digital Seluruh Divisi
     */
    public function documents(Request $request)
    {
        $documents = KabidDokumen::with(['user', 'user.division'])
            ->when($request->division_id, function($q) use ($request) {
                return $q->where('division_id', $request->division_id);
            })
            ->latest()
            ->paginate(20);

        return view('direktur.monitoring.documents', compact('documents'));
    }

    /**
     * Lihat Detail Tugas (Tanpa fungsi Update/Edit)
     */
    public function showTask($id)
    {
        $task = KabidTask::with(['kabid', 'team', 'user', 'kabid.division'])->findOrFail($id);

        // Direktur hanya melihat, tidak ada form submission/revisi di view ini
        return view('direktur.monitoring.show_task', compact('task'));
    }



    /**
     * Monitoring Service Request (Tiket antar divisi)
     */
    public function serviceRequests(Request $request)
    {
        $requests = \App\Models\ServiceRequest::with(['requester', 'requesterDivision', 'targetDivision', 'handler'])
            ->when($request->status, function($q) use ($request) {
                return $q->where('status', $request->status);
            })
            ->when($request->division_id, function($q) use ($request) {
                return $q->where('target_division_id', $request->division_id);
            })
            ->latest()
            ->paginate(15);

        return view('direktur.monitoring.service_requests', compact('requests'));
    }

    /**
     * Monitoring Proposal (Pengajuan Anggaran/Proyek)
     */
    public function proposals(Request $request)
    {
        $proposals = \App\Models\Proposal::with(['user', 'division', 'reviewer', 'approver'])
            ->when($request->status, function($q) use ($request) {
                return $q->where('status', $request->status);
            })
            ->latest()
            ->paginate(15);

        return view('direktur.monitoring.proposals', compact('proposals'));
    }

    /**
     * Monitoring Arsip (Dokumen yang dipublikasikan)
     */
    public function archives(Request $request)
    {
        // Direktur memantau semua arsip (baik public maupun milik user tertentu)
        $archives = \App\Models\Archive::with('user')
            ->when($request->category, function($q) use ($request) {
                return $q->where('category', $request->category);
            })
            ->latest()
            ->paginate(20);

        return view('direktur.monitoring.archives', compact('archives'));
    }

    
}
