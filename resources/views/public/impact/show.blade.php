@extends('public.layouts.app')

@section('content')
<main x-data="{ lang: '{{ app()->getLocale() }}' }" class="bg-white min-h-screen pt-44 font-['Plus_Jakarta_Sans']">

    <section class="max-w-7xl mx-auto px-6 mb-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div>
                <nav class="mb-10">
                    <a href="{{ route('public.impact.index') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#052c24] flex items-center gap-2 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg> Kembali ke Galeri
                    </a>
                </nav>

                <h1 class="text-6xl md:text-7xl font-black text-[#052c24] tracking-tighter leading-none mb-10 uppercase">
                    {{ $report->title[app()->getLocale()] ?? $report->title['id'] }}
                </h1>

                <div class="prose prose-lg text-slate-500 font-medium leading-relaxed mb-12">
                    {{ $report->description[app()->getLocale()] ?? ($report->description['id'] ?? '') }}
                </div>

                @if($report->pdf_path)
                <a href="{{ $report->pdf_path }}" target="_blank" class="inline-flex items-center gap-4 bg-[#052c24] text-[#BEF264] px-10 py-5 rounded-[2.5rem] font-black uppercase text-xs tracking-[0.2em] hover:shadow-2xl transition-all hover:-translate-y-1">
                    Download Full Report (PDF)
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                </a>
                @endif
            </div>

            <div class="grid grid-cols-2 gap-6 p-10 bg-slate-50 rounded-[4rem] border border-slate-100">
                @foreach($report->stats_data ?? [] as $stat)
                <div class="bg-white p-8 rounded-[3rem] shadow-sm hover:shadow-xl transition-all border border-slate-50 group">
                    <div class="text-4xl font-black text-[#052c24] group-hover:text-lime-500 transition-colors mb-2">{{ $stat['value'] }}</div>
                    <div class="text-[10px] font-black uppercase tracking-widest text-blue-600 mb-2">
                        {{ $stat['label_'.app()->getLocale()] ?? $stat['label_id'] }}
                    </div>
                    <p class="text-[11px] text-slate-400 font-bold leading-tight uppercase tracking-tighter italic">
                        {{ $stat['sub_'.app()->getLocale()] ?? $stat['sub_id'] }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-[#052c24] py-32 text-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-20">
            <div class="space-y-6">
                <span class="text-lime-400 text-[10px] font-black uppercase tracking-[0.4em]">01 / Purpose</span>
                <h3 class="text-2xl font-bold italic font-serif">Tujuan & Sasaran</h3>
                <p class="text-white/60 leading-relaxed">{{ $report->goals[app()->getLocale()] ?? $report->goals['id'] }}</p>
            </div>
            <div class="space-y-6">
                <span class="text-lime-400 text-[10px] font-black uppercase tracking-[0.4em]">02 / Execution</span>
                <h3 class="text-2xl font-bold italic font-serif">Metodologi</h3>
                <p class="text-white/60 leading-relaxed">{{ $report->methodology[app()->getLocale()] ?? $report->methodology['id'] }}</p>
            </div>
            <div class="space-y-6">
                <span class="text-lime-400 text-[10px] font-black uppercase tracking-[0.4em]">03 / Stories</span>
                <h3 class="text-2xl font-bold italic font-serif">Cerita Dampak</h3>
                <div class="space-y-4">
                    @foreach($report->impact_stories ?? [] as $story)
                        <p class="text-white/60 text-sm italic border-l-2 border-lime-500/30 pl-4">
                            "{{ $story[app()->getLocale()] ?? $story['id'] }}"
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
