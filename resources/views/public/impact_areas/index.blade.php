@extends('public.layouts.app')

@section('title', '6 Pilar Program & Strategic Impact Areas | Yota Adiwidya Center')
@section('seo_title', '6 Pilar Dampak Strategis Yayasan Yota Wujudkan Asa')
@section('seo_description', 'Enam area aksi strategis yang menghubungkan kepemudaan, komunitas, inovasi teknologi, kelestarian alam, mitigasi bencana, dan ilmu pengetahuan.')

@section('content')
<div class="bg-[#FDFDFB] min-h-screen py-16 md:py-24 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        {{-- Header Page --}}
        <div class="text-center max-w-3xl mx-auto mb-20">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-slate-100 text-[#052c24] text-[10px] font-black uppercase tracking-[0.3em] mb-4 border border-slate-200">
                <span class="w-2 h-2 rounded-full bg-lime-500 animate-pulse"></span>
                SIX IMPACT AREAS
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-[#052c24] tracking-tight uppercase leading-[0.95] mb-6">
                Enam Pilar <span class="italic font-serif lowercase text-lime-600">aksi strategis.</span>
            </h1>
            <p class="text-slate-500 text-sm md:text-base leading-relaxed font-light">
                Setiap program, proyek, dan aksi nyata Yayasan Yota Wujudkan Asa berlandaskan pada 6 pilar strategis ini untuk mewujudkan dampak terukur dan ketahanan peradaban berkelanjutan.
            </p>
        </div>

        {{-- Grid 6 Pilar Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
            @foreach($impactAreas as $pilar)
            <div class="group bg-white rounded-[2.5rem] border border-slate-200/80 shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col justify-between hover:-translate-y-1">
                
                {{-- Card Top Banner with Motif --}}
                <div class="relative h-56 overflow-hidden bg-slate-900">
                    <img src="{{ $pilar->motif_url ?? asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png') }}"
                         alt="{{ $pilar->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-80">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                    {{-- Code Badge --}}
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-xl text-[10px] font-black uppercase font-mono shadow-sm"
                         style="color: {{ $pilar->color }}">
                        PILAR {{ $pilar->code }}
                    </div>

                    {{-- Logo Circle --}}
                    <div class="absolute -bottom-6 right-6 w-16 h-16 rounded-2xl bg-white shadow-xl p-2.5 border border-slate-100 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <img src="{{ $pilar->logo_url ?? asset('image/yt.png') }}" alt="{{ $pilar->name }}" class="w-full h-full object-contain">
                    </div>
                </div>

                {{-- Content Body --}}
                <div class="p-8 pt-10 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-black text-[#052c24] tracking-tight uppercase mb-2 group-hover:text-lime-600 transition-colors">
                            {{ $pilar->name }}
                        </h3>

                        <p class="text-xs font-bold italic mb-4" style="color: {{ $pilar->color }}">
                            {{ $pilar->tagline ?? '' }}
                        </p>

                        <p class="text-slate-500 text-xs md:text-sm leading-relaxed font-light line-clamp-3 mb-6">
                            {{ $pilar->description }}
                        </p>

                        {{-- Focus Areas Tags --}}
                        <div class="flex flex-wrap gap-1.5 mb-6">
                            @foreach(array_slice($pilar->focus_areas ?? [], 0, 3) as $f)
                                <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-slate-50 text-slate-600 border border-slate-200">
                                    {{ $f }}
                                </span>
                            @endforeach
                            @if(count($pilar->focus_areas ?? []) > 3)
                                <span class="px-2 py-1 rounded-lg text-[10px] font-bold bg-slate-50 text-slate-400">
                                    +{{ count($pilar->focus_areas) - 3 }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Card Footer --}}
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">
                            {{ count($pilar->example_programs ?? []) }} Inisiatif Program
                        </span>

                        <a href="{{ route('public.impact-areas.show', $pilar->slug) }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-wider text-white shadow transition-all hover:scale-105"
                           style="background-color: {{ $pilar->color }}">
                            <span>Detail</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        {{-- Interactive Geospatial Pillar Map --}}
        @include('public.components.pillar-program-map')

    </div>
</div>
@endsection

