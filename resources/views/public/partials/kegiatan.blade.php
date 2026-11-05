@php
    $lang = app()->getLocale();

    // Ambil program aktif (Upcoming & Ongoing)
    $activeMovements = \App\Models\Program::whereIn('status', ['upcoming', 'ongoing'])
                        ->orderBy('start_date', 'asc')
                        ->take(3)
                        ->get();

    // Default pillars mapping untuk indicator badge
    $defaultPillars = \App\Models\ImpactArea::getDefaultPillars();
@endphp

<section class="bg-white py-16 md:py-20 relative overflow-hidden font-['Plus_Jakarta_Sans'] border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Header Section: Compact & Clean --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10">
            <div>
                <span class="inline-block px-3 py-1 rounded-full bg-slate-100 text-[#064e3b] text-[10px] font-black uppercase tracking-[0.3em] mb-2 border border-slate-200">
                    Pillar Movements
                </span>
                <h2 class="text-3xl md:text-5xl font-black text-[#064e3b] leading-tight tracking-tight uppercase">
                    {{ $lang == 'id' ? 'Agenda & Aksi' : 'Upcoming' }} <span class="text-lime-600 italic font-serif lowercase">{{ $lang == 'id' ? 'terdekat kami.' : 'movements.' }}</span>
                </h2>
                <p class="text-slate-500 text-xs md:text-sm font-normal mt-1 max-w-xl">
                    Implementasi nyata dari 6 Pilar Program yang sedang dan akan segera berjalan di lapangan.
                </p>
            </div>

            <a href="{{ route('public.programs.index') }}"
               class="text-xs font-black uppercase tracking-wider text-[#064e3b] hover:text-lime-600 transition-colors flex items-center gap-2 group">
                <span>Lihat Seluruh Agenda</span>
                <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>

        {{-- Grid List Movement (Compact & Berpadu dengan Pilar) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($activeMovements as $idx => $move)
            @php
                $assignedPillar = $defaultPillars->get($idx % 6);
            @endphp
            <article class="group bg-slate-50/70 hover:bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div>
                    {{-- Banner Image --}}
                    <div class="relative h-48 overflow-hidden bg-slate-200">
                        <img src="{{ $move->banner_image ? asset('storage/' . $move->banner_image) : asset('image/default-cover.jpg') }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <div class="absolute top-3 left-3 flex items-center gap-2">
                            @if($move->status == 'ongoing')
                                <span class="bg-lime-400 text-[#064e3b] px-3 py-1 rounded-xl text-[9px] font-black uppercase tracking-widest shadow flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 bg-[#064e3b] rounded-full animate-pulse"></span>
                                    {{ $lang == 'id' ? 'Sedang Jalan' : 'Live Now' }}
                                </span>
                            @else
                                <span class="bg-[#064e3b] text-white px-3 py-1 rounded-xl text-[9px] font-black uppercase tracking-widest shadow">
                                    {{ $lang == 'id' ? 'Akan Datang' : 'Upcoming' }}
                                </span>
                            @endif

                            {{-- Pillar Badge Integration --}}
                            <span class="px-2.5 py-1 rounded-xl text-[9px] font-black uppercase text-white shadow-sm"
                                  style="background-color: {{ $assignedPillar->color }}">
                                {{ $assignedPillar->name }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        {{-- Date & Location --}}
                        <div class="flex items-center gap-2 mb-3 text-slate-400 font-bold text-[10px] uppercase tracking-wider">
                            <svg class="w-3.5 h-3.5 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>{{ $move->start_date ? $move->start_date->format('d M Y') : 'Segera' }}</span>
                            @if(!empty($move->location_name))
                                <span>•</span>
                                <span class="truncate max-w-[140px]">{{ $move->location_name }}</span>
                            @endif
                        </div>

                        {{-- Title --}}
                        <h3 class="text-lg font-black text-[#064e3b] leading-tight uppercase tracking-tight mb-2 group-hover:text-lime-600 transition-colors line-clamp-2">
                            {{ $move->title[$lang] ?? $move->title['id'] }}
                        </h3>

                        {{-- Goal / Summary --}}
                        <p class="text-slate-500 text-xs font-normal leading-relaxed line-clamp-2 mb-4">
                            {{ $move->goal[$lang] ?? $move->goal['id'] ?? 'Inisiatif pergerakan kolaboratif untuk dampak nyata.' }}
                        </p>
                    </div>
                </div>

                {{-- Action Footer --}}
                <div class="p-6 pt-0 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-400">
                        {{ $move->quota_total ? $move->quota_total . ' Kuota Relawan' : 'Terbuka Umum' }}
                    </span>

                    <a href="{{ route('public.programs.show', $move->slug) }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-[#064e3b] text-[#BEF264] hover:bg-lime-500 hover:text-[#064e3b] text-xs font-black uppercase tracking-wider transition-all">
                        <span>Ikuti Aksi</span>
                        <span>→</span>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center py-10 bg-slate-50 rounded-2xl border border-slate-100">
                <p class="text-xs font-bold text-slate-500">Agenda movement baru sedang dalam tahap finalisasi kurasi tim.</p>
            </div>
            @endforelse

        </div>

    </div>
</section>
