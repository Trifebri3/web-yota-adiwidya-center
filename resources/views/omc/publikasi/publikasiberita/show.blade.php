@extends('omc.layouts.app')

@section('title', $publication->title[App::getLocale()] . ' - Yota Adiwidya Center')

@section('content')
<article class="bg-[#FDFDFB] min-h-screen pb-32 font-['Plus_Jakarta_Sans']">

    <header class="relative w-full h-[60vh] lg:h-[80vh] overflow-hidden bg-[#064e3b]">
        <img src="{{ asset('storage/' . $publication->banner) }}"
             alt="{{ $publication->title[App::getLocale()] }}"
             class="w-full h-full object-cover opacity-60">

        <div class="absolute inset-0 bg-gradient-to-t from-[#064e3b] via-[#064e3b]/20 to-transparent"></div>

        <div class="absolute bottom-0 left-0 w-full p-6 lg:p-20 z-10">
            <div class="max-w-5xl mx-auto">
                <div class="flex flex-wrap items-center gap-4 mb-8">
                    <span class="px-4 py-1.5 bg-lime-500 text-[#064e3b] text-[10px] font-black uppercase tracking-[0.2em] rounded-full">
                        {{ strtoupper($publication->type) }}
                    </span>
                    <span class="text-white/60 text-xs font-bold uppercase tracking-widest">
                        {{ \Carbon\Carbon::parse($publication->published_at)->translatedFormat('d F Y') }}
                    </span>
                    <span class="text-white/40 text-xs font-medium uppercase tracking-widest">
                        BY {{ $publication->author }}
                    </span>
                </div>

                <h1 class="text-4xl md:text-7xl font-black text-white leading-[0.95] tracking-tighter mb-6">
                    {{ $publication->title[App::getLocale()] }}
                </h1>

                <p class="text-xl md:text-2xl text-slate-300 font-light leading-relaxed max-w-3xl italic">
                    {{ $publication->description[App::getLocale()] }}
                </p>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 mt-20">
        <div class="grid lg:grid-cols-12 gap-20">

            <aside class="lg:col-span-1 hidden lg:block">
                <div class="sticky top-32 space-y-8 flex flex-col items-center border-r border-slate-100 pr-8">
                    <p class="text-[9px] font-black text-slate-400 uppercase vertical-text tracking-[0.3em] mb-4">SHARE</p>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-[#064e3b] hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764z"/></svg>
                    </a>
                    <button onclick="window.print()" class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-lime-500 hover:text-[#064e3b] transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    </button>
                </div>
            </aside>

            <div class="lg:col-span-8">
                <div class="prose prose-xl prose-slate max-w-none
                            prose-headings:font-black prose-headings:text-[#064e3b] prose-headings:tracking-tighter
                            prose-p:leading-relaxed prose-p:text-slate-600 prose-p:font-light
                            prose-strong:text-[#064e3b] prose-strong:font-bold
                            prose-img:rounded-[2rem] prose-img:shadow-2xl">
                    {!! $publication->content[App::getLocale()] !!}
                </div>

                @if($publication->pdf_file)
                <div class="mt-20 p-10 bg-[#064e3b] rounded-[3rem] text-white flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-lime-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold">{{ __('publication.download_title') }}</h4>
                            <p class="text-slate-400 text-sm italic">{{ __('publication.download_desc') }}</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $publication->pdf_file) }}"
                       target="_blank"
                       class="bg-lime-500 text-[#064e3b] px-10 py-5 rounded-2xl font-black text-xs tracking-widest uppercase hover:bg-white transition-all shadow-xl shadow-lime-500/20">
                       Download PDF
                    </a>
                </div>
                @endif
            </div>

            <aside class="lg:col-span-3 space-y-12">
                <div class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 text-center">
                    <img src="{{ asset('image/haran-mascot-read.png') }}" class="w-24 h-24 mx-auto mb-4 drop-shadow-xl" alt="Haran Reading">
                    <h5 class="text-sm font-black text-[#064e3b] uppercase tracking-widest mb-2 italic">Verified by Haran</h5>
                    <p class="text-[10px] text-slate-400 leading-relaxed font-medium">
                        Artikel ini telah melalui kurasi internal untuk memastikan akurasi data dan integritas narasi.
                    </p>
                </div>

                <div class="pt-8 border-t border-slate-100">
                    <a href="{{ route('omc.index') }}" class="flex items-center gap-4 group">
                        <div class="w-12 h-12 rounded-full border border-slate-200 flex items-center justify-center group-hover:bg-[#064e3b] group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </div>
                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest group-hover:text-[#064e3b] transition-colors">Back to Publications</span>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</article>

<style>
    .vertical-text {
        writing-mode: vertical-rl;
    }
</style>
@endsection
