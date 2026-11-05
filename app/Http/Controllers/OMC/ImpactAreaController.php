<?php

namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Models\ImpactArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImpactAreaController extends Controller
{
    /**
     * List semua Impact Areas
     */
    public function index()
    {
        $impactAreas = collect();

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('impact_areas')) {
                $impactAreas = ImpactArea::orderBy('order', 'asc')->orderBy('id', 'asc')->get();
            }
        } catch (\Throwable $e) {
            $impactAreas = collect();
        }

        if ($impactAreas->isEmpty()) {
            $impactAreas = ImpactArea::getDefaultPillars();
        }

        return view('omc.impact_areas.index', compact('impactAreas'));
    }

    /**
     * Form tambah Impact Area
     */
    public function create()
    {
        return view('omc.impact_areas.create');
    }

    /**
     * Simpan Impact Area baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:10|unique:impact_areas,code',
            'name'        => 'required|string|max:255',
            'tagline'     => 'nullable|string|max:255',
            'color'       => 'required|string|max:20',
            'description' => 'required|string',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:3072',
            'motif'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'banner'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'focus_areas' => 'nullable|string',
            'target_beneficiaries' => 'nullable|string',
            'strategic_direction'  => 'nullable|string',
            'what_desc'   => 'nullable|string',
            'why_desc'    => 'nullable|string',
            'who_desc'    => 'nullable|string',
            'where_desc'  => 'nullable|string',
            'when_desc'   => 'nullable|string',
            'how_desc'    => 'nullable|string',
            'order'       => 'nullable|integer',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('pilar_uploads/logos', 'public');
        }

        $motifPath = null;
        if ($request->hasFile('motif')) {
            $motifPath = $request->file('motif')->store('pilar_uploads/motifs', 'public');
        }

        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('pilar_uploads/banners', 'public');
        }

        // Parsing focus areas (line-by-line or comma-separated)
        $focusList = [];
        if (!empty($validated['focus_areas'])) {
            $focusList = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n|,/', $validated['focus_areas']))));
        }

        ImpactArea::create([
            'code'        => $validated['code'],
            'slug'        => Str::slug($validated['name']),
            'name'        => $validated['name'],
            'tagline'     => $validated['tagline'] ?? null,
            'color'       => $validated['color'],
            'logo'        => $logoPath,
            'motif'       => $motifPath,
            'banner'      => $bannerPath,
            'description' => $validated['description'],
            'focus_areas' => $focusList,
            'target_beneficiaries' => $validated['target_beneficiaries'] ?? null,
            'strategic_direction'  => $validated['strategic_direction'] ?? null,
            'what_desc'   => $validated['what_desc'] ?? null,
            'why_desc'    => $validated['why_desc'] ?? null,
            'who_desc'    => $validated['who_desc'] ?? null,
            'where_desc'  => $validated['where_desc'] ?? null,
            'when_desc'   => $validated['when_desc'] ?? null,
            'how_desc'    => $validated['how_desc'] ?? null,
            'order'       => $validated['order'] ?? 0,
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()->route('omc.impact-areas.index')
            ->with('success', 'Pilar Program / Impact Area berhasil ditambahkan!');
    }

    /**
     * Form Edit Impact Area
     */
    public function edit($id)
    {
        $impactArea = null;

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('impact_areas')) {
                $impactArea = ImpactArea::find($id);
            }
        } catch (\Throwable $e) {
            $impactArea = null;
        }

        if (!$impactArea) {
            // Jika belum ada di DB tapi ada di default
            $defaultPillars = ImpactArea::getDefaultPillars();
            $default = $defaultPillars->firstWhere('id', (int)$id)
                    ?: $defaultPillars->firstWhere('code', $id)
                    ?: $defaultPillars->firstWhere('slug', $id)
                    ?: $defaultPillars->first();

            $impactArea = new ImpactArea((array)$default);
            $impactArea->id = $id;
        }

        return view('omc.impact_areas.edit', compact('impactArea'));
    }

    /**
     * Update Impact Area
     */
    public function update(Request $request, $id)
    {
        if (!\Illuminate\Support\Facades\Schema::hasTable('impact_areas')) {
            return redirect()->route('omc.impact-areas.index')
                ->with('info', 'Tabel database impact_areas belum dibuat. Silakan jalankan php artisan migrate di terminal hosting jika ingin menyimpan perubahan ke database.');
        }

        $impactArea = ImpactArea::find($id);

        if (!$impactArea) {
            // Jika record belum ada di DB, buat baru
            $defaultPillars = ImpactArea::getDefaultPillars();
            $default = $defaultPillars->firstWhere('id', $id);

            $impactArea = new ImpactArea();
            if ($default) {
                $impactArea->code = $default->code;
                $impactArea->slug = $default->slug;
                $impactArea->logo = $default->logo_url;
                $impactArea->motif = $default->motif_url;
            }
        }

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'tagline'     => 'nullable|string|max:255',
            'color'       => 'required|string|max:20',
            'description' => 'required|string',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:3072',
            'motif'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'banner'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'focus_areas' => 'nullable|string',
            'target_beneficiaries' => 'nullable|string',
            'strategic_direction'  => 'nullable|string',
            'what_desc'   => 'nullable|string',
            'why_desc'    => 'nullable|string',
            'who_desc'    => 'nullable|string',
            'where_desc'  => 'nullable|string',
            'when_desc'   => 'nullable|string',
            'how_desc'    => 'nullable|string',
            'order'       => 'nullable|integer',
        ]);

        if ($request->hasFile('logo')) {
            $impactArea->logo = $request->file('logo')->store('pilar_uploads/logos', 'public');
        }

        if ($request->hasFile('motif')) {
            $impactArea->motif = $request->file('motif')->store('pilar_uploads/motifs', 'public');
        }

        if ($request->hasFile('banner')) {
            $impactArea->banner = $request->file('banner')->store('pilar_uploads/banners', 'public');
        }

        $focusList = [];
        if (!empty($validated['focus_areas'])) {
            $focusList = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n|,/', $validated['focus_areas']))));
        }

        $impactArea->name = $validated['name'];
        $impactArea->slug = Str::slug($validated['name']);
        $impactArea->tagline = $validated['tagline'] ?? null;
        $impactArea->color = $validated['color'];
        $impactArea->description = $validated['description'];
        $impactArea->focus_areas = $focusList;
        $impactArea->target_beneficiaries = $validated['target_beneficiaries'] ?? null;
        $impactArea->strategic_direction = $validated['strategic_direction'] ?? null;
        $impactArea->what_desc = $validated['what_desc'] ?? null;
        $impactArea->why_desc = $validated['why_desc'] ?? null;
        $impactArea->who_desc = $validated['who_desc'] ?? null;
        $impactArea->where_desc = $validated['where_desc'] ?? null;
        $impactArea->when_desc = $validated['when_desc'] ?? null;
        $impactArea->how_desc = $validated['how_desc'] ?? null;
        $impactArea->order = $validated['order'] ?? $impactArea->order ?? 0;
        $impactArea->is_active = $request->has('is_active');

        $impactArea->save();

        return redirect()->route('omc.impact-areas.index')
            ->with('success', 'Perubahan Pilar Program / Impact Area berhasil disimpan!');
    }

    /**
     * Hapus Impact Area
     */
    public function destroy($id)
    {
        $impactArea = ImpactArea::findOrFail($id);
        $impactArea->delete();

        return redirect()->route('omc.impact-areas.index')
            ->with('success', 'Pilar Program berhasil dihapus!');
    }
}

