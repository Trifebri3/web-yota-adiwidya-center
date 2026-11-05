@extends('public.layouts.app')

@section('content')
<main class="bg-[#FDFDFB] min-h-screen pt-44 pb-32 font-['Plus_Jakarta_Sans']">
    <div class="max-w-5xl mx-auto px-6">

        {{-- 1. HEADER SECTION --}}
        <header class="text-center mb-20">
            <span class="inline-block px-4 py-1.5 rounded-full bg-[#052c24] text-[#BEF264] text-[10px] font-black tracking-[0.4em] uppercase mb-6">
                Connect with Us
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-[#052c24] leading-[0.85] tracking-tighter uppercase mb-8">
                Digital <br><span class="italic font-serif text-slate-400 lowercase">Ecosystem.</span>
            </h1>
            <p class="text-slate-500 text-lg font-medium italic max-w-2xl mx-auto">
                {{ app()->getLocale() == 'id'
                    ? 'Pusat informasi digital, jaringan komunitas, dan layanan dukungan krisis YOTA Adiwidya Center.'
                    : 'Digital information center, community network, and crisis support services of YOTA Adiwidya Center.' }}
            </p>
        </header>

        {{-- 2. SOCIAL MEDIA GRID (Mewah & Pipih) --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-20">
            @php
                $socials = [
                    ['name' => 'TikTok', 'icon' => 'TK', 'color' => 'bg-black', 'url' => '#'],
                    ['name' => 'YouTube', 'icon' => 'YT', 'color' => 'bg-red-600', 'url' => '#'],
                    ['name' => 'Instagram', 'icon' => 'IG', 'color' => 'bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-600', 'url' => '#'],
                    ['name' => 'LinkedIn', 'icon' => 'LI', 'color' => 'bg-blue-700', 'url' => '#'],
                ];
            @endphp
            @foreach($socials as $soc)
            <a href="{{ $soc['url'] }}" target="_blank" class="group relative p-8 rounded-[2.5rem] bg-white border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 text-center overflow-hidden">
                <div class="absolute inset-0 {{ $soc['color'] }} opacity-0 group-hover:opacity-10 transition-opacity"></div>
                <div class="relative z-10">
                    <span class="text-2xl font-black text-[#052c24] group-hover:scale-110 transition-transform block mb-2">{{ $soc['icon'] }}</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-[#052c24] transition-colors">{{ $soc['name'] }}</span>
                </div>
            </a>
            @endforeach
        </div>

        {{-- 3. SUB-ENTITY & HUBS (LOGO TAMBAHAN) --}}
        <div class="bg-white rounded-[3.5rem] p-12 border border-slate-100 shadow-sm mb-20">
            <h3 class="text-center text-[10px] font-black uppercase tracking-[0.5em] text-slate-300 mb-12">YOTA Ecosystem Hubs</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="flex flex-col items-center text-center group">
                    <div class="w-20 h-20 rounded-3xl bg-slate-50 flex items-center justify-center mb-6 group-hover:bg-lime-400 transition-colors">
                        <span class="text-xl font-black text-[#052c24]">YH</span>
                    </div>
                    <h4 class="text-sm font-black text-[#052c24] uppercase tracking-tighter">Yota Hub</h4>
                    <p class="text-[10px] text-slate-400 font-bold italic mt-2">Innovation & Tech Lab</p>
                </div>
                <div class="flex flex-col items-center text-center group">
                    <div class="w-20 h-20 rounded-3xl bg-slate-50 flex items-center justify-center mb-6 group-hover:bg-lime-400 transition-colors">
                        <span class="text-xl font-black text-[#052c24]">CS</span>
                    </div>
                    <h4 class="text-sm font-black text-[#052c24] uppercase tracking-tighter">Community Service</h4>
                    <p class="text-[10px] text-slate-400 font-bold italic mt-2">Social Impact Unit</p>
                </div>
                <div class="flex flex-col items-center text-center group">
                    <div class="w-20 h-20 rounded-3xl bg-slate-50 flex items-center justify-center mb-6 group-hover:bg-lime-400 transition-colors">
                        <span class="text-xl font-black text-[#052c24]">YC</span>
                    </div>
                    <h4 class="text-sm font-black text-[#052c24] uppercase tracking-tighter">Yota Community</h4>
                    <p class="text-[10px] text-slate-400 font-bold italic mt-2">Global Volunteer Network</p>
                </div>
            </div>
        </div>

        {{-- 4. OFFICE GALLERY & CONTACT (Direct Action) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
            {{-- Office Photos --}}
<div class="grid grid-cols-2 gap-4 h-full">
    <div class="rounded-[2.5rem] overflow-hidden shadow-xl h-full border border-slate-200 group">
        <img src="{{ asset('image/kerja2.png') }}" 
             alt="Yota Workspace Main" 
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
    </div>

    <div class="space-y-4">
        <div class="rounded-[2.5rem] overflow-hidden shadow-xl h-48 border border-slate-200 group">
            <img src="{{ asset('image/kerja1.png') }}" 
                 alt="Yota Creative Process" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        </div>

        <div class="rounded-[2.5rem] bg-lime-500 p-8 flex flex-col justify-end h-48 shadow-lg shadow-lime-500/20">
            <span class="text-3xl font-black text-[#052c24] leading-none uppercase tracking-tighter italic">
                Creative <br> Workspace.
            </span>
            <div class="mt-4 flex items-center gap-2">
                <span class="w-8 h-[2px] bg-[#052c24]"></span>
                <p class="text-[9px] font-black text-[#052c24]/60 uppercase tracking-widest italic">Yota Innovation</p>
            </div>
        </div>
    </div>
</div>

            {{-- Contact Info --}}
            <div class="bg-[#052c24] rounded-[3.5rem] p-12 text-white shadow-2xl shadow-[#052c24]/20 flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-black uppercase tracking-tighter mb-8 leading-none">
                        Get In Touch <br><span class="text-lime-400 italic font-serif lowercase">Directly.</span>
                    </h3>
                    <div class="space-y-8">
                        <a href="https://wa.me/6285117713303" target="_blank" class="flex items-center gap-6 group">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-[#BEF264] transition-all">
                                <svg class="w-5 h-5 group-hover:text-[#052c24]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <span class="block text-[9px] font-black text-white/40 uppercase tracking-widest mb-1">WhatsApp Admin</span>
                                <span class="text-sm font-bold tracking-tight">+62 851-1771-3303</span>
                            </div>
                        </a>
                        <a href="https://maps.app.goo.gl/uZvckUCkMEdW1tC38" target="_blank" class="flex items-center gap-6 group">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-[#BEF264] transition-all">
                                <svg class="w-5 h-5 group-hover:text-[#052c24]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            </div>
                            <div>
                                <span class="block text-[9px] font-black text-white/40 uppercase tracking-widest mb-1">Office Location</span>
                                <span class="text-sm font-bold tracking-tight">Baleendah, Kabupaten Bandung</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-white/5 flex justify-between items-center">
                    <span class="text-[9px] font-black uppercase tracking-[0.3em] text-white/20 italic">YOTA ADIWIDYA CENTER</span>
                    <div class="w-2 h-2 bg-lime-500 rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
