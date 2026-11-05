@php
    // Rekapitulasi Data Publikasi & Media
    $totalCampaigns = \App\Models\Campaign::count();
    $activeCampaigns = \App\Models\Campaign::where('status', 'active')->count();

    $totalDonations = \App\Models\Donation::paid()->sum('amount');
    $totalDonors = \App\Models\Donation::paid()->count();

    $totalScientific = \App\Models\ScientificArticle::where('is_verified', true)->count();
    $totalDocs = \App\Models\DocPublication::verified()->count();
    $totalImpacts = \App\Models\ImpactReport::where('is_verified', true)->count();

    // Data Trending (Publication)
    $trendingNews = \App\Models\Publication::trending()->take(5)->get();

    // Engagement Media
    $totalViews = \App\Models\Publication::sum('views');
    $totalShares = \App\Models\Publication::sum('shares');
@endphp

@extends('omc.layouts.app')

@section('content')
<div class="p-8 bg-[#FDFDFB] min-h-screen">
    <div class="mb-8">
        <h1 class="text-4xl font-black text-[#064e3b] uppercase tracking-tighter italic font-serif">OMC <span class="not-italic font-sans text-slate-400 font-light">Insight Center</span></h1>
        <p class="text-slate-500">Rekapitulasi performa publikasi, donasi, dan jangkauan media secara real-time.</p>
    </div>

    {{-- QUICK ACTIONS LAUNCHER --}}
    <div class="bg-[#064e3b] rounded-3xl p-6 mb-8 text-white shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-[#bef264]"></span>
                <span class="text-[11px] font-black uppercase tracking-widest text-[#bef264]">Aksi Cepat & Smart Publishing</span>
            </div>
            <span class="text-[10px] font-mono text-white/60">OMC CONTENT ENGINE</span>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
            <a href="{{ route('omc.quick_publish.index') }}" class="p-3 bg-[#bef264] text-[#064e3b] rounded-2xl font-black text-xs uppercase tracking-tight flex items-center justify-between hover:scale-105 transition-transform">
                <span>Smart Publish</span>
                <span>→</span>
            </a>
            <a href="{{ route('omc.create') }}" class="p-3 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl font-bold text-xs uppercase tracking-tight flex items-center justify-between transition-colors">
                <span>Tulis Berita</span>
                <span>+</span>
            </a>
            <a href="{{ route('omc.programs.create') }}" class="p-3 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl font-bold text-xs uppercase tracking-tight flex items-center justify-between transition-colors">
                <span>Program Baru</span>
                <span>+</span>
            </a>
            <a href="{{ route('omc.hero-slides.index') }}" class="p-3 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl font-bold text-xs uppercase tracking-tight flex items-center justify-between transition-colors">
                <span>Hero Slider</span>
                <span>⚙</span>
            </a>
            <a href="{{ route('omc.docs.index') }}" class="p-3 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl font-bold text-xs uppercase tracking-tight flex items-center justify-between transition-colors">
                <span>Buku & Riset</span>
                <span>📚</span>
            </a>
            <a href="{{ route('omc.impact.index') }}" class="p-3 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl font-bold text-xs uppercase tracking-tight flex items-center justify-between transition-colors">
                <span>Laporan Dampak</span>
                <span>📊</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100">
            <span class="text-[10px] font-black text-lime-600 uppercase tracking-widest block mb-2">Total Donasi Lunas</span>
            <h2 class="text-3xl font-black text-[#064e3b]">Rp {{ number_format($totalDonations, 0, ',', '.') }}</h2>
            <p class="text-[10px] text-slate-400 mt-1">Dari {{ $totalDonors }} transaksi sukses</p>
        </div>
        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Kampanye Aktif</span>
            <h2 class="text-3xl font-black text-[#064e3b]">{{ $activeCampaigns }} <span class="text-sm font-normal text-slate-400">/ {{ $totalCampaigns }}</span></h2>
        </div>
        <div class="bg-[#064e3b] p-6 rounded-[2.5rem] shadow-xl text-white">
            <span class="text-[10px] font-black text-lime-400 uppercase tracking-widest block mb-2">Total Views Publikasi</span>
            <h2 class="text-3xl font-black">{{ number_format($totalViews, 0, ',', '.') }}</h2>
            <p class="text-[10px] text-white/50 mt-1">Jangkauan pembaca organik</p>
        </div>
        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Total Shares</span>
            <h2 class="text-3xl font-black text-[#064e3b]">{{ number_format($totalShares, 0, ',', '.') }}</h2>
        </div>
    </div>

