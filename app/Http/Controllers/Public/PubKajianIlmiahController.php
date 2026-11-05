<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ScientificArticle;
use Illuminate\Http\Request;

class PubKajianIlmiahController extends Controller
{
    /**
     * Menampilkan daftar kajian ilmiah untuk publik.
     */
    public function index(Request $request)
    {
        $query = ScientificArticle::with('authors')->where('is_verified', true);

        // 1. Fitur Search (Multibahasa JSON)
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title->id', 'like', "%{$search}%")
                  ->orWhere('title->en', 'like', "%{$search}%")
                  ->orWhere('abstract->id', 'like', "%{$search}%");
            });
        }

        // 2. Filter Berdasarkan Penulis
        if ($request->filled('author')) {
            $query->whereHas('authors', function($q) use ($request) {
                $q->where('users.id', $request->get('author'));
            });
        }

        // 3. Sistem Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'alphabetical':
                $query->orderBy('title->id', 'asc');
                break;
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        $articles = $query->paginate(12)->withQueryString();

        // Pastikan folder view sesuai: public/kajianilmiah/index.blade.php
        return view('public.kajianilmiah.index', compact('articles'));
    }

    /**
     * Menampilkan detail kajian ilmiah.
     */
    public function show($slug)
    {
        $article = ScientificArticle::with('authors')
            ->where('slug', $slug)
            ->where('is_verified', true)
            ->firstOrFail();

        return view('public.kajianilmiah.show', compact('article'));
    }
}
