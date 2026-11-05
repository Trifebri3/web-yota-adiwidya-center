<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $publicationId)
    {
        // 1. Validasi
        $request->validate([
            'content' => 'required|min:5',
        ]);

        // 2. Simpan (Tanpa Login)
        Comment::create([
            'post_id'     => $publicationId, // Menghubungkan ke publikasi
            'body'        => $request->content, // Ambil dari textarea name="content"
            'user_id'     => null, // Karena tanpa login
            'is_approved' => true, // Set true agar langsung muncul
        ]);

        return back()->with('success', 'Refleksi berhasil diposting!');
    }
}
