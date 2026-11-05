@extends('public.layouts.app')

@php
    $pTitle = is_array($program->title ?? null) ? ($program->title[app()->getLocale()] ?? $program->title['id']) : ($program->title ?? 'Program YOTA');
    $pGoal = is_array($program->goal ?? null) ? ($program->goal[app()->getLocale()] ?? $program->goal['id']) : ($program->goal ?? '');
    $bannerSrc = str_starts_with($program->banner_image ?? '', 'pilar/') 
        ? asset($program->banner_image) 
        : (str_starts_with($program->banner_image ?? '', 'http') ? $program->banner_image : asset('storage/' . ($program->banner_image ?: 'image/default-cover.jpg')));
@endphp

@section('title', $pTitle . ' | Program Yayasan Yota Wujudkan Asa')
@section('seo_title', $pTitle . ' — Aksi Nyata YOTA')
@section('seo_description', Str::limit(strip_tags($pGoal), 160))
@section('og_title', $pTitle)
@section('og_image', $bannerSrc)

@section('content')
<div class="bg-[#FDFDFB] min-h-screen pb-32 font-['Plus_Jakarta_Sans']">

    {{-- 1. HERO BANNER --}}
    <section class="relative h-[60vh] md:h-[70vh] w-full overflow-hidden bg-[#052c24]">
        <img src="{{ $bannerSrc }}" alt="{{ $pTitle }}" class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0 bg-gradient-to-t from-[#FDFDFB] via-transparent to-transparent"></div>

        <div class="absolute inset-0 flex items-end">
            <div class="max-w-7xl mx-auto px-6 w-full pb-20">
                <div class="flex flex-wrap gap-3 mb-8">
                    <span class="{{ $program->status_label['color'] }} px-6 py-2 rounded-full text-[10px] font-black text-white uppercase tracking-widest shadow-xl">
                        {{ app()->getLocale() == 'id' ? $program->status_label['id_text'] : $program->status_label['text'] }}
                    </span>
                    <span class="bg-white/20 backdrop-blur-md px-6 py-2 rounded-full text-[10px] font-black text-white uppercase tracking-widest border border-white/20">
                        {{ $program->location_name }}
                    </span>
                </div>
                <h1 class="text-4xl md:text-7xl font-black text-[#052c24] leading-[0.9] tracking-tighter uppercase max-w-4xl">
                    {{ $pTitle }}
                </h1>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-16 mt-12">

        {{-- 2. LEFT SIDE: CONTENT & DETAILS (8 Columns) --}}
        <div class="lg:col-span-8 space-y-16">

            {{-- Goal & Story --}}
            <section>
                <h3 class="text-xs font-black uppercase tracking-[0.4em] text-lime-600 mb-6">The Mission</h3>
                <div class="prose prose-xl prose-slate font-medium leading-relaxed italic text-slate-600">
                    {!! nl2br(e($program->goal[app()->getLocale()] ?? $program->goal['id'])) !!}
                </div>
            </section>

            {{-- Tech Specs / Methodology --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-12 border-y border-slate-100">
                <div>
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Target Audience</h4>
                    <p class="text-sm font-bold text-[#052c24]">{{ $program->target_audience[app()->getLocale()] ?? $program->target_audience['id'] }}</p>
                </div>
                <div>
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Implementation Method</h4>
                    <p class="text-sm font-bold text-[#052c24]">{{ $program->methodology[app()->getLocale()] ?? $program->methodology['id'] }}</p>
                </div>
            </div>

            {{-- 3. DOKUMEN PANDUAN & TOR PROGRAM --}}
            <section class="bg-slate-50/80 rounded-[2.5rem] p-8 border border-slate-200/80">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-200 flex items-center justify-center shrink-0 text-rose-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <span class="inline-block px-2.5 py-0.5 rounded-full bg-rose-100 text-rose-700 text-[9px] font-black uppercase tracking-wider mb-1">
                                Dokumen Resmi & Panduan
                            </span>
                            <h4 class="text-base font-black text-[#052c24] leading-snug">
                                Term of Reference (TOR) & Guidebook Program
                            </h4>
                            <p class="text-xs text-slate-500 mt-1">
                                Unduh panduan teknis, jadwal fase pelaksanaan, kriteria seleksi, dan petunjuk kepesertaan.
                            </p>
                        </div>
                    </div>

                    @php
                        $docUrl = !empty($program->guidebook_file) ? asset('storage/' . $program->guidebook_file) : asset('documents/TOR-Program-YOTA.pdf');
                    @endphp
                    <a href="{{ $docUrl }}" download target="_blank"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-[#052c24] text-[#BEF264] hover:bg-emerald-800 text-xs font-black uppercase tracking-wider transition-all shadow shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>Unduh Dokumen PDF</span>
                    </a>
                </div>
            </section>

            {{-- 4. MONITORING FASE BERJALAN --}}
            <section class="p-8 bg-white rounded-[2.5rem] border border-slate-200/80 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                        </span>
                        <h4 class="text-sm font-black uppercase tracking-wider text-[#052c24]">
                            Timeline & Monitoring Fase Program
                        </h4>
                    </div>
                    <span class="text-[10px] font-bold text-slate-400 font-mono">Real-time Progress</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200">
                        <span class="text-[9px] font-black uppercase tracking-wider text-emerald-700 block mb-1">Fase 1</span>
                        <div class="text-xs font-black text-[#052c24]">Persiapan & Koordinasi</div>
                        <span class="inline-block mt-2 text-[9px] font-bold text-emerald-600">✓ Selesai</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#052c24] text-white shadow">
                        <span class="text-[9px] font-black uppercase tracking-wider text-[#BEF264] block mb-1">Fase 2 (Aktif)</span>
                        <div class="text-xs font-black text-white">Open Recruitment / Pendaftaran</div>
                        <span class="inline-block mt-2 text-[9px] font-bold text-lime-400 animate-pulse">● Berlangsung</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/60">
                        <span class="text-[9px] font-black uppercase tracking-wider text-slate-400 block mb-1">Fase 3</span>
                        <div class="text-xs font-black text-slate-600">Pelaksanaan & Aksi Nyata</div>
                        <span class="inline-block mt-2 text-[9px] font-bold text-slate-400">Desember 2026</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/60">
                        <span class="text-[9px] font-black uppercase tracking-wider text-slate-400 block mb-1">Fase 4</span>
                        <div class="text-xs font-black text-slate-600">Monitoring & Diseminasi</div>
                        <span class="inline-block mt-2 text-[9px] font-bold text-slate-400">Februari 2027</span>
                    </div>
                </div>
            </section>

            {{-- Map Location --}}
            <section>
                <h3 class="text-xs font-black uppercase tracking-[0.4em] text-lime-600 mb-6">Location Center</h3>
                <div class="rounded-[3rem] overflow-hidden bg-slate-100 h-80 border border-slate-100 shadow-inner group">
                    {{-- Embed Google Maps / Static Map Image --}}
                    <div class="w-full h-full flex items-center justify-center relative">
                         <div class="absolute z-10 bg-white px-8 py-4 rounded-2xl shadow-2xl text-[10px] font-black uppercase tracking-widest">
                             <a href="{{ $program->location_link }}" target="_blank">Open in Google Maps —→</a>
                         </div>
                         <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $program->coordinates }}&zoom=13&size=800x400&key=YOUR_KEY" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                    </div>
                </div>
            </section>
        </div>

        {{-- 3. RIGHT SIDE: STICKY ACTION CARD (4 Columns) --}}
        <div class="lg:col-span-4">
            <div class="sticky top-32 space-y-6">

                <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-2xl shadow-slate-200/50">
                    @if($program->has_donation)
                        {{-- Donation Style --}}
                        <div class="mb-8">
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Fundraising Progress</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl font-black text-[#052c24]">Rp {{ number_format($program->current_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="mt-4 h-2 w-full bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                                <div class="h-full bg-lime-500 rounded-full" style="width: {{ $program->donation_percentage }}%"></div>
                            </div>
                            <div class="flex justify-between mt-3 text-[10px] font-black uppercase italic text-slate-400">
                                <span>{{ $program->donation_percentage }}% Reached</span>
                                <span>Goal: Rp {{ number_format($program->target_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @else
                        {{-- Quota Style --}}
                        <div class="mb-8 p-6 bg-slate-50 rounded-[2rem] border border-slate-100">
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Available Quota</span>
                            <div class="text-4xl font-black text-[#052c24]">{{ $program->remaining_quota }} <span class="text-xs text-slate-300">Slots left</span></div>
                        </div>
                    @endif

                    <div class="space-y-4">
                        @if($program->status !== 'history')
                            @php
                                $regLink = !empty($program->registration_link) ? $program->registration_link : 'https://hub.siyota.org';
                            @endphp
                            <a href="{{ $regLink }}" target="_blank" class="w-full bg-[#052c24] text-[#BEF264] py-5 rounded-[2rem] font-black text-xs uppercase tracking-[0.25em] hover:bg-lime-500 hover:text-[#052c24] transition-all flex items-center justify-center gap-2 shadow-xl shadow-[#052c24]/20 group">
                                <span>{{ $program->has_donation ? 'Donasi Sekarang' : 'Daftar & Ikut Program' }}</span>
                                <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </a>
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 bg-lime-500 rounded-full animate-pulse"></span>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Time Remaining: {{ $program->time_remaining }}</span>
                            </div>
                        @else
                            <button disabled class="w-full bg-slate-100 text-slate-400 py-6 rounded-[2rem] font-black text-xs uppercase tracking-[0.3em] cursor-not-allowed">
                                Program Finished
                            </button>
                        @endif
                    </div>
                </div>

                {{-- Share Card --}}
                <div class="bg-slate-50 rounded-[2rem] p-6 flex items-center justify-between border border-slate-100">
                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Share Initiative</span>
                    <div class="flex gap-4">
                        {{-- Icons for social --}}
                        <div class="w-8 h-8 rounded-full bg-white border border-slate-100 flex items-center justify-center text-slate-400 hover:text-[#052c24] cursor-pointer transition-all">f</div>
                        <div class="w-8 h-8 rounded-full bg-white border border-slate-100 flex items-center justify-center text-slate-400 hover:text-[#052c24] cursor-pointer transition-all">t</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
