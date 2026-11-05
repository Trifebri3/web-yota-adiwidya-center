<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanBidang;
use App\Models\Proposal;
use App\Models\Program;
use Illuminate\Http\Request;

class AuditAdminController extends Controller
{
    /**
     * Dashboard Audit Administrasi & Program
     */
    public function index()
    {
        // 1. Statistik Proposal (Keuangan & Approval)
        $proposalStats = [
            'total' => Proposal::count(),
            'approved' => Proposal::where('status', 'approved')->count(),
            'total_budget' => Proposal::where('status', 'approved')->sum('estimated_cost'),
        ];

        // 2. Laporan Bidang (Kepatuhan Administrasi)
        $reportStats = [
            'total' => LaporanBidang::count(),
            'pending' => LaporanBidang::pending()->count(),
        ];

        // 3. Program Kerja (Realisasi Publik)
        $activePrograms = Program::active()->latest()->take(5)->get();

        // 4. Laporan Bidang Terbaru untuk Tracking
        $latestReports = LaporanBidang::with(['division', 'user'])->latest()->take(10)->get();

        return view('admin.audit.admin.index', compact(
            'proposalStats',
            'reportStats',
            'activePrograms',
            'latestReports'
        ));
    }

    /**
     * Audit Proposal Detail (Melihat rincian biaya & dokumen)
     */
    public function showProposal(Proposal $proposal)
    {
        return view('admin.audit.admin.proposal-detail', compact('proposal'));
    }

    /**
     * Monitoring Program (Melihat target vs realisasi)
     */
    public function showProgram(Program $program)
    {
        return view('admin.audit.admin.program-detail', compact('program'));
    }

    /**
 * Melihat Detail Laporan Bidang (Arsip Bulanan/Mingguan)
 */
public function showReport(LaporanBidang $report)
{
    $report->load(['division', 'user']);
    return view('admin.audit.admin.report-detail', compact('report'));
}
}
