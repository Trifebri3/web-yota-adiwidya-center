<?php

namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    /**
     * Tampilkan daftar hero slide
     */
    public function index()
    {
        $slides = collect();

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('hero_slides')) {
                $slides = HeroSlide::with('publication')
                    ->orderBy('order', 'asc')
                    ->orderBy('id', 'desc')
                    ->paginate(15);
            } else {
                $slides = new \Illuminate\Pagination\LengthAwarePaginator(collect(), 0, 15);
            }
        } catch (\Throwable $e) {
            $slides = new \Illuminate\Pagination\LengthAwarePaginator(collect(), 0, 15);
        }

        return view('omc.hero_slides.index', compact('slides'));
    }

    /**
     * Form tambah hero slide baru
     */
    public function create()
    {
        $publications = Publication::latest('published_at')->limit(30)->get();
        return view('omc.hero_slides.create', compact('publications'));
    }

    /**
     * Simpan hero slide baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'publication_id' => 'nullable|exists:publications,id',
            'title'          => 'required|string|max:255',
            'category'       => 'required|string|max:100',
            'summary'        => 'nullable|string|max:1000',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'button_text'    => 'required|string|max:60',
            'button_link'    => 'required|string|max:500',
            'order'          => 'nullable|integer',
            'is_active'      => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hero_slides', 'public');
        } elseif ($request->filled('publication_id')) {
            $pub = Publication::find($request->publication_id);
            if ($pub && $pub->banner) {
                $imagePath = $pub->banner;
            }
        }

        HeroSlide::create([
            'publication_id' => $validated['publication_id'] ?? null,
            'title'          => $validated['title'],
            'category'       => $validated['category'],
            'summary'        => $validated['summary'] ?? null,
            'image'          => $imagePath,
            'button_text'    => $validated['button_text'] ?: 'Baca Selengkapnya',
            'button_link'    => $validated['button_link'] ?: '#',
            'order'          => $validated['order'] ?? 0,
            'is_active'      => $request->has('is_active'),
        ]);

        return redirect()->route('omc.hero-slides.index')
            ->with('success', 'Hero Slide publikasi berhasil ditambahkan!');
    }

    /**
     * Form edit hero slide
     */
    public function edit(HeroSlide $heroSlide)
    {
        $publications = Publication::latest('published_at')->limit(30)->get();
        return view('omc.hero_slides.edit', compact('heroSlide', 'publications'));
    }

    /**
     * Update hero slide
     */
    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'publication_id' => 'nullable|exists:publications,id',
            'title'          => 'required|string|max:255',
            'category'       => 'required|string|max:100',
            'summary'        => 'nullable|string|max:1000',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'button_text'    => 'required|string|max:60',
            'button_link'    => 'required|string|max:500',
            'order'          => 'nullable|integer',
            'is_active'      => 'nullable|boolean',
        ]);

        $imagePath = $heroSlide->image;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada di hero_slides
            if ($heroSlide->image && str_starts_with($heroSlide->image, 'hero_slides/')) {
                Storage::disk('public')->delete($heroSlide->image);
            }
            $imagePath = $request->file('image')->store('hero_slides', 'public');
        } elseif ($request->filled('publication_id') && empty($imagePath)) {
            $pub = Publication::find($request->publication_id);
            if ($pub && $pub->banner) {
                $imagePath = $pub->banner;
            }
        }

        $heroSlide->update([
            'publication_id' => $validated['publication_id'] ?? null,
            'title'          => $validated['title'],
            'category'       => $validated['category'],
            'summary'        => $validated['summary'] ?? null,
            'image'          => $imagePath,
            'button_text'    => $validated['button_text'] ?: 'Baca Selengkapnya',
            'button_link'    => $validated['button_link'] ?: '#',
            'order'          => $validated['order'] ?? 0,
            'is_active'      => $request->has('is_active'),
        ]);

        return redirect()->route('omc.hero-slides.index')
            ->with('success', 'Hero Slide publikasi berhasil diperbarui!');
    }

    /**
     * Toggle status aktif/nonaktif
     */
    public function toggleStatus(HeroSlide $heroSlide)
    {
        $heroSlide->is_active = !$heroSlide->is_active;
        $heroSlide->save();

        return back()->with('success', 'Status slide berhasil diubah!');
    }

    /**
     * Hapus hero slide
     */
    public function destroy(HeroSlide $heroSlide)
    {
        if ($heroSlide->image && str_starts_with($heroSlide->image, 'hero_slides/')) {
            Storage::disk('public')->delete($heroSlide->image);
        }

        $heroSlide->delete();

        return redirect()->route('omc.hero-slides.index')
            ->with('success', 'Hero Slide berhasil dihapus!');
    }
}

