@extends('public.layouts.app')
@section('title', 'Sejarah | Yota adiwidya center')

@section('content')


<section class="bg-[#FDFDFB] py-32 relative overflow-hidden font-['Plus_Jakarta_Sans']">
    <div class="absolute left-1/2 top-0 bottom-0 w-px bg-slate-200 hidden lg:block -translate-x-1/2 z-0"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">

        <div class="text-center mb-32">
            <span class="inline-block px-4 py-1.5 rounded-full bg-lime-100 text-[#064e3b] text-[10px] font-black tracking-[0.4em] uppercase mb-6">
                {{ __('history.yetc_legacy') }}
            </span>
            <h2 class="text-5xl md:text-7xl font-black text-[#064e3b] tracking-tighter mb-8 leading-none">
                {{ __('history.title') }}
            </h2>
            <p class="text-slate-500 text-lg font-light italic">{{ __('history.subtitle') }}</p>
        </div>

        <div class="space-y-32 relative">

            <div class="relative grid lg:grid-cols-2 gap-12 items-center">
                <div class="lg:text-right">
                    <span class="text-8xl font-black text-slate-100 block mb-4">2023</span>
                    <h3 class="text-2xl font-bold text-[#064e3b] mb-4">{{ __('history.milestones.2023.label') }}</h3>
                    <p class="text-slate-500 leading-relaxed font-light">{{ __('history.milestones.2023.desc') }}</p>
                    <div class="mt-6 p-6 bg-[#064e3b] text-white rounded-[2rem] inline-block lg:ml-auto">
                        <p class="text-sm italic font-serif">"{{ __('history.milestones.2023.quote') }}"</p>
                    </div>
                </div>
                <div class="relative group">
                    <div class="aspect-video bg-slate-200 rounded-[3rem] overflow-hidden border-8 border-white shadow-2xl">
                        <img src="{{ asset('image/e1.jpg') }}" 
     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" 
     alt="History 2023">
                    </div>
                    <div class="absolute left-[-4.3rem] top-1/2 -translate-y-1/2 w-6 h-6 bg-lime-500 rounded-full border-4 border-white shadow-lg hidden lg:block"></div>
                </div>
            </div>

            <div class="relative grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1 relative group">
                    <div class="aspect-video bg-slate-200 rounded-[3rem] overflow-hidden border-8 border-white shadow-2xl">
                        <img src="{{ asset('image/yetcc.jpg') }}" 
     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" 
     alt="Kosan Manisi">
                    </div>
                    <div class="absolute right-[-4.3rem] top-1/2 -translate-y-1/2 w-6 h-6 bg-lime-500 rounded-full border-4 border-white shadow-lg hidden lg:block"></div>
                </div>
                <div class="order-1 lg:order-2">
                    <span class="text-8xl font-black text-slate-100 block mb-4">2024</span>
                    <h3 class="text-2xl font-bold text-[#064e3b] mb-4">{{ __('history.milestones.2024_early.label') }}</h3>
                    <div class="flex items-center gap-2 mb-4 text-lime-600 font-bold text-xs uppercase tracking-widest">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ __('history.milestones.2024_early.location') }}
                    </div>
                    <p class="text-slate-500 leading-relaxed font-light italic">"{{ __('history.milestones.2024_early.desc') }}"</p>
                </div>
            </div>

            <div class="relative">
                <div class="max-w-4xl mx-auto bg-[#064e3b] rounded-[4rem] p-12 lg:p-20 text-center text-white overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none">
                        <img src="{{ asset('image/haran-pattern.png') }}" class="w-full h-full object-cover">
                    </div>
                    <span class="text-lime-400 font-black tracking-widest text-[10px] uppercase mb-8 block">The Transformation</span>
                    <h3 class="text-4xl md:text-5xl font-black mb-6">{{ __('history.milestones.2025_trans.label') }}</h3>
                    <p class="text-slate-300 text-lg font-light leading-relaxed max-w-2xl mx-auto">
                        {{ __('history.milestones.2025_trans.desc') }}
                    </p>
                    <div class="mt-12 inline-flex items-center gap-4 px-8 py-4 bg-white/10 rounded-full border border-white/10">
                        <div class="w-10 h-10 bg-lime-500 rounded-full flex items-center justify-center text-[#064e3b] font-black">Y</div>
                        <span class="text-sm font-bold tracking-widest uppercase">Yota: The First Robot Legacy</span>
                    </div>
                </div>
            </div>

            <div class="relative grid lg:grid-cols-2 gap-12 items-center">
                <div class="lg:text-right">
                    <span class="text-8xl font-black text-slate-100 block mb-4">Present</span>
                    <h3 class="text-2xl font-bold text-[#064e3b] mb-4">{{ __('history.milestones.2025_official.label') }}</h3>
                    <div class="flex lg:justify-end items-center gap-2 mb-4 text-lime-600 font-bold text-xs uppercase tracking-widest">
                        {{ __('history.milestones.2025_official.location') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    </div>
                    <p class="text-slate-500 leading-relaxed font-light">{{ __('history.milestones.2025_official.desc') }}</p>
                </div>
                <div class="relative group">
                    <div class="aspect-video bg-slate-200 rounded-[3rem] overflow-hidden border-8 border-white shadow-2xl">
                        <img src="{{ asset('image/aljabar.jpg') }}" 
     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" 
     alt="Al-Jabbar">
                    </div>
                    <div class="absolute left-[-4.3rem] top-1/2 -translate-y-1/2 w-6 h-6 bg-lime-500 rounded-full border-4 border-white shadow-lg hidden lg:block"></div>
                </div>
            </div>

        </div>

        <div class="mt-40 text-center">
            <div class="relative inline-block">
                <img src="{{ asset('image/fyota1.jpg') }}" class="w-32 h-32 mx-auto mb-8 drop-shadow-2xl">
                <p class="text-3xl md:text-5xl font-black text-[#064e3b] tracking-tighter leading-tight max-w-4xl">
                    "{{ __('history.footer_note') }}"
                </p>
                <div class="mt-12 flex justify-center gap-12">
                    <div class="text-center">
                        <p class="text-3xl font-black text-[#064e3b]">3</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Founders</p>
                    </div>
                    <div class="text-center border-x border-slate-200 px-12">
                        <p class="text-3xl font-black text-[#064e3b]">YOTA</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Innovation Core</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-black text-[#064e3b]">∞</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Commitment</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
