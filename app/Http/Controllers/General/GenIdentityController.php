<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Identity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GenIdentityController extends Controller
{
    public function index()
    {
        $identity = Auth::user()->identity ?? new Identity();
        return view('general.cv.index', compact('identity'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:150',
            'avatar_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cv_pdf_path' => 'nullable|mimes:pdf|max:5120',
        ]);

        $data = $request->all();
        $identity = Auth::user()->identity();

        // Handle Avatar Upload
        if ($request->hasFile('avatar_image')) {
            if (Auth::user()->identity?->avatar_image) {
                Storage::disk('public')->delete(Auth::user()->identity->avatar_image);
            }
            $data['avatar_image'] = $request->file('avatar_image')->store('avatars', 'public');
        }

        // Handle CV Upload
        if ($request->hasFile('cv_pdf_path')) {
            if (Auth::user()->identity?->cv_pdf_path) {
                Storage::disk('public')->delete(Auth::user()->identity->cv_pdf_path);
            }
            $data['cv_pdf_path'] = $request->file('cv_pdf_path')->store('cv_files', 'public');
        }

        Auth::user()->identity()->updateOrCreate(['user_id' => Auth::id()], $data);

        return back()->with('success', 'Identitas GTU berhasil diperbarui!');
    }
}
