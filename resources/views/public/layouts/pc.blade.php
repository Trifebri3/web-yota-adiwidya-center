<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-xl border-b border-slate-200/80 shadow-sm transition-all font-['Plus_Jakarta_Sans']" role="banner">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            {{-- 1. LOGO & BRANDING --}}
            <div class="flex-shrink-0">
                <a href="/" class="transition-transform duration-300 hover:scale-105 block focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 rounded-lg" aria-label="Beranda Yayasan Yota Wujudkan Asa">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo Yayasan Yota Wujudkan Asa" class="h-11 w-auto" width="160" height="44" />
                </a>
            </div>

            {{-- 2. DESKTOP NAVIGATION MENU --}}
            <nav class="flex items-center space-x-1 lg:space-x-2 text-[11px] font-black uppercase tracking-[0.12em] text-slate-600" role="navigation" aria-label="Navigasi Utama">

                {{-- Beranda --}}
                <a href="/" class="px-3.5 py-2 rounded-xl transition-colors hover:text-[#064e3b] hover:bg-slate-50 {{ request()->is('/') ? 'text-[#064e3b] font-black bg-emerald-50/60' : '' }}">
                    {{ __('header.home') ?? 'Beranda' }}
                </a>

                {{-- 6 PILAR PROGRAM (IMPACT AREAS) - DIRECT LINK FOR UCD CLARITY --}}
                <a href="{{ route('public.impact-areas.index') }}"
                   class="px-3.5 py-2 rounded-xl transition-colors hover:text-[#064e3b] hover:bg-slate-50 flex items-center gap-1.5 {{ request()->is('impact-areas*') ? 'text-[#064e3b] font-black bg-emerald-50/60' : '' }}">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>6 Pilar Program</span>
                </a>

                {{-- DROPDOWN: PROGRAM & AKSI --}}
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" @keydown.escape="open = false">
                    <button type="button"
                            class="flex items-center px-3.5 py-2 rounded-xl group-hover:text-[#064e3b] group-hover:bg-slate-50 transition-colors focus:outline-none"
                            :aria-expanded="open"
                            aria-haspopup="true">
                        <span>{{ __('header.program_team') ?? 'Program & Aksi' }}</span>
                        <svg class="ml-1 w-3 h-3 transition-transform duration-300 group-hover:rotate-180 text-slate-400 group-hover:text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition.opacity.duration.200ms class="absolute left-0 w-80 pt-2 z-50" style="display: none;">
                        <div class="bg-white shadow-2xl rounded-2xl p-4 border border-slate-200/90 overflow-hidden">
                            <p class="px-3 py-1 text-[9px] font-black text-emerald-700 tracking-[0.2em] uppercase">AKSI LAPANGAN & REAL IMPACT</p>
                            <a href="{{ route('public.programs.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                <span>{{ __('header.program_sub.list') ?? 'Katalog Program Organisasi' }}</span>
                                <span class="text-slate-400 text-[10px]">→</span>
                            </a>
                            <a href="{{ route('public.impact-areas.index') }}#sebaran-pilar" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                <span>Peta Sebaran Geospasial</span>
                                <span class="text-slate-400 text-xs">→</span>
                            </a>
                            <a href="{{ route('public.impact.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                <span>{{ __('header.program_sub.impact') ?? 'Laporan Capaian Dampak' }}</span>
                                <span class="text-slate-400 text-xs">→</span>
                            </a>

                            <div class="my-2 border-t border-slate-100"></div>

                            <p class="px-3 py-1 text-[9px] font-black text-slate-400 tracking-[0.2em] uppercase">PARTISIPASI & EKOSISTEM</p>
                            <a href="https://hub.siyota.org" target="_blank" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                <span>{{ __('header.program_sub.volunteer') ?? 'YOTA Hub (Portal Relawan)' }}</span>
                                <span class="text-xs">↗</span>
                            </a>
                            <a href="{{ route('public.team') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                <span>{{ __('header.program_sub.team') ?? 'Struktur Tim & Dewan' }}</span>
                                <span class="text-slate-400 text-[10px]">→</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- DROPDOWN: PUBLIKASI & RISET --}}
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" @keydown.escape="open = false">
                    <button type="button"
                            class="flex items-center px-3.5 py-2 rounded-xl group-hover:text-[#064e3b] group-hover:bg-slate-50 transition-colors focus:outline-none"
                            :aria-expanded="open"
                            aria-haspopup="true">
                        <span>{{ __('header.publication') ?? 'Publikasi' }}</span>
                        <svg class="ml-1 w-3 h-3 transition-transform duration-300 group-hover:rotate-180 text-slate-400 group-hover:text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition.opacity.duration.200ms class="absolute left-0 w-80 pt-2 z-50" style="display: none;">
                        <div class="bg-white shadow-2xl rounded-2xl p-4 border border-slate-200/90 overflow-hidden">
                            <a href="{{ route('public.docs.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-800 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-black text-xs">
                                <span>{{ __('header.pub_sub.buku') ?? 'Buku & Monograf Ilmiah' }}</span>
                                <span class="text-[9px] px-2 py-0.5 rounded bg-lime-100 text-[#064e3b] font-mono">NEW</span>
                            </a>
                            <a href="{{ route('public.kajianilmiah.index') }}" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                {{ __('header.pub_sub.blog') ?? 'Kajian & Riset Terapan' }}
                            </a>
                            <a href="{{ route('public.publications.index') }}" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                {{ __('header.pub_sub.berita') ?? 'Berita & Rilis Kegiatan' }}
                            </a>
                            <a href="{{ route('public.products.index') }}" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                {{ __('header.pub_sub.produk') ?? 'Inovasi Produk Sosial' }}
                            </a>
                            <a href="{{ route('public.gallery.index') }}" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                {{ __('header.pub_sub.gallery') ?? 'Galeri Dokumentasi Aksi' }}
                            </a>
                        </div>
                    </div>
                </div>

                {{-- DROPDOWN: TENTANG KAMI --}}
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" @keydown.escape="open = false">
                    <button type="button"
                            class="flex items-center px-3.5 py-2 rounded-xl group-hover:text-[#064e3b] group-hover:bg-slate-50 transition-colors focus:outline-none"
                            :aria-expanded="open"
                            aria-haspopup="true">
                        <span>{{ __('header.about') ?? 'Tentang' }}</span>
                        <svg class="ml-1 w-3 h-3 transition-transform duration-300 group-hover:rotate-180 text-slate-400 group-hover:text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition.opacity.duration.200ms class="absolute left-0 w-72 pt-2 z-50" style="display: none;">
                        <div class="bg-white shadow-2xl rounded-2xl p-4 border border-slate-200/90 overflow-hidden">
                            <a href="{{ route('public.tentangkami.profil') }}" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                {{ __('header.about_sub.profile') ?? 'Profil Organisasi' }}
                            </a>
                            <a href="{{ route('public.tentangkami.visi') }}" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                {{ __('header.about_sub.vision') ?? 'Visi & Misi' }}
                            </a>
                            <a href="{{ route('public.tentangkami.legalitas') }}" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                {{ __('header.about_sub.legality') ?? 'Legalitas & Akreditasi' }}
                            </a>
                            <a href="{{ route('public.tentangkami.sejarah') }}" class="block px-3 py-2 rounded-xl text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition-colors font-bold text-xs">
                                {{ __('header.about_sub.history') ?? 'Sejarah & Jejak Langkah' }}
                            </a>
                        </div>
                    </div>
                </div>

                {{-- KONTAK & MITRA --}}
                <a href="{{ route('public.tentangkami.kontak') }}" class="px-3.5 py-2 rounded-xl transition-colors hover:text-[#064e3b] hover:bg-slate-50 {{ request()->is('tentang-kami/kontak') ? 'text-[#064e3b] font-black bg-emerald-50/60' : '' }}">
                    {{ __('header.contact') ?? 'Kontak' }}
                </a>

                {{-- Language Switcher (Clean, Single container) --}}
                <div class="flex items-center ml-2 pl-3 border-l border-slate-200 gap-2 text-[10px] font-black select-none">
                    <a href="{{ route('lang.switch', 'id') }}"
                       class="px-2 py-1 rounded-md transition-colors {{ app()->getLocale() == 'id' ? 'bg-[#064e3b] text-white' : 'text-slate-400 hover:text-slate-700' }}"
                       aria-label="Ganti Bahasa ke Indonesia">ID</a>
                    <span class="text-slate-300">/</span>
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="px-2 py-1 rounded-md transition-colors {{ app()->getLocale() == 'en' ? 'bg-[#064e3b] text-white' : 'text-slate-400 hover:text-slate-700' }}"
                       aria-label="Switch Language to English">EN</a>
                </div>

            </nav>

            {{-- 3. PRIMARY CALL TO ACTION BUTTON (HCD) --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('public.campaign.index') }}"
                   class="inline-flex items-center gap-2 bg-[#064e3b] text-[#BEF264] px-6 py-2.5 rounded-full font-black text-xs uppercase tracking-wider shadow-md hover:bg-emerald-800 hover:scale-105 transition-all">
                    <span>{{ __('header.donate') ?? 'Ikut Aksi & Donasi' }}</span>
                    <span>→</span>
                </a>
            </div>

        </div>
    </div>
</header>
