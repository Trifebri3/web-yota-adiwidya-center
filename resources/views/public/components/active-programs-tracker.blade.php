@php
    $lang = app()->getLocale();
    $activeProgramsList = collect();

    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('programs')) {
            $activeProgramsList = \App\Models\Program::active()->with('impactAreas')->latest('start_date')->take(3)->get();
        }
    } catch (\Throwable $e) {
        $activeProgramsList = collect();
    }

    // Default Fallback dengan aset gambar yang memukau
    if ($activeProgramsList->isEmpty()) {
        $activeProgramsList = collect([
            (object)[
                'id' => 1,
                'title' => 'CAP 2026: Collaborative Action Program',
                'slug' => 'cap-2026',
                'phase' => 'OPEN RECRUITMENT',
                'phase_color' => '#16a34a',
                'pillar_name' => 'Youth Development',
                'pillar_color' => '#0361a4',
                'url' => route('public.programs.index'),
                'image' => asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png'),
            ],
            (object)[
                'id' => 2,
                'title' => 'YOTA Bencana: Siaga & Mitigasi Cincin Api',
                'slug' => 'yota-bencana',
                'phase' => 'TAHAP PERSIAPAN',
                'phase_color' => '#d97706',
                'pillar_name' => 'Disaster Resilience',
                'pillar_color' => '#8f2c2d',
                'url' => route('public.programs.index'),
                'image' => asset('pilar/pilar1/Disaster Resilience Mosaic Poster.png'),
            ],
            (object)[
                'id' => 3,
                'title' => 'Inovasi AgroSense: Smart Agriculture Desa Binaan',
                'slug' => 'smart-agriculture-agrosense',
                'phase' => 'SEDANG BERJALAN',
                'phase_color' => '#0284c7',
                'pillar_name' => 'Innovation & Research',
                'pillar_color' => '#04717f',
                'url' => route('public.programs.index'),
                'image' => asset('pilar/pilar3/Teal Innovation Research Grid.png'),
            ],
        ]);
    }
@endphp

{{-- ========================================================================= --}}
{{-- ACTIVE PROGRAM TRACKER (SUPER SIMPEL: GAMBAR + STATUS + TOMBOL)           --}}
{{-- ========================================================================= --}}
<section class="relative bg-white border-b border-slate-200/80 py-10 md:py-12 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header Ringkas --}}
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-3">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
                <h2 class="text-xl md:text-2xl font-black text-[#052c24] tracking-tight uppercase">
                    Program & Aksi Aktif Berjalan
                </h2>
            </div>

            <a href="{{ route('public.programs.index') }}" class="text-xs font-black uppercase tracking-wider text-[#052c24] hover:text-emerald-700 transition-colors flex items-center gap-1.5 group">
                <span>Semua Program</span>
                <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>

        {{-- Grid Kartu: SUPER SIMPEL --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($activeProgramsList as $prog)
            @php
                $title = is_array($prog->title ?? null) ? ($prog->title[$lang] ?? $prog->title['id']) : ($prog->title ?? 'Program YOTA');
                $phase = $prog->phase ?? 'OPEN RECRUITMENT';
                $phaseColor = $prog->phase_color ?? '#16a34a';
                $pillarName = $prog->pillar_name ?? 'Inisiatif YOTA';
                $pillarColor = $prog->pillar_color ?? '#0361a4';
                $detailUrl = isset($prog->slug) ? route('public.programs.show', $prog->slug) : route('public.programs.index');
                $img = $prog->image ?? (isset($prog->banner_image) ? asset('storage/' . $prog->banner_image) : asset('image/default-cover.jpg'));
            @endphp

            <div class="group bg-white rounded-3xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">

                {{-- 1. GAMBAR UTAMA DENGAN STATUS & JUDUL OVERLAY --}}
                <a href="{{ $detailUrl }}" class="block relative h-60 overflow-hidden bg-slate-900 group/img">
                    <img src="{{ $img }}" alt="{{ $title }}" loading="lazy" decoding="async" width="600" height="380" class="w-full h-full object-cover group-hover/img:scale-105 transition-transform duration-700 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-black/10"></div>

                    {{-- 2. STATUS FASE BADGE --}}
                    <div class="absolute top-4 left-4 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider text-white shadow-lg backdrop-blur-md"
                              style="background-color: {{ $phaseColor }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                            <span>{{ $phase }}</span>
                        </span>
                    </div>

                    {{-- Pilar Badge --}}
                    <div class="absolute top-4 right-4">
                        <span class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase text-white shadow font-mono backdrop-blur-md"
                              style="background-color: {{ $pillarColor }}ee">
                            {{ Str::limit($pillarName, 18) }}
                        </span>
                    </div>

                    {{-- Judul di Atas Gambar --}}
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-base md:text-lg font-black text-white leading-snug uppercase tracking-tight line-clamp-2 drop-shadow group-hover/img:text-[#BEF264] transition-colors">
                            {{ $title }}
                        </h3>
                    </div>
                </a>

                {{-- 3. TOMBOL AKSI UTAMA MENUJU DETAIL (Tempat Dokumen, Panduan, & Link Daftar Berada) --}}
                <div class="p-4 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2 text-slate-400">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span class="text-[11px] font-bold text-slate-500">
                            Panduan, TOR & Pendaftaran
                        </span>
                    </div>

                    <a href="{{ $detailUrl }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#052c24] text-[#BEF264] hover:bg-emerald-800 text-xs font-black uppercase tracking-wider transition-all shadow hover:scale-105 shrink-0">
                        <span>Ikut & Lihat</span>
                        <span>→</span>
                    </a>
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>
