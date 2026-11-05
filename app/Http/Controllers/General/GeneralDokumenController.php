<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\KabidDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralDokumenController extends Controller
{
    /**
     * Menampilkan daftar dokumen/link khusus untuk divisi user yang login (Read-Only)
     */
    public function index()
    {
        // Mengambil dokumen yang HANYA milik divisi user tersebut
        $documents = KabidDokumen::where('division_id', Auth::user()->division_id)
            ->with('user') // Mengetahui kabid mana yang memposting
            ->latest()
            ->get();

        return view('general.dokumen.index', compact('documents'));
    }

    /**
     * Opsional: Fitur pencarian dokumen berdasarkan judul atau kategori
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $documents = KabidDokumen::where('division_id', Auth::user()->division_id)
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('category', 'like', "%{$query}%");
            })
            ->latest()
            ->get();

        return view('general.dokumen.index', compact('documents'));
    }
}
