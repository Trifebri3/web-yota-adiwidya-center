@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="bg-white min-h-screen">
    <div class="fixed top-0 left-0 w-full h-1 z-50">
        <div id="scrollProgress" class="h-full bg-lime-400 w-0 transition-all duration-150"></div>
    </div>

    <header class="max-w-4xl mx-auto pt-20 px-6">
        <div class="flex items-center gap-4 mb-8">
            <span class="px-4 py-1.5 bg-slate-100 rounded-full text-[10px] font-black uppercase tracking-[0.2em] text-[#064e3b]">
                {{ $post->category->name }}
            </span>
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                {{ $post->reading_time }} Min Read
            </span>
        </div>

        <h1 class="text-4xl md:text-6xl font-black text-[#064e3b] leading-[1.1] uppercase italic tracking-tighter mb-10">
            {{ $post->title }}
        </h1>

        <div class="flex items-center justify-between border-y border-slate-100 py-8">
            <div class="flex items-center gap-4">
                <img src="https://ui-avatars.com/api/?name={{ $post->author->name }}" class="w-12 h-12 rounded-full border-2 border-lime-400">
                <div>
                    <p class="text-[11px] font-black uppercase text-[#064e3b] tracking-widest">{{ $post->author->name }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase">{{ $post->published_at->format('M d, Y') }}</p>
                </div>
            </div>
            <div class="flex gap-4">
                <button class="text-slate-300 hover:text-lime-500 transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                </button>
            </div>
        </div>
    </header>

    @if($post->cover_image)
    <div class="max-w-6xl mx-auto mt-12 px-6">
        <div class="rounded-[3rem] overflow-hidden shadow-2xl">
            <img src="{{ asset('storage/' . $post->cover_image) }}" class="w-full h-full object-cover max-h-[600px]">
        </div>
    </div>
    @endif

    <main class="max-w-3xl mx-auto px-6 py-20">
        @if($post->type === 'journal' && $post->meta)
        <div class="bg-lime-50 rounded-[2rem] p-8 mb-12 border border-lime-100 italic font-serif text-sm text-lime-800 leading-relaxed shadow-sm">
            <p class="font-black uppercase text-[10px] mb-4 tracking-[0.3em]">Abstract / Executive Summary</p>
            {{ $post->excerpt }}
        </div>
        @endif

        <article class="prose prose-lg prose-slate max-w-none font-serif leading-relaxed text-[#064e3b]
            prose-headings:font-black prose-headings:uppercase prose-headings:italic prose-headings:tracking-tighter prose-headings:text-[#064e3b]
            prose-p:text-lg prose-p:mb-8
            prose-strong:text-lime-600
            prose-a:text-lime-500 prose-a:no-underline hover:prose-a:underline">

            {!! $post->content !!}
        </article>

        @if($post->type === 'journal' && $post->meta)
        <div class="mt-20 pt-10 border-t border-slate-100">
            <h4 class="text-xs font-black uppercase tracking-widest text-slate-300 mb-6">Scientific References</h4>
            <div class="text-xs text-slate-400 font-serif space-y-2 leading-relaxed italic">
                {!! nl2br(e($post->meta->references)) !!}
            </div>
            @if($post->meta->pdf_version)
            <a href="{{ asset('storage/' . $post->meta->pdf_version) }}" class="inline-flex items-center gap-3 mt-8 px-6 py-3 bg-[#064e3b] text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg>
                Download Full Paper (PDF)
            </a>
            @endif
        </div>
        @endif
    </main>

    <footer class="bg-slate-50 py-20 px-6">
        <div class="max-w-3xl mx-auto text-center">
            <div class="w-24 h-24 mx-auto mb-6 rounded-full border-4 border-white shadow-xl overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ $post->author->name }}" class="w-full h-full object-cover">
            </div>
            <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-300 mb-2 italic">Written By</h4>
            <h3 class="text-2xl font-black text-[#064e3b] uppercase italic">{{ $post->author->name }}</h3>
            <p class="mt-4 text-slate-400 text-sm italic max-w-md mx-auto">Director of Yota Nusantara. Focusing on digital ecosystem and social innovation.</p>
        </div>
    </footer>
</div>

<script>
    window.onscroll = function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        document.getElementById("scrollProgress").style.width = scrolled + "%";
    };
</script>
@endsection
