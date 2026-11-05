<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GenServiceRequestController extends Controller
{
    /**
     * Tampilkan daftar permintaan (Inbox & Outbox)
     */
    public function index()
    {
        $user = Auth::user();

        // Permintaan yang dibuat oleh User (Outbox)
        $myRequests = ServiceRequest::where('requester_id', $user->id)->latest()->get();

        // Permintaan yang masuk ke Divisi User (Inbox)
        // Jika Approved, semua anggota divisi bisa lihat. Jika Pending, hanya Kadiv yang biasanya handle (atau semua tergantung kebijakan)
        $incomingRequests = ServiceRequest::where('target_division_id', $user->division_id)
            ->where(function($q) use ($user) {
                // Tampilkan jika status sudah approved (untuk semua anggota)
                // atau jika masih pending (biasanya untuk Kadiv/Admin Divisi)
                $q->where('status', '!=', 'pending')
                  ->orWhere('status', 'pending');
            })
            ->latest()
            ->get();

        $divisions = Division::where('id', '!=', $user->division_id)->get();

        return view('general.service.index', compact('myRequests', 'incomingRequests', 'divisions'));
    }

    /**
     * Store: User mengajukan permintaan ke divisi lain
     */
    public function store(Request $request)
    {
        $request->validate([
            'target_division_id' => 'required|exists:divisions,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment_request' => 'nullable|file|max:5120',
        ]);

        $ticketNumber = 'SRQ-' . strtoupper(Str::random(6)) . '-' . now()->format('Ymd');

        $data = [
            'requester_id' => Auth::id(),
            'requester_division_id' => Auth::user()->division_id,
            'target_division_id' => $request->target_division_id,
            'ticket_number' => $ticketNumber,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending',
        ];

        if ($request->hasFile('attachment_request')) {
            $data['attachment_request'] = $request->file('attachment_request')->store('service/requests', 'public');
        }

        ServiceRequest::create($data);

        return back()->with('success', "Tiket $ticketNumber berhasil dikirim!");
    }

    /**
     * Approve: Dilakukan oleh Kadiv Tujuan agar bisa dikerjakan anggota divisinya
     */
    public function approve($id)
    {
        $request = ServiceRequest::findOrFail($id);

        // Proteksi: Hanya divisi tujuan yang bisa approve
        if ($request->target_division_id != Auth::user()->division_id) abort(403);

        $request->update([
            'status' => 'approved',
            'approved_at' => now()
        ]);

        return back()->with('success', 'Permintaan disetujui dan siap dikerjakan tim.');
    }

    /**
     * Take: Anggota Divisi Tujuan mengambil tugas untuk dikerjakan
     */
    public function takeTask($id)
    {
        $request = ServiceRequest::findOrFail($id);

        if ($request->target_division_id != Auth::user()->division_id) abort(403);

        $request->update([
            'status' => 'in_progress',
            'handler_id' => Auth::id()
        ]);

        return back()->with('info', 'Tiket sekarang dalam pengerjaan Anda.');
    }

    /**
     * Submit: Anggota Divisi Tujuan mengirimkan hasil kerja (Submission)
     */
 public function submitWork(Request $request, $id)
    {
        $sr = ServiceRequest::findOrFail($id);

        // Proteksi: Hanya handler (orang yang ambil tugas) yang bisa submit
        if ($sr->handler_id != Auth::id()) {
            abort(403, 'Hanya penanggung jawab tugas yang dapat mengirimkan hasil.');
        }

        $request->validate([
            'submission_notes' => 'required|string',
            'submission_link'  => 'required|url', // Pastikan inputnya adalah URL valid
        ]);

        $sr->update([
            'submission_notes' => $request->submission_notes,
            'submission_file'  => $request->submission_link, // Kita simpan link di kolom file
            'status'           => 'completed',
            'completed_at'     => now(),
        ]);

        return back()->with('success', 'Tugas selesai! Link hasil kerja telah dikirim ke pemohon.');
    }
}
