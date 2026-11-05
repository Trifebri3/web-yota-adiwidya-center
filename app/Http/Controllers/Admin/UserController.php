<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengurus (Index)
     */
    public function index()
    {
        // Menggunakan paginate agar dashboard tidak berat jika data banyak
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Form tambah pengurus baru (Create)
     */
    public function create()
    {
        $roles = UserRole::cases();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Menyimpan pengurus baru ke database (Store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'membership_status' => 'aktif', // Default untuk pengurus baru
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', "Pengurus {$request->name} berhasil didaftarkan ke sistem.");
    }

    /**
     * Form edit data pengurus (Edit)
     */
    public function edit(User $user)
    {
        $roles = UserRole::cases();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Memperbarui data pengurus (Update)
     */
    public function update(Request $request, User $user)
    {
        // Validasi data sensitif dan role
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required'],
            'membership_status' => ['required', 'in:calon,aktif,nonaktif,alumni'],
        ];

        // Password hanya divalidasi jika diisi (opsional saat edit)
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Rules\Password::defaults()];
        }

        $request->validate($rules);

        // Siapkan data untuk update
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'membership_status' => $request->membership_status,
        ];

        // Hash password hanya jika diganti
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', "Data akses {$user->name} telah diperbarui.");
    }

    /**
     * Menghapus pengurus (Destroy)
     */
    public function destroy(User $user)
    {
        // PROTEKSI: Jangan biarkan Admin Utama menghapus dirinya sendiri
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tindakan Ditolak: Anda tidak dapat menghapus akun Anda sendiri demi keamanan sistem.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "Akun pengurus {$userName} telah dihapus dari sistem.");
    }
}
