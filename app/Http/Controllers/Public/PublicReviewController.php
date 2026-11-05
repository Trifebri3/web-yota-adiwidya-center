<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Review; // Pastikan Model Review di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicReviewController extends Controller
{
    /**
     * Tampilan Index untuk Publik
     */
    public function index()
    {
        // Menggunakan scope 'published' yang kita buat di Model tadi
        $reviews = Review::where('is_published', true)->latest()->paginate(12);
        return view('public.reviews.index', compact('reviews'));
    }

    /**
     * Store Review dari Form Publik
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'comment'  => 'required|string|min:10',
            'rating'   => 'required|integer|min:1|max:5',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
        ]);

        try {
            // 2. Mapping Data
            $data = [
                'name'         => $request->name,
                'position'     => $request->position,
                'comment'      => $request->comment,
                'rating'       => $request->rating,
                'is_published' => false, // Default HARUS false (menunggu ACC)
            ];

            // 3. Handle Upload Foto
            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('reviews', 'public');
            }

            // 4. Eksekusi Simpan
            $create = Review::create($data);

            // Cek jika gagal simpan
            if (!$create) {
                return back()->with('error', 'Gagal menyimpan data ke database.');
            }

            return back()->with('success', 'Terima kasih! Review Anda sedang ditinjau oleh tim kami.');

        } catch (\Exception $e) {
            // Jika error, tampilkan pesan errornya untuk debugging
            // Hapus line di bawah ini jika sudah masuk produksi
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
