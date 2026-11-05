@extends('public.layouts.app')

@section('title', $post->title . ' - Yota Adiwidya Center')

@php
use Illuminate\Support\Str;
@endphp

@section('content')

{{-- READING PROGRESS --}}
<div class="fixed top-0 left-0 w-full h-1.5 z-[100] pointer-events-none">
    <div id="progress-bar"
         class="h-full bg-lime-500 transition-all duration-150 shadow-[0_0_15px_rgba(190,242,100,0.8)]"
         style="width:0%">
    </div>
</div>

<main class="bg-[#FDFDFB] pt-20 pb-32 font-['Plus_Jakarta_Sans']">

    <article class="max-w-7xl mx-auto px-6 lg:px-8">

        {{-- HERO --}}
        <div class="max-w-4xl mx-auto text-center mb-16">

            {{-- BREADCRUMB --}}
            <nav class="flex justify-center items-center gap-3 mb-8 text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">
                <a href="{{ route('public.ceritapribadi.index') }}"
                   class="hover:text-lime-600 transition-colors">
                    Narasi
                </a>

                <span class="w-1.5 h-1.5 bg-lime-500 rounded-full"></span>

                <span class="text-[#064e3b]">
                    {{ $post->category->name }}
                </span>
            </nav>

            {{-- TITLE --}}
            <h1 class="text-4xl md:text-7xl font-black text-[#064e3b] tracking-tighter leading-[0.95] mb-10">
                {{ $post->title }}
            </h1>

            {{-- META --}}
            <div class="flex flex-col md:flex-row items-center justify-center gap-6 text-slate-500">

                {{-- AUTHOR --}}
                <div class="flex items-center gap-4">

                    <img
                        src="{{ $post->author->avatar
                            ? asset('storage/'.$post->author->avatar)
                            : 'https://ui-avatars.com/api/?name='.urlencode($post->author->name).'&background=064e3b&color=BEF264' }}"
                        class="w-12 h-12 rounded-2xl object-cover shadow-md border-2 border-white">

                    <div class="text-left">
                        <p class="text-[10px] font-black uppercase tracking-widest text-[#064e3b] leading-none">
                            {{ $post->author->name }}
                        </p>

                        <p class="text-[9px] font-bold mt-1 uppercase text-slate-400">
                            Author
                        </p>
                    </div>
                </div>

                <div class="hidden md:block w-px h-8 bg-slate-200"></div>

                {{-- DATE --}}
                <div class="flex items-center gap-8 text-[11px] font-bold uppercase tracking-widest">

                    <span class="flex items-center gap-2">
                        <i class="far fa-calendar-alt text-lime-500"></i>

                        {{ $post->published_at
                            ? $post->published_at->format('M d, Y')
                            : 'Recent' }}
                    </span>

                    <span class="flex items-center gap-2">
                        <i class="far fa-clock text-lime-500"></i>

                        {{ $post->reading_time }} Min Read
                    </span>
                </div>
            </div>
        </div>

        {{-- COVER --}}
        <div class="relative w-full aspect-[21/9] rounded-[3.5rem] overflow-hidden shadow-2xl mb-20 group">

            <img
                src="{{ $post->cover_image
                    ? asset('storage/' . $post->cover_image)
                    : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=1000' }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[3s]"
                alt="{{ $post->title }}">

            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/30"></div>
        </div>

        {{-- CONTENT GRID --}}
        <div class="grid lg:grid-cols-12 gap-16">

            {{-- LEFT SOCIAL --}}
            <div class="hidden lg:block lg:col-span-1">

                <div class="sticky top-32 flex flex-col gap-6 items-center border-r border-slate-100 pr-8">

                    <div class="text-[9px] font-black text-slate-300 uppercase tracking-widest vertical-text mb-4">
                        Engagement
                    </div>

                    {{-- VIEWS --}}
                    <button class="group flex flex-col items-center gap-2">

                        <div class="w-12 h-12 rounded-2xl bg-[#064e3b] flex items-center justify-center text-lime-400 shadow-lg group-hover:scale-110 transition-all">
                            <i class="fas fa-eye"></i>
                        </div>

                        <span class="text-[10px] font-black text-[#064e3b]">
                            {{ number_format($post->views_count) }}
                        </span>
                    </button>

                    <div class="w-8 h-px bg-slate-100"></div>

                    {{-- SHARE WA --}}
                    <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                       target="_blank"
                       class="w-12 h-12 rounded-2xl bg-[#25D366] flex items-center justify-center text-white shadow-lg hover:scale-110 transition-all">

                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>

                    {{-- SHARE X --}}
                    <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($post->title) }}"
                       target="_blank"
                       class="w-12 h-12 rounded-2xl bg-black flex items-center justify-center text-white shadow-lg hover:scale-110 transition-all">

                        <i class="fab fa-x-twitter text-lg"></i>
                    </a>

                </div>
            </div>

            {{-- MAIN CONTENT --}}
            <div class="lg:col-span-8">

                {{-- ARTICLE CONTENT --}}
                <div class="yota-content prose prose-xl prose-slate max-w-none mb-20">

                    {!! Str::markdown($post->content) !!}

                </div>

                {{-- AUTHOR CARD --}}
                <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 md:p-12 flex flex-col md:flex-row items-center gap-8 shadow-sm">

                    <img
                        src="{{ $post->author->avatar
                            ? asset('storage/'.$post->author->avatar)
                            : 'https://ui-avatars.com/api/?name='.urlencode($post->author->name).'&background=064e3b&color=BEF264' }}"
                        class="w-24 h-24 rounded-[2rem] object-cover shadow-xl border-4 border-[#FDFDFB]">

                    <div class="flex-1 text-center md:text-left">

                        <span class="text-[9px] font-black uppercase tracking-[0.3em] text-lime-600 mb-2 block">
                            Written By
                        </span>

                        <h4 class="text-2xl font-black text-[#064e3b] mb-3">
                            {{ $post->author->name }}
                        </h4>

                        <p class="text-sm text-slate-500 font-light leading-relaxed">
                            Kontributor aktif Yota Adiwidya Center yang berfokus pada narasi pembangunan berkelanjutan dan inovasi teknologi untuk kemanusiaan.
                        </p>

                    </div>
                </div>

                {{-- TAG --}}
                <div class="mt-12 flex flex-wrap gap-3">

                    <span class="px-5 py-2 bg-[#064e3b] text-lime-400 rounded-xl text-[10px] font-black uppercase tracking-widest">
                        #{{ str_replace(' ', '', $post->category->name) }}
                    </span>

                </div>
            </div>

            {{-- RELATED POSTS --}}
            <div class="lg:col-span-3">

                <div class="sticky top-32">

                    <h4 class="text-xs font-black uppercase tracking-[0.2em] text-[#064e3b] mb-8 flex items-center gap-3">
                        Related Stories
                        <span class="h-px flex-1 bg-lime-500"></span>
                    </h4>

                    <div class="flex flex-col gap-10">

                        @foreach($relatedPosts as $related)

                        <a href="{{ route('public.ceritapribadi.show', $related->slug) }}"
                           class="group block">

                            <div class="aspect-video rounded-3xl overflow-hidden mb-4">

                                <img
                                    src="{{ $related->cover_image
                                        ? asset('storage/' . $related->cover_image)
                                        : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=1000' }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                            </div>

                            <h5 class="text-sm font-black text-[#064e3b] leading-tight group-hover:text-lime-600 transition-colors">
                                {{ $related->title }}
                            </h5>

                        </a>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </article>
