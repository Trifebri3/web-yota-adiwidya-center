<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\AgendaPresence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DirAgendaController extends Controller
{
    /**
     * INDEX: Daftar Agenda & Ringkasan Cepat
     */
    public function index()
    {
        $agendas = Agenda::withCount([
            'presences as total_hadir' => function($q) { $q->where('status', 'hadir'); },
            'presences as total_izin' => function($q) { $q->where('status', 'izin'); },
            'presences as total_alpha' => function($q) {
                $q->where('status', 'alpha')->orWhere('status', 'pending');
            }
        ])->latest()->paginate(10);

        return view('direktur.agenda.index', compact('agendas'));
    }

    /**
     * CREATE: Form Rancang Agenda
     */
    public function create()
    {
        return view('direktur.agenda.create');
    }

    /**
     * STORE: Simpan Agenda & Generate Presensi Massal
     */
public function store(Request $request)
{
    // Validasi diperingkas: Hanya Judul dan Waktu yang WAJIB
    $request->validate([
        'title'      => 'required|string|max:255',
        'start_time' => 'required',
        'end_time'   => 'required',
    ]);

    try {
        DB::beginTransaction();

        // 1. Buat Agenda (Field lain akan otomatis masuk jika ada di $fillable)
        $agenda = Agenda::create($request->all());

        // 2. Generate Presensi Otomatis untuk Staf (Kecuali Admin/OMC)
        $participants = User::whereNotIn('role', ['admin', 'omc'])->get();

        $presenceData = $participants->map(function ($user) use ($agenda) {
            return [
                'agenda_id'  => $agenda->id,
                'user_id'    => $user->id,
                'status'     => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        AgendaPresence::insert($presenceData);

        DB::commit();
        return redirect()->route('direktur.agenda.index')->with('success', 'Agenda Berhasil Dipublikasikan!');

    } catch (\Exception $e) {
        DB::rollBack();
        // DD ini akan mematikan aplikasi dan memunculkan pesan error aslinya (sangat membantu debugging)
        dd("GAGAL SIMPAN: " . $e->getMessage());
    }
}

    /**
     * SHOW: Monitoring Real-time & Update Status Manual
     */
    public function show(Agenda $agenda)
    {
        $presences = AgendaPresence::with(['user.division', 'user.team'])
            ->where('agenda_id', $agenda->id)
            ->get();

        return view('direktur.agenda.show', compact('agenda', 'presences'));
    }

    /**
     * EDIT: Form Penyesuaian Agenda
     */
    public function edit(Agenda $agenda)
    {
        return view('direktur.agenda.edit', compact('agenda'));
    }

    /**
     * UPDATE: Perbarui Detail Agenda
     */
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $agenda->update($request->all());

        return redirect()->route('direktur.agenda.index')
            ->with('success', 'Jadwal agenda berhasil disesuaikan.');
    }

    /**
     * DESTROY: Batalkan Agenda
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('direktur.agenda.index')
            ->with('success', 'Agenda telah dibatalkan dari sistem.');
    }

    /**
     * REPORT: Analisis Mendalam Kehadiran Per Divisi
     */
    public function report($id)
    {
        $agenda = Agenda::with(['presences.user.division'])->findOrFail($id);

        $stats = [
            'total' => $agenda->presences->count(),
            'hadir' => $agenda->presences->where('status', 'hadir')->count(),
            'izin'  => $agenda->presences->where('status', 'izin')->count(),
            'sakit' => $agenda->presences->where('status', 'sakit')->count(),
            'alpha' => $agenda->presences->whereIn('status', ['pending', 'alpha'])->count(),
        ];

        $divisionReport = $agenda->presences->groupBy('user.division.name')
            ->map(function ($group) {
                $presentCount = $group->where('status', 'hadir')->count();
                $totalInGroup = $group->count();
                return [
                    'hadir' => $presentCount,
                    'total' => $totalInGroup,
                    'persentase' => $totalInGroup > 0 ? round(($presentCount / $totalInGroup) * 100, 1) : 0
                ];
            });

        return view('direktur.agenda.report', compact('agenda', 'stats', 'divisionReport'));
    }

    /**
     * UPDATE PRESENCE: Direktur Override Status
     */
    public function updatePresence(Request $request, $presenceId)
    {
        $presence = AgendaPresence::findOrFail($presenceId);
        $presence->update([
            'status' => $request->status,
            'confirmed_at' => now()
        ]);

        return back()->with('success', 'Status anggota berhasil diubah oleh Direktur.');
    }

    /**
     * PRIVATE HELPER: Generate Daftar Hadir Massal
     */
    private function generatePresences(Agenda $agenda)
    {
        // Ambil semua user kecuali Admin & OMC agar tidak mengotori daftar hadir staf
        $participants = User::whereNotIn('role', ['admin', 'omc'])->get();

        $presenceData = $participants->map(function ($user) use ($agenda) {
            return [
                'agenda_id' => $agenda->id,
                'user_id' => $user->id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        AgendaPresence::insert($presenceData);
    }
}
