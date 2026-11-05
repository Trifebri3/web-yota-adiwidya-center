@extends('omc.layouts.app')

@section('content')
<div class="bg-white min-h-screen font-['Plus_Jakarta_Sans']" x-data="{ lang: 'id' }">
    <header class="bg-[#052c24] pt-40 pb-20 px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(#BEF264 1px, transparent 1px); background-size: 20px 20px;"></div>
        </div>

        <div class="max-w-5xl mx-auto relative z-10">
            <div class="flex gap-2 mb-8 bg-white/5 p-1 rounded-xl w-fit border border-white/10">
                <button @click="lang = 'id'" :class="lang === 'id' ? 'bg-[#BEF264] text-[#052c24]' : 'text-white/60'" class="px-5 py-2 rounded-lg text-[9px] font-black uppercase tracking-widest transition-all">Indonesia</button>
                <button @click="lang = 'en'" :class="lang === 'en' ? 'bg-[#BEF264] text-[#052c24]' : 'text-white/60'" class="px-5 py-2 rounded-lg text-[9px] font-black uppercase tracking-widest transition-all">English</button>
            </div>

            <h1 class="text-3xl md:text-6xl font-black text-white tracking-tighter leading-[1.1] mb-10 uppercase">
                <span x-show="lang === 'id'">{{ $article->title['id'] }}</span>
                <span x-show="lang === 'en'">{{ $article->title['en'] }}</span>
            </h1>

            <div class="flex flex-wrap items-center gap-8 pt-8 border-t border-white/10">
                <div class="flex items-center gap-4">
                    <div class="flex -space-x-3">
                        @forelse($article->authors as $author)
                            <div class="w-12 h-12 rounded-full bg-[#BEF264] border-4 border-[#052c24] flex items-center justify-center font-black text-[#052c24] text-sm shadow-xl" title="{{ $author->name }}">
                                {{ substr($author->name, 0, 1) }}
                            </div>
                        @empty
                            <div class="w-12 h-12 rounded-full bg-slate-700 border-4 border-[#052c24] flex items-center justify-center font-black text-white text-sm">
                                P
                            </div>
                        @endforelse
                    </div>
                    <div>
                        <p class="text-white font-bold text-sm leading-tight">
                            {{ $article->authors->isEmpty() ? 'Pusat Informasi dan Komunikasi' : $article->authors->pluck('name')->implode(', ') }}
                        </p>
                        <p class="text-[#BEF264] text-[10px] uppercase font-black tracking-widest mt-1">
                            {{ $article->authors->isEmpty() ? 'Official Institution' : 'Lead Authors' }}
                        </p>
                    </div>
                </div>

                <div class="h-10 w-px bg-white/10 hidden md:block"></div>
                <div>
                    <p class="text-white/40 text-[9px] uppercase font-black tracking-[0.2em] mb-1">Published At</p>
                    <p class="text-white font-bold text-sm">{{ $article->published_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <div class="lg:col-span-4 order-2 lg:order-1">
                <div class="sticky top-10 flex flex-col gap-6">
                    @if($article->pdf_version)
                    <a href="{{ asset('storage/' . $article->pdf_version) }}" target="_blank" class="flex items-center justify-between bg-[#052c24] p-6 rounded-3xl group hover:bg-[#BEF264] transition-all shadow-xl shadow-slate-200">
                        <span class="text-white group-hover:text-[#052c24] font-black text-xs uppercase tracking-widest">Download Full PDF</span>
                        <svg class="w-6 h-6 text-[#BEF264] group-hover:text-[#052c24]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </a>
                    @endif

                    <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6">Table of Contents</h3>
                        <ul class="flex flex-col gap-4">
                            @foreach(['Abstract', 'Introduction', 'Methodology', 'Results', 'Discussion', 'Conclusion', 'References'] as $nav)
                            <li><a href="#{{ strtolower($nav) }}" class="text-sm font-bold text-[#052c24] hover:text-[#BEF264] transition-colors tracking-tight">{{ $nav }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 order-1 lg:order-2 prose prose-slate max-w-none">
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
                <section id="{{ $id }}" class="mb-16 scroll-mt-10">
                    <h2 class="text-xs font-black uppercase tracking-[0.3em] text-[#052c24] mb-6 flex items-center gap-3">
                        <span class="w-8 h-px bg-[#BEF264]"></span>
                        {{ ucfirst($id) }}
                    </h2>
                    <div class="text-slate-600 leading-relaxed text-lg font-medium scientific-content">
                        <div x-show="lang === 'id'">{!! $article->{$dbField}['id'] !!}</div>
                        <div x-show="lang === 'en'">{!! $article->{$dbField}['en'] !!}</div>
                    </div>
                </section>
                @endforeach
            </div>
        </div>
    </main>
</div>

<style>
    .scientific-content p { margin-bottom: 1.5rem; }
    .scientific-content ul { list-style-type: disc; margin-left: 1.5rem; margin-bottom: 1.5rem; }
    .scientific-content blockquote { border-left: 4px solid #BEF264; padding-left: 1.5rem; font-style: italic; color: #64748b; }
</style>
@endsection
