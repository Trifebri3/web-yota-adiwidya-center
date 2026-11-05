<?php

namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(10);
        return view('omc.programs.index', compact('programs'));
    }

    public function create()
    {
        $pillars = [
            '01' => 'Pilar 01 • Youth Development',
            '02' => 'Pilar 02 • Community Empowerment',
            '03' => 'Pilar 03 • Environmental Conservation',
            '04' => 'Pilar 04 • Innovation & Research',
            '05' => 'Pilar 05 • Disaster Resilience',
            '06' => 'Pilar 06 • Knowledge & Publication',
        ];
        return view('omc.programs.create', compact('pillars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_id' => 'required|string',
            'title_en' => 'required|string',
            'banner_image' => 'required|image|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:upcoming,ongoing,history',
        ]);

        // Mapping Data Multibahasa Manual
        $data = $request->except(['banner_image']);
        $data['coordinates'] = !empty($request->coordinates) ? trim($request->coordinates) : '-6.9175, 107.6191';
        $data['location_name'] = $request->location_name ?? 'Bandung, Jawa Barat';
        $data['location_link'] = $request->location_link ?? '#';
        $data['title'] = ['id' => $request->title_id, 'en' => $request->title_en];
        $data['goal'] = ['id' => $request->goal_id, 'en' => $request->goal_en];
        $data['target_audience'] = ['id' => $request->audience_id, 'en' => $request->audience_en];
        $data['methodology'] = ['id' => $request->method_id, 'en' => $request->method_en];

        // Simpan Pilar & Hierarki Lokasi ke impact_stats agar 100% aman dan langsung terbaca di Peta
        $stats = [];
        $stats['pillar_code'] = $request->pillar_code ?? '01';
        $stats['province'] = $request->province ?? 'Jawa Barat';
        $stats['city'] = $request->city ?? 'Bandung';
        $stats['detail_address'] = $request->detail_address ?? '';
        $data['impact_stats'] = $stats;

        if ($request->filled('city') && $request->filled('province')) {
            $data['location_name'] = $request->filled('detail_address') 
                ? ($request->detail_address . ', ' . $request->city . ', ' . $request->province)
                : ($request->city . ', ' . $request->province);
        }

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('programs/banners', 'public');
        }

        $data['slug'] = Str::slug($request->title_id) . '-' . Str::random(5);
        $data['published_by'] = auth()->user()->name ?? 'CMO Office';

        // Default nilai jika donasi tidak diisi (Opsional)
        $data['target_amount'] = $request->target_amount ?? 0;
        $data['current_amount'] = $request->current_amount ?? 0;

        $program = Program::create($data);

        // Jika tabel impact_areas ada, sinkronkan juga relasinya
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('impact_areas') && \Illuminate\Support\Facades\Schema::hasTable('program_impact_areas')) {
                $ia = \App\Models\ImpactArea::where('code', $request->pillar_code)->first();
                if ($ia) {
                    $program->impactAreas()->sync([$ia->id]);
                }
            }
        } catch (\Throwable $e) {}

        return redirect()->route('omc.programs.index')->with('success', 'Program Published Successfully!');
    }

    public function edit(Program $program)
    {
        $pillars = [
            '01' => 'Pilar 01 • Youth Development',
            '02' => 'Pilar 02 • Community Empowerment',
            '03' => 'Pilar 03 • Environmental Conservation',
            '04' => 'Pilar 04 • Innovation & Research',
            '05' => 'Pilar 05 • Disaster Resilience',
            '06' => 'Pilar 06 • Knowledge & Publication',
        ];

        $currentPillar = '01';
        if (is_array($program->impact_stats) && !empty($program->impact_stats['pillar_code'])) {
            $currentPillar = $program->impact_stats['pillar_code'];
        } else {
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('impact_areas') && $program->impactAreas()->exists()) {
                    $currentPillar = $program->impactAreas->first()->code ?? '01';
                }
            } catch (\Throwable $e) {}
        }

        $currentProvince = $program->impact_stats['province'] ?? '';
        $currentCity = $program->impact_stats['city'] ?? '';
        $currentDetail = $program->impact_stats['detail_address'] ?? '';

        return view('omc.programs.edit', compact('program', 'pillars', 'currentPillar', 'currentProvince', 'currentCity', 'currentDetail'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'title_id' => 'required',
            'status' => 'required',
        ]);

        $data = $request->except(['banner_image']);

        // Re-mapping JSON data
        $data['title'] = ['id' => $request->title_id, 'en' => $request->title_en];
        $data['goal'] = ['id' => $request->goal_id, 'en' => $request->goal_en];
        $data['target_audience'] = ['id' => $request->audience_id, 'en' => $request->audience_en];
        $data['methodology'] = ['id' => $request->method_id, 'en' => $request->method_en];

        if ($request->filled('coordinates')) {
            $data['coordinates'] = trim($request->coordinates);
        }

        // Update Pilar & Hierarki Lokasi di impact_stats
        $stats = is_array($program->impact_stats) ? $program->impact_stats : [];
        if ($request->filled('pillar_code')) {
            $stats['pillar_code'] = $request->pillar_code;
        }
        if ($request->filled('province')) {
            $stats['province'] = $request->province;
        }
        if ($request->filled('city')) {
            $stats['city'] = $request->city;
        }
        if ($request->has('detail_address')) {
            $stats['detail_address'] = $request->detail_address;
        }
        $data['impact_stats'] = $stats;

        if ($request->filled('city') && $request->filled('province')) {
            $data['location_name'] = $request->filled('detail_address') 
                ? ($request->detail_address . ', ' . $request->city . ', ' . $request->province)
                : ($request->city . ', ' . $request->province);
        }

        if ($request->hasFile('banner_image')) {
            if ($program->banner_image) Storage::disk('public')->delete($program->banner_image);
            $data['banner_image'] = $request->file('banner_image')->store('programs/banners', 'public');
        }

        // Khusus jika status pindah ke History
        if ($request->status == 'history') {
            $data['impact_summary'] = ['id' => $request->summary_id, 'en' => $request->summary_en];
            $data['curated_story'] = ['id' => $request->story_id, 'en' => $request->story_en];
        }

        $program->update($data);

        // Jika tabel impact_areas ada, sinkronkan juga relasinya
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('impact_areas') && \Illuminate\Support\Facades\Schema::hasTable('program_impact_areas') && $request->filled('pillar_code')) {
                $ia = \App\Models\ImpactArea::where('code', $request->pillar_code)->first();
                if ($ia) {
                    $program->impactAreas()->sync([$ia->id]);
                }
            }
        } catch (\Throwable $e) {}

        return redirect()->route('omc.programs.index')->with('success', 'Program Updated!');
    }

    public function destroy(Program $program)
    {
        if ($program->banner_image) Storage::disk('public')->delete($program->banner_image);
        $program->delete();
        return redirect()->route('omc.programs.index')->with('success', 'Program Deleted!');
    }
}
