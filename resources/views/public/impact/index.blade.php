@extends('public.layouts.app')

@section('content')
<main class="bg-[#FDFDFB] min-h-screen pt-44 pb-32 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-6">

        {{-- 1. HERO & COUNTER (Hemat Ruang) --}}
        <header class="grid lg:grid-cols-2 gap-16 items-center mb-24">
            <div>
                <h2 class="text-xs font-black uppercase tracking-[0.5em] text-lime-600 mb-6">{{ __('impact.intelligence_tag') }}</h2>
                <h1 class="text-6xl md:text-7xl font-black text-[#052c24] leading-[0.85] tracking-tighter uppercase mb-10 italic">
                    {{ __('impact.hero_title') }} <br><span class="text-slate-300 not-italic">{{ __('impact.hero_subtitle') }}</span>
                </h1>
                <p class="text-xl text-slate-500 font-medium leading-relaxed max-w-xl">
                    {{ __('impact.hero_description') }}
                </p>
            </div>

            {{-- Grid Counter (Top 4) --}}
            <div class="grid grid-cols-2 gap-4">
                @foreach($globalStats as $stat)
                <div class="p-8 bg-[#052c24] rounded-[2.5rem] group hover:bg-lime-400 transition-all duration-500 shadow-xl shadow-[#052c24]/20">
                    <div class="text-4xl font-black text-lime-400 group-hover:text-[#052c24] transition-colors mb-2 tracking-tighter">
                        {{ number_format($stat['value'], 0, ',', '.') }}<span class="text-[0.6em] ml-1 opacity-80">{{ $stat['symbol'] }}</span>
                    </div>
                    <div class="text-[9px] font-black uppercase tracking-widest text-white/40 group-hover:text-[#052c24]/60">
                        {{ $stat['label_'.app()->getLocale()] ?? $stat['label_id'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </header>

        {{-- 2. ANALYTICS & TABLE (Dashboard Style) --}}
        <div class="grid lg:grid-cols-12 gap-8 mb-32 items-start">

            {{-- Distribusi (Chart) --}}
            <div class="lg:col-span-4 bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                <h3 class="text-sm font-black text-[#052c24] uppercase tracking-widest mb-10">{{ __('impact.distribution_title') }}</h3>
                <div class="relative w-full aspect-square mx-auto">
                    <canvas id="categoryChart"></canvas>
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-4xl font-black text-[#052c24]">{{ $totalCount }}</span>
                        <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Reports</span>
                    </div>
                </div>
            </div>

            {{-- Tabel Rekapitulasi (SEMUA DATA) --}}
            <div class="lg:col-span-8 bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col h-full">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                    <h3 class="text-xs font-black text-[#052c24] uppercase tracking-widest">Global Aggregate Measurement</h3>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-lime-500 rounded-full animate-pulse"></span>
                        <span class="text-[9px] font-black text-slate-400 uppercase italic">Live Data</span>
                    </div>
                </div>
                <div class="overflow-y-auto max-h-[450px] no-scrollbar">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-slate-50">
                            @foreach($tableStats as $stat)
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="text-sm font-black text-[#052c24] uppercase group-hover:text-lime-600">
                                        {{ $stat['label_'.app()->getLocale()] ?? $stat['label_id'] }}
                                    </div>
                                    <div class="text-[9px] text-slate-400 font-bold uppercase tracking-widest opacity-60">
                                        {{ $stat['sub_id'] ?: 'Verified Metric' }}
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <span class="text-2xl font-black text-[#052c24] tracking-tighter">
                                        {{ number_format($stat['value'], 0, ',', '.') }}<span class="text-lime-500 ml-0.5">{{ $stat['symbol'] }}</span>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- Footer Tabel --}}
                <div class="mt-auto p-6 bg-slate-50/50 border-t border-slate-100 flex justify-between items-center">
                    <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest">
                        Verified by Haran AI Audit Trail
                    </p>
                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Total: {{ $tableStats->count() }} Metrics</span>
                </div>
            </div>
        </div>
        {{-- 3. THE REPOSITORY: DOCUMENT GALLERY --}}
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <h3 class="text-3xl font-black text-[#052c24] uppercase tracking-tighter">
                {{ __('impact.repository_title') }} <span class="text-lime-500">.</span>
            </h3>
            <div class="flex items-center gap-4">
                <form action="{{ route('public.impact.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="bg-white border border-slate-100 rounded-2xl px-6 py-3 text-[10px] font-bold uppercase tracking-widest w-64 focus:ring-2 focus:ring-lime-500 outline-none transition-all shadow-sm"
                           placeholder="{{ __('impact.search_placeholder') }}">
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach($reports as $report)
            <article class="group bg-white rounded-[3.5rem] overflow-hidden border border-slate-50 shadow-sm hover:shadow-2xl transition-all duration-700 flex flex-col h-full">
                <a href="{{ route('public.impact.show', $report->slug) }}" class="block relative aspect-[4/5] overflow-hidden bg-slate-100">
                    @if($report->cover_image)
                        <img src="{{ asset('storage/'.$report->cover_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-[#052c24] via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-10">
                        <p class="text-lime-400 text-xs font-black uppercase tracking-[0.2em] transform translate-y-4 group-hover:translate-y-0 transition-transform">
                            Open Audit Report —→
                        </p>
                    </div>

                    <div class="absolute top-8 left-8">
                        <span class="px-5 py-2 bg-white/90 backdrop-blur rounded-full text-[9px] font-black uppercase tracking-widest text-[#052c24] shadow-xl">
                            {{ __('impact.categories.'.$report->category) }}
                        </span>
                    </div>
                </a>

                <div class="p-10 flex flex-col flex-grow">
                    <h3 class="text-2xl font-black text-[#052c24] leading-[1.1] mb-5 group-hover:text-lime-600 transition-colors">
                        {{ $report->title[app()->getLocale()] ?? $report->title['id'] }}
                    </h3>
                    <p class="text-slate-500 text-sm line-clamp-3 mb-10 font-medium leading-relaxed italic">
                        {{ $report->description[app()->getLocale()] ?? ($report->description['id'] ?? '') }}
                    </p>

                    <div class="mt-auto pt-8 border-t border-slate-50 flex items-center justify-between">
                        <div>
                            <span class="block text-[8px] font-black text-slate-300 uppercase tracking-widest mb-1">Impact Scale</span>
                            <span class="text-[10px] font-black text-[#052c24] uppercase tracking-tighter italic">{{ $report->province }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-lime-500 rounded-full animate-pulse"></span>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $report->published_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="mt-20 pt-10 border-t border-slate-100">
            {{ $reports->links() }}
        </div>
    </div>
</main>

{{-- Chart.js Integration --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($categoryDist->pluck('label')) !!},
            datasets: [{
                data: {!! json_encode($categoryDist->pluck('total')) !!},
                backgroundColor: {!! json_encode($categoryDist->pluck('color')) !!},
                borderWidth: 8,
                borderColor: '#ffffff',
                hoverOffset: 20
            }]
        },
        options: {
            cutout: '85%',
            plugins: { legend: { display: false } },
            animation: { animateScale: true }
        }
    });
</script>
@endsection
