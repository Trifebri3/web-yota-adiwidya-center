<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\ImpactReport;
use Illuminate\Http\Request;

class AuditImpactController extends Controller
{
    /**
     * Dashboard Laporan Dampak & Filantropi
     */
    public function index()
    {
        // 1. Ringkasan Finansial Donasi
        $financialStats = [
            'total_raised' => Campaign::sum('current_amount'),
            'total_donors' => Donation::paid()->count(),
            'pending_funds' => Donation::where('status', 'pending')->sum('amount'),
        ];

        // 2. Data Dampak Global (Menggunakan static method di Model lo)
        $globalImpacts = ImpactReport::getGlobalStatistics();

        // 3. Kampanye Aktif & Progresnya
        $activeCampaigns = Campaign::withCount('donations')
            ->where('status', 'active')
            ->latest()
            ->get();

        // 4. Laporan Dampak Terbaru
        $latestReports = ImpactReport::where('is_verified', true)
            ->latest()
            ->take(5)
            ->get();

        return view('admin.audit.impact.index', compact(
            'financialStats',
            'globalImpacts',
            'activeCampaigns',
            'latestReports'
        ));
    }

    /**
     * Detail Audit Kampanye & List Donatur (Read-Only)
     */
    public function campaignTrace(Campaign $campaign)
    {
        $donations = $campaign->donations()->latest()->paginate(20);
        return view('admin.audit.impact.campaign-trace', compact('campaign', 'donations'));
    }

    /**
     * Melihat Detail Laporan Dampak yang Terverifikasi
     */
    public function showReport(ImpactReport $report)
    {
        return view('admin.audit.impact.report-detail', compact('report'));
    }
}
