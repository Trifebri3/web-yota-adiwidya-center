<?php

namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccReviewController extends Controller
{
    /**
     * Menampilkan semua review (Pending & Published)
     */
    public function index()
    {
        // Menampilkan yang terbaru lebih dulu
        $reviews = Review::latest()->get();

        // Statistik singkat untuk dashboard
        $stats = [
            'total' => Review::count(),
            'pending' => Review::where('is_published', false)->count(),
            'published' => Review::where('is_published', true)->count(),
        ];

        return view('omc.reviews.index', compact('reviews', 'stats'));
    }

    /**
     * Proses ACC (Toggle Publish/Unpublish)
     */
    public function togglePublish(Review $review)
    {
        // Membalikkan status: Jika true jadi false, jika false jadi true
        $review->update([
            'is_published' => !$review->is_published
        ]);

        $status = $review->is_published ? 'disetujui dan tampil di website!' : 'ditarik dari publikasi.';

        return back()->with('success', "Ulasan dari {$review->name} {$status}");
    }

    /**
     * Menghapus Review
     */
    public function destroy(Review $review)
    {
        // Hapus foto dari storage jika ada
        if ($review->photo) {
            Storage::disk('public')->delete($review->photo);
        }

        $review->delete();

        return back()->with('success', 'Ulasan berhasil dihapus secara permanen.');
    }
}
