<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use App\Models\TimelineStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DirTimelineController extends Controller
{
    /**
     * Menampilkan semua Timeline Besar beserta progresnya
     */
    public function index()
    {
        // Mengambil timeline dengan relasi stages untuk menghitung progres di Blade
        $timelines = Timeline::with('stages')->latest()->get();

        return view('direktur.timeline.index', compact('timelines'));
    }

    /**
     * Menyimpan Timeline Besar beserta banyak Termin sekaligus
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category' => 'nullable|string',
            // Validasi untuk Array Termin
            'stages' => 'required|array|min:1',
            'stages.*.stage_name' => 'required|string',
            'stages.*.start_date' => 'required|date',
            'stages.*.end_date' => 'required|date|after_or_equal:stages.*.start_date',
        ]);

        try {
            DB::beginTransaction();

            // 1. Simpan Master Timeline
            $timeline = Timeline::create([
                'title' => $request->title,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'category' => $request->category,
                'status' => 'planned',
            ]);

            // 2. Simpan Semua Termin (Stages)
            foreach ($request->stages as $index => $stage) {
                TimelineStage::create([
                    'timeline_id' => $timeline->id,
                    'stage_name' => $stage['stage_name'],
                    'task_detail' => $stage['task_detail'] ?? null,
                    'start_date' => $stage['start_date'],
                    'end_date' => $stage['end_date'],
                    'order' => $index + 1,
                    'send_reminder' => true,
                ]);
            }

            DB::commit();
            return redirect()->route('direktur.timeline.index')->with('success', 'Timeline Master dan Termin berhasil dibentuk!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat timeline: ' . $e->getMessage());
        }
    }

    /**
     * Detail View untuk monitoring termin secara mendalam
     */
    public function show(Timeline $timeline)
    {
        $timeline->load('stages');
        return view('direktur.timeline.show', compact('timeline'));
    }

    /**
     * Update Status Termin (Checklist Selesai)
     */
    public function updateStage(Request $request, TimelineStage $stage)
    {
        $stage->update([
            'is_completed' => $request->has('is_completed')
        ]);

        // Cek jika semua stage selesai, otomatis update status Master Timeline
        $parent = $stage->timeline;
        $totalStages = $parent->stages()->count();
        $completedStages = $parent->stages()->where('is_completed', true)->count();

        if ($totalStages == $completedStages) {
            $parent->update(['status' => 'completed']);
        } else {
            $parent->update(['status' => 'on_progress']);
        }

        return back()->with('success', 'Progress termin berhasil diperbarui.');
    }

    /**
     * Menghapus seluruh Timeline dan Termin di dalamnya
     */
    public function destroy(Timeline $timeline)
    {
        $timeline->delete();
        return back()->with('success', 'Timeline berhasil dihapus.');
    }
    public function addStage(Request $request, Timeline $timeline)
{
    $request->validate([
        'stage_name' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    TimelineStage::create([
        'timeline_id' => $timeline->id,
        'stage_name' => $request->stage_name,
        'task_detail' => $request->task_detail,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'order' => $timeline->stages()->count() + 1,
    ]);

    return back()->with('success', 'Termin baru berhasil ditambahkan ke project!');
}
}
