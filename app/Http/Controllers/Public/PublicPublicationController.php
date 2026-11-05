<?php

namespace App\Http\Controllers\Public;

// --- TAMBAHKAN IMPORT INI ---
use App\Http\Controllers\Controller;
// ----------------------------
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PublicPublicationController extends Controller
{
    /**
     * Menampilkan Landing Page Publikasi dengan fitur Sorting & Filtering.
     */
    public function index(Request $request)
    {
        $query = Publication::where('is_verified', true);

        // 1. Filter berdasarkan Tipe (Official, Article, Journal, dsb)
        if ($request->has('type') && $request->type != 'all') {
            $query->where('type', $request->type);
        }

        // 2. Pencarian Multibahasa pada kolom JSON
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title->id', 'like', "%{$search}%")
                  ->orWhere('title->en', 'like', "%{$search}%")
                  ->orWhere('description->id', 'like', "%{$search}%")
                  ->orWhere('description->en', 'like', "%{$search}%");
            });
        }

        // 3. Sistem Sorting (Luxury Standard)
        switch ($request->get('sort')) {
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'trending':
                $query->orderBy('shares', 'desc');
                break;
            default:
                $query->latest('published_at');
                break;
        }

        return view('public.publications.index', [
            // Gunakan 9 item per halaman agar grid 3x3 simetris di desktop
            'publications' => $query->paginate(9)->withQueryString(),
            // Sidebar Trending: Ambil 3 yang paling banyak dilihat
            'trending'     => Publication::where('is_verified', true)
                                ->orderBy('views', 'desc')
                                ->take(3)
                                ->get()
        ]);
    }

    /**
     * Detail Publikasi & Increment Metrics
     */


public function show(string $slug)
{
    // Ambil data publikasi berdasarkan slug & sudah diverifikasi
    $publication = Publication::where('slug', $slug)
        ->where('is_verified', true)
        ->firstOrFail();

    // Anti-spam views (1 session = 1 view)
    $sessionKey = 'viewed_pub_' . $publication->id;

    if (!session()->has($sessionKey)) {
        $publication->increment('views');
        session()->put($sessionKey, true);
    }

    return view('public.publications.show', [
        'publication' => $publication,
        'locale'      => App::getLocale(),
    ]);
}


    /**
     * Fitur Share Tracking (Triggered via AJAX di frontend)
     */
    public function trackShare(Publication $publication)
    {
        $publication->increment('shares');
        return response()->json([
            'status' => 'success',
            'total_shares' => $publication->shares
        ]);
    }
}
