@extends('public.layouts.app')

@section('title', __('publication.archive_title') . ' — Portal Berita & Warta Gerakan | SIYOTA.org')

@section('content')
@php
    $locale = app()->getLocale();
@endphp

<main class="bg-[#FDFDFB] pt-24 sm:pt-32 pb-24 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- 1. EDITORIAL HEADER SECTION --}}
        <div class="max-w-3xl mb-12 sm:mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 border border-slate-200 text-[#064e3b] text-[10px] font-black uppercase tracking-[0.25em] mb-3">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>YOTA NEWSROOM & FIELD DISCOURSE</span>
            </div>
            <h1 class="text-4xl sm:text-5xl md:text-7xl font-black text-[#052c24] tracking-tight uppercase leading-[0.95]">
                Warta Gerakan <br>
                <span class="text-slate-400 font-serif italic lowercase">& catatan lapangan.</span>
            </h1>
            <p class="mt-4 text-xs sm:text-sm md:text-base text-slate-500 font-normal leading-relaxed max-w-2xl">
                Arsip liputan resmi, rilis pers inisiatif 6 pilar, kabar komunitas dampingan desa, dan diskursus keberlanjutan dari seluruh penjuru kepulauan.
            </p>
        </div>

        {{-- 2. FILTER, SEARCH & SORT CONTROLS --}}
        <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4 mb-12 pb-6 border-b border-slate-200/80">

            {{-- Category Filter Pills --}}
            <div class="flex items-center gap-2 overflow-x-auto pb-2 lg:pb-0 scrollbar-none select-none">
                @php
                    $categories = [
                        'all' => 'Semua Berita',
                        'berita_resmi' => 'Berita Resmi',
                        'kegiatan_yota' => 'Aksi Lapangan',
                        'lingkungan' => 'Konservasi',
                        'bencana' => 'Resiliensi Bencana',
                        'edukasi' => 'Pendidikan STEAM',
                        'opini' => 'Opini & Kolom'
                    ];
                @endphp

                @foreach($categories as $catKey => $catLabel)
                <a href="{{ request()->fullUrlWithQuery(['type' => $catKey, 'page' => 1]) }}"
                   class="px-4 py-2 rounded-full text-[11px] font-black uppercase tracking-wider whitespace-nowrap transition-all duration-200 border
                   {{ request('type', 'all') == $catKey
                        ? 'bg-[#052c24] text-[#BEF264] border-[#052c24] shadow-sm'
                        : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50 hover:text-slate-900'
                   }}">
                    {{ $catLabel }}
                </a>
                @endforeach
            </div>

            {{-- Search & Sort --}}
            <div class="flex items-center gap-3 w-full lg:w-auto">
                <form action="{{ route('public.publications.index') }}" method="GET" class="relative flex-grow lg:w-64">
                    <input type="hidden" name="type" value="{{ request('type', 'all') }}">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari berita atau isu..."
                           class="w-full bg-white border border-slate-200 rounded-2xl pl-10 pr-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-emerald-600 focus:outline-none transition-all placeholder:text-slate-400">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </form>

                <select onchange="location = this.value;"
                        class="bg-white border border-slate-200 rounded-2xl px-4 py-2.5 text-[10px] font-black uppercase tracking-wider text-[#052c24] focus:ring-2 focus:ring-emerald-600 focus:outline-none transition-all cursor-pointer shrink-0">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'trending']) }}" {{ request('sort') == 'trending' ? 'selected' : '' }}>Trending</option>
                </select>
            </div>
        </div>

        {{-- 3. HERO FEATURED EDITORIAL STORY (First Page & No Search) --}}
        @if($publications->onFirstPage() && $publications->isNotEmpty() && !request('search') && request('type', 'all') == 'all')
            @php $featured = $publications->first(); @endphp
            @php
                $featTitle = is_array($featured->title) ? ($featured->title[$locale] ?? $featured->title['id'] ?? 'Untitled') : $featured->title;
                $featDesc = is_array($featured->description) ? ($featured->description[$locale] ?? $featured->description['id'] ?? '') : $featured->description;
                $featBanner = !empty($featured->banner)
                    ? (Str::startsWith($featured->banner, 'http') ? $featured->banner : asset('storage/' . $featured->banner))
                    : asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png');
            @endphp
            <div class="mb-14">
                <div class="group relative grid grid-cols-1 lg:grid-cols-12 bg-white rounded-[2.5rem] overflow-hidden border border-slate-200/90 shadow-lg hover:shadow-2xl transition-all duration-500">

                    {{-- Image Banner (7 Cols) --}}
                    <div class="lg:col-span-7 h-72 sm:h-96 lg:h-[460px] relative overflow-hidden bg-slate-900">
                        <img src="{{ $featBanner }}"
                             alt="{{ $featTitle }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent lg:hidden"></div>

                        <div class="absolute top-5 left-5">
                            <span class="px-3.5 py-1.5 rounded-xl bg-[#052c24]/90 backdrop-blur text-[10px] font-black uppercase tracking-wider text-[#BEF264] shadow-md border border-white/10 font-mono">
                                FEATURED STORY
                            </span>
                        </div>
                    </div>

                    {{-- Content Panel (5 Cols) --}}
                    <div class="lg:col-span-5 p-6 sm:p-10 lg:p-12 flex flex-col justify-between bg-white">
                        <div>
                            {{-- Meta Tags --}}
                            <div class="flex items-center gap-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-4">
                                <span class="text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full font-black">
                                    {{ str_replace('_', ' ', $featured->type) }}
                                </span>
                                <span>•</span>
                                <span>{{ optional($featured->published_at)->format('d M Y') ?? 'Terbaru' }}</span>
                                <span>•</span>
                                <span>{{ $featured->author ?? 'Tim Redaksi YOTA' }}</span>
                            </div>

                            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#052c24] leading-snug tracking-tight uppercase group-hover:text-emerald-800 transition-colors mb-4">
                                <a href="{{ route('public.publications.show', $featured->slug) }}">
                                    {{ $featTitle }}
                                </a>
                            </h2>

                            <p class="text-xs sm:text-sm text-slate-600 font-normal leading-relaxed line-clamp-4 mb-6">
                                {{ $featDesc }}
                            </p>
                        </div>

                        <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-3 text-xs text-slate-400 font-mono">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    {{ number_format($featured->views ?? 0) }}
                                </span>
                                <span>•</span>
                                <span>~3 min baca</span>
                            </div>

                            <a href="{{ route('public.publications.show', $featured->slug) }}"
                               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-[#052c24] text-[#BEF264] hover:bg-emerald-800 text-xs font-black uppercase tracking-wider transition-all shadow hover:scale-105">
                                <span>Baca Cerita</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @endif

        {{-- 4. BENTO EDITORIAL GRID (3 Columns) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @forelse($publications as $pub)
                @if($publications->onFirstPage() && $loop->first && !request('search') && request('type', 'all') == 'all')
                    @continue
                @endif

                @php
                    $pTitle = is_array($pub->title) ? ($pub->title[$locale] ?? $pub->title['id'] ?? 'Untitled') : $pub->title;
                    $pDesc = is_array($pub->description) ? ($pub->description[$locale] ?? $pub->description['id'] ?? '') : $pub->description;
                    $pBanner = !empty($pub->banner)
                        ? (Str::startsWith($pub->banner, 'http') ? $pub->banner : asset('storage/' . $pub->banner))
                        : asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png');
                @endphp

                <article class="group bg-white rounded-3xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">

                    <div>
                        {{-- Image Banner with Category Badge --}}
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-900">
                            <img src="{{ $pBanner }}"
                                 alt="{{ $pTitle }}"
                                 loading="lazy"
                                 decoding="async"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90 group-hover:opacity-100">

                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 rounded-xl bg-white/95 backdrop-blur text-[9px] font-black uppercase tracking-wider text-[#052c24] shadow-sm font-mono">
                                    {{ str_replace('_', ' ', $pub->type) }}
                                </span>
                            </div>
                        </div>

                        {{-- Article Content --}}
                        <div class="p-6">
                            {{-- Date & Author --}}
                            <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2.5">
                                <span>{{ optional($pub->published_at)->format('d M Y') ?? 'Terbaru' }}</span>
                                <span>•</span>
                                <span class="truncate max-w-[130px]">{{ $pub->author ?? 'Tim Redaksi' }}</span>
                            </div>

                            <h3 class="text-base sm:text-lg font-black text-[#052c24] leading-snug uppercase tracking-tight group-hover:text-emerald-700 transition-colors line-clamp-2 mb-3">
                                <a href="{{ route('public.publications.show', $pub->slug) }}">
                                    {{ $pTitle }}
                                </a>
                            </h3>

                            <p class="text-xs text-slate-500 font-normal leading-relaxed line-clamp-3 mb-4">
                                {{ $pDesc }}
                            </p>
                        </div>
                    </div>

                    {{-- Article Footer --}}
                    <div class="p-6 pt-0">
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-3 text-slate-400 text-xs font-mono">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    {{ number_format($pub->views ?? 0) }}
                                </span>
                            </div>

                            <a href="{{ route('public.publications.show', $pub->slug) }}"
                               class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-wider text-[#052c24] group-hover:text-emerald-600 transition-colors">
                                <span>Baca</span>
                                <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </a>
                        </div>
                    </div>

                </article>
            @empty
                <div class="col-span-full py-28 text-center bg-white rounded-3xl border border-slate-200">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <h3 class="text-base font-black text-[#052c24] uppercase tracking-tight mb-1">
                        Belum Ada Warta yang Ditemukan
                    </h3>
                    <p class="text-xs text-slate-500 max-w-sm mx-auto mb-5">
                        Tidak ada artikel untuk kategori atau kata kunci yang dipilih. Silakan reset filter pencarian.
                    </p>
                    <a href="{{ route('public.publications.index') }}"
                       class="inline-block px-5 py-2.5 rounded-xl bg-[#052c24] text-[#BEF264] text-xs font-black uppercase tracking-wider">
                        Lihat Semua Warta →
                    </a>
                </div>
            @endforelse
        </div>

        {{-- 5. PRESS & STORY SUBMISSION BANNER --}}
        <div class="mt-16 p-8 rounded-3xl bg-[#052c24] text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl relative overflow-hidden">
            <div class="relative z-10 max-w-xl">
                <span class="text-[9px] font-black uppercase tracking-widest text-[#BEF264] block mb-1">PRESS & FIELD STORIES</span>
                <h3 class="text-xl sm:text-2xl font-black uppercase tracking-tight">
                    Punya Kabar Aksi atau Rilis Pers Kolaborasi?
                </h3>
                <p class="text-xs text-slate-300 font-normal mt-1 leading-relaxed">
                    Kirimkan materi siaran pers, dokumentasi kegiatan lapangan, atau artikel opini Anda untuk dipublikasikan di kanal resmi Yayasan Yota Wujudkan Asa.
                </p>
            </div>
            <a href="mailto:hello@siyota.org?subject=[Rilis Pers/Cerita Lapangan] Pengajuan Publikasi YOTA"
               class="relative z-10 py-3 px-6 rounded-2xl bg-[#BEF264] hover:bg-white text-[#052c24] text-xs font-black uppercase tracking-wider transition-all shadow shrink-0">
                Kirim via hello@siyota.org →
            </a>
        </div>

        {{-- 6. PAGINATION CONTROLS --}}
        @if($publications->hasPages())
        <div class="mt-14 flex justify-center">
            {{ $publications->links() }}
        </div>
        @endif

    </div>
</main>
@endsection
