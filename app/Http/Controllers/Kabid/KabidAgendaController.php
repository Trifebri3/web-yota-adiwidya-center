<?php


namespace App\Http\Controllers\Kabid;

use App\Http\Controllers\Controller;
use App\Models\DivisionAgenda;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KabidAgendaController extends Controller
{
    /**
     * Tampilan utama Kalender dan Timeline
     */
    public function index()
    {
        $divisionId = auth()->user()->division_id;

        // Ambil agenda untuk list timeline (Urutkan dari yang paling dekat)
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

        return view('kabid.agenda.index', [
            'events'   => $calendarEvents,
            'upcoming' => $upcomingAgendas
        ]);
    }

    /**
     * Menyimpan agenda baru (Rapat/Kegiatan/Deadline)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'type'       => 'required|in:meeting,event,project_deadline,other',
            'start_time' => 'required|date',
            'end_time'   => 'required|date|after:start_time',
            'location'   => 'nullable|string',
        ]);

        // Mapping warna otomatis berdasarkan tipe agenda
        $colors = [
            'meeting'          => '#ef4444', // Red-500
            'event'            => '#10b981', // Emerald-500
            'project_deadline' => '#f59e0b', // Amber-500
            'other'            => '#64748b', // Slate-500
        ];

        DivisionAgenda::create([
            'division_id' => auth()->user()->division_id,
            'created_by'  => auth()->id(),
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

    /**
     * Update agenda (Geser jadwal atau ubah detail)
     */
    public function update(Request $request, $id)
    {
        $agenda = DivisionAgenda::where('division_id', auth()->user()->division_id)
                                ->findOrFail($id);

        $agenda->update($request->all());

        return back()->with('success', 'Agenda berhasil diperbarui!');
    }

    /**
     * Batalkan/Hapus Agenda
     */
    public function destroy($id)
    {
        $agenda = DivisionAgenda::where('division_id', auth()->user()->division_id)
                                ->findOrFail($id);

        $agenda->delete();

        return back()->with('success', 'Agenda berhasil dihapus dari timeline.');
    }
}
