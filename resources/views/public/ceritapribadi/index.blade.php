@extends('public.layouts.app')

@section('title', 'Cerita & Narasi - Yota Adiwidya Center')

@section('content')
<main class="bg-[#FDFDFB] pt-20 pb-32 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="max-w-3xl mb-16">
            <h1 class="text-6xl md:text-8xl font-black text-[#064e3b] tracking-tighter leading-[0.9]">
                Personal<br><span class="text-lime-500">Narratives.</span>
            </h1>
            <p class="mt-8 text-xl text-slate-500 font-light leading-relaxed">
                Kumpulan pemikiran, opini, dan catatan perjalanan inovasi yang dikemas dalam bentuk narasi personal.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row items-center justify-between gap-8 mb-16 pb-8 border-b border-slate-100">
            <div class="flex items-center gap-3 overflow-x-auto no-scrollbar w-full lg:w-auto pb-4 lg:pb-0">
                <a href="{{ route('public.ceritapribadi.index') }}"
                   class="px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap transition-all duration-500
                   {{ !request('category') ? 'bg-[#064e3b] text-[#BEF264] shadow-xl scale-105' : 'bg-white text-slate-400 border border-slate-100 hover:border-[#BEF264]' }}">
                    All Stories
                </a>
                @foreach($categories as $cat)
                    <a href="{{ request()->fullUrlWithQuery(['category' => $cat->slug, 'page' => 1]) }}"
                       class="px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap transition-all duration-500
                       {{ request('category') == $cat->slug
                            ? 'bg-[#064e3b] text-[#BEF264] shadow-xl scale-105'
                            : 'bg-white text-slate-400 border border-slate-100 hover:border-[#BEF264] hover:text-[#064e3b]'
                       }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <div class="flex items-center gap-4 w-full lg:w-auto">
                <form action="{{ route('public.ceritapribadi.index') }}" method="GET" class="relative flex-grow">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search stories..."
                           class="w-full lg:w-64 bg-white border border-slate-100 rounded-2xl px-6 py-3 text-xs font-bold focus:ring-2 focus:ring-lime-500 focus:border-transparent outline-none">
                </form>

                <select onchange="location = this.value;" class="bg-white border border-slate-100 rounded-2xl px-6 py-3 text-[10px] font-black uppercase tracking-widest text-[#064e3b] focus:ring-2 focus:ring-lime-500 outline-none cursor-pointer">
                    <option value="{{ request()->fullUrlWithQuery(['type' => '']) }}">Tipe Konten</option>
                    <option value="{{ request()->fullUrlWithQuery(['type' => 'story']) }}" {{ request('type') == 'story' ? 'selected' : '' }}>Story</option>
                    <option value="{{ request()->fullUrlWithQuery(['type' => 'opinion']) }}" {{ request('type') == 'opinion' ? 'selected' : '' }}>Opinion</option>
                    <option value="{{ request()->fullUrlWithQuery(['type' => 'article']) }}" {{ request('type') == 'article' ? 'selected' : '' }}>Article</option>
                </select>
            </div>
        </div>

        @if($posts->onFirstPage() && $posts->isNotEmpty() && !request('search') && !request('category'))
            @php $featured = $posts->first(); @endphp
            <div class="mb-20">
                <div class="group relative grid lg:grid-cols-12 gap-12 bg-[#064e3b] rounded-[3.5rem] overflow-hidden shadow-2xl">
                    <div class="lg:col-span-7 h-[400px] lg:h-[600px] overflow-hidden">
                        <img src="{{ $featured->cover_image ? asset('storage/' . $featured->cover_image) : 'https://images.unsplash.com/photo-1516414447565-b14be0adf13e?q=80&w=1000' }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[2s] opacity-80" alt="">
                    </div>
                    <div class="lg:col-span-5 p-12 lg:p-20 flex flex-col justify-center text-white">
                        <div class="flex items-center gap-4 mb-8">
                            <img src="{{ $featured->author->avatar ? asset('storage/'.$featured->author->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($featured->author->name).'&background=BEF264&color=064e3b' }}"
                                 class="w-12 h-12 rounded-2xl object-cover border-2 border-lime-400">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-lime-400 leading-none">{{ $featured->author->name }}</p>
                                <p class="text-[9px] font-bold text-slate-300 mt-1">Featured Author</p>
                            </div>
                        </div>

                        <span class="text-lime-400 font-black tracking-[0.3em] text-[10px] uppercase mb-4 block">{{ $featured->type }}</span>
                        <h2 class="text-4xl md:text-5xl font-black leading-[0.95] tracking-tighter mb-8">
                            <a href="{{ route('public.ceritapribadi.show', $featured->slug) }}" class="hover:text-lime-400 transition-colors">
                                {{ $featured->title }}
                            </a>
                        </h2>
                        <p class="text-slate-300 font-light text-lg mb-10 line-clamp-3">
                            {{ $featured->excerpt }}
                        </p>
                        <div class="flex items-center gap-6">
                            <a href="{{ route('public.ceritapribadi.show', $featured->slug) }}" class="bg-lime-500 text-[#064e3b] px-10 py-5 rounded-2xl font-black text-xs tracking-widest uppercase hover:bg-white transition-all">
                                Read Narration
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @forelse($posts as $post)
                @if($posts->onFirstPage() && $loop->first && !request('search') && !request('category')) @continue @endif

                <div class="group flex flex-col bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 hover:shadow-2xl transition-all duration-500">
                    <div class="relative h-72 overflow-hidden">
                        <img src="{{ $post->cover_image ? asset('storage/' . $post->cover_image) : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=1000' }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" alt="">

                        <div class="absolute top-6 left-6 px-4 py-1.5 bg-white/90 backdrop-blur-md rounded-full text-[9px] font-black uppercase tracking-widest text-[#064e3b]">
                            {{ $post->type }}
                        </div>
                    </div>

                    <div class="p-10 flex flex-col flex-grow">
                        <div class="flex items-center gap-4 mb-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Recent' }}</span>
                            <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                            <span>{{ $post->reading_time }} Min Read</span>
                        </div>

                        <h3 class="text-2xl font-black text-[#064e3b] leading-tight mb-4 group-hover:text-lime-600 transition-colors line-clamp-2">
                            <a href="{{ route('public.ceritapribadi.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>

                        <p class="text-slate-500 font-light text-sm line-clamp-3 mb-8 flex-grow">
                            {{ $post->excerpt }}
                        </p>

                        <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ $post->author->avatar ? asset('storage/'.$post->author->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($post->author->name).'&background=f1f5f9&color=064e3b' }}"
                                     class="w-9 h-9 rounded-xl object-cover shadow-sm">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-black uppercase text-[#064e3b] tracking-wider leading-none">{{ $post->author->name }}</span>
                                    <span class="text-[8px] font-bold text-slate-400 uppercase mt-1">Author</span>
                                </div>
                            </div>

                            <a href="{{ route('public.ceritapribadi.show', $post->slug) }}" class="text-[#064e3b] font-black text-[10px] uppercase tracking-widest flex items-center gap-2 group-hover:gap-4 transition-all">
                                Open
                                <svg class="w-4 h-4 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-40 text-center">
                    <div class="mb-6 text-slate-200">
                        <i class="fas fa-feather fa-4x opacity-20"></i>
                    </div>
                    <h4 class="text-2xl font-black text-slate-300 uppercase tracking-widest">Belum ada cerita ditemukan</h4>
                </div>
            @endforelse
        </div>

        <div class="mt-20">
            {{ $posts->links() }}
        </div>
    </div>
</main>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection
