<?php

namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Models\ImpactArea;
use App\Models\Program;
use App\Models\Publication;
use App\Models\DocPublication;
use App\Models\ImpactReport;
use App\Services\AiContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QuickPublishController extends Controller
{
    protected AiContentService $aiService;

    public function __construct(AiContentService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Halaman Utama Universal Content Publisher
     */
    public function index()
    {
        $impactAreas = ImpactArea::getDefaultPillars();
        $recentPublications = Publication::latest()->take(5)->get();
        $recentPrograms = Program::latest()->take(5)->get();
        $recentDocs = DocPublication::latest()->take(5)->get();

        return view('omc.quick_publish.index', compact('impactAreas', 'recentPublications', 'recentPrograms', 'recentDocs'));
    }

    /**
     * Simpan Konten Terpadu (Article, Program, Book, Impact Report)
     */
    public function store(Request $request)
    {
        $type = $request->input('content_type', 'article');

        // Handle File Upload
        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('uploads/omc', 'public');
        }

        $titleId = $request->input('title_id');
        $titleEn = $request->input('title_en') ?: $this->aiService->translate($titleId, 'id', 'en');

        $descId = $request->input('description_id');
        $descEn = $request->input('description_en') ?: ($descId ? $this->aiService->translate($descId, 'id', 'en') : '');

        $contentId = $request->input('content_id');
        $contentEn = $request->input('content_en') ?: ($contentId ? $this->aiService->translate(Str::limit(strip_tags($contentId), 500), 'id', 'en') : '');

        $status = $request->input('status', 'published');
        $slug = Str::slug($titleId) . '-' . Str::lower(Str::random(5));

        switch ($type) {
            case 'program':
                $program = Program::create([
                    'title' => ['id' => $titleId, 'en' => $titleEn],
                    'slug' => $slug,
                    'banner_image' => $coverPath ?: 'pilar/pilar6/Blue Mosaic Youth Development Icons.png',
                    'published_by' => auth()->user()->name ?? 'Yayasan Yota Wujudkan Asa',
                    'goal' => ['id' => $descId ?: $titleId, 'en' => $descEn ?: $titleEn],
                    'target_audience' => ['id' => $request->input('target_audience', 'Masyarakat Umum & Pemuda'), 'en' => 'General Public & Youth'],
                    'methodology' => ['id' => 'Pendampingan Berkelanjutan', 'en' => 'Sustainable Mentorship'],
                    'location_name' => $request->input('location_name', 'Indonesia'),
                    'quota_total' => (int) $request->input('quota_total', 100),
                    'quota_used' => 0,
                    'status' => $status === 'published' ? 'ongoing' : 'upcoming',
                    'impact_stats' => [
                        'beneficiaries' => $request->input('stat_beneficiaries', '500+'),
                        'volunteers' => $request->input('stat_volunteers', '50+')
                    ],
                ]);

                return redirect()->route('omc.quick_publish.index')
                    ->with('success', "Program '{$titleId}' berhasil disimpan dan otomatis terhubung ke publik!");

            case 'book':
                $doc = DocPublication::create([
                    'title' => $titleId,
                    'slug' => $slug,
                    'category' => 'buku',
                    'description' => $descId,
                    'cover_image' => $coverPath ?: 'pilar/pilar2/Purple Knowledge Mosaic Poster.png',
                    'pdf_path' => $request->input('pdf_url', 'https://drive.google.com/file/d/1DbOEOOHNIRAQjfxxMm-SoBOev8PU8n3E/view?usp=sharing'),
                    'published_at' => Carbon::now(),
                    'is_verified' => $status === 'published',
                ]);

                return redirect()->route('omc.quick_publish.index')
                    ->with('success', "Buku & Monograf '{$titleId}' berhasil ditambahkan ke Doc Center!");

            case 'impact_report':
                $report = ImpactReport::create([
                    'title' => $titleId,
                    'slug' => $slug,
                    'summary' => $descId,
                    'is_verified' => $status === 'published',
                ]);

                return redirect()->route('omc.quick_publish.index')
                    ->with('success', "Laporan Dampak '{$titleId}' berhasil diterbitkan!");

            case 'article':
            default:
                $publication = Publication::create([
                    'title' => ['id' => $titleId, 'en' => $titleEn],
                    'slug' => $slug,
                    'description' => ['id' => $descId, 'en' => $descEn],
                    'content' => ['id' => $contentId, 'en' => $contentEn],
                    'type' => $request->input('category', 'berita_resmi'),
                    'banner' => $coverPath ?: 'omc/banners/default.jpg',
                    'author' => auth()->user()->name ?? 'Tim Redaksi YOTA',
                    'views' => 0,
                    'shares' => 0,
                    'published_at' => Carbon::now(),
                ]);

                return redirect()->route('omc.quick_publish.index')
                    ->with('success', "Warta / Artikel '{$titleId}' berhasil dipublikasikan dalam 2 Bahasa (ID & EN)!");
        }
    }
}

