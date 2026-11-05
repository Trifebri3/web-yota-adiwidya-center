<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ImpactArea;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PublicImpactAreaController extends Controller
{
    /**
     * Halaman Utama 6 Pilar / Impact Areas
     */
    public function index()
    {
        $impactAreas = collect();

        try {
            if (Schema::hasTable('impact_areas')) {
                $impactAreas = ImpactArea::where('is_active', true)
                    ->orderBy('order', 'asc')
                    ->orderBy('id', 'asc')
                    ->get();
            }
        } catch (\Throwable $e) {
            $impactAreas = collect();
        }

        if ($impactAreas->isEmpty()) {
            $impactAreas = ImpactArea::getDefaultPillars();
        }

        return view('public.impact_areas.index', compact('impactAreas'));
    }

    /**
     * Halaman Detail Pilar / Impact Area
     */
    public function show($slug)
    {
        $impactArea = null;

        try {
            if (Schema::hasTable('impact_areas')) {
                $impactArea = ImpactArea::with(['programs' => function($q) {
                    $q->latest()->limit(10);
                }])->where('slug', $slug)->first();
            }
        } catch (\Throwable $e) {
            $impactArea = null;
        }

        if (!$impactArea) {
            $defaultPillars = ImpactArea::getDefaultPillars();
            $impactArea = $defaultPillars->firstWhere('slug', $slug);

            if (!$impactArea) {
                // Cari berdasarkan ID atau code
                $impactArea = $defaultPillars->first();
            }
        }

        // Ambil program terkait (jika ada)
        $relatedPrograms = collect();
        try {
            if (isset($impactArea->id) && Schema::hasTable('program_impact_areas')) {
                $relatedPrograms = Program::whereHas('impactAreas', function($q) use ($impactArea) {
                    $q->where('impact_areas.id', $impactArea->id);
                })->latest()->take(6)->get();
            }
        } catch (\Throwable $e) {
            $relatedPrograms = collect();
        }

        // Ambil semua pilar untuk sidebar / switcher
        $allPillars = ImpactArea::getDefaultPillars();

        return view('public.impact_areas.show', compact('impactArea', 'relatedPrograms', 'allPillars'));
    }
}

