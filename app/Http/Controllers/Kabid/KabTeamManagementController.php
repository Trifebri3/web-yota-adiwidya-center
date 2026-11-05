<?php

namespace App\Http\Controllers\Kabid;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class KabTeamManagementController extends Controller
{
public function index()
{
    $divisionId = auth()->user()->division_id;

    // Ambil Tim beserta anggotanya
    $teams = Team::with('members')->where('division_id', $divisionId)->get();

    // Ambil Anggota Divisi yang team_id nya NULL (Belum punya tim)
    $unassignedMembers = User::where('division_id', $divisionId)
                             ->whereNull('team_id')
                             ->get();

    return view('kabid.teams.index', compact('teams', 'unassignedMembers'));
}

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        Team::create([
            'name' => $request->name,
            'division_id' => auth()->user()->division_id // Otomatis masuk ke divisi Kabid
        ]);

        return back()->with('success', 'Tim baru berhasil dibentuk!');
    }

    public function assignMember(Request $request, Team $team)
    {
        // Kabid memilih anggota dari divisinya yang belum punya tim atau mau dipindah
        $user = User::findOrFail($request->user_id);

        if($user->division_id == auth()->user()->division_id) {
            $user->update(['team_id' => $team->id]);
            return back()->with('success', $user->name . ' berhasil dimasukkan ke ' . $team->name);
        }

        return back()->with('error', 'User bukan bagian dari divisi Anda.');
    }
}
