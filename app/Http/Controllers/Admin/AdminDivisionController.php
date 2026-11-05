<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminDivisionController extends Controller
{
    /**
     * Menampilkan daftar semua divisi.
     */
  public function index()
    {
        $divisions = Division::with(['kabid', 'members'])->latest()->get();
        $users_anggota = User::where('role', 'anggota')->whereNull('division_id')->orderBy('name')->get();

        return view('admin.divisions.index', compact('divisions', 'users_anggota'));
    }

    /** * INI YANG HILANG: Fungsi untuk menampilkan halaman Form Tambah
     */
    public function create()
    {
        // Ambil user yang bisa dijadikan Kabid (Anggota atau yang sudah Kabid untuk rotasi)
        $users = User::whereIn('role', ['anggota', 'kabid'])->orderBy('name')->get();
        return view('admin.divisions.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'kabid_id' => 'required|exists:users,id',
            'logo'     => 'nullable|image|max:2048',
        ]);

        return DB::transaction(function () use ($request) {
            $logoPath = $request->hasFile('logo')
                ? $request->file('logo')->store('division_logos', 'public')
                : null;

            $division = Division::create([
                'name'        => $request->name,
                'kabid_id'    => $request->kabid_id,
                'description' => $request->description,
                'logo'        => $logoPath,
            ]);

            User::where('id', $request->kabid_id)->update([
                'role'        => 'kabid',
                'division_id' => $division->id
            ]);

            return redirect()->route('admin.divisions.index')->with('success', 'Divisi berhasil dibentuk.');
        });
    }

    /** * INI JUGA PASTIKAN ADA: Fungsi untuk menampilkan halaman Form Edit
     */
    public function edit(Division $division)
    {
        $users = User::whereIn('role', ['anggota', 'kabid'])->orderBy('name')->get();
        return view('admin.divisions.edit', compact('division', 'users'));
    }

    public function update(Request $request, Division $division)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'kabid_id' => 'required|exists:users,id',
            'logo'     => 'nullable|image|max:2048',
        ]);

        return DB::transaction(function () use ($request, $division) {
            if ($division->kabid_id != $request->kabid_id) {
                User::where('id', $division->kabid_id)->update(['role' => 'anggota']);
                User::where('id', $request->kabid_id)->update([
                    'role'        => 'kabid',
                    'division_id' => $division->id
                ]);
            }

            $data = $request->only(['name', 'description', 'kabid_id']);
            if ($request->hasFile('logo')) {
                if ($division->logo) Storage::disk('public')->delete($division->logo);
                $data['logo'] = $request->file('logo')->store('division_logos', 'public');
            }

            $division->update($data);
            return redirect()->route('admin.divisions.index')->with('success', 'Data divisi diperbarui.');
        });
    }

    /**
     * Menambahkan banyak anggota sekaligus ke dalam divisi.
     */
    public function addMembers(Request $request, Division $division)
    {
        $request->validate([
            'user_ids'   => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        // Role mereka tidak berubah (tetap anggota), hanya division_id yang diisi
        User::whereIn('id', $request->user_ids)->update([
            'division_id' => $division->id
        ]);

        return back()->with('success', count($request->user_ids) . ' Anggota berhasil digabungkan.');
    }

    /**
     * Mengeluarkan anggota dari divisi (reset ke status tanpa divisi).
     */
    public function removeMember(User $user)
    {
        $user->update([
            'division_id' => null,
            'team_id'     => null
        ]);

        return back()->with('success', 'Anggota telah dilepas dari divisi.');
    }

    /**
     * Menghapus divisi & mereset semua pengurus di dalamnya.
     */
    public function destroy(Division $division)
    {
        return DB::transaction(function () use ($division) {
            // Reset semua anggota & kabid di divisi ini menjadi status normal
            User::where('division_id', $division->id)->update([
                'division_id' => null,
                'team_id'     => null,
                'role'        => 'anggota'
            ]);

            if ($division->logo) Storage::disk('public')->delete($division->logo);

            $division->delete();

            return redirect()->route('admin.divisions.index')
                             ->with('success', 'Divisi dihapus dan anggota telah didelegasikan ulang.');
        });
    }
}
