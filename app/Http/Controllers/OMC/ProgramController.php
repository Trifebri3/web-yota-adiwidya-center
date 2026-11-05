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
        return view('omc.programs.create');
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
        $data['coordinates'] = $request->coordinates ?? '0,0';
        $data['title'] = ['id' => $request->title_id, 'en' => $request->title_en];
        $data['goal'] = ['id' => $request->goal_id, 'en' => $request->goal_en];
        $data['target_audience'] = ['id' => $request->audience_id, 'en' => $request->audience_en];
        $data['methodology'] = ['id' => $request->method_id, 'en' => $request->method_en];

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('programs/banners', 'public');
        }

        $data['slug'] = Str::slug($request->title_id) . '-' . Str::random(5);
        $data['published_by'] = auth()->user()->name ?? 'CMO Office';

        // Default nilai jika donasi tidak diisi (Opsional)
        $data['target_amount'] = $request->target_amount ?? 0;
        $data['current_amount'] = $request->current_amount ?? 0;

    
        Program::create($data);

        return redirect()->route('omc.programs.index')->with('success', 'Program Published Successfully!');
    }

    public function edit(Program $program)
    {
        return view('omc.programs.edit', compact('program'));
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

        return redirect()->route('omc.programs.index')->with('success', 'Program Updated!');
    }

    public function destroy(Program $program)
    {
        if ($program->banner_image) Storage::disk('public')->delete($program->banner_image);
        $program->delete();
        return redirect()->route('omc.programs.index')->with('success', 'Program Deleted!');
    }
}
