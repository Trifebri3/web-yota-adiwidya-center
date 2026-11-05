<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Division;
use App\Enums\UserRole;

class TeamStructureController extends Controller
{
    public function index()
    {
        // 1. Ambil Jajaran Petinggi (Direktur, Pembina, Pengawas)
        // Admin & OMC dikecualikan (tidak tampil)
        $leaders = User::whereIn('role', [
            UserRole::DIREKTUR,
            UserRole::PEMBINA,
            UserRole::PENGAWAS
        ])->orderBy('role')->get();

        // 2. Ambil Divisi beserta Kabid dan Anggotanya
        $divisions = Division::with(['kabid', 'members' => function($query) {
            $query->where('role', UserRole::ANGGOTA); // Hanya tampilkan anggota biasa di list divisi
        }])->get();

        return view('public.team.index', compact('leaders', 'divisions'));
    }
}
