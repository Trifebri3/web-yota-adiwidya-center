@extends('public.layouts.app')

@section('content')
{{-- Load Serif Font untuk Nuansa Akademik --}}
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">

<div class="bg-white min-h-screen font-['Plus_Jakarta_Sans']" x-data="{ lang: 'id' }">
    {{-- Reading Progress Bar --}}
    <div class="fixed top-0 left-0 w-full h-1 bg-slate-100 z-[100]">
        <div class="h-full bg-[#BEF264] transition-all duration-150" id="reading-progress" style="width: 0%"></div>
    </div>

    {{-- Header Section --}}
    <header class="bg-[#F8FAFC] pt-44 pb-20 px-4 border-b border-slate-100 relative overflow-hidden">
        <div class="max-w-5xl mx-auto relative z-10">
            <div class="flex flex-wrap items-center justify-between gap-6 mb-12">
                <a href="{{ route('public.kajianilmiah.index') }}" class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#052c24] transition-all group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    {{ __('scientific_show.back') }}
                </a>

                {{-- Language Switcher Luxury --}}
                <div class="flex bg-slate-200/50 p-1.5 rounded-2xl border border-slate-200">
                    <button @click="lang = 'id'" :class="lang === 'id' ? 'bg-white text-[#052c24] shadow-sm' : 'text-slate-400 hover:text-slate-600'" class="px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all">ID</button>
                    <button @click="lang = 'en'" :class="lang === 'en' ? 'bg-white text-[#052c24] shadow-sm' : 'text-slate-400 hover:text-slate-600'" class="px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all">EN</button>
                </div>
            </div>

            <h1 class="text-4xl md:text-xl font-black text-[#052c24] tracking-tighter leading-[1.1] mb-12 uppercase italic">
                <span x-show="lang === 'id'" x-transition:enter="transition opacity duration-300">{{ $article->title['id'] }}</span>
                <span x-show="lang === 'en'" x-transition:enter="transition opacity duration-300" x-cloak>{{ $article->title['en'] }}</span>
            </h1>

            <div class="flex flex-wrap items-center gap-10 pt-10 border-t border-slate-200">
                <div class="flex items-center gap-5">
                    <div class="flex -space-x-4">
                        @forelse($article->authors as $author)
                            <div class="w-14 h-14 rounded-full bg-[#052c24] border-4 border-[#F8FAFC] flex items-center justify-center font-black text-[#BEF264] text-xs shadow-md transition-transform hover:scale-110 hover:z-10 cursor-help" title="{{ $author->name }}">
                                {{ substr($author->name, 0, 1) }}
                            </div>
                        @empty
                            <div class="w-14 h-14 rounded-full bg-slate-300 border-4 border-[#F8FAFC] flex items-center justify-center font-black text-white text-xs">P</div>
                        @endforelse
                    </div>
                    <div>
                        <p class="text-[#052c24] font-black text-sm leading-tight uppercase tracking-tight">
                            {{ $article->authors->isEmpty() ? 'Scientific Node YOTA' : $article->authors->pluck('name')->implode(', ') }}
                        </p>
                        <p class="text-slate-400 text-[9px] uppercase font-black tracking-widest mt-1 italic">{{ __('scientific_show.corresponding') }}</p>
                    </div>
                </div>

                <div class="hidden md:block w-px h-12 bg-slate-200"></div>

                <div>
                    <p class="text-slate-400 text-[9px] uppercase font-black tracking-widest mb-1">{{ __('scientific_show.published') }}</p>
                    <p class="text-[#052c24] font-bold text-sm uppercase tracking-tighter">{{ $article->published_at->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">

            {{-- Sidebar Navigation --}}
            <aside class="lg:col-span-3 hidden lg:block">
                <div class="sticky top-32 space-y-12">
                    <div>
                        <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-300 mb-8">{{ __('scientific_show.outline') }}</h4>
                        <nav class="space-y-4">
                            @foreach(['Abstract', 'Introduction', 'Methodology', 'Results', 'Discussion', 'Conclusion', 'References'] as $nav)
                            <a href="#{{ strtolower($nav) }}" class="text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-[#052c24] transition-all flex items-center gap-4 group">
                                <span class="w-0 h-px bg-[#BEF264] group-hover:w-6 transition-all"></span>
                                {{ $nav }}
                            </a>
                            @endforeach
                        </nav>
                    </div>

                    @if($article->pdf_version)
                    <div class="pt-10 border-t border-slate-100">
                        <a href="{{ asset('storage/' . $article->pdf_version) }}" target="_blank" class="flex items-center justify-between bg-[#052c24] p-6 rounded-2xl group hover:shadow-2xl hover:shadow-[#052c24]/30 transition-all transform hover:-translate-y-1">
                            <span class="text-white font-black text-[9px] uppercase tracking-[0.2em]">{{ __('scientific_show.full_access') }}</span>
                            <div class="bg-[#BEF264] p-2 rounded-lg text-[#052c24]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                        </a>
                    </div>
                    @endif
                </div>
            </aside>

            {{-- Main Content Body --}}
            <div class="lg:col-span-9 max-w-3xl">
                @php
                    $sections = [
                        'abstract' => 'abstract',
                        'introduction' => 'introduction',
                        'methodology' => 'methodology',
                        'results' => 'results',
                        'discussion' => 'discussion',
                        'conclusion' => 'conclusion',
                        'references' => 'references'
                    ];
                @endphp

                @foreach($sections as $id => $dbField)
                <section id="{{ $id }}" class="mb-32 scroll-mt-40 group">
                    <div class="flex items-center gap-6 mb-10">
                        <span class="text-[12px] font-black text-[#052c24] bg-[#BEF264] w-10 h-10 flex items-center justify-center rounded-xl shadow-sm italic group-hover:rotate-12 transition-transform">0{{ $loop->iteration }}</span>
                        <h2 class="text-2xl font-black text-[#052c24] uppercase italic tracking-tighter">{{ $id }}</h2>
                        <div class="h-px flex-grow bg-slate-100"></div>
                    </div>

                    <div class="prose prose-slate prose-xl max-w-none text-slate-700 leading-[1.8] scientific-body overflow-hidden">
                        <div x-show="lang === 'id'" x-transition:enter="transition opacity duration-500">{!! $article->{$dbField}['id'] !!}</div>
                        <div x-show="lang === 'en'" x-transition:enter="transition opacity duration-500" x-cloak>{!! $article->{$dbField}['en'] !!}</div>
                    </div>
                </section>
                @endforeach

                {{-- Trust Footer --}}
                <footer class="mt-40 p-12 bg-slate-50 rounded-[3rem] border border-slate-100 flex flex-col md:flex-row items-center gap-10">
                    <img src="{{ asset('image/haran-mascot-read.png') }}" class="w-32 h-32 grayscale brightness-110">
                    <div>
                        <h5 class="text-xs font-black text-[#052c24] uppercase tracking-widest mb-3">Arsip Terverifikasi</h5>
                        <p class="text-[11px] text-slate-400 font-medium leading-relaxed max-w-md italic">
                            {{ __('scientific_show.verified') }}
                        </p>
                    </div>
                </footer>
            </div>
        </div>
    </main>
</div>

<script>
    // Reading Progress
    window.onscroll = function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        document.getElementById("reading-progress").style.width = scrolled + "%";
    };
</script>

<style>
    /* Styling Pembersihan Gaya Word & Jurnal Luxury */
    .scientific-body { font-family: 'Merriweather', serif; text-align: justify; }
    .scientific-body * { color: inherit !important; font-size: unset !important; }
    .scientific-body p { margin-bottom: 2.2rem; }
    .scientific-body h3 { color: #052c24 !important; font-weight: 900 !important; text-transform: uppercase !important; font-size: 1.1rem !important; margin-top: 3rem !important; font-family: 'Plus Jakarta Sans', sans-serif !important; }
    .scientific-body blockquote { border-left: 6px solid #BEF264 !important; background: #f8fafc !important; padding: 2.5rem !important; font-style: italic !important; border-radius: 0 2rem 2rem 0 !important; }
    .scientific-body table { border-collapse: collapse; width: 100%; margin: 2rem 0; border: 1px solid #e2e8f0; }
    .scientific-body th, .scientific-body td { border: 1px solid #e2e8f0; padding: 1rem; text-align: left; font-size: 0.9rem !important; font-family: 'Plus Jakarta Sans', sans-serif !important; }
    [x-cloak] { display: none !important; }
</style>
@endsection
