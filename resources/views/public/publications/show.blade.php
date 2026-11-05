@extends('public.layouts.app')

@php
    $locale = app()->getLocale();
    $articleTitle = is_array($publication->title) ? ($publication->title[$locale] ?? $publication->title['id'] ?? 'Untitled') : $publication->title;
    $articleDesc = is_array($publication->description) ? ($publication->description[$locale] ?? $publication->description['id'] ?? '') : $publication->description;
    $articleContent = is_array($publication->content) ? ($publication->content[$locale] ?? $publication->content['id'] ?? '') : $publication->content;
    $bannerUrl = !empty($publication->banner)
        ? (Str::startsWith($publication->banner, 'http') ? $publication->banner : asset('storage/' . $publication->banner))
        : asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png');
@endphp

@section('title', $articleTitle . ' — Warta YOTA | SIYOTA.org')
@section('seo_title', $articleTitle)
@section('seo_description', Str::limit(strip_tags($articleDesc), 160))
@section('og_title', $articleTitle)
@section('og_image', $bannerUrl)
@section('og_type', 'article')

@section('content')
<article x-data="{ copied: false, shareLink() { navigator.clipboard.writeText(window.location.href); this.copied = true; setTimeout(() => this.copied = false, 2500); } }"
         class="bg-[#FDFDFB] min-h-screen pt-24 sm:pt-32 pb-24 font-['Plus_Jakarta_Sans']">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- 1. BREADCRUMB & METADATA BAR --}}
        <div class="mb-6">
            <nav class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-wider mb-4" aria-label="Breadcrumb">
                <a href="/" class="hover:text-[#052c24] transition-colors">Beranda</a>
                <span>/</span>
                <a href="{{ route('public.publications.index') }}" class="hover:text-[#052c24] transition-colors">Warta & Publikasi</a>
                <span>/</span>
                <span class="text-emerald-700 font-black">{{ str_replace('_', ' ', $publication->type) }}</span>
            </nav>

            {{-- Category Pill & Date --}}
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="px-3.5 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-[10px] font-black uppercase tracking-wider font-mono">
                    {{ str_replace('_', ' ', $publication->type) }}
                </span>
                <span class="text-slate-300">•</span>
                <span class="text-xs text-slate-500 font-bold">
                    {{ optional($publication->published_at)->translatedFormat('l, d F Y') ?? date('d M Y') }}
                </span>
                <span class="text-slate-300">•</span>
                <span class="text-xs text-slate-400 font-mono flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    ~4 min baca
                </span>
            </div>

            {{-- Main Headline --}}
            <h1 class="text-2xl sm:text-4xl md:text-5xl font-black text-[#052c24] leading-tight tracking-tight uppercase mb-6">
                {{ $articleTitle }}
            </h1>

            {{-- Author & Share Actions Row --}}
            <div class="py-4 border-y border-slate-200/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-[#052c24] text-[#BEF264] flex items-center justify-center font-black text-sm uppercase shadow-sm shrink-0">
                        {{ substr($publication->author ?? 'YOTA', 0, 2) }}
                    </div>
                    <div>
                        <div class="text-xs font-black text-[#052c24] uppercase tracking-tight">
                            {{ $publication->author ?? 'Tim Redaksi YOTA' }}
                        </div>
                        <div class="text-[10px] text-slate-400 font-medium uppercase tracking-wider">
                            Rilis Resmi Yayasan Yota Wujudkan Asa
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    {{-- Views Counter --}}
                    <div class="px-3 py-1.5 rounded-xl bg-slate-100 text-slate-600 text-xs font-mono font-bold flex items-center gap-1.5" title="Jumlah Pembaca">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <span>{{ number_format($publication->views ?? 0) }}</span>
                    </div>

                    {{-- Copy Link Button --}}
                    <button type="button" @click="shareLink()"
                            class="px-3.5 py-1.5 rounded-xl border border-slate-200 hover:border-slate-400 text-slate-700 text-xs font-bold transition-all flex items-center gap-1.5 bg-white shadow-xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span x-text="copied ? 'Tersalin!' : 'Bagikan'"></span>
                    </button>
                </div>
            </div>
        </div>

        {{-- 2. FEATURED HERO IMAGE --}}
        <div class="mb-10 rounded-[2rem] sm:rounded-[2.5rem] overflow-hidden bg-slate-900 border border-slate-200/90 shadow-lg">
            <img src="{{ $bannerUrl }}"
                 alt="{{ $articleTitle }}"
                 class="w-full aspect-[16/9] object-cover object-center">
        </div>

        {{-- 3. ARTICLE DECK / LEAD SUMMARY --}}
        @if(!empty($articleDesc))
        <div class="mb-10 p-5 sm:p-6 rounded-2xl bg-emerald-50/60 border-l-4 border-emerald-600">
            <p class="text-sm sm:text-base text-slate-700 leading-relaxed font-medium">
                {{ $articleDesc }}
            </p>
        </div>
        @endif

        {{-- 4. CLEAN ARTICLE BODY (ELEGANT PROSE) --}}
        <div id="article-body-wrapper" class="prose prose-slate max-w-none text-slate-700 text-sm sm:text-base leading-relaxed">
            {!! $articleContent !!}
        </div>

        {{-- 5. DOKUMEN LAMPIRAN PDF (JIKA ADA) --}}
        @if($publication->pdf_file)
        <div class="mt-12 p-6 rounded-3xl bg-[#052c24] text-white flex flex-col sm:flex-row items-center justify-between gap-4 shadow-xl">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/10 text-[#BEF264] flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-black uppercase tracking-tight">Dokumen Salinan Resmi</h4>
                    <p class="text-xs text-slate-300 font-normal">Unduh naskah publikasi ini dalam format PDF.</p>
                </div>
            </div>
            <a href="{{ asset('storage/' . $publication->pdf_file) }}" target="_blank"
               class="px-5 py-2.5 rounded-xl bg-[#BEF264] hover:bg-white text-[#052c24] text-xs font-black uppercase tracking-wider transition-all shadow shrink-0">
                Unduh PDF ↓
            </a>
        </div>
        @endif

        {{-- 6. FOOTER ACTIONS: KEMBALI & AJUKAN LIPUTAN --}}
        <div class="mt-12 pt-8 border-t border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-4">
            <a href="{{ route('public.publications.index') }}"
               class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-[#052c24] hover:text-emerald-700 transition-colors">
                <span>← Kembali ke Warta Gerakan</span>
            </a>

            <a href="mailto:hello@siyota.org?subject=[Tanggapan Warta] {{ urlencode($articleTitle) }}"
               class="text-xs text-slate-500 hover:text-[#052c24] font-medium transition-colors">
                Kirim tanggapan via <span class="font-bold underline text-emerald-700">hello@siyota.org</span>
            </a>
        </div>

        {{-- 7. COMMUNITY DISCOURSE / REFLEKSI (CLEAN & COMPACT) --}}
        <section class="mt-14 pt-10 border-t border-slate-200/80">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">RUANG DISKUSI</span>
                    <h3 class="text-lg font-black text-[#052c24] uppercase tracking-tight">
                        Refleksi Pembaca ({{ count($publication->comments ?? []) }})
                    </h3>
                </div>
            </div>

            {{-- Form Komentar --}}
            <form action="{{ route('comments.store', $publication->id) }}" method="POST"
                  class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs mb-8">
                @csrf
                <textarea name="content" required rows="3"
                          placeholder="Bagikan refleksi atau pandangan Anda terkait inisiatif ini..."
                          class="w-full border-none focus:ring-0 text-xs sm:text-sm font-normal text-slate-700 placeholder:text-slate-400 resize-none p-0 focus:outline-none"></textarea>
                <div class="pt-3 border-t border-slate-100 flex justify-end">
                    <button type="submit"
                            class="px-4 py-2 rounded-xl bg-[#052c24] text-[#BEF264] hover:bg-emerald-800 text-xs font-black uppercase tracking-wider transition-all shadow-sm">
                        Kirim Komentar
                    </button>
                </div>
            </form>

            {{-- Komentar List --}}
            <div class="space-y-4">
                @forelse($publication->comments ?? [] as $comment)
                <div class="p-4 rounded-2xl bg-white border border-slate-100 shadow-2xs">
                    <div class="flex items-center gap-2 mb-1.5 text-xs">
                        <span class="font-black text-[#052c24] uppercase">{{ $comment->name ?? 'Pembaca' }}</span>
                        <span class="text-slate-300">•</span>
                        <span class="text-[10px] text-slate-400 font-mono">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        {{ $comment->body ?? $comment->content }}
                    </p>
                </div>
                @empty
                <p class="text-xs text-slate-400 italic text-center py-4">
                    Belum ada diskusi. Jadilah yang pertama memberikan refleksi.
                </p>
                @endforelse
            </div>
        </section>

    </div>
</article>

@push('styles')
<style>
    /* Styling Typography Konten Artikel yang Elegan & Rapi */
    #article-body-wrapper {
        color: #334155;
        line-height: 1.85;
    }
    #article-body-wrapper p {
        margin-bottom: 1.25rem;
    }
    #article-body-wrapper h2 {
        font-size: 1.5rem;
        font-weight: 900;
        color: #052c24;
        text-transform: uppercase;
        letter-spacing: -0.02em;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    #article-body-wrapper h3 {
        font-size: 1.25rem;
        font-weight: 800;
        color: #064e3b;
        margin-top: 1.75rem;
        margin-bottom: 0.75rem;
    }
    #article-body-wrapper h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
    }
    #article-body-wrapper ul {
        list-style-type: disc;
        margin-left: 1.5rem;
        margin-bottom: 1.25rem;
    }
    #article-body-wrapper ol {
        list-style-type: decimal;
        margin-left: 1.5rem;
        margin-bottom: 1.25rem;
    }
    #article-body-wrapper li {
        margin-bottom: 0.5rem;
    }
    #article-body-wrapper blockquote {
        border-left: 4px solid #10b981;
        padding-left: 1.25rem;
        font-style: italic;
        color: #475569;
        margin: 1.5rem 0;
        background: #f8fafc;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        border-radius: 0 1rem 1rem 0;
    }
    #article-body-wrapper strong {
        font-weight: 800;
        color: #0f172a;
    }
    #article-body-wrapper img {
        border-radius: 1.25rem;
        margin: 1.5rem auto;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        max-width: 100%;
        height: auto;
    }
    #article-body-wrapper table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5rem 0;
        font-size: 0.875rem;
    }
    #article-body-wrapper table th,
    #article-body-wrapper table td {
        padding: 0.75rem;
        border: 1px solid #e2e8f0;
    }
    #article-body-wrapper table th {
        background-color: #f8fafc;
        font-weight: 800;
        text-align: left;
    }
</style>
@endpush
@endsection
