@extends('public.layouts.app')
@section('title', 'Profil Kami | Yota adiwidya center')

@section('content')
<div class="bg-[#FDFDFB] overflow-hidden font-['Plus_Jakarta_Sans']">

    {{-- 1. HERO & ESSENCE SECTION --}}
    <section class="pt-24 sm:pt-32 pb-16 md:pb-24 relative overflow-hidden">
        {{-- Subtle Background Accent (clipped to prevent horizontal scroll) --}}
        <div class="absolute top-0 right-0 w-1/3 h-full bg-slate-100/40 -skew-x-12 translate-x-16 pointer-events-none hidden md:block"></div>
        <div class="absolute top-20 left-4 text-6xl md:text-9xl font-black text-slate-100/40 select-none pointer-events-none tracking-tighter truncate max-w-full">
            PHILOSOPHY
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">

                {{-- Left: Mountain / Hero Photo --}}
                <div class="lg:col-span-6 relative">
                    <div class="relative rounded-[2.5rem] sm:rounded-[3.5rem] overflow-hidden shadow-2xl group aspect-[4/3] sm:aspect-[16/11]">
                        <img src="{{ asset('image/foto1.jpg') }}" alt="Gunung Burangrang YOTA" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#064e3b]/85 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-4 sm:bottom-6 left-4 sm:left-6 right-4 sm:right-6 p-4 sm:p-6 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl">
                            <p class="text-white text-xs sm:text-sm md:text-base font-medium leading-relaxed italic">
                                "{{ __('about.hero_quote') }}"
                            </p>
                        </div>
                    </div>
                    <div class="absolute -top-6 -right-6 w-24 h-24 sm:w-32 sm:h-32 animate-bounce-slow pointer-events-none">
                        <img src="{{ asset('image/yt.png') }}" class="w-full h-full object-contain drop-shadow-xl" alt="Haran YOTA">
                    </div>
                </div>

                {{-- Right: Narrative --}}
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-lime-100 text-[#064e3b] text-[10px] font-black tracking-[0.25em] uppercase">
                        <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                        <span>Our Essence</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-[#064e3b] leading-tight tracking-tight uppercase">
                        {{ __('about.title_yota') }} <br>
                        <span class="text-lime-600 italic font-serif lowercase">{{ __('about.title_sub') }}</span>
                    </h1>

                    <div class="space-y-4 text-slate-600 text-xs sm:text-sm md:text-base font-light leading-relaxed">
                        <p>{!! __('about.desc_1') !!}</p>
                        <p>{{ __('about.desc_2') }}</p>
                    </div>

                    <div class="pt-4 grid grid-cols-2 gap-4 border-t border-slate-200">
                        <div class="p-3 bg-white rounded-2xl border border-slate-100 shadow-xs">
                            <span class="text-[9px] font-black text-lime-700 uppercase tracking-wider block mb-1">Tagline Organisasi</span>
                            <span class="text-[#064e3b] font-bold text-xs sm:text-sm">Forum for Your High Performance</span>
                        </div>
                        <div class="p-3 bg-white rounded-2xl border border-slate-100 shadow-xs">
                            <span class="text-[9px] font-black text-lime-700 uppercase tracking-wider block mb-1">Fokus Gerakan</span>
                            <span class="text-[#064e3b] font-bold text-xs sm:text-sm">Muda, Peduli, Berinovasi untuk Bumi</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 2. TIGA FOKUS TANTANGAN & PENDEKATAN --}}
    <section class="py-16 md:py-24 bg-white border-y border-slate-200/80 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Section Heading --}}
            <div class="max-w-3xl mb-12 sm:mb-16">
                <span class="inline-block px-3.5 py-1 rounded-full bg-[#064e3b] text-[#d9f99d] text-[10px] font-black tracking-[0.25em] uppercase mb-3">
                    {{ __('focus.tagline') }}
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-[#064e3b] leading-tight tracking-tight uppercase">
                    {{ __('focus.title') }} <br>
                    <span class="text-lime-600 italic font-serif lowercase">{{ __('focus.title_accent') }}</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-stretch">

                {{-- Left: Tiga Masalah Riil (7 Cols) --}}
                <div class="lg:col-span-7 space-y-4">
                    <div class="flex items-center gap-3 mb-6">
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400">{{ __('focus.problem_title') }}</h3>
                        <div class="h-[1px] flex-grow bg-slate-200"></div>
                    </div>

                    {{-- Problem 1 --}}
                    <div class="p-5 sm:p-6 rounded-3xl bg-slate-50 border border-slate-100 hover:border-red-200 hover:bg-red-50/50 transition-all flex gap-4 sm:gap-5 items-start">
                        <div class="w-12 h-12 shrink-0 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm sm:text-base font-black text-[#064e3b] mb-1">{{ __('focus.problems.disaster.title') }}</h4>
                            <p class="text-xs sm:text-sm text-slate-500 font-light leading-relaxed">{{ __('focus.problems.disaster.desc') }}</p>
                        </div>
                    </div>

                    {{-- Problem 2 --}}
                    <div class="p-5 sm:p-6 rounded-3xl bg-slate-50 border border-slate-100 hover:border-blue-200 hover:bg-blue-50/50 transition-all flex gap-4 sm:gap-5 items-start">
                        <div class="w-12 h-12 shrink-0 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm sm:text-base font-black text-[#064e3b] mb-1">{{ __('focus.problems.social.title') }}</h4>
                            <p class="text-xs sm:text-sm text-slate-500 font-light leading-relaxed">{{ __('focus.problems.social.desc') }}</p>
                        </div>
                    </div>

                    {{-- Problem 3 --}}
                    <div class="p-5 sm:p-6 rounded-3xl bg-slate-50 border border-slate-100 hover:border-amber-200 hover:bg-amber-50/50 transition-all flex gap-4 sm:gap-5 items-start">
                        <div class="w-12 h-12 shrink-0 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm sm:text-base font-black text-[#064e3b] mb-1">{{ __('focus.problems.culture.title') }}</h4>
                            <p class="text-xs sm:text-sm text-slate-500 font-light leading-relaxed">{{ __('focus.problems.culture.desc') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Right: Tiga Pendekatan Strategis YOTA (5 Cols) --}}
                <div class="lg:col-span-5 bg-[#064e3b] rounded-[2.5rem] p-6 sm:p-8 lg:p-10 text-white flex flex-col justify-between relative overflow-hidden shadow-xl">
                    <div class="relative z-10 space-y-6">
                        <div class="flex items-center gap-3">
                            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-lime-400">{{ __('focus.approach_title') }}</h3>
                            <div class="h-[1px] flex-grow bg-white/20"></div>
                        </div>

                        <div class="space-y-6">
                            <div class="relative pl-10">
                                <span class="absolute left-0 top-0 text-3xl font-black text-lime-400/30 font-mono">01</span>
                                <h4 class="text-base font-black mb-1 text-white">{{ __('focus.approach.education.title') }}</h4>
                                <p class="text-xs text-slate-300 font-light leading-relaxed">{{ __('focus.approach.education.desc') }}</p>
                            </div>

                            <div class="relative pl-10">
                                <span class="absolute left-0 top-0 text-3xl font-black text-lime-400/30 font-mono">02</span>
                                <h4 class="text-base font-black mb-1 text-white">{{ __('focus.approach.tech.title') }}</h4>
                                <p class="text-xs text-slate-300 font-light leading-relaxed italic">"{{ __('focus.approach.tech.desc') }}"</p>
                            </div>

                            <div class="relative pl-10">
                                <span class="absolute left-0 top-0 text-3xl font-black text-lime-400/30 font-mono">03</span>
                                <h4 class="text-base font-black mb-1 text-lime-300">{{ __('focus.approach.sustainability.title') }}</h4>
                                <p class="text-xs text-slate-300 font-light leading-relaxed">{{ __('focus.approach.sustainability.desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10 pt-6 mt-6 border-t border-white/10 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-lime-400 text-[#064e3b] flex items-center justify-center shrink-0 font-black">
                            ✓
                        </div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-lime-100 leading-snug">
                            Mendorong Empati, Bukti Ilmiah, & Keadilan bagi Semesta.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 3. FILOSOFI NAMA (YOTA & ADIWIDYA) --}}
    <section class="py-16 md:py-24 bg-[#FDFDFB]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                    ETIMOLOGI & VISI BESAR
                </span>
                <h3 class="text-2xl sm:text-4xl font-black text-[#064e3b] uppercase tracking-tight mt-3">
                    {{ __('about.name_philosophy') }}
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 rounded-3xl overflow-hidden border border-slate-200 shadow-lg">
                <div class="bg-white p-8 sm:p-12 border-b md:border-b-0 md:border-r border-slate-200">
                    <span class="text-lime-600 font-serif italic text-sm mb-2 block font-bold">Yunani: Titik Nol & Integritas Fundamental</span>
                    <h4 class="text-4xl sm:text-5xl font-black text-[#064e3b] mb-3 tracking-tighter">YOTA</h4>
                    <p class="text-lg font-black text-slate-800 mb-2">{{ __('about.yota_meaning_title') }}</p>
                    <p class="text-xs sm:text-sm text-slate-500 font-light leading-relaxed">{{ __('about.yota_meaning_desc') }}</p>
                </div>

                <div class="bg-[#064e3b] p-8 sm:p-12 text-white">
                    <span class="text-lime-300 font-serif italic text-sm mb-2 block font-bold">Sansekerta: Pengetahuan Luhur & Bermanfaat</span>
                    <h4 class="text-4xl sm:text-5xl font-black text-white mb-3 tracking-tighter">ADIWIDYA</h4>
                    <p class="text-lg font-black text-lime-300 mb-2">{{ __('about.adiwidya_meaning_title') }}</p>
                    <p class="text-xs sm:text-sm text-slate-200 font-light leading-relaxed">{{ __('about.adiwidya_meaning_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. MAKNA LOGO --}}
    <section class="py-16 md:py-24 bg-white border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

                {{-- Left: Penjelasan Simbol (7 Cols) --}}
                <div class="lg:col-span-7 space-y-6">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">IDENTITAS VISUAL</span>
                        <h3 class="text-2xl sm:text-4xl font-black text-[#064e3b] tracking-tight uppercase mt-1">
                            {{ __('about.logo_meaning') }}
                        </h3>
                    </div>

                    <div class="space-y-4">
                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex gap-4 items-start">
                            <div class="w-12 h-12 shrink-0 bg-yellow-100 text-yellow-700 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.989-2.386l-.548-.547z"/></svg>
                            </div>
                            <div>
                                <h5 class="text-sm font-black text-[#064e3b] mb-1">{{ __('about.logo_light_title') }}</h5>
                                <p class="text-xs text-slate-500 font-light leading-relaxed">{{ __('about.logo_light_desc') }}</p>
                            </div>
                        </div>

                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex gap-4 items-start">
                            <div class="w-12 h-12 shrink-0 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6zM12 10a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            </div>
                            <div>
                                <h5 class="text-sm font-black text-[#064e3b] mb-1">{{ __('about.logo_leaf_title') }}</h5>
                                <p class="text-xs text-slate-500 font-light leading-relaxed">{{ __('about.logo_leaf_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Logo Display (5 Cols) --}}
                <div class="lg:col-span-5 bg-slate-50 rounded-3xl p-8 sm:p-12 flex items-center justify-center border border-slate-200">
                    <img src="{{ asset('image/logo.png') }}" class="w-full max-w-xs drop-shadow-xl" alt="Logo YAC">
                </div>

            </div>
        </div>
    </section>

</div>
@endsection
