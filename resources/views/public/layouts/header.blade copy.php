<script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

<header x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-slate-100/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20 lg:h-24">

            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="group transition-transform duration-500 hover:scale-105">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-9 lg:h-12 w-auto" />
                </a>
            </div>

            <nav class="hidden xl:flex items-center space-x-1 text-[11px] font-extrabold uppercase tracking-[0.15em] text-slate-500">
                <a href="/" class="px-4 py-2 nav-link {{ request()->is('/') ? 'nav-active' : '' }}">{{ __('header.home') }}</a>

                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center px-4 py-2 hover:text-[#064e3b] transition">
                        {{ __('header.about') }}
                        <svg class="ml-1.5 w-3 h-3 opacity-50 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-transition.opacity class="absolute left-0 w-72 pt-4">
                        <div class="bg-white shadow-2xl border border-slate-100 rounded-[2rem] py-6 overflow-hidden">
                            <a href="{{ route('public.tentangkami.profil') }}" class="block px-8 py-3 text-slate-600 hover:bg-lime-50 hover:text-[#064e3b] transition-colors">{{ __('header.about_sub.profile') }}</a>
                            <a href="{{ route('public.tentangkami.visi') }}" class="block px-8 py-3 text-slate-600 hover:bg-lime-50 hover:text-[#064e3b] transition-colors">{{ __('header.about_sub.vision') }}</a>
                            <a href="{{ route('public.tentangkami.legalitas') }}" class="block px-8 py-3 text-slate-600 hover:bg-lime-50 hover:text-[#064e3b] transition-colors">{{ __('header.about_sub.legality') }}</a>
                            <a href="{{ route('public.tentangkami.sejarah') }}" class="block px-8 py-3 text-slate-600 hover:bg-lime-50 hover:text-[#064e3b] transition-colors">{{ __('header.about_sub.history') }}</a>
                        </div>
                    </div>
                </div>

                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center px-4 py-2 hover:text-[#064e3b] transition">
                        {{ __('header.program_team') }}
                        <svg class="ml-1.5 w-3 h-3 opacity-50 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-transition.opacity class="absolute left-0 w-72 pt-4">
                        <div class="bg-white shadow-2xl border border-slate-100 rounded-[2rem] py-6">
                            <p class="px-8 py-2 text-[9px] font-black text-lime-600 tracking-[0.2em]">ORGANISASI</p>
                            <a href="#" class="block px-8 py-3 text-slate-600 hover:bg-slate-50 transition-colors">{{ __('header.program_sub.team') }}</a>
                            <a href="https://hub.siyota.org" class="block px-8 py-3 text-slate-600 hover:bg-slate-50 transition-colors">{{ __('header.program_sub.volunteer') }}</a>
                            <div class="my-4 border-t border-slate-100"></div>
                            <p class="px-8 py-2 text-[9px] font-black text-lime-600 tracking-[0.2em]">AKSI NYATA</p>
                            <a href="{{ route('public.programs.index') }}" class="block px-8 py-3 text-slate-600 hover:bg-slate-50 transition-colors">{{ __('header.program_sub.list') }}</a>
                            <a href="{{ route('public.impact.index') }}" class="block px-8 py-3 text-slate-600 hover:bg-slate-50 transition-colors text-[#064e3b] font-bold">{{ __('header.program_sub.impact') }}</a>
                        </div>
                    </div>
                </div>

                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center px-4 py-2 hover:text-[#064e3b] transition">
                        {{ __('header.publication') }}
                        <svg class="ml-1.5 w-3 h-3 opacity-50 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-transition.opacity class="absolute left-0 w-80 pt-4">
                        <div class="bg-white shadow-2xl border border-slate-100 rounded-[2rem] py-6">
                            <a href="{{ route('public.docs.index') }}" class="block px-8 py-3 text-slate-600 hover:bg-lime-50 transition-colors">{{ __('header.pub_sub.annual') }}</a>
                            <a href="{{ route('public.publications.index') }}" class="block px-8 py-3 text-slate-600 hover:bg-lime-50 transition-colors">{{ __('header.pub_sub.berita') }}</a>
                            <a href="{{ route('public.scientific.index') }}" class="block px-8 py-3 text-slate-600 hover:bg-lime-50 transition-colors">{{ __('header.pub_sub.blog') }}</a>
                            <a href="{{ route('public.products.index') }}" class="block px-8 py-3 text-slate-600 hover:bg-lime-50 transition-colors">{{ __('header.pub_sub.produk') }}</a>
                            <a href="{{ route('public.gallery.index') }}" class="block px-8 py-3 text-slate-600 hover:bg-lime-50 transition-colors">{{ __('header.pub_sub.gallery') }}</a>
                        </div>
                    </div>
                </div>

                <div class="flex items-center ml-4 pl-4 border-l border-slate-200 gap-3 text-[10px] font-black">
                    <a href="{{ route('lang.switch', 'id') }}" class="{{ app()->getLocale() == 'id' ? 'text-lime-600 underline' : 'text-slate-400 hover:text-slate-600' }}">ID</a>
                    <span class="text-slate-300">|</span>
                    <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'text-lime-600 underline' : 'text-slate-400 hover:text-slate-600' }}">EN</a>
                </div>
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ route('public.campaign.index') }}" class="hidden sm:inline-flex bg-[#064e3b] text-white px-6 lg:px-8 py-3 rounded-full font-extrabold text-[10px] lg:text-[12px] tracking-widest uppercase shadow-lg shadow-[#064e3b]/20 hover:bg-lime-500 hover:text-[#064e3b] hover:-translate-y-0.5 transition-all duration-300">
                    {{ __('header.donate') }}
                </a>

                <button @click="mobileMenuOpen = true" class="xl:hidden text-[#064e3b] p-2 hover:bg-slate-50 rounded-xl transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-10"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-10"
         class="fixed inset-0 z-[999] bg-white overflow-y-auto"
         style="display: none;">

        <div class="sticky top-0 bg-white/90 backdrop-blur-md px-6 py-6 flex justify-between items-center border-b border-slate-50">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-9 w-auto" />
            <button @click="mobileMenuOpen = false" class="text-slate-400 p-2 bg-slate-50 rounded-full hover:text-red-500 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="px-8 py-10 pb-20">
            <nav class="space-y-8">
                <a href="/" class="block text-4xl font-black text-[#064e3b] tracking-tighter">Home</a>

                <div x-data="{ open: false }" class="border-b border-slate-100 pb-4">
                    <button @click="open = !open" class="flex justify-between items-center w-full py-2 text-2xl font-bold text-slate-800">
                        {{ __('header.about') }}
                        <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 transition-transform text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-4 space-y-4 pt-4 text-lg text-slate-500 font-medium">
                        <a href="{{ route('public.tentangkami.profil') }}" class="block hover:text-[#064e3b]">{{ __('header.about_sub.profile') }}</a>
                        <a href="{{ route('public.tentangkami.visi') }}" class="block hover:text-[#064e3b]">{{ __('header.about_sub.vision') }}</a>
                        <a href="{{ route('public.tentangkami.legalitas') }}" class="block hover:text-[#064e3b]">{{ __('header.about_sub.legality') }}</a>
                        <a href="{{ route('public.tentangkami.sejarah') }}" class="block hover:text-[#064e3b]">{{ __('header.about_sub.history') }}</a>
                    </div>
                </div>

                <div x-data="{ open: false }" class="border-b border-slate-100 pb-4">
                    <button @click="open = !open" class="flex justify-between items-center w-full py-2 text-2xl font-bold text-slate-800">
                        {{ __('header.program_team') }}
                        <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 transition-transform text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-4 space-y-6 pt-4 text-lg text-slate-500 font-medium">
                        <div>
                            <p class="text-[10px] font-black text-lime-600 uppercase tracking-widest mb-3">Organisasi</p>
                            <div class="space-y-4">
                                <a href="#" class="block">{{ __('header.program_sub.team') }}</a>
                                <a href="https://hub.siyota.org" class="block">{{ __('header.program_sub.volunteer') }}</a>
                            </div>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-lime-600 uppercase tracking-widest mb-3">Aksi Nyata</p>
                            <div class="space-y-4">
                                <a href="{{ route('public.programs.index') }}" class="block">{{ __('header.program_sub.list') }}</a>
                                <a href="{{ route('public.impact.index') }}" class="block text-[#064e3b] font-black">{{ __('header.program_sub.impact') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-data="{ open: false }" class="border-b border-slate-100 pb-4">
                    <button @click="open = !open" class="flex justify-between items-center w-full py-2 text-2xl font-bold text-slate-800">
                        {{ __('header.publication') }}
                        <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 transition-transform text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-4 space-y-4 pt-4 text-lg text-slate-500 font-medium">
                        <a href="{{ route('public.docs.index') }}" class="block">{{ __('header.pub_sub.annual') }}</a>
                        <a href="{{ route('public.publications.index') }}" class="block">{{ __('header.pub_sub.berita') }}</a>
                        <a href="{{ route('public.scientific.index') }}" class="block">{{ __('header.pub_sub.blog') }}</a>
                        <a href="{{ route('public.products.index') }}" class="block">{{ __('header.pub_sub.produk') }}</a>
                        <a href="{{ route('public.gallery.index') }}" class="block">{{ __('header.pub_sub.gallery') }}</a>
                    </div>
                </div>

                <a href="{{ route('public.tentangkami.kontak') }}" class="block text-2xl font-bold text-slate-800">Contact</a>
            </nav>

            <div class="mt-16 space-y-8">
                <div class="flex gap-4">
                    <a href="{{ route('lang.switch', 'id') }}" class="flex-1 text-center py-4 rounded-2xl border-2 {{ app()->getLocale() == 'id' ? 'bg-[#064e3b] text-white border-[#064e3b]' : 'text-slate-400 border-slate-100' }} font-bold text-sm">INDONESIA</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="flex-1 text-center py-4 rounded-2xl border-2 {{ app()->getLocale() == 'en' ? 'bg-[#064e3b] text-white border-[#064e3b]' : 'text-slate-400 border-slate-100' }} font-bold text-sm">ENGLISH</a>
                </div>

                <a href="{{ route('public.campaign.index') }}" class="block w-full bg-[#064e3b] text-white text-center py-6 rounded-[2rem] font-black text-xl tracking-widest uppercase shadow-2xl shadow-[#064e3b]/30">
                    {{ __('header.donate') }}
                </a>

                <div class="bg-lime-50 p-8 rounded-[2.5rem] text-center">
                    <p class="text-xs font-black text-lime-700 uppercase tracking-[0.2em] mb-4">Mari Bergabung</p>
                    <a href="https://hub.siyota.org" class="text-[#064e3b] font-black text-2xl underline underline-offset-8 decoration-lime-400 decoration-4 italic">Join Volunteer Hub</a>
                </div>
            </div>
        </div>
    </div>
</header>
