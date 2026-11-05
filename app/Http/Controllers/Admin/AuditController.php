<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Division;
use App\Models\Proposal;
use App\Models\ServiceRequest;
use App\Models\KabidTask;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AuditController extends Controller
{
    /**
     * Dashboard Audit: Gabungan Statistik User & Divisi
     */
public function index()
{
    // Cukup load division dan identity (buat foto)
    $users = User::with(['division', 'identity'])->latest()->paginate(15);

    $stats = [
        'total_users'        => User::count(),
        'total_divisions'    => Division::count(),
        'completed_services' => \App\Models\ServiceRequest::where('status', 'completed')->count(),
        'new_users_today'    => User::whereDate('created_at', now()->today())->count(),
    ];

    return view('admin.audit.index', compact('stats', 'users'));
}

    /**
     * Detail Audit User: Tracing Kontribusi & Aktivitas
     */
    public function showUser(User $user)
    {
        // Mengambil data user lengkap dengan relasi pengerjaan mereka
        $user->load([
            'division',
            'kabidTasks', // Tugas yang diberikan kepadanya
            'handledServices' // Service Request yang dia kerjakan
        ]);

        // Mengambil log aktivitas khusus user ini
        $activities = Activity::where('causer_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        return view('admin.audit.user-detail', compact('user', 'activities'));
    }

    /**
     * Monitoring Aktivitas Seluruh Sistem (Global Log)
     */
    public function activityLog()
    {
        $logs = Activity::with('causer')->latest()->paginate(30);
        return view('admin.audit.logs', compact('logs'));
    }

    /**
     * Laporan Divisi: Melihat beban kerja tiap divisi
     */
    public function divisionReports()
    {
        $divisions = Division::withCount([
            'members',
            // Tambahkan count lain yang relevan
        ])->get();

        return view('admin.audit.division-reports', compact('divisions'));
    }
}
