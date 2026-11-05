<?php

namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('order', 'asc')->latest()->get();
        return view('omc.galleries.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|max:2048',
            'category' => 'required'
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        Gallery::create($data);
        return back()->with('success', 'Foto berhasil ditambahkan ke galeri!');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