</main>

{{-- CUSTOM STYLE --}}
<style>

.vertical-text{
    writing-mode: vertical-rl;
    transform: rotate(180deg);
}

/* ARTICLE CONTENT */

.yota-content{
    color:#475569;
    line-height:2;
    font-size:17px;
}

.yota-content h1{
    font-size:3rem;
    font-weight:900;
    line-height:1;
    color:#064e3b;
    margin-top:3rem;
    margin-bottom:1.5rem;
    letter-spacing:-0.03em;
}

.yota-content h2{
    font-size:2.2rem;
    font-weight:900;
    line-height:1.1;
    color:#064e3b;
    margin-top:4rem;
    margin-bottom:1.5rem;
    letter-spacing:-0.03em;
}

.yota-content h3{
    font-size:1.6rem;
    font-weight:800;
    color:#064e3b;
    margin-top:2.5rem;
    margin-bottom:1rem;
}

.yota-content p{
    margin-top:1.5rem;
    margin-bottom:1.5rem;
    color:#475569;
    line-height:2;
    font-weight:300;
}

.yota-content strong{
    color:#064e3b;
    font-weight:800;
}

.yota-content ul{
    margin-top:2rem;
    margin-bottom:2rem;
    padding-left:1.5rem;
}

.yota-content li{
    margin-bottom:0.8rem;
    line-height:1.9;
}

.yota-content blockquote{
    border-left:4px solid #84cc16;
    background:#f8fafc;
    padding:1.5rem 2rem;
    border-radius:0 1.5rem 1.5rem 0;
    font-style:italic;
    margin:2.5rem 0;
    color:#64748b;
}

.yota-content img{
    width:100%;
    border-radius:2rem;
    margin:3rem 0;
    box-shadow:0 20px 50px rgba(0,0,0,0.08);
}

.yota-content a{
    color:#65a30d;
    font-weight:700;
    text-decoration:none;
}

.yota-content a:hover{
    color:#84cc16;
}

.yota-content hr{
    margin:4rem 0;
    border-color:#e2e8f0;
}

.yota-content code{
    background:#f1f5f9;
    padding:0.2rem 0.5rem;
    border-radius:0.5rem;
    font-size:0.9em;
}

.yota-content pre{
    background:#0f172a;
    color:white;
    padding:2rem;
    border-radius:1.5rem;
    overflow-x:auto;
    margin:2rem 0;
}

</style>

{{-- SCRIPT --}}
<script>

window.onscroll = function () {

    let winScroll =
        document.body.scrollTop ||
        document.documentElement.scrollTop;

    let height =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;

    let scrolled = (winScroll / height) * 100;

    document.getElementById("progress-bar").style.width =
        scrolled + "%";
};

</script>

@endsection