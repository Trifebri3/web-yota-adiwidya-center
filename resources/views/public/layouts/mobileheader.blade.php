<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-xl border-b border-slate-200/90 xl:hidden font-['Plus_Jakarta_Sans']" role="banner">
    <div class="px-5 h-20 flex justify-between items-center">
        <a href="/" class="focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 rounded-lg" aria-label="Beranda Yayasan Yota Wujudkan Asa">
            <img src="{{ asset('image/logo.png') }}" alt="Logo Yayasan Yota Wujudkan Asa" class="h-9 w-auto" width="130" height="36" />
        </a>

        <div class="flex items-center gap-3">
            <a href="{{ route('public.campaign.index') }}"
               class="bg-[#064e3b] text-[#BEF264] px-4 py-2 rounded-full font-black text-[10px] uppercase tracking-wider shadow-sm">
                Ikut Aksi
            </a>
            <button type="button"
                    @click="mobileMenuOpen = true"
                    class="p-2.5 min-w-[44px] min-h-[44px] flex items-center justify-center text-[#064e3b] bg-slate-100/80 rounded-xl transition-all active:scale-95 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    aria-label="Buka Menu Navigasi"
                    :aria-expanded="mobileMenuOpen">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
</header>

{{-- MOBILE FULLSCREEN DRAWER --}}
<div x-show="mobileMenuOpen"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-x-full"
     x-transition:enter-end="opacity-100 translate-x-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-x-0"
     x-transition:leave-end="opacity-0 translate-x-full"
     class="fixed inset-0 z-[9999] bg-white overflow-y-auto font-['Plus_Jakarta_Sans']"
     role="dialog"
     aria-modal="true"
     aria-label="Menu Navigasi Mobile"
     style="display: none;">

    {{-- Top Bar in Drawer --}}
    <div class="px-6 py-5 flex justify-between items-center border-b border-slate-100 sticky top-0 bg-white/95 backdrop-blur z-10">
        <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-8 w-auto" />
        <button type="button"
                @click="mobileMenuOpen = false"
                class="p-2.5 min-w-[44px] min-h-[44px] flex items-center justify-center text-slate-500 bg-slate-100 rounded-full hover:text-red-500 hover:bg-red-50 transition-colors focus:outline-none"
                aria-label="Tutup Menu Navigasi">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    {{-- Drawer Navigation Body --}}
    <div class="px-6 py-8 space-y-6 pb-36 text-slate-800">
        <nav class="space-y-4" role="navigation">

            {{-- 1. Beranda --}}
            <a href="/" class="block text-2xl font-black text-[#064e3b] tracking-tight py-2 border-b border-slate-100">
                Beranda
            </a>

            {{-- 2. 6 Pilar Program (Direct Highlight) --}}
            <a href="{{ route('public.impact-areas.index') }}" class="flex items-center justify-between text-xl font-black text-[#064e3b] tracking-tight py-2 border-b border-slate-100">
                <span class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    <span>6 Pilar Program</span>
                </span>
                <span class="text-xs bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded-full">Strategis</span>
            </a>

            {{-- 3. Program & Aksi Nyata Accordion --}}
            <div x-data="{ open: false }" class="border-b border-slate-100 pb-3">
                <button type="button" @click="open = !open" class="flex justify-between items-center w-full py-2.5 text-xl font-black text-slate-800 min-h-[44px]">
                    <span>Program & Aksi</span>
                    <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" x-collapse class="pl-3 space-y-3 pt-2 text-sm text-slate-600 font-bold">
                    <a href="{{ route('public.programs.index') }}" class="block py-1.5 hover:text-emerald-700">Katalog Program Organisasi</a>
                    <a href="{{ route('public.impact-areas.index') }}#sebaran-pilar" class="block py-1.5 hover:text-emerald-700">Peta Sebaran Geospasial</a>
                    <a href="{{ route('public.impact.index') }}" class="block py-1.5 hover:text-emerald-700">Laporan Capaian Dampak</a>
                    <a href="https://hub.siyota.org" target="_blank" class="block py-1.5 text-emerald-700">YOTA Hub (Portal Relawan) ↗</a>
                    <a href="{{ route('public.team') }}" class="block py-1.5 hover:text-emerald-700">Struktur Tim & Dewan</a>
                </div>
            </div>

            {{-- 4. Publikasi & Riset Accordion --}}
            <div x-data="{ open: false }" class="border-b border-slate-100 pb-3">
                <button type="button" @click="open = !open" class="flex justify-between items-center w-full py-2.5 text-xl font-black text-slate-800 min-h-[44px]">
                    <span>Publikasi & Riset</span>
                    <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" x-collapse class="pl-3 space-y-3 pt-2 text-sm text-slate-600 font-bold">
                    <a href="{{ route('public.docs.index') }}" class="block py-1.5 text-emerald-800 font-black">Buku & Monograf Ilmiah</a>
                    <a href="{{ route('public.kajianilmiah.index') }}" class="block py-1.5 hover:text-emerald-700">Kajian & Riset Terapan</a>
                    <a href="{{ route('public.publications.index') }}" class="block py-1.5 hover:text-emerald-700">Berita & Rilis Kegiatan</a>
                    <a href="{{ route('public.products.index') }}" class="block py-1.5 hover:text-emerald-700">Inovasi Produk Sosial</a>
                    <a href="{{ route('public.gallery.index') }}" class="block py-1.5 hover:text-emerald-700">Galeri Dokumentasi Aksi</a>
                </div>
            </div>

            {{-- 5. Tentang Kami Accordion --}}
            <div x-data="{ open: false }" class="border-b border-slate-100 pb-3">
                <button type="button" @click="open = !open" class="flex justify-between items-center w-full py-2.5 text-xl font-black text-slate-800 min-h-[44px]">
                    <span>Tentang Kami</span>
                    <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" x-collapse class="pl-3 space-y-3 pt-2 text-sm text-slate-600 font-bold">
                    <a href="{{ route('public.tentangkami.profil') }}" class="block py-1.5 hover:text-emerald-700">Profil Organisasi</a>
                    <a href="{{ route('public.tentangkami.visi') }}" class="block py-1.5 hover:text-emerald-700">Visi & Misi</a>
                    <a href="{{ route('public.tentangkami.legalitas') }}" class="block py-1.5 hover:text-emerald-700">Legalitas & Akreditasi</a>
                    <a href="{{ route('public.tentangkami.sejarah') }}" class="block py-1.5 hover:text-emerald-700">Sejarah & Jejak Langkah</a>
                </div>
            </div>

            {{-- 6. Kontak & Kemitraan --}}
            <a href="{{ route('public.tentangkami.kontak') }}" class="block text-xl font-black text-slate-800 py-2 border-b border-slate-100">
                Kontak Kami
            </a>
            <a href="{{ route('public.partners.index') }}" class="block text-xl font-black text-slate-800 py-2 border-b border-slate-100">
                Mitra Kolaborasi
            </a>

        </nav>

        {{-- Language Switcher & Call to Action on Mobile --}}
        <div class="pt-6 space-y-4">
            <div class="flex items-center gap-3 text-xs font-black">
                <span class="text-slate-400 uppercase tracking-wider">Bahasa / Language:</span>
                <a href="{{ route('lang.switch', 'id') }}" class="px-3 py-1.5 rounded-lg {{ app()->getLocale() == 'id' ? 'bg-[#064e3b] text-white' : 'bg-slate-100 text-slate-600' }}">ID</a>
                <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1.5 rounded-lg {{ app()->getLocale() == 'en' ? 'bg-[#064e3b] text-white' : 'bg-slate-100 text-slate-600' }}">EN</a>
            </div>

            <a href="{{ route('public.campaign.index') }}"
               class="block w-full text-center py-4 rounded-2xl bg-[#064e3b] text-[#BEF264] font-black text-sm uppercase tracking-wider shadow-lg">
                Ikut Aksi & Dukung Program →
            </a>
        </div>
    </div>
</div>
