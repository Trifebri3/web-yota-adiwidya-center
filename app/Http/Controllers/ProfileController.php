<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan form update profil (Edit).
     */
public function edit(Request $request): View
{
    return view('profile.update', [ // Memanggil file di profile/update.blade.php
        'user' => $request->user(),
    ]);
}

    /**
     * Update data profil, keamanan (password), dan foto profil.
     */
    public function update(Request $request): RedirectResponse
    {
        // 1. Validasi Input Terintegrasi
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'in:L,P'],
            'pob' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'domicile_address' => ['required', 'string'],
            'last_education' => ['nullable', 'string', 'max:255'],
            'main_skill' => ['nullable', 'string', 'max:255'],
            'blood_type' => ['nullable', 'in:A,B,AB,O'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            // Validasi Password Baru (Opsional)
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user = $request->user();

        // 2. Mass Assignment data dasar (kecuali avatar & password)
        $user->fill($request->except(['avatar', 'password']));

        // 3. Handle Ganti Password jika diinput
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 4. Handle Foto Profil (Avatar)
        if ($request->hasFile('avatar')) {
            // Hapus file lama untuk efisiensi storage
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Simpan file baru ke folder public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // 5. Reset Verifikasi Email jika email berubah (Jika fitur verifikasi aktif)
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('profile.complete')
            ->with('status', 'Profil dan keamanan Anda berhasil diperbarui!');
    }

    /**
     * Hapus akun pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Bersihkan storage dari foto profil user tersebut
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
