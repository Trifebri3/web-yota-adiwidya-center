@php
    $pillars = collect();

    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('impact_areas')) {
            $pillars = \App\Models\ImpactArea::where('is_active', true)->orderBy('order', 'asc')->orderBy('id', 'asc')->get();
        }
    } catch (\Throwable $e) {
        $pillars = collect();
    }

    if ($pillars->isEmpty()) {
        $pillars = \App\Models\ImpactArea::getDefaultPillars();
    }

    // Ringkasan Data Statistik & Penyelarasan SDGs Terikat per Pilar
    $pillarMetrics = [
        '01' => ['stat' => '1.450+ Pemuda', 'label' => 'Kapasitas STEAM Terlatih', 'sdg' => 'SDG 04', 'sdg_name' => 'Quality Education', 'color' => '#C5192D'],
        '02' => ['stat' => '64.5 Jt UMKM', 'label' => 'Jejaring Usaha Binaan', 'sdg' => 'SDG 08', 'sdg_name' => 'Decent Work & Economy', 'color' => '#A21942'],
        '03' => ['stat' => '1.850 Ha', 'label' => 'Restorasi Habitat & Pohon', 'sdg' => 'SDG 13 & 15', 'sdg_name' => 'Climate Action', 'color' => '#3F7E44'],
        '04' => ['stat' => '34 Riset', 'label' => 'Prototipe Tepat Guna & AI', 'sdg' => 'SDG 09', 'sdg_name' => 'Innovation & Infra', 'color' => '#FD6925'],
        '05' => ['stat' => '24 Sekolah', 'label' => 'Kesiapsiagaan Sesar', 'sdg' => 'SDG 11', 'sdg_name' => 'Sustainable Cities', 'color' => '#F99D26'],
        '06' => ['stat' => '142+ Naskah', 'label' => 'Kajian Ilmiah Terpublikasi', 'sdg' => 'SDG 17', 'sdg_name' => 'Partnerships', 'color' => '#19486A'],
    ];
@endphp

