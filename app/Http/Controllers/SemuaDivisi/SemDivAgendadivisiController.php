<?php

namespace App\Http\Controllers\SemuaDivisi;

use App\Http\Controllers\Controller;
use App\Models\DivisionAgenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemDivAgendadivisiController extends Controller
{
    /**
     * Tampilan Kalender & Timeline khusus Divisi User
     */
    public function index()
    {
        $user = Auth::user();
        $divisionId = $user->division_id;

        // Proteksi: Jika user belum punya divisi
        if (!$divisionId) {
            return back()->with('error', 'Anda belum terdaftar di divisi manapun.');
        }

        // Ambil agenda mendatang khusus divisi user
        $upcomingAgendas = DivisionAgenda::where('division_id', $divisionId)
            ->where('end_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->get();

        // Format data untuk FullCalendar.js
        $calendarEvents = DivisionAgenda::where('division_id', $divisionId)
            ->get()
            ->map(function($event) {
                return [
                    'id'    => $event->id,
                    'title' => '[' . strtoupper($event->type) . '] ' . $event->title,
                    'start' => $event->start_time->toIso8601String(),
                    'end'   => $event->end_time->toIso8601String(),
                    'backgroundColor' => $event->color,
                    'borderColor'     => $event->color,
                    'extendedProps'   => [
                        'location'    => $event->location,
                        'description' => $event->description,
                        'type'        => $event->type
                    ]
                ];
            });

        return view('semuadivisi.divisiagenda.index', [
            'events'   => $calendarEvents,
            'upcoming' => $upcomingAgendas,
            'divisionName' => $user->division?->name
        ]);
    }

    /**
     * Simpan agenda baru (Hanya jika role memiliki izin, misal Kabid/Admin)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'type'       => 'required|in:meeting,event,project_deadline,other',
            'start_time' => 'required|date',
            'end_time'   => 'required|date|after:start_time',
        ]);

        $colors = [
            'meeting'          => '#ef4444',
            'event'            => '#10b981',
            'project_deadline' => '#f59e0b',
            'other'            => '#64748b',
        ];

        DivisionAgenda::create([
            'division_id' => Auth::user()->division_id,
            'created_by'  => Auth::id(),
            'title'       => $request->title,
            'type'        => $request->type,
            'description' => $request->description,
            'location'    => $request->location,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'color'       => $colors[$request->type] ?? '#064e3b',
        ]);

        return back()->with('success', 'Agenda divisi berhasil dijadwalkan!');
    }

    // Update & Destroy dengan proteksi division_id
    public function update(Request $request, $id)
    {
        $agenda = DivisionAgenda::where('division_id', Auth::user()->division_id)->findOrFail($id);
        $agenda->update($request->all());
        return back()->with('success', 'Agenda berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $agenda = DivisionAgenda::where('division_id', Auth::user()->division_id)->findOrFail($id);
        $agenda->delete();
        return back()->with('success', 'Agenda berhasil dihapus.');
    }
}
