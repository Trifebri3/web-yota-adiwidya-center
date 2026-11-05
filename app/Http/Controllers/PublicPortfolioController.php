<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Identity;
use Illuminate\Http\Request;

class PublicPortfolioController extends Controller
{
    /**
     * Menampilkan portofolio publik berdasarkan slug nama.
     */
    public function show($slug)
    {
        // Mencari identitas yang nama lengkapnya cocok dengan slug
        // Kita asumsikan slug dibuat dari str_slug(full_name)
        $identity = Identity::whereRaw("LOWER(REPLACE(full_name, ' ', '-')) = ?", [$slug])->firstOrFail();

        // Ambil user terkait beserta seluruh relasinya (Eager Loading)
        $user = $identity->user()->with([
            'skills',
            'experiences',
            'educations',
            'portfolios',
            'achievements',
            'organizations',
            'socialLinks',
            'certifications',
            'additionalSkills'
        ])->first();

        return view('public.portfolio', compact('user', 'identity'));
    }
}