{{-- ========================================================================= --}}
{{-- 6 PILAR PROGRAM STRATEGIS (IMPACT AREAS) — COMPACT BENTO GRID             --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-24 bg-[#FDFDFB] relative overflow-hidden font-['Plus_Jakarta_Sans']" id="impact-areas">

    {{-- Subtle Background Glow --}}
    <div class="absolute top-10 right-10 w-96 h-96 bg-lime-100/50 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Heading: Ringkas, Tegas, Tanpa Spasi Berlebih --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-[#064e3b] text-[10px] font-black uppercase tracking-[0.3em] mb-2">
                    <span class="w-2 h-2 rounded-full bg-lime-500 animate-pulse"></span>
                    SIX STRATEGIC PILLARS
                </div>
                <h2 class="text-3xl md:text-5xl font-black text-[#064e3b] tracking-tight uppercase leading-none">
                    Our Impact <span class="text-slate-400 italic font-serif lowercase">pillars.</span>
                </h2>
                <p class="text-slate-500 text-xs md:text-sm font-normal mt-2 max-w-xl">
                    Arah strategis terpadu yang memayungi seluruh program, riset, inovasi, dan pergerakan relawan YOTA.
                </p>
            </div>

            <a href="{{ route('public.impact-areas.index') }}"
               class="text-xs font-black uppercase tracking-wider text-[#064e3b] hover:text-lime-600 transition-colors flex items-center gap-2 group">
                <span>Lihat Semua Pilar</span>
                <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>

        {{-- 6 PILAR BENTO GRID (6 KARTU LENGKAP TANPA KONTAINER KAKU) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-16">
            @foreach($pillars as $pilar)
            <div class="group bg-white rounded-[2rem] border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between overflow-hidden hover:-translate-y-1">

                {{-- Visual Header: Motif Poster Khas & Floating Logo --}}
                <div class="relative h-44 bg-slate-900 overflow-hidden">
                    <img src="{{ $pilar->motif_url ?? asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png') }}"
                         alt="{{ $pilar->name }}"
                         loading="lazy"
                         decoding="async"
                         width="400"
                         height="176"
                         class="w-full h-full object-cover opacity-85 group-hover:scale-105 transition-transform duration-700">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent"></div>

                    {{-- Code & Color Badge --}}
                    <div class="absolute top-4 left-4 flex items-center gap-2">
                        <span class="px-3 py-1 rounded-xl bg-white/95 backdrop-blur text-[10px] font-black uppercase font-mono shadow-sm"
                              style="color: {{ $pilar->color }}">
                            PILAR {{ $pilar->code }}
                        </span>
                        <span class="w-3.5 h-3.5 rounded-full border border-white shadow-sm" style="background-color: {{ $pilar->color }}"></span>
                    </div>

                    {{-- Logo Floating Badge --}}
                    <div class="absolute -bottom-3 right-5 w-14 h-14 rounded-2xl bg-white shadow-xl p-2 border border-slate-100 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <img src="{{ $pilar->logo_url ?? asset('image/yt.png') }}" alt="{{ $pilar->name }} Logo" loading="lazy" decoding="async" width="56" height="56" class="w-full h-full object-contain">
                    </div>
                </div>

                {{-- Content Body --}}
                <div class="p-6 pt-6 flex-1 flex flex-col justify-between">
                    <div>
                        {{-- Title & Tagline --}}
                        <h3 class="text-xl font-black text-[#052c24] tracking-tight uppercase group-hover:text-lime-600 transition-colors leading-tight mb-1">
                            {{ $pilar->name }}
                        </h3>

                        <p class="text-[11px] font-bold italic line-clamp-1 mb-3" style="color: {{ $pilar->color }}">
                            {{ $pilar->tagline ?? '' }}
                        </p>

                        <p class="text-xs text-slate-500 leading-relaxed font-normal line-clamp-3 mb-5">
                            {{ $pilar->description }}
                        </p>

                        {{-- Area Fokus Mini Chips --}}
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            @foreach(array_slice($pilar->focus_areas ?? [], 0, 3) as $fc)
                                <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-slate-50 text-slate-700 border border-slate-200">
                                    {{ $fc }}
                                </span>
                            @endforeach
                            @if(count($pilar->focus_areas ?? []) > 3)
                                <span class="px-2 py-1 rounded-lg text-[10px] font-bold bg-slate-50 text-slate-400">
                                    +{{ count($pilar->focus_areas) - 3 }}
                                </span>
                            @endif
                        </div>

                        {{-- Inisiatif Program Terkait --}}
                        <div class="p-3 rounded-xl bg-slate-50/80 border border-slate-100 mb-4">
                            <span class="text-[9px] font-black uppercase tracking-wider text-slate-400 block mb-1">Inisiatif Terkait:</span>
                            <div class="text-[11px] font-bold text-slate-700 line-clamp-1">
                                {{ implode(' • ', array_slice($pilar->example_programs ?? ['Program YOTA'], 0, 3)) }}
                            </div>
                        </div>

                        {{-- Data Statistik Ringkas & Penyelarasan SDGs (User Feedback: Langsung di Kartu Pilar) --}}
                        @php
                            $metric = $pillarMetrics[$pilar->code] ?? null;
                        @endphp
                        @if($metric)
                        <div class="px-3 py-2 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between mb-2">
                            <div class="min-w-0 pr-2">
                                <span class="text-[8px] font-black uppercase tracking-wider text-slate-400 block leading-tight truncate">{{ $metric['label'] }}</span>
                                <span class="text-xs font-black text-[#052c24] font-mono leading-tight">{{ $metric['stat'] }}</span>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-wider text-white shrink-0 font-mono shadow-xs" style="background-color: {{ $metric['color'] }}">
                                {{ $metric['sdg'] }}
                            </span>
                        </div>
                        @endif
                    </div>

                    {{-- Footer Action Link --}}
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[10px] font-mono font-bold text-slate-400">
                            {{ count($pilar->example_programs ?? []) }} Inisiatif
                        </span>

                        <a href="{{ route('public.impact-areas.show', $pilar->slug) }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-black uppercase tracking-wider text-white shadow-sm transition-all hover:scale-105"
                           style="background-color: {{ $pilar->color }}">
                            <span>Eksplorasi</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        {{-- ========================================================================= --}}
        {{-- PETA PERSEBARAN PROGRAM & KEGIATAN YANG TERIKAT KE 6 PILAR               --}}
        {{-- ========================================================================= --}}
        @include('public.components.pillar-program-map')

    </div>
</section>
