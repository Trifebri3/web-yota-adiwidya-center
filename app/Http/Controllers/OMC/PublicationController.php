<?php

namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Http\Requests\OMC\StorePublicationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use League\CommonMark\CommonMarkConverter;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $publications = Publication::query()
            ->when($request->search, function ($query, $search) {
                $query->where('title->id', 'like', "%{$search}%")
                      ->orWhere('title->en', 'like', "%{$search}%");
            })
            ->latest('published_at')
            ->paginate(10);

        return view('omc.publikasi.publikasiberita.index', compact('publications'));
    }

    public function create()
    {
        return view('omc.publikasi.publikasiberita.create');
    }

    public function store(StorePublicationRequest $request)
    {
        $data = $request->validated();
        $converter = new CommonMarkConverter();

        // Banner
        $bannerPath = $request->file('banner')->store('omc/banners', 'public');

        // PDF (optional)
        $pdfPath = null;
        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('omc/documents', 'public');
        }

        Publication::create([
            'slug'         => Str::slug($data['title_id']) . '-' . Str::random(5),
            'type'         => $data['type'],
            'author'       => auth()->user()->name,
            'banner'       => $bannerPath,
            'pdf_file'     => $pdfPath,
            'published_at' => $data['published_at'],
            'is_verified'  => true,

            'title' => [
                'id' => $data['title_id'],
                'en' => $data['title_en']
            ],
            'description' => [
                'id' => $data['desc_id'],
                'en' => $data['desc_en']
            ],
            'content' => [
                'id' => $converter->convert($request->content_id)->getContent(),
                'en' => $converter->convert($request->content_en)->getContent(),
            ],
        ]);

        return redirect()->route('omc.index')
            ->with('success', 'Publikasi Resmi Berhasil Diterbitkan!');
    }

    public function edit(Publication $publication)
    {
        return view('omc.publikasi.publikasiberita.edit', compact('publication'));
    }

    public function update(Request $request, Publication $publication)
    {
        $request->validate([
            'title_id'     => 'required|string|max:255',
            'title_en'     => 'required|string|max:255',
            'published_at' => 'required|date',
        ]);

        $converter = new CommonMarkConverter();

        $updateData = [
            'title' => [
                'id' => $request->title_id,
                'en' => $request->title_en
            ],
            'description' => [
                'id' => $request->desc_id,
                'en' => $request->desc_en
            ],
            'content' => [
                'id' => $converter->convert($request->content_id)->getContent(),
                'en' => $converter->convert($request->content_en)->getContent(),
            ],
            'published_at' => $request->published_at,
        ];

        if ($request->hasFile('banner')) {
            if ($publication->banner) {
                Storage::disk('public')->delete($publication->banner);
            }
            $updateData['banner'] = $request->file('banner')
                ->store('omc/banners', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            if ($publication->pdf_file) {
                Storage::disk('public')->delete($publication->pdf_file);
            }
            $updateData['pdf_file'] = $request->file('pdf_file')
                ->store('omc/documents', 'public');
        }

        $publication->update($updateData);

        return redirect()->route('omc.index')
            ->with('success', 'Data OMC Berhasil Diperbarui!');
    }

    public function destroy(Publication $publication)
    {
        if ($publication->banner) {
            Storage::disk('public')->delete($publication->banner);
        }
        if ($publication->pdf_file) {
            Storage::disk('public')->delete($publication->pdf_file);
        }

        $publication->delete();

        return redirect()->route('omc.index')
            ->with('success', 'Publikasi Berhasil Dihapus.');
    }

    public function show(Publication $publication)
    {
        $publication->increment('views');

        return view('omc.publikasi.publikasiberita.show', [
            'publication' => $publication,
            'locale'      => App::getLocale(),
        ]);
    }
}
