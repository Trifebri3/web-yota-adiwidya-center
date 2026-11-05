<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class PublicGalleryController extends Controller
{
    /**
     * Menampilkan halaman galeri publik dengan fitur filter
     */
    public function index(Request $request)
    {
        // 1. Ambil semua kategori yang unik dari database untuk tombol filter
        $categories = Gallery::where('is_active', true)
                            ->select('category')
                            ->distinct()
                            ->pluck('category');

        // 2. Query dasar (hanya yang aktif)
        $query = Gallery::where('is_active', true)->latest();

        // 3. Logika Filter jika user memilih kategori tertentu
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // 4. Paginate agar halaman tidak berat jika foto sudah ribuan
        $galleries = $query->paginate(12)->withQueryString();

        return view('public.galleries.index', compact('galleries', 'categories'));
    }

    /**
     * Opsional: Detail galeri jika ingin ada halaman khusus per foto
     */
    public function show($slug)
    {
        $gallery = Gallery::where('slug', $slug)->where('is_active', true)->firstOrFail();

        // Ambil foto terkait (kategori sama) untuk rekomendasi di bawah
        $related = Gallery::where('category', $gallery->category)
                          ->where('id', '!=', $gallery->id)
                          ->limit(4)
                          ->get();

        return view('public.galleries.show', compact('gallery', 'related'));
    }
}
