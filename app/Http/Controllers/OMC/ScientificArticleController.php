<?php

namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Models\ScientificArticle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\CommonMarkConverter;

class ScientificArticleController extends Controller
{
    public function index()
    {
        // Load relasi 'authors' (Many-to-Many) untuk menghindari N+1
        $articles = ScientificArticle::with('authors')->latest()->paginate(10);
        return view('omc.publikasi.ilmiah.index', compact('articles'));
    }

    public function create()
    {
        $users = User::all();
        return view('omc.publikasi.ilmiah.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_id' => 'required',
            'abstract_id' => 'required',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
        ]);

        $converter = new CommonMarkConverter();

        $bannerPath = $request->file('banner') ? $request->file('banner')->store('omc/scientific/banners', 'public') : null;
        $pdfPath = $request->file('pdf_file') ? $request->file('pdf_file')->store('omc/scientific/docs', 'public') : null;

        // 1. Simpan Data Artikel
        $article = ScientificArticle::create([
            'slug' => Str::slug($request->title_id) . '-' . Str::random(5),
            'published_at' => $request->published_at ?? now(),
            'cover_image' => $bannerPath,
            'pdf_version' => $pdfPath,
            'is_verified' => true,
            'title' => ['id' => $request->title_id, 'en' => $request->title_en ?? $request->title_id],
            'abstract' => [
                'id' => $converter->convert($request->abstract_id ?? '')->getContent(),
                'en' => $converter->convert($request->abstract_en ?? '')->getContent()
            ],
            'introduction' => [
                'id' => $converter->convert($request->intro_id ?? '')->getContent(),
                'en' => $converter->convert($request->intro_en ?? '')->getContent()
            ],
            'methodology' => [
                'id' => $converter->convert($request->method_id ?? '')->getContent(),
                'en' => $converter->convert($request->method_en ?? '')->getContent()
            ],
            'results' => [
                'id' => $converter->convert($request->result_id ?? '')->getContent(),
                'en' => $converter->convert($request->result_en ?? '')->getContent()
            ],
            'discussion' => [
                'id' => $converter->convert($request->discussion_id ?? '')->getContent(),
                'en' => $converter->convert($request->discussion_en ?? '')->getContent()
            ],
            'conclusion' => [
                'id' => $converter->convert($request->conclusion_id ?? '')->getContent(),
                'en' => $converter->convert($request->conclusion_en ?? '')->getContent()
            ],
            'references' => [
                'id' => $converter->convert($request->ref_id ?? '')->getContent(),
                'en' => $converter->convert($request->ref_en ?? '')->getContent()
            ],
        ]);

        // 2. Simpan Relasi Penulis (Pivot) agar terhitung di statistik user
        $authorIds = $request->input('user_ids', []);
        if (!empty($authorIds) && !in_array('default', $authorIds)) {
            $article->authors()->attach($authorIds);
        }

        return redirect()->route('omc.scientific.index')->with('success', 'Artikel Ilmiah Berhasil Terbit!');
    }

    public function edit(ScientificArticle $article)
    {
        $users = User::all();
        // Load authors agar checkbox/select di view terisi otomatis
        $article->load('authors');
        return view('omc.publikasi.ilmiah.edit', compact('article', 'users'));
    }

    public function update(Request $request, ScientificArticle $article)
    {
        $converter = new CommonMarkConverter();

        $updateData = [
            'title' => ['id' => $request->title_id, 'en' => $request->title_en ?? $request->title_id],
            'abstract' => [
                'id' => $converter->convert($request->abstract_id ?? '')->getContent(),
                'en' => $converter->convert($request->abstract_en ?? '')->getContent()
            ],
            'introduction' => [
                'id' => $converter->convert($request->intro_id ?? '')->getContent(),
                'en' => $converter->convert($request->intro_en ?? '')->getContent()
            ],
            'methodology' => [
                'id' => $converter->convert($request->method_id ?? '')->getContent(),
                'en' => $converter->convert($request->method_en ?? '')->getContent()
            ],
            'results' => [
                'id' => $converter->convert($request->result_id ?? '')->getContent(),
                'en' => $converter->convert($request->result_en ?? '')->getContent()
            ],
            'discussion' => [
                'id' => $converter->convert($request->discussion_id ?? '')->getContent(),
                'en' => $converter->convert($request->discussion_en ?? '')->getContent()
            ],
            'conclusion' => [
                'id' => $converter->convert($request->conclusion_id ?? '')->getContent(),
                'en' => $converter->convert($request->conclusion_en ?? '')->getContent()
            ],
            'references' => [
                'id' => $converter->convert($request->ref_id ?? '')->getContent(),
                'en' => $converter->convert($request->ref_en ?? '')->getContent()
            ],
        ];

        // Handle Banner Update
        if ($request->hasFile('banner')) {
            if ($article->cover_image) Storage::disk('public')->delete($article->cover_image);
            $updateData['cover_image'] = $request->file('banner')->store('omc/scientific/banners', 'public');
        }

        // Handle PDF Update
        if ($request->hasFile('pdf_file')) {
            if ($article->pdf_version) Storage::disk('public')->delete($article->pdf_version);
            $updateData['pdf_version'] = $request->file('pdf_file')->store('omc/scientific/docs', 'public');
        }

        $article->update($updateData);

        // 3. Update/Sync Relasi Penulis (Hapus yang lama, ganti yang baru dipilih)
        $authorIds = $request->input('user_ids', []);
        if (in_array('default', $authorIds) || empty($authorIds)) {
            $article->authors()->detach(); // Jadi default (PIK)
        } else {
            $article->authors()->sync($authorIds);
        }

        return redirect()->route('omc.scientific.index')->with('success', 'Artikel Ilmiah Diperbarui!');
    }

    public function destroy(ScientificArticle $article)
    {
        if ($article->cover_image) Storage::disk('public')->delete($article->cover_image);
        if ($article->pdf_version) Storage::disk('public')->delete($article->pdf_version);

        // Hapus relasi di pivot sebelum artikel dihapus
        $article->authors()->detach();
        $article->delete();

        return redirect()->route('omc.scientific.index')->with('success', 'Artikel Ilmiah Dihapus!');
    }

    public function show(ScientificArticle $article)
    {
        // Load authors agar di view bisa memanggil $article->authors
        $article->load('authors');
        return view('omc.publikasi.ilmiah.show', compact('article'));
    }
}
