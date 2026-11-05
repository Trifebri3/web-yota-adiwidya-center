<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ImpactReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PubImpactController extends Controller
{
public function index(Request $request)
{
    // 1. Ambil Semua Laporan untuk Gallery
    $query = ImpactReport::where('is_verified', true);
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }
    $reports = $query->latest()->paginate(9)->withQueryString();

    // 2. Ambil Statistik Gabungan
    $allStats = ImpactReport::getGlobalStatistics();

    // 3. Pisahkan: 4 untuk Counter Atas, Sisanya (atau semua) untuk Tabel
    $topStats = $allStats->take(4);

    // 4. Analitik Distribusi Kategori
    $categoryDistribution = ImpactReport::where('is_verified', true)
        ->select('category', DB::raw('count(*) as total'))
        ->groupBy('category')
        ->get()
        ->map(function ($item) {
            return [
                'label' => $item->category, // Sesuaikan dengan transisi lang anda
                'total' => $item->total,
                'color' => $this->getCategoryColor(strtolower($item->category))
            ];
        });

    return view('public.impact.index', [
        'reports' => $reports,
        'globalStats' => $topStats,       // Untuk Counter Grid
        'tableStats' => $allStats,        // Untuk Tabel Rekap (Semua data)
        'categoryDist' => $categoryDistribution,
        'yearlyTrends' => ImpactReport::getImpactTrends(),
        'totalCount' => ImpactReport::where('is_verified', true)->count()
    ]);
}
    public function show($slug)
    {
        $report = ImpactReport::where('slug', $slug)->where('is_verified', true)->firstOrFail();

        // Metrik Detail: Perbandingan dengan rata-rata kategori yang sama
        $categoryAverage = ImpactReport::where('category', $report->category)->avg('impact_value');

        $related = ImpactReport::where('category', $report->category)
            ->where('id', '!=', $report->id)
            ->take(3)
            ->get();

        return view('public.impact.show', compact('report', 'related', 'categoryAverage'));
    }

    /**
     * Helper untuk warna grafik yang konsisten dengan brand
     */
    private function getCategoryColor($category)
    {
        return [
            'environment' => '#BEF264', // Lemon
            'education'   => '#052c24', // Deep Green
            'disaster'    => '#ef4444', // Red
            'social'      => '#3b82f6', // Blue
        ][$category] ?? '#94a3b8';
    }
}
