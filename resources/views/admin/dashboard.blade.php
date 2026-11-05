@extends('admin.layouts.app')

@php
    $totalUsers = \App\Models\User::count();
    $totalDivisi = \App\Models\Division::count();
    $totalBidang = \App\Models\Team::count();
    $latestUsers = \App\Models\User::with('division')->latest()->limit(5)->get();
    $divisions = \App\Models\Division::withCount('members')->get();

    // Content Totals
    $totalPrograms = \App\Models\Program::count();
    $totalPublications = \App\Models\Publication::count();
    $totalBooks = \App\Models\DocPublication::where('category', 'buku')->count();
    $totalDocs = \App\Models\DocPublication::count();
    $totalScientific = \App\Models\ScientificArticle::count();
    $totalImpactReports = \App\Models\ImpactReport::count();
    $totalHeroSlides = \Illuminate\Support\Facades\Schema::hasTable('hero_slides') ? \App\Models\HeroSlide::count() : 0;

    // Recent Content for Pipeline
    $recentPublications = \App\Models\Publication::latest()->limit(5)->get();
    $recentPrograms = \App\Models\Program::latest()->limit(4)->get();
@endphp

@section('content')
<style>
    .omc-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 32px; }
    .omc-card { background: #ffffff; border-radius: 28px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03); padding: 24px; transition: all 0.3s ease; }
    .omc-card:hover { transform: translateY(-3px); box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.06); }
    .text-green-bot { color: #064e3b; }
    .bg-green-bot { background-color: #064e3b; }
    .badge-role { background: #f1f5f9; color: #064e3b; padding: 4px 10px; border-radius: 8px; font-size: 9px; font-weight: 800; text-transform: uppercase; }
    .flex-between { display: flex; justify-content: space-between; align-items: center; }
</style>

<div class="omc-container">
    @include('partials.birthday_alert')

    {{-- Header --}}
    <div class="flex-between" style="margin-bottom: 28px;">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-[#064e3b] text-[10px] font-black uppercase tracking-wider mb-2">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>SIYOTA.ORG ADMINISTRATIVE HUB</span>
            </div>
            <h1 style="font-size: 32px; font-weight: 900; color: #064e3b; line-height: 1.1; text-transform: uppercase; letter-spacing: -1px;">
                CENTRAL <span style="font-family: serif; font-style: italic; color: #16a34a; text-transform: none;">Command Center</span>
            </h1>
            <p style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 2px; margin-top: 6px;">
                Manajemen Konten Publik, 6 Pilar Program, Anggota & Laporan Dampak
            </p>
        </div>

        <div style="background: #ffffff; padding: 10px 20px; border-radius: 16px; display: flex; align-items: center; gap: 12px; border: 1px solid #e2e8f0;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: #bef264; display: flex; align-items: center; justify-content: center; color: #064e3b; font-weight: 900;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </div>
            <div>
                <p style="font-size: 9px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Hari Ini</p>
                <p style="font-size: 13px; font-weight: 800; color: #064e3b;">{{ date('d M Y') }}</p>
            </div>
        </div>
    </div>

    {{-- QUICK ACTIONS LAUNCHER --}}
    <div style="background: #064e3b; border-radius: 24px; padding: 20px 24px; margin-bottom: 32px; color: white;">
        <div class="flex-between" style="margin-bottom: 16px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="display: inline-block; width: 8px; height: 8px; border-radius: 9999px; background: #bef264;"></span>
                <span style="font-size: 11px; font-weight: 900; letter-spacing: 2px; text-transform: uppercase; color: #bef264;">Quick Actions & Publication Hub</span>
            </div>
            <span style="font-size: 10px; font-family: monospace; color: rgba(255,255,255,0.7);">SIYOTA SMART CMS</span>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px;">
            <a href="{{ route('omc.quick_publish.index') }}" style="background: #bef264; color: #064e3b; padding: 12px 16px; border-radius: 14px; text-decoration: none; font-weight: 900; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; justify-content: space-between; transition: all 0.2s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                <span>Smart Quick Publish</span>
                <span>→</span>
            </a>

            <a href="{{ route('omc.create') }}" style="background: rgba(255,255,255,0.12); color: white; padding: 12px 16px; border-radius: 14px; text-decoration: none; font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; justify-content: space-between; border: 1px solid rgba(255,255,255,0.2);">
                <span>Tulis Berita / Artikel</span>
                <span>+</span>
            </a>

            <a href="{{ route('omc.programs.create') }}" style="background: rgba(255,255,255,0.12); color: white; padding: 12px 16px; border-radius: 14px; text-decoration: none; font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; justify-content: space-between; border: 1px solid rgba(255,255,255,0.2);">
                <span>Tambah Program Baru</span>
                <span>+</span>
            </a>

            <a href="{{ route('omc.hero-slides.index') }}" style="background: rgba(255,255,255,0.12); color: white; padding: 12px 16px; border-radius: 14px; text-decoration: none; font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; justify-content: space-between; border: 1px solid rgba(255,255,255,0.2);">
                <span>Hero Banner Beranda</span>
                <span>⚙</span>
            </a>

            <a href="{{ route('omc.docs.index') }}" style="background: rgba(255,255,255,0.12); color: white; padding: 12px 16px; border-radius: 14px; text-decoration: none; font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; justify-content: space-between; border: 1px solid rgba(255,255,255,0.2);">
                <span>Buku & Kebijakan</span>
                <span>📚</span>
            </a>

            <a href="{{ route('omc.impact.index') }}" style="background: rgba(255,255,255,0.12); color: white; padding: 12px 16px; border-radius: 14px; text-decoration: none; font-weight: 800; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; justify-content: space-between; border: 1px solid rgba(255,255,255,0.2);">
                <span>Laporan Dampak</span>
                <span>📊</span>
            </a>
        </div>
    </div>

    {{-- STATS OVERVIEW --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 32px;">
        <div class="omc-card">
            <p style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; margin-bottom: 10px;">Program Inisiatif</p>
            <h3 style="font-size: 36px; font-weight: 900; color: #064e3b; letter-spacing: -1px;">{{ $totalPrograms }}</h3>
            <p style="font-size: 10px; color: #16a34a; font-weight: 800; margin-top: 6px;">Tersebar di 6 Pilar</p>
        </div>

        <div class="omc-card">
            <p style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; margin-bottom: 10px;">Publikasi & Berita</p>
            <h3 style="font-size: 36px; font-weight: 900; color: #064e3b; letter-spacing: -1px;">{{ $totalPublications }}</h3>
            <p style="font-size: 10px; color: #64748b; font-weight: 800; margin-top: 6px;">Artikel Publik Terbit</p>
        </div>

        <div class="omc-card">
            <p style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; margin-bottom: 10px;">Buku & Dokumen Resmi</p>
            <h3 style="font-size: 36px; font-weight: 900; color: #064e3b; letter-spacing: -1px;">{{ $totalDocs }}</h3>
            <p style="font-size: 10px; color: #0284c7; font-weight: 800; margin-top: 6px;">{{ $totalBooks }} Buku / Monograf</p>
        </div>

        <div class="omc-card">
            <p style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; margin-bottom: 10px;">Artikel Riset Ilmiah</p>
            <h3 style="font-size: 36px; font-weight: 900; color: #064e3b; letter-spacing: -1px;">{{ $totalScientific }}</h3>
            <p style="font-size: 10px; color: #9333ea; font-weight: 800; margin-top: 6px;">Open Access Repository</p>
        </div>

        <div class="omc-card">
            <p style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; margin-bottom: 10px;">Total Pengurus & User</p>
            <h3 style="font-size: 36px; font-weight: 900; color: #064e3b; letter-spacing: -1px;">{{ $totalUsers }}</h3>
            <p style="font-size: 10px; color: #16a34a; font-weight: 800; margin-top: 6px;">{{ $totalDivisi }} Divisi Aktif</p>
        </div>
    </div>

    {{-- DUA KOLOM PIPELINE & PENGURUS --}}
    <div style="display: grid; grid-template-columns: 3fr 2fr; gap: 24px;">

        {{-- KOLOM KIRI: RECENT PUBLICATIONS & PROGRAMS --}}
        <div style="display: flex; flex-direction: column; gap: 24px;">

            {{-- Recent Publications --}}
            <div class="omc-card" style="padding: 28px;">
                <div class="flex-between" style="margin-bottom: 20px;">
                    <div>
                        <span style="font-size: 9px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">LIVE FEED</span>
                        <h3 style="font-size: 18px; font-weight: 900; color: #064e3b; text-transform: uppercase; margin-top: 2px;">
                            Publikasi & Artikel Terkini
                        </h3>
                    </div>
                    <a href="{{ route('omc.index') }}" style="font-size: 10px; font-weight: 900; color: #16a34a; text-decoration: none; text-transform: uppercase;">
                        Buka Semua Berita →
                    </a>
                </div>

                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @forelse($recentPublications as $pub)
                    @php
                        $pTitle = is_array($pub->title) ? ($pub->title[app()->getLocale()] ?? $pub->title['id'] ?? reset($pub->title) ?? 'Untitled') : ($pub->title ?? 'Untitled');
                    @endphp
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; background: #f8fafc; border-radius: 16px; border: 1px solid #f1f5f9;">
                        <div style="display: flex; align-items: center; gap: 12px; max-width: 75%;">
                            <span style="width: 8px; height: 8px; border-radius: 9999px; background: {{ $pub->status === 'published' ? '#16a34a' : '#d97706' }}; flex-shrink: 0;"></span>
                            <div>
                                <h4 style="font-size: 12px; font-weight: 800; color: #0f172a; margin: 0; line-height: 1.3;" class="truncate">
                                    {{ $pTitle }}
                                </h4>
                                <span style="font-size: 9px; color: #94a3b8; text-transform: uppercase; font-weight: 700;">
                                    {{ $pub->category ?? 'News' }} • {{ $pub->published_at ? $pub->published_at->format('d M Y') : 'Draft' }}
                                </span>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 8px;">
                            <a href="{{ route('public.publications.show', $pub->slug) }}" target="_blank" style="padding: 6px 10px; background: white; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 10px; font-weight: 800; color: #064e3b; text-decoration: none;">
                                Preview
                            </a>
                            <a href="{{ route('omc.edit', $pub->id) }}" style="padding: 6px 10px; background: #064e3b; border-radius: 8px; font-size: 10px; font-weight: 800; color: white; text-decoration: none;">
                                Edit
                            </a>
                        </div>
                    </div>
                    @empty
                    <p style="font-size: 12px; color: #94a3b8;">Belum ada artikel publikasi.</p>
                    @endforelse
                </div>
            </div>

            {{-- Recent Programs --}}
            <div class="omc-card" style="padding: 28px;">
                <div class="flex-between" style="margin-bottom: 20px;">
                    <div>
                        <span style="font-size: 9px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">6 PILAR STRATEGIS</span>
                        <h3 style="font-size: 18px; font-weight: 900; color: #064e3b; text-transform: uppercase; margin-top: 2px;">
                            Program Inisiatif Lapangan
                        </h3>
                    </div>
                    <a href="{{ route('omc.programs.index') }}" style="font-size: 10px; font-weight: 900; color: #16a34a; text-decoration: none; text-transform: uppercase;">
                        Kelola Semua Program →
                    </a>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    @forelse($recentPrograms as $prog)
                    @php
                        $prTitle = is_array($prog->title) ? ($prog->title[app()->getLocale()] ?? $prog->title['id'] ?? reset($prog->title) ?? 'Program') : ($prog->title ?? $prog->name ?? 'Program');
                    @endphp
                    <div style="padding: 14px; background: #f8fafc; border-radius: 16px; border: 1px solid #f1f5f9;">
                        <span style="font-size: 8px; font-weight: 900; text-transform: uppercase; padding: 3px 6px; border-radius: 6px; background: #e0f2fe; color: #0369a1; display: inline-block; margin-bottom: 6px;">
                            {{ $prog->status ?? 'Aktif' }}
                        </span>
                        <h4 style="font-size: 12px; font-weight: 800; color: #0f172a; margin-bottom: 4px; line-height: 1.3;" class="line-clamp-1">
                            {{ $prTitle }}
                        </h4>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px; font-size: 10px;">
                            <a href="{{ route('public.programs.show', $prog->slug) }}" target="_blank" style="color: #64748b; font-weight: 700; text-decoration: none;">
                                Lihat Publik
                            </a>
                            <a href="{{ route('omc.programs.edit', $prog->id) }}" style="color: #064e3b; font-weight: 900; text-decoration: none;">
                                Edit →
                            </a>
                        </div>
                    </div>
                    @empty
                    <p style="font-size: 12px; color: #94a3b8;">Belum ada program.</p>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- KOLOM KANAN: PENGURUS & DIVISI --}}
        <div style="display: flex; flex-direction: column; gap: 24px;">

            {{-- Anggota Terkini --}}
            <div class="omc-card" style="padding: 28px;">
                <div class="flex-between" style="margin-bottom: 20px;">
                    <h3 style="font-size: 16px; font-weight: 900; color: #064e3b; text-transform: uppercase;">
                        Pengurus <span style="font-family: serif; font-style: italic; color: #16a34a; text-transform: none;">Terkini</span>
                    </h3>
                    <a href="{{ route('admin.users.index') }}" style="font-size: 10px; font-weight: 900; color: #94a3b8; text-decoration: none; text-transform: uppercase;">
                        Lihat Semua
                    </a>
                </div>

                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @foreach($latestUsers as $user)
                    <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid #f1f5f9;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?background=064e3b&color=BEF264&name='.urlencode($user->name) }}" style="width: 36px; height: 36px; border-radius: 10px; object-fit: cover;">
                            <div>
                                <p style="font-size: 12px; font-weight: 800; color: #1e293b; margin: 0; text-transform: uppercase;">{{ $user->name }}</p>
                                <p style="font-size: 10px; color: #94a3b8; margin: 0;">{{ $user->email }}</p>
                            </div>
                        </div>
                        <span class="badge-role">{{ $user->role->value ?? $user->role }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Distribusi SDM Divisi --}}
            <div class="omc-card" style="padding: 28px;">
                <h3 style="font-size: 16px; font-weight: 900; color: #064e3b; text-transform: uppercase; margin-bottom: 20px;">
                    Distribusi <span style="font-family: serif; font-style: italic; color: #16a34a; text-transform: none;">Divisi</span>
                </h3>

                <div style="display: flex; flex-direction: column; gap: 16px;">
                    @foreach($divisions as $div)
                    <div>
                        <div class="flex-between" style="margin-bottom: 6px;">
                            <span style="font-size: 11px; font-weight: 800; color: #1e293b; text-transform: uppercase;">{{ $div->name }}</span>
                            <span style="font-size: 10px; font-weight: 800; color: #16a34a;">{{ $div->members_count }} orang</span>
                        </div>
                        <div style="background: #f1f5f9; height: 8px; border-radius: 9999px; overflow: hidden;">
                            <div style="height: 100%; border-radius: 9999px; background: linear-gradient(90deg, #064e3b, #bef264); width: {{ min(($div->members_count / ($totalUsers ?: 1)) * 100, 100) }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #f1f5f9; text-align: center;">
                    <a href="{{ route('admin.divisions.index') }}" style="display: block; padding: 12px; border-radius: 12px; background: #064e3b; color: #bef264; text-decoration: none; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px;">
                        Buka Manajemen Divisi
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
