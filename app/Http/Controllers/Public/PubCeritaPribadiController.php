<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PubCeritaPribadiController extends Controller
{
    /**
     * Menampilkan daftar cerita, opini, dan artikel dari pengguna.
     */
    public function index(Request $request)
    {
        // Hanya ambil yang statusnya 'published'
        $query = Post::with(['category', 'author'])
            ->where('status', 'published');

        // Filter berdasarkan kategori jika ada
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter berdasarkan tipe (story, opinion, article)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Pencarian judul atau isi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        return view('public.ceritapribadi.index', [
            'posts' => $query->latest()->paginate(12)->withQueryString(),
            'categories' => Category::has('posts')->get(), // Hanya kategori yang ada isinya
        ]);
    }

    /**
     * Menampilkan detail cerita secara mendalam.
     */
    public function show($slug)
    {
        // Ambil data berdasarkan slug
        $post = Post::with(['category', 'author', 'meta'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment View Count (Tracing popularitas)
        $post->increment('views_count');

        // Ambil cerita terkait (opsional untuk sidebar/rekomendasi)
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->limit(3)
            ->get();

        return view('public.ceritapribadi.show', compact('post', 'relatedPosts'));
    }
}
