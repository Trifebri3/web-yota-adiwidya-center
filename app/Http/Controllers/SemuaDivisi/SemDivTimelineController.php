<?php

namespace App\Http\Controllers\SemuaDivisi;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;

class SemDivTimelineController extends Controller
{
    /**
     * Menampilkan semua jadwal project besar organisasi
     */
    public function index()
    {
        // Ambil semua timeline beserta tahapannya
        $timelines = Timeline::with('stages')->latest()->get();

        return view('semuadivisi.timeline.index', compact('timelines'));
    }

    /**
     * Detail pengerjaan tiap termin
     */
    public function show($id)
    {
        $timeline = Timeline::with(['stages' => function($query) {
            $query->orderBy('order', 'asc');
        }])->findOrFail($id);

        return view('semuadivisi.timeline.show', compact('timeline'));
    }
}
