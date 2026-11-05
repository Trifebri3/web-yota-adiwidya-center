<section class="py-24 bg-[#052c24] relative overflow-hidden font-['Plus_Jakarta_Sans'] rounded-[4rem] mx-6 my-10 shadow-2xl">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-lime-400 rounded-full blur-[120px]"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-lime-400 rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-8 lg:px-12 relative z-10">
        <div class="grid lg:grid-cols-12 gap-16 items-center">

            {{-- Left: Visual Representation (Hemat Ruang) --}}
            <div class="lg:col-span-5 relative group">
                <div class="relative rounded-[3rem] overflow-hidden border border-white/10 shadow-2xl aspect-[4/5] md:aspect-square lg:aspect-auto">
                    {{-- Ganti dengan screenshot Mockup Platform YOTA HUB --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-lime-400/20 to-transparent z-10"></div>
                    <img src="{{ asset('image/hub.png') }}" alt="YOTA HUB Platform" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000 group-hover:scale-105">

                    {{-- Floating Stats Badge --}}
                    <div class="absolute bottom-8 left-8 bg-white/10 backdrop-blur-xl p-6 rounded-3xl border border-white/20 z-20 shadow-2xl">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-lime-400 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-[#052c24]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Content & Features --}}
            <div class="lg:col-span-7">
                <div class="max-w-2xl">
                    <h2 class="text-xs font-black uppercase tracking-[0.5em] text-lime-400 mb-6">{{ __('hub.tag') }}</h2>
                    <h3 class="text-5xl md:text-7xl font-black text-white leading-[0.85] tracking-tighter uppercase mb-4">
                        {{ __('hub.title') }}
                    </h3>
                    <h4 class="text-xl md:text-2xl font-black text-white/40 uppercase tracking-tighter italic mb-8">
                        {{ __('hub.subtitle') }}
                    </h4>
                    <p class="text-white/60 text-lg font-medium leading-relaxed italic mb-12">
                        {{ __('hub.desc') }}
                    </p>

                    {{-- Feature Grid (Pipih & Compact) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12">
                        @foreach(__('hub.features') as $key => $feature)
                        <div class="flex items-center gap-4 bg-white/5 border border-white/5 p-4 rounded-2xl hover:bg-white/10 transition-colors cursor-default group">
                            <div class="w-2 h-2 rounded-full bg-lime-400 group-hover:animate-ping"></div>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest">{{ $feature }}</span>
                        </div>
                        @endforeach
                    </div>

                    {{-- Action Area --}}
                    <div class="flex flex-col sm:flex-row items-center gap-8">
                        <a href="https://hub.siyota.org" class="w-full sm:w-auto bg-lime-400 text-[#052c24] px-10 py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] hover:bg-white transition-all shadow-xl shadow-lime-400/20 active:scale-95 text-center">
                            {{ __('hub.cta') }}
                        </a>
                        <div class="flex items-center gap-3">
                            <div class="flex -space-x-3">
                                <div class="w-8 h-8 rounded-full border-2 border-[#052c24] bg-slate-200"></div>
                                <div class="w-8 h-8 rounded-full border-2 border-[#052c24] bg-slate-400"></div>
                                <div class="w-8 h-8 rounded-full border-2 border-[#052c24] bg-slate-600"></div>
                            </div>
                            <span class="text-[9px] font-bold text-white/40 uppercase tracking-widest italic">Join the movement</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
