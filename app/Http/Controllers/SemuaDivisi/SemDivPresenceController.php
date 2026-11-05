<?php

namespace App\Http\Controllers\SemuaDivisi;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\AgendaPresence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemDivPresenceController extends Controller
{
    /**
     * Handle Absensi via Klik Link
     * URL: /presence/check/{agenda_id}
     */
 public function markAttendance($agenda_id)
{
    $agenda = Agenda::findOrFail($agenda_id);
    $now = now();
    $startTime = $agenda->start_time;

    $openTime = $startTime->copy()->subMinutes(15);
    $closeTime = $startTime->copy()->addMinutes(20);

    // 1. Cek jika terlalu cepat
    if ($now->lt($openTime)) {
        return view('semuadivisi.presence_status', [
            'status'  => 'error',
            'agenda'  => $agenda,
            'message' => 'Absensi belum dibuka. Silahkan kembali 15 menit sebelum acara.'
        ]);
    }

    // 2. Cek jika terlambat (Sudah lewat 20 menit dari jam mulai)
    if ($now->gt($closeTime)) {
        return view('semuadivisi.presence_status', [
            'status'  => 'error',
            'agenda'  => $agenda,
            'message' => 'Maaf, batas waktu absensi (20 menit setelah mulai) telah berakhir.'
        ]);
    }

    // 3. Proses Absen jika waktu sesuai
    AgendaPresence::updateOrCreate(
        ['agenda_id' => $agenda->id, 'user_id' => auth()->id()],
        ['status' => 'hadir', 'confirmed_at' => now()]
    );

    return view('semuadivisi.presence_status', [
        'status'  => 'success',
        'agenda'  => $agenda,
        'message' => 'Kehadiran berhasil dicatat tepat waktu!'
    ]);
}

    /**
     * Menampilkan daftar agenda yang harus diikuti oleh user login
     */
    public function myAgendas()
    {
        $userId = Auth::id();

        // Ambil agenda terbaru beserta status presensi user saat ini
        $agendas = Agenda::with(['presences' => function($q) use ($userId) {
            $q->where('user_id', $userId);
        }])->latest()->paginate(10);

        return view('semuadivisi.agenda.index', compact('agendas'));
    }


}
