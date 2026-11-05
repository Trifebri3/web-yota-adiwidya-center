@extends('public.layouts.app')

@section('content')
<div class="bg-[#F8FAFC] min-h-screen font-['Plus_Jakarta_Sans']" x-data="{ openFilter: false }">
    <section class="bg-[#052c24] pt-44 pb-32 px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0\' 0 \'60\' 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23BEF264\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="max-w-4xl mx-auto text-center relative z-10">
            <h1 class="text-4xl md:text-6xl font-black text-white tracking-tighter mb-6 uppercase italic">
                Scientific <span class="text-[#BEF264]">{{ __('scientific.hero_title') }}</span>
            </h1>
            <p class="text-white/70 text-lg mb-12 font-medium max-w-2xl mx-auto leading-relaxed">
                {{ __('scientific.hero_subtitle') }}
            </p>

            <form action="{{ route('public.kajianilmiah.index') }}" method="GET" class="relative max-w-2xl mx-auto">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full bg-white/10 border border-white/20 rounded-3xl py-6 px-8 text-white placeholder:text-white/40 focus:ring-4 focus:ring-[#BEF264]/20 focus:bg-white/20 transition-all backdrop-blur-md outline-none"
                    placeholder="{{ __('scientific.search_placeholder') }}">
                <button type="submit" class="absolute right-3 top-3 bg-[#BEF264] text-[#052c24] px-6 py-3 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:scale-95 transition-all">
                    Search
                </button>
            </form>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 -mt-8 relative z-20">
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-4 flex flex-wrap items-center justify-between gap-4 border border-slate-100">
            <div class="flex items-center gap-4">
                <button @click="openFilter = !openFilter" class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-50 text-[#052c24] font-black text-[10px] uppercase tracking-widest hover:bg-slate-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    {{ __('scientific.filter_label') }}
                </button>
                @if(request('search') || request('sort'))
                    <a href="{{ route('public.kajianilmiah.index') }}" class="text-[9px] font-black text-red-500 uppercase tracking-widest hover:underline">
                        {{ __('scientific.reset_filter') }}
                    </a>
                @endif
            </div>

            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                {{ __('scientific.results_count', ['count' => $articles->total()]) }}
            </p>
        </div>

        <div x-show="openFilter" x-transition class="mt-4 bg-white rounded-3xl p-8 shadow-xl border border-slate-100" x-cloak>
            <form action="{{ route('public.kajianilmiah.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">{{ __('scientific.sort_by') }}</label>
                    <select name="sort" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#BEF264]">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>{{ __('scientific.sort_latest') }}</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ __('scientific.sort_oldest') }}</option>
                        <option value="alphabetical" {{ request('sort') == 'alphabetical' ? 'selected' : '' }}>{{ __('scientific.sort_az') }}</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-[#052c24] text-white py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-[#BEF264] hover:text-[#052c24] transition-all">
                        {{ __('scientific.apply_filter') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($articles as $art)
            <article class="group bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 flex flex-col h-full relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#BEF264]/5 rounded-full blur-3xl transition-all group-hover:bg-[#BEF264]/20"></div>

                <div class="flex items-center justify-between mb-8 relative z-10">
                    <span class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-400">
                        {{ $art->published_at->format('M d, Y') }}
                    </span>
                    <span class="px-4 py-1.5 bg-[#BEF264]/10 text-[#052c24] text-[9px] font-black uppercase tracking-widest rounded-full border border-[#BEF264]/20">
                        {{ __('scientific.badge_label') }}
                    </span>
                </div>

                <h2 class="text-xl font-black text-[#052c24] leading-tight mb-6 group-hover:text-[#064e3b] transition-colors relative z-10">
                    <a href="{{ route('public.kajianilmiah.show', $art->slug) }}">
                        {{ $art->title[App::getLocale()] ?? $art->title['id'] }}
                    </a>
                </h2>

                <div class="mt-auto pt-8 border-t border-slate-50 flex flex-col gap-4 relative z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-black text-[#052c24] border border-slate-200 shadow-inner">
                            {{ $art->authors->count() > 0 ? substr($art->authors->first()->name, 0, 1) : 'P' }}
                        </div>
                        <div>
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-0.5">{{ __('scientific.published_by') }}</p>
                            <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">
                                {{ $art->authors->count() > 0 ? $art->authors->first()->name . ($art->authors->count() > 1 ? ' et al.' : '') : 'Official Media Center' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-end opacity-0 group-hover:opacity-100 transition-all transform translate-x-4 group-hover:translate-x-0">
                        <div class="w-10 h-10 bg-[#052c24] rounded-full flex items-center justify-center text-[#BEF264] shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full py-40 text-center">
                <img src="{{ asset('image/haran-mascot-lost.png') }}" class="w-32 h-32 mx-auto mb-6 opacity-20 grayscale">
                <p class="text-slate-400 font-black uppercase tracking-[0.4em]">{{ __('scientific.no_results') }}</p>
            </div>
            @endforelse
        </div>

        <div class="mt-20">
            {{ $articles->links() }}
        </div>
    </main>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
