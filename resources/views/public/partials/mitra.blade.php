@php
    /**
     * AMBIL DATA PARTNER AKTIF
     * Mengambil logo mitra yang is_active = true, diurutkan berdasarkan 'order'
     */
    $dbPartners = \App\Models\Partner::where('is_active', true)
                  ->orderBy('order', 'asc')
                  ->get();

    $lang = app()->getLocale();
@endphp

<section class="bg-[#FDFDFB] py-20 border-y border-slate-100 overflow-hidden font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-12 text-center">
        <h2 class="text-[10px] font-black tracking-[0.5em] text-slate-400 uppercase">
            {{ $lang == 'id' ? 'Dipercaya oleh Institusi Global & Lokal' : 'Trusted by Global & Local Institutions' }}
        </h2>
    </div>

    <div class="relative flex overflow-x-hidden group">
        {{-- Marquee Track 1 --}}
        <div class="flex animate-marquee whitespace-nowrap items-center gap-16 py-4">
            {{-- Kita looping 2x agar sambungan marquee tidak putus --}}
            @foreach($dbPartners->concat($dbPartners) as $partner)
                <div class="flex items-center justify-center w-40 h-20 grayscale opacity-40 hover:grayscale-0 hover:opacity-100 transition-all duration-500 group/logo">
                    @if($partner->logo)
                        <img src="{{ asset('storage/' . $partner->logo) }}"
                             alt="{{ $partner->name }}"
                             title="{{ $partner->name }}"
                             class="max-h-12 max-w-[140px] object-contain filter">
                    @else
                        <span class="text-xl font-black text-[#064e3b] tracking-tighter uppercase">{{ $partner->name }}</span>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Marquee Track 2 (Overlay untuk seamless loop) --}}
        <div class="absolute top-0 flex animate-marquee2 whitespace-nowrap items-center gap-16 py-4">
            @foreach($dbPartners->concat($dbPartners) as $partner)
                <div class="flex items-center justify-center w-40 h-20 grayscale opacity-40 hover:grayscale-0 hover:opacity-100 transition-all duration-500 group/logo">
                    @if($partner->logo)
                        <img src="{{ asset('storage/' . $partner->logo) }}"
                             alt="{{ $partner->name }}"
                             title="{{ $partner->name }}"
                             class="max-h-12 max-w-[140px] object-contain filter">
                    @else
                        <span class="text-xl font-black text-[#064e3b] tracking-tighter uppercase">{{ $partner->name }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 mt-12">
        <div class="flex items-center justify-center gap-4 py-6 border-t border-slate-50">
            {{-- Gunakan Haran Mini Logo --}}
            <img src="{{ asset('image/yota3.png') }}" alt="Haran" class="w-6 h-6 opacity-30 grayscale">
            <p class="text-slate-400 text-[9px] font-black uppercase tracking-[0.3em]">
                {{ $lang == 'id' ? 'Bersama membangun ekosistem yang tangguh' : 'Building a resilient ecosystem together' }}
            </p>
        </div>
    </div>
</section>

<style>
    @keyframes marquee {
        0% { transform: translateX(0%); }
        100% { transform: translateX(-100%); }
    }
    @keyframes marquee2 {
        0% { transform: translateX(100%); }
        100% { transform: translateX(0%); }
    }
    .animate-marquee {
        animation: marquee 40s linear infinite; /* Sedikit diperlambat agar lebih elegan */
    }
    .animate-marquee2 {
        animation: marquee2 40s linear infinite;
    }
    /* Berhenti saat kursor di atasnya */
    .group:hover .animate-marquee,
    .group:hover .animate-marquee2 {
        animation-play-state: paused;
    }
</style>
