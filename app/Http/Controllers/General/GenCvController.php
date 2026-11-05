<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GenCvController extends Controller
{
    /**
     * Redirect ke view berdasarkan tipe CV (Skills/Experience/dll)
     */
    public function list($type)
    {
        $user = Auth::user();
        $data = match($type) {
            'skills' => $user->skills,
            'experience' => $user->experiences()->orderBy('start_date', 'desc')->get(),
            'portfolios' => $user->portfolios,
            'achievements' => $user->achievements,
            'organizations' => $user->organizations,
            default => abort(404)
        };

        // Kirim ke satu file utama 'list.blade.php'
return view("general.cv.list", [
    'data' => $data,
    'type' => $type // Kirim variabel type buat judul di Blade
]);
    }

    /**
     * Store data umum untuk berbagai model CV
     */
    public function store(Request $request, $type)
    {
        $modelName = Str::studly(Str::singular($type));
        $fullModelPath = "App\\Models\\" . ($type == 'organizations' ? 'PortfolioOrganization' : $modelName);

        if (!class_exists($fullModelPath)) abort(404);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        $fullModelPath::create($data);

        return back()->with('success', "Data " . ucfirst($type) . " berhasil ditambahkan.");
    }

    /**
     * Delete data umum
     */
    public function destroy($type, $id)
    {
        $modelName = Str::studly(Str::singular($type));
        $fullModelPath = "App\\Models\\" . ($type == 'organizations' ? 'PortfolioOrganization' : $modelName);

        $item = $fullModelPath::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $item->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }
}
