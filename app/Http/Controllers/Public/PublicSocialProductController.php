<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SocialProduct;
use Illuminate\Http\Request;

class PublicSocialProductController extends Controller
{
    /**
     * Menampilkan semua daftar produk inovasi sosial
     */
    public function index(Request $request)
    {
        // Query dasar
        $query = SocialProduct::where('is_active', true);

        // Filter berdasarkan kategori jika ada request dari frontend
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Pencarian nama produk (mencari di dalam JSON name -> id)
        if ($request->has('search')) {
            $query->where('name->id', 'like', '%' . $request->search . '%')
                  ->orWhere('name->en', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(9);

        // Mengambil daftar kategori unik untuk filter di view
        $categories = SocialProduct::distinct()->pluck('category');

        return view('public.products.index', compact('products', 'categories'));
    }

    /**
     * Menampilkan detail satu produk berdasarkan slug
     */
    public function show(SocialProduct $product)
    {
        // Pastikan produk aktif sebelum ditampilkan ke publik
        if (!$product->is_active) {
            abort(404);
        }

        // Mengambil produk lain sebagai rekomendasi (produk terkait)
        $relatedProducts = SocialProduct::where('category', $product->category)
                            ->where('id', '!=', $product->id)
                            ->where('is_active', true)
                            ->limit(3)
                            ->get();

        return view('public.products.show', compact('product', 'relatedProducts'));
    }
}
