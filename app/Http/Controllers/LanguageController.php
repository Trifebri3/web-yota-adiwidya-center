<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
public function switch(string $lang)
{
    if (in_array($lang, ['en', 'id'])) {
        // Simpan ke session
        session(['locale' => $lang]);
        // Set aplikasi secara langsung untuk request saat ini
        app()->setLocale($lang);
    }

    return redirect()->back();
}
}
