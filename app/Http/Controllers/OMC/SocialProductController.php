<?php
namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Models\SocialProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SocialProductController extends Controller
{
    public function index()
    {
        $products = SocialProduct::latest()->paginate(10);
        return view('omc.products.index', compact('products'));
    }

    public function create()
    {
        return view('omc.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|image|max:2048',
            'name_id' => 'required', // Nama Bahasa Indonesia
            'name_en' => 'required', // Nama Bahasa Inggris
            'category' => 'required',
        ]);

        $data = [
            'category' => $request->category,
            'name' => ['id' => $request->name_id, 'en' => $request->name_en],
            'description' => ['id' => $request->description_id, 'en' => $request->description_en],
            'features' => ['id' => $request->features_id, 'en' => $request->features_en],
            'benefits' => ['id' => $request->benefits_id, 'en' => $request->benefits_en],
            'video_url' => $request->video_url,
            'pdf_url' => $request->pdf_url,
            'external_link' => $request->external_link,
            'published_by' => auth()->user()->name ?? 'OMC Office',
            'slug' => Str::slug($request->name_id) . '-' . Str::random(5),
        ];

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('products/banners', 'public');
        }

        SocialProduct::create($data);
        return redirect()->route('omc.products.index')->with('success', 'Produk Inovasi Berhasil Ditambahkan!');
    }

    public function edit(SocialProduct $product)
    {
        return view('omc.products.edit', compact('product'));
    }

    public function update(Request $request, SocialProduct $product)
    {
        // Logika update sama dengan store, namun gunakan $product->update($data)
        // Dan pastikan hapus foto lama jika upload foto baru.

        $data = [
            'category' => $request->category,
            'name' => ['id' => $request->name_id, 'en' => $request->name_en],
            'description' => ['id' => $request->description_id, 'en' => $request->description_en],
            'features' => ['id' => $request->features_id, 'en' => $request->features_en],
            'benefits' => ['id' => $request->benefits_id, 'en' => $request->benefits_en],
            'video_url' => $request->video_url,
            'pdf_url' => $request->pdf_url,
            'external_link' => $request->external_link,
        ];

        if ($request->hasFile('banner_image')) {
            Storage::disk('public')->delete($product->banner_image);
            $data['banner_image'] = $request->file('banner_image')->store('products/banners', 'public');
        }

        $product->update($data);
        return redirect()->route('omc.products.index')->with('success', 'Produk Berhasil Diupdate!');
    }
}
