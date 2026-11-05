@extends('public.layouts.app')

@section('title', 'Dokumen Kebijakan & Publikasi Buku Resmi | SIYOTA.org')
@section('seo_description', 'Akses dokumen resmi, policy brief, laporan tahunan, dan buku publikasi strategis Yayasan Yota Wujudkan Asa.')
@section('og_title', 'Dokumen Kebijakan & Buku Resmi — SIYOTA.org')
@section('og_image', asset('pilar/pilar2/Purple Knowledge Mosaic Poster.png'))

@section('content')
@php 
    $locale = App::getLocale();
    // Mengambil data langsung dari Model tanpa melalui Controller
    $docs = \App\Models\DocPublication::getGallery();
@endphp

<div class="bg-[#F8FAFC] min-h-screen pt-28 md:pt-36 pb-24 px-4 font-['Plus_Jakarta_Sans']" x-data="{ activeTab: 'all' }">
    <div class="max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="text-center mb-12">
            <h2 class="text-xs font-black uppercase tracking-[0.4em] text-[#052c24] mb-3">
                {{ __('doc.hero_tag') }}
            </h2>
            <h1 class="text-4xl md:text-6xl font-black text-[#052c24] tracking-tight uppercase leading-none">
                {{ __('doc.hero_title') }} <span class="text-slate-300 not-italic font-serif lowercase">{{ __('doc.hero_subtitle') }}</span>
            </h1>
        </div>

        {{-- Tab Navigation --}}
        <div class="flex flex-wrap justify-center gap-2.5 mb-14">
            @php
                $tabs = [
                    'all' => 'all_docs',
                    'buku' => 'buku_monograf',
                    'annual_report' => 'annual_reports',
                    'policy_brief' => 'policy_briefs',
                    'official_statement' => 'official_statements'
                ];
            @endphp

            @foreach($tabs as $key => $label)
            <button @click="activeTab = '{{ $key }}'"
                :class="activeTab === '{{ $key }}' ? 'bg-[#052c24] text-[#BEF264] shadow-xl shadow-[#052c24]/20' : 'bg-white text-slate-400 border border-slate-100'"
                class="px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all hover:scale-105 active:scale-95">
                {{ __('doc.' . $label) }}
            </button>
            @endforeach
        </div>

        {{-- Document Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @forelse($docs as $doc)
            <div x-show="activeTab === 'all' || activeTab === '{{ $doc->category }}'"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform translate-y-8"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-50 shadow-sm hover:shadow-2xl hover:-translate-y-3 transition-all duration-700 flex flex-col h-full">

                {{-- Cover Image dengan Rasio A4 (1:1.41) --}}
                <div class="relative w-full aspect-[1/1.414] overflow-hidden bg-[#052c24]">
                    @if($doc->cover_image)
                        @php
                            $coverSrc = Str::startsWith($doc->cover_image, 'http') 
                                ? $doc->cover_image 
                                : (Str::startsWith($doc->cover_image, 'pilar/') || Str::startsWith($doc->cover_image, 'image/') 
                                    ? asset($doc->cover_image) 
                                    : asset('storage/'.$doc->cover_image));
                        @endphp
                        <img src="{{ $coverSrc }}" 
                             alt="{{ is_array($doc->title) ? ($doc->title[$locale] ?? $doc->title['id'] ?? 'Doc Cover') : $doc->title }}"
                             class="w-full h-full object-cover transition-transform duration-[1.5s] group-hover:scale-105 opacity-90 group-hover:opacity-100">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center bg-slate-100">
                            <svg class="w-20 h-20 text-slate-200" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                            <span class="text-[10px] font-black uppercase text-slate-300 tracking-widest mt-4">No Preview</span>
                        </div>
                    @endif

                    {{-- Category Floating Badge --}}
                    <div class="absolute top-6 left-6">
                        <span class="px-5 py-2 bg-white/90 backdrop-blur-md rounded-full text-[9px] font-black uppercase tracking-widest text-[#052c24] shadow-lg">
                            {{ is_array($doc->category_label) ? ($doc->category_label[$locale] ?? $doc->category_label['id']) : $doc->category_label }}
                        </span>
                    </div>
                </div>

                {{-- Content Body --}}
                <div class="p-8 flex-grow flex flex-col">
                    <h3 class="text-xl font-black text-[#052c24] mb-3 line-clamp-2 uppercase leading-tight">
                        {{ is_array($doc->title) ? ($doc->title[$locale] ?? $doc->title['id'] ?? 'Untitled') : $doc->title }}
                    </h3>

                    <div class="text-slate-500 text-sm italic mb-6 line-clamp-3">
                        {{ is_array($doc->description) ? ($doc->description[$locale] ?? $doc->description['id'] ?? '-') : ($doc->description ?? '-') }}
                    </div>

                    <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-[8px] font-black text-slate-300 uppercase tracking-widest mb-1">Release Date</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">
                                {{ optional($doc->published_at)->translatedFormat('d M Y') ?? '-' }}
                            </span>
                        </div>

                        {{-- Update Link: Menghapus prefix storage karena path berisi URL Google Drive --}}
                        <a href="{{ $doc->pdf_path }}" 
                           target="_blank" 
                           class="flex items-center gap-3 bg-slate-50 hover:bg-[#BEF264] text-[#052c24] px-5 py-3 rounded-xl transition-all duration-500 group/btn">
                            <span class="text-[9px] font-black uppercase tracking-widest">
                                LIHAT LAPORAN
                                    </span>
<svg class="w-4 h-4 transform group-hover/btn:translate-y-1 transition-transform" 
     fill="none" 
     stroke="currentColor" 
     viewBox="0 0 24 24">
    <path stroke-linecap="round" 
          stroke-linejoin="round" 
          stroke-width="2" 
          d="M7 3h6l5 5v13a1 1 0 01-1 1H7a1 1 0 01-1-1V4a1 1 0 011-1z"/>
</svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-40 text-center">
                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h4 class="text-sm font-black text-slate-300 uppercase tracking-[0.3em]">{{ __('doc.no_docs') }}</h4>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection