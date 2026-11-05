@extends('omc.layouts.app')

@section('title', 'Manajemen 6 Pilar Program (Impact Areas) - OMC')

@section('content')
<div class="py-12 bg-slate-50 min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Flash Notification --}}
        @if(session('success'))
            <div class="mb-8 p-5 bg-lime-50 border-l-4 border-lime-500 rounded-2xl flex items-center gap-4 shadow-sm animate-fade-in">
                <div class="w-10 h-10 bg-lime-500 rounded-full flex items-center justify-center text-[#052c24] shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-black text-[#052c24] uppercase tracking-wider">Berhasil!</h4>
                    <p class="text-xs text-slate-600 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-1 bg-[#BEF264] rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Strategic Direction</span>
                </div>
                <h1 class="text-4xl font-black text-[#052c24] tracking-tighter uppercase">6 Pilar Program (Impact Areas)</h1>
                <p class="text-slate-500 font-medium">Kelola identitas, warna khas, logo, motif mosaik, deskripsi, dan kerangka 5W1H enam pilar strategis.</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('public.impact-areas.index') }}" target="_blank" class="bg-white text-slate-700 border border-slate-200 px-6 py-4 rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-slate-100 transition-all flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Publik
                </a>
            </div>
        </div>

        {{-- Grid Card 6 Pilar --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($impactAreas as $pilar)
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col justify-between group hover:shadow-2xl transition-all">
                
                {{-- Motif Banner Top --}}
                <div class="relative h-44 bg-slate-900 overflow-hidden">
                    <img src="{{ $pilar->motif_url ?? asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png') }}"
                         alt="{{ $pilar->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-80">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                    {{-- Code & Color Badge --}}
                    <div class="absolute top-4 left-4 flex items-center gap-2">
                        <span class="px-3 py-1 rounded-xl bg-white/90 backdrop-blur text-[10px] font-black uppercase font-mono shadow-sm"
                              style="color: {{ $pilar->color }}">
                            PILAR {{ $pilar->code }}
                        </span>
                        <span class="w-4 h-4 rounded-full border-2 border-white shadow-sm" style="background-color: {{ $pilar->color }}" title="Warna Khas: {{ $pilar->color }}"></span>
                    </div>

                    {{-- Logo Floating Badge --}}
                    <div class="absolute -bottom-4 right-6 w-14 h-14 rounded-2xl bg-white shadow-xl p-2 border border-slate-100 flex items-center justify-center">
                        <img src="{{ $pilar->logo_url ?? asset('image/yt.png') }}" alt="{{ $pilar->name }}" class="w-full h-full object-contain">
                    </div>
                </div>

                {{-- Pilar Details --}}
                <div class="p-8 pt-8 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-black text-[#052c24] tracking-tight uppercase mb-1">
                            {{ $pilar->name }}
                        </h3>

                        <p class="text-xs font-bold italic mb-3" style="color: {{ $pilar->color }}">
                            {{ $pilar->tagline ?? '' }}
                        </p>

                        <p class="text-xs text-slate-500 leading-relaxed font-normal line-clamp-3 mb-6">
                            {{ $pilar->description }}
                        </p>

                        {{-- Focus Areas Tags --}}
                        <div class="space-y-1 mb-6">
                            <span class="text-[9px] font-black uppercase tracking-wider text-slate-400 block">Area Fokus:</span>
                            <div class="flex flex-wrap gap-1">
                                @foreach(array_slice($pilar->focus_areas ?? [], 0, 3) as $fc)
                                    <span class="px-2 py-0.5 rounded-md text-[9px] font-bold bg-slate-50 text-slate-600 border border-slate-200">
                                        {{ $fc }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[10px] font-mono font-bold text-slate-400 uppercase">
                            Hex: {{ $pilar->color }}
                        </span>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('public.impact-areas.show', $pilar->slug) }}" target="_blank" class="p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-600 transition-colors" title="Lihat Halaman Publik">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>

                            <a href="{{ route('omc.impact-areas.edit', $pilar->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#052c24] text-[#BEF264] rounded-xl text-xs font-black uppercase tracking-wider hover:opacity-90 transition-all shadow">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                Kelola
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection

