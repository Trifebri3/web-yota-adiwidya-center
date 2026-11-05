@php
    $homeCampaigns = \App\Models\Campaign::where('status', 'active')->latest()->take(2)->get();
    $locale = app()->getLocale();
@endphp

<section class="bg-[#FDFDFB] py-20 relative overflow-hidden font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Header Ringkas --}}
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="max-w-xl">
                <h2 class="text-[10px] font-black uppercase tracking-[0.4em] text-lime-600 mb-2">{{ __('campaign.hero_tag') }}</h2>
                <h3 class="text-3xl md:text-5xl font-black text-[#052c24] leading-none tracking-tighter uppercase">
                    {{ __('campaign.title') }} <span class="text-slate-300 italic font-serif lowercase">{{ __('campaign.title_accent') }}</span>
                </h3>
            </div>
            <p class="hidden lg:block max-w-xs text-slate-400 text-[11px] font-medium leading-relaxed italic">
                {{ __('campaign.subtitle') }}
            </p>
        </div>

        {{-- Grid Pipih --}}
        <div class="grid grid-cols-1 gap-6">
            @foreach($homeCampaigns as $cp)
            <div class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col md:flex-row h-full md:h-[320px]">

                {{-- Image Area (Pipih) --}}
                <div class="relative w-full md:w-2/5 h-64 md:h-full overflow-hidden bg-slate-100">
                    @if($cp->image)
                        <img src="{{ asset('storage/'.$cp->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    @endif

                    <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest text-[#052c24]">
                        {{ $cp->status == 'active' ? __('campaign.trending') : __('campaign.program') }}
                    </div>
                </div>

                {{-- Content Area (Compact) --}}
                <div class="w-full md:w-3/5 p-8 md:p-10 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="text-xl md:text-2xl font-black text-[#052c24] tracking-tighter uppercase leading-tight group-hover:text-lime-600 transition-colors">
                                {{ $cp->title[$locale] ?? $cp->title['id'] }}
                            </h4>
                            <div class="flex items-center gap-2 bg-slate-50 px-3 py-1 rounded-lg border border-slate-100">
                                <span class="w-2 h-2 bg-lime-500 rounded-full animate-pulse"></span>
                                <span class="text-[8px] font-black uppercase text-slate-400 italic">Yota Verified</span>
                            </div>
                        </div>
                        <p class="text-slate-500 text-xs line-clamp-2 italic mb-6">
                            {{ $cp->description[$locale] ?? $cp->description['id'] }}
                        </p>
                    </div>

                    {{-- Progress & Stats Row --}}
                    <div class="space-y-6">
                        <div class="grid grid-cols-3 gap-4 items-end">
                            <div class="flex flex-col">
                                <span class="text-[8px] font-black text-slate-300 uppercase tracking-widest mb-1">{{ __('campaign.collected') }}</span>
                                <span class="text-sm font-black text-[#052c24] italic">
                                    {{ $locale == 'id' ? 'Rp' : '$' }} {{ number_format($cp->current_amount, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex flex-col border-x border-slate-100 px-4">
                                <span class="text-[8px] font-black text-slate-300 uppercase tracking-widest mb-1">{{ __('campaign.target') }}</span>
                                <span class="text-sm font-bold text-slate-400">
                                    {{ $locale == 'id' ? 'Rp' : '$' }} {{ number_format($cp->target_amount, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-2xl font-black text-lime-500 italic leading-none">{{ $cp->progress_percentage }}%</span>
                            </div>
                        </div>

                        {{-- Action Area --}}
                        <div class="flex items-center gap-4">
                            <div class="flex-grow h-1.5 bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                                <div class="h-full bg-lime-500 rounded-full transition-all duration-1000 ease-out shadow-[0_0_10px_rgba(132,204,22,0.4)]" style="width: {{ $cp->progress_percentage }}%"></div>
                            </div>
                            <a href="{{ route('public.campaign.show', $cp->slug) }}" class="whitespace-nowrap bg-[#052c24] text-[#BEF264] px-8 py-3.5 rounded-2xl font-black text-[9px] uppercase tracking-[0.2em] hover:bg-lime-500 hover:text-[#052c24] transition-all shadow-lg active:scale-95">
                                {{ __('campaign.donate_now') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Partner CTA (Mini Version) --}}
        <div class="mt-12 flex flex-col md:flex-row items-center justify-between p-8 bg-slate-50 rounded-[2rem] border border-slate-100 gap-4">
            <p class="text-slate-400 font-black tracking-widest uppercase text-[9px]">
                {{ __('campaign.partner_tag') }}
            </p>
            <a href="{{ route('public.campaign.index') }}" class="text-[#052c24] font-black text-lg tracking-tighter hover:text-lime-600 transition-all uppercase italic flex items-center gap-3">
                {{ __('campaign.partner_cta') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-lime-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
            </a>
        </div>
    </div>
</section>
