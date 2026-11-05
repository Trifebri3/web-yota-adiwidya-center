<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class PubCampaignController extends Controller
{
    /**
     * Menampilkan semua kampanye yang sedang aktif.
     */
    public function index()
    {
        $campaigns = Campaign::where('status', 'active')
            ->latest()
            ->paginate(6);

        return view('public.campaign.index', compact('campaigns'));
    }

    /**
     * Menampilkan detail kampanye tunggal.
     */
    public function show($slug)
    {
        $campaign = Campaign::where('slug', $slug)
            ->firstOrFail();

        // Mengambil donasi terbaru yang sukses untuk ditampilkan di sidebar
        $recentDonations = $campaign->donations()
            ->where('status', 'success')
            ->latest()
            ->take(5)
            ->get();

        return view('public.campaign.show', compact('campaign', 'recentDonations'));
    }
}
