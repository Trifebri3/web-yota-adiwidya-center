<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleSwitchController extends Controller
{
    public function switchMode(Request $request)
    {
        $targetMode = $request->mode; // 'direktur' atau 'anggota'

        // Simpan ke session
        session(['role_mode' => $targetMode]);

        return redirect()->route($targetMode == 'direktur' ? 'direktur.dashboard' : 'anggota.dashboard')
                         ->with('success', "Berhasil beralih ke mode " . ucfirst($targetMode));
    }
}
