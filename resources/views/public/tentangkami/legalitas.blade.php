@extends('public.layouts.app')
@section('title', 'legalitas kami | Yota adiwidya center')

@section('content')


<section class="bg-white py-32 relative overflow-hidden font-['Plus_Jakarta_Sans']">
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#064e3b 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">

        <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
            <div class="max-w-2xl text-left">
                <span class="inline-block px-4 py-1.5 rounded-full bg-slate-100 text-[#064e3b] text-[10px] font-black tracking-[0.3em] uppercase mb-6">
                    Trust & Governance
                </span>
                <h2 class="text-5xl md:text-6xl font-black text-[#064e3b] leading-tight tracking-tighter">
                    {{ __('legality.title') }}
                </h2>
                <p class="mt-6 text-slate-500 text-lg font-light leading-relaxed">
                    {{ __('legality.subtitle') }}
                </p>
            </div>
            <div class="pb-2">
                <div class="flex items-center gap-4 px-6 py-4 bg-lime-50 rounded-2xl border border-lime-100">
                    <div class="w-3 h-3 bg-lime-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-black text-[#064e3b] uppercase tracking-widest">{{ __('legality.status_value') }}</span>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-12 gap-8">

            <div class="lg:col-span-8 space-y-8">
                <div class="bg-[#064e3b] rounded-[3rem] p-10 lg:p-14 text-white shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 -rotate-45 translate-x-20 -translate-y-20"></div>

                    <h3 class="text-2xl font-bold mb-10 flex items-center gap-4">
                        <svg class="w-6 h-6 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04Cover1.764 1.764 0 00-6.138 6.138c0 5.117 3.38 9.444 8.006 10.824a1.994 1.994 0 001.494 0c4.627-1.38 8.006-5.707 8.006-10.824a1.764 1.764 0 00-6.138-6.138z"/></svg>
                        {{ __('legality.sections.identity.title') }}
                    </h3>

                    <div class="grid md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="border-b border-white/10 pb-4">
                            <p class="text-[10px] font-black text-lime-400 uppercase tracking-widest mb-2">{{ __('legality.sections.identity.deed') }}</p>
                            <p class="text-lg font-medium">No. 03.-</p>
                        </div>
                        <div class="border-b border-white/10 pb-4">
                            <p class="text-[10px] font-black text-lime-400 uppercase tracking-widest mb-2">{{ __('legality.sections.identity.kemenkumham') }}</p>
                            <p class="text-lg font-medium">AHU-0038112.AH.01.12.Tahun 2025</p>
                        </div>
                        <div class="border-b border-white/10 pb-4">
                            <p class="text-[10px] font-black text-lime-400 uppercase tracking-widest mb-2">{{ __('legality.sections.identity.npwp') }}</p>
                            <p class="text-lg font-medium">1000.XXXX.XXXX.6081</p>
                        </div>
                        <div class="border-b border-white/10 pb-4">
                            <p class="text-[10px] font-black text-lime-400 uppercase tracking-widest mb-2">{{ __('legality.sections.identity.domicile') }}</p>
                            <p class="text-lg font-medium">Baleendah, Kab. Bandung</p>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 rounded-[3rem] p-10 lg:p-14 border border-slate-100">
                    <h3 class="text-2xl font-bold text-[#064e3b] mb-10">{{ __('legality.sections.financial.title') }}</h3>
                    <div class="flex flex-col md:flex-row gap-12 items-center">
                        <div class="flex-grow space-y-6">
                            <div class="flex justify-between items-end">
                                <span class="text-slate-400 text-sm font-medium">{{ __('legality.sections.financial.bank') }}</span>
                                <span class="text-[#064e3b] font-black italic">Bank Rakyak Indonesia (BRI) (Official)</span>
                            </div>
@php
    $accNumber = "0895 01 000053 56 3";
    $masked = substr($accNumber, 0, 4) . str_repeat('*', strlen($accNumber) - 8) . substr($accNumber, -4);
@endphp

<div class="p-6 bg-white rounded-2xl shadow-sm border border-slate-100 flex justify-between items-center">
    <div>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">
            {{ __('legality.sections.financial.acc_number') }}
        </p>
        <p class="text-2xl font-black text-[#064e3b] tracking-tighter select-all">
            {{ $masked }}
        </p>
    </div>
    <button onclick="navigator.clipboard.writeText('{{ $accNumber }}')" 
            class="p-3 hover:bg-lime-100 rounded-xl transition-colors text-lime-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V21a2 2 0 01-2 2h-6a2 2 0 01-2-2v-2"/>
        </svg>
    </button>
</div>
                            <p class="text-sm font-bold text-slate-500 uppercase tracking-widest text-center italic">An. YAYASAN YOTA WUJUDKAN ASA</p>
                        </div>
                        <div class="w-full md:w-1/3 p-8 bg-lime-50 rounded-[2.5rem] text-center border border-lime-100">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <h4 class="text-sm font-black text-[#064e3b] uppercase mb-2">Audit Status</h4>
                            <p class="text-xs text-lime-700 font-bold tracking-widest uppercase">Under Independent Review 2026</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8">
                <div class="p-8 bg-white border border-slate-100 rounded-[3rem] shadow-xl">
                    <h4 class="text-lg font-black text-[#064e3b] mb-8 uppercase tracking-widest">{{ __('legality.download_label') }}</h4>
                    <ul class="space-y-4">
                        @php $docs = ['SKT Kemenkumham', 'Laporan Keuangan 2025']; @endphp
                        @foreach($docs as $doc)
                        <li class="group">
                            <a href="https://drive.google.com/file/d/1wAqTOQuKDsdAvR4LJQvqTocaK6og7AcN/view?usp=sharing" class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 group-hover:bg-[#064e3b] group-hover:text-white transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <svg class="w-5 h-5 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    <span class="text-sm font-bold">{{ $doc }}</span>
                                </div>
                                <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="p-8 bg-[#064e3b] text-white rounded-[3rem] relative overflow-hidden">
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-lime-500 opacity-20 blur-2xl"></div>
                    <h4 class="text-sm font-black uppercase tracking-[0.3em] mb-8 text-lime-400">{{ __('legality.sections.commitment.title') }}</h4>
                    <ul class="space-y-6">
                        <li class="flex gap-4">
                            <span class="text-lime-500 font-black">/</span>
                            <p class="text-xs text-slate-300 leading-relaxed">{{ __('legality.sections.commitment.item_1') }}</p>
                        </li>
                        <li class="flex gap-4">
                            <span class="text-lime-500 font-black">/</span>
                            <p class="text-xs text-slate-300 leading-relaxed">{{ __('legality.sections.commitment.item_2') }}</p>
                        </li>
                        <li class="flex gap-4">
                            <span class="text-lime-500 font-black">/</span>
                            <p class="text-xs text-slate-300 leading-relaxed">{{ __('legality.sections.commitment.item_3') }}</p>
                        </li>
                    </ul>
                </div>

                <div class="text-center pt-8">
                    <img src="{{ asset('image/verifikasi.png') }}" class="w-32 h-32 mx-auto drop-shadow-2xl" alt="Haran Verified">
                    <p class="mt-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Public Accountability Guaranteed</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
