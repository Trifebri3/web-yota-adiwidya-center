<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class PublicProgramController extends Controller
{
    /**
     * Menampilkan semua program (Active & History)
     */
    public function index(Request $request)
    {
        $query = Program::query();

        // Filter berdasarkan status jika ada (e.g. ?status=ongoing)
        if ($request->has('status')) {
            $query->where('status', $request->status);
        } else {
            // Default: Tampilkan yang aktif/sedang jalan di atas
            $query->orderByRaw("FIELD(status, 'ongoing', 'upcoming', 'history') ASC");
        }

        $programs = $query->latest()->paginate(9);

        return view('public.programs.index', compact('programs'));
    }

    /**
     * Menampilkan detail program tunggal
     */
    public function show($slug)
    {
        // Cari berdasarkan slug
        $program = Program::where('slug', $slug)->firstOrFail();

        // Ambil program terkait (kategori yang sama atau terbaru)
        $relatedPrograms = Program::where('id', '!=', $program->id)
            ->active()
            ->take(3)
            ->get();

        return view('public.programs.show', compact('program', 'relatedPrograms'));
    }
}
