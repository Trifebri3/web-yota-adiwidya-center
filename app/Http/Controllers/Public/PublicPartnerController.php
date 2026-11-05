<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PublicPartnerController extends Controller
{
    /**
     * Menampilkan daftar mitra strategis untuk publik
     */
    public function index()
    {
        // Ambil mitra yang aktif, urutkan berdasarkan 'order' terkecil, lalu waktu terbaru
        $partners = Partner::where('is_active', true)
                           ->orderBy('order', 'asc')
                           ->latest()
                           ->get();

        // Mengelompokkan berdasarkan tipe untuk layout yang lebih rapi di view (Opsional)
        $groupedPartners = $partners->groupBy('type');

        return view('public.partners.index', compact('partners', 'groupedPartners'));
    }
}