@include('partials.birthday_alert')


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100">
                <h3 class="text-lg font-black text-[#064e3b] uppercase mb-6 flex items-center gap-3">
                    <span class="w-2 h-6 bg-lime-500 rounded-full"></span>
                    Library & Riset Update
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                    <div class="p-6 bg-slate-50 rounded-[2rem]">
                        <h4 class="text-2xl font-black text-[#064e3b]">{{ $totalScientific }}</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Artikel Ilmiah</p>
                    </div>
                    <div class="p-6 bg-slate-50 rounded-[2rem]">
                        <h4 class="text-2xl font-black text-[#064e3b]">{{ $totalDocs }}</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Publikasi Resmi</p>
                    </div>
                    <div class="p-6 bg-slate-50 rounded-[2rem]">
                        <h4 class="text-2xl font-black text-[#064e3b]">{{ $totalImpacts }}</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Laporan Dampak</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100">
                <h3 class="text-lg font-black text-[#064e3b] uppercase mb-6 flex items-center gap-3">
                    <span class="w-2 h-6 bg-[#064e3b] rounded-full"></span>
                    Trending News (Top Views)
                </h3>
                <div class="space-y-4">
                    @foreach($trendingNews as $news)
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl hover:bg-lime-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <span class="w-8 h-8 bg-white rounded-full flex items-center justify-center font-black text-xs text-[#064e3b] shadow-sm">{{ $loop->iteration }}</span>
                            <div>
                                <h4 class="text-sm font-bold text-[#064e3b]">{{ $news->translated_title }}</h4>
                                <span class="text-[9px] text-slate-400 uppercase tracking-widest">{{ $news->published_at->format('d M Y') }}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-black text-[#064e3b]">{{ number_format($news->views) }}</span>
                            <span class="block text-[8px] text-slate-400 uppercase font-black">Views</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-lime-400 p-8 rounded-[3rem] shadow-xl shadow-lime-200">
                <h3 class="text-xl font-black text-[#064e3b] uppercase tracking-tighter leading-none mb-4">Butuh Verifikasi <br><span class="text-3xl font-serif italic">Konten?</span></h3>
                <p class="text-[#064e3b]/70 text-sm mb-6 font-medium">Periksa naskah masuk dari Kabid sebelum dipublikasikan ke publik.</p>
                <a href="#" class="inline-block bg-[#064e3b] text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-white hover:text-[#064e3b] transition-all shadow-lg">Buka Antrean Verifikasi</a>
            </div>

            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100">
                <h3 class="text-sm font-black text-[#064e3b] uppercase mb-6 tracking-widest">Global Impact Stats</h3>
                @php $globalStats = \App\Models\ImpactReport::getGlobalStatistics(); @endphp
                <div class="space-y-6">
                    @foreach($globalStats->take(4) as $stat)
                    <div>
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-[10px] font-bold text-slate-400 uppercase">{{ $stat['label_id'] }}</span>
                            <span class="text-sm font-black text-[#064e3b]">{{ number_format($stat['value']) }}{{ $stat['symbol'] }}</span>
                        </div>
                        <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-lime-500 rounded-full" style="width: {{ rand(40, 90) }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


@include('partials.birthday-calendar')

@endsection
