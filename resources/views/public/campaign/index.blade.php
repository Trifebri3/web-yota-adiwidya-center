@extends('public.layouts.app')

@section('content')
<main class="bg-white min-h-screen pt-44 pb-32 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-6">
        <header class="max-w-2xl mb-20">
            <h2 class="text-xs font-black uppercase tracking-[0.5em] text-lime-600 mb-6">Crowdfunding</h2>
            <h1 class="text-6xl font-black text-[#052c24] leading-[0.85] tracking-tighter uppercase mb-6">
                Wujudkan <br><span class="italic font-serif text-slate-400 lowercase">perubahan nyata.</span>
            </h1>
            <p class="text-slate-500 font-medium italic">Pilih inisiatif yang ingin Anda dukung dan pantau dampaknya secara transparan.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach($campaigns as $cp)
            <div class="group bg-white rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col hover:-translate-y-2 transition-all duration-500">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('storage/'.$cp->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-6 left-6">
                        <span class="px-4 py-2 bg-white/90 backdrop-blur text-[#052c24] text-[10px] font-black uppercase tracking-widest rounded-full shadow-lg">
                            {{ $cp->days_left }} Hari Lagi
                        </span>
                    </div>
                </div>

                <div class="p-10 flex-1 flex flex-col">
                    <h3 class="text-2xl font-black text-[#052c24] mb-6 leading-tight group-hover:text-lime-600 transition-colors">
                        {{ $cp->title[app()->getLocale()] ?? $cp->title['id'] }}
                    </h3>

                    <div class="mt-auto space-y-4">
                        <div class="flex justify-between items-end">
                            <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Terkumpul</span>
                            <span class="text-xl font-black text-[#052c24]">{{ $cp->progress_percentage }}%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-lime-500" style="width: {{ $cp->progress_percentage }}%"></div>
                        </div>
                        <div class="flex justify-between font-bold text-xs text-slate-500">
                            <span>Rp {{ number_format($cp->current_amount, 0, ',', '.') }}</span>
                            <span>Target: Rp {{ number_format($cp->target_amount, 0, ',', '.') }}</span>
                        </div>

                        <a href="{{ route('public.campaign.show', $cp->slug) }}" class="block w-full text-center py-4 bg-[#052c24] text-[#BEF264] rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-lime-500 hover:text-[#052c24] transition-all">
                            Donasi Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
