<section class="relative bg-[#FDFDFB] pt-24 pb-40 overflow-hidden">
<div class="absolute top-10 left-10 opacity-[0.08] select-none pointer-events-none">
    <img src="{{ asset('image/yt.png') }}"
         alt="YOTA"
         class="w-[60rem] h-auto font-black text-slate-50" />
</div>

    <div class="absolute -top-24 -right-24 w-96 h-96 bg-lime-100/50 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-16 mb-24">

            <div class="lg:w-2/3 text-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-100 text-green-600 text-sm font-bold tracking-widest uppercase mb-8 border border-slate-200">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-lime-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-lime-500"></span>
                    </span>
                    Future Resilience
                </div>

                <h1 class="text-4xl md:text-5xl font-black tracking-tight text-green-900 mb-8 leading-[0.95]">
                    @php
                        $headline = __('homepage.hero.headline');
                        $headline = str_replace('Resilience', '<span class="text-lime-500 underline decoration-green-900/10">Resilience</span>', $headline);
                        $headline = str_replace('Nurani', '<span class="italic font-serif text-lime-500 ">Nurani</span>', $headline);
                    @endphp
                    {!! $headline !!}
                </h1>

                <p class="max-w-2xl text-xl text-slate-500 mb-12 leading-relaxed font-light">
                    {{ __('homepage.hero.subheadline') }}
                </p>

                <div class="flex flex-wrap gap-6">
                    <a href="https://siyota.org/impact" class="group relative overflow-hidden bg-green-900 text-white px-12 py-6 rounded-full font-bold text-lg transition-all duration-500 hover:shadow-[0_20px_50px_rgba(0,0,0,0.2)]">
                        <span class="relative z-10">{{ __('homepage.hero.cta_primary') }}</span>
                        <div class="absolute inset-0 bg-lime-500 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                    </a>
                    <a href="https://siyota.org/donasi" class="flex items-center gap-3 text-green-900 px-8 py-6 rounded-full font-bold text-lg hover:text-lime-600 transition-colors group">
                        {{ __('homepage.hero.cta_secondary') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="lg:w-1/3 relative">
                <div class="relative w-full aspect-square max-w-[400px] mx-auto">
                    <div class="absolute inset-0 border-[1px] border-slate-200 rounded-full animate-[spin_20s_linear_infinite]"></div>
                    <div class="absolute inset-4 border-[1px] border-dashed border-slate-300 rounded-full"></div>

                    <div class="absolute inset-0 flex items-center justify-center p-8">
                        <img src="{{ asset('image/yt.png') }}" alt="YOTA Mascot" class="w-full h-full object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-700">
                    </div>

                    <div class="absolute -bottom-4 -right-4 bg-white p-6 rounded-2xl shadow-xl border border-slate-50 flex items-center gap-4">
                        <div class="text-3xl font-bold text-lime-500">100%</div>
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-tight">Human-Centric<br>Integrity</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border border-slate-200 rounded-[2rem] overflow-hidden shadow-2xl shadow-slate-200/50">

            <div class="group p-12 bg-white border-r border-slate-100 hover:bg-slate-50 transition-all duration-500">
                <div class="mb-10 inline-block p-4 rounded-2xl bg-lime-50 text-lime-600 group-hover:rotate-12 transition-transform duration-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <h3 class="text-2xl font-black text-green-900 mb-4">{{ __('homepage.triangle.local_wisdom.title') }}</h3>
                <p class="text-slate-500 leading-relaxed font-light">
                    {{ __('homepage.triangle.local_wisdom.desc') }}
                </p>
            </div>

            <div class="group p-12 bg-green-900 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-lime-500/10 blur-3xl"></div>
                <div class="mb-10 inline-block p-4 rounded-2xl bg-white text-lime-400 group-hover:-translate-y-2 transition-transform duration-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04Cover1.764 1.764 0 00-6.138 6.138c0 5.117 3.38 9.444 8.006 10.824a1.994 1.994 0 001.494 0c4.627-1.38 8.006-5.707 8.006-10.824a1.764 1.764 0 00-6.138-6.138z" /></svg>
                </div>
                <h3 class="text-2xl font-black text-white mb-4">{{ __('homepage.triangle.tech_responsibility.title') }}</h3>
                <p class="text-white leading-relaxed font-light">
                    {{ __('homepage.triangle.tech_responsibility.desc') }}
                </p>
            </div>

            <div class="group p-12 bg-white hover:bg-slate-50 transition-all duration-500">
                <div class="mb-10 inline-block p-4 rounded-2xl bg-lime-50 text-lime-600 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                </div>
                <h3 class="text-2xl font-black text-green-900 mb-4">{{ __('homepage.triangle.bottom_up.title') }}</h3>
                <p class="text-slate-500 leading-relaxed font-light">
                    {{ __('homepage.triangle.bottom_up.desc') }}
                </p>
            </div>

        </div>
    </div>
</section>
