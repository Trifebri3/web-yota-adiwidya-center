@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-8">
    <div class="max-w-7xl mx-auto mb-16 flex justify-between items-end">
        <div>
            <h1 class="text-6xl font-black text-[#064e3b] tracking-tighter uppercase italic">
                The <span class="text-lime-500 not-italic">Archive.</span>
            </h1>
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.3em] mt-4">Insights, Research, and Stories from Yota Team</p>
        </div>
        <a href="{{ route('gen-posts.create') }}" class="bg-[#064e3b] text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-xl shadow-lime-100">
            Write New Story
        </a>
    </div>

    <div class="max-w-7xl mx-auto mb-12 flex gap-4 overflow-x-auto pb-4 no-scrollbar">
        <a href="#" class="px-6 py-3 bg-white border border-slate-100 rounded-full text-[10px] font-black uppercase tracking-widest text-[#064e3b] hover:border-lime-400 transition-all">All Feed</a>
        @foreach(['Journal', 'Opinion', 'Case Study', 'Story'] as $cat)
            <a href="#" class="px-6 py-3 bg-white border border-slate-100 rounded-full text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#064e3b] hover:border-lime-400 transition-all">{{ $cat }}</a>
        @endforeach
    </div>

    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-12 gap-8">

            <div class="col-span-12 lg:col-span-8 space-y-8">
                @foreach($posts as $post)
                <div class="group bg-white p-8 rounded-[3rem] border border-slate-100 hover:shadow-2xl hover:shadow-lime-100 transition-all duration-500 relative overflow-hidden">
                    <div class="absolute top-0 right-0 px-8 py-2 bg-slate-50 rounded-bl-[1.5rem] text-[8px] font-black uppercase tracking-widest text-slate-400 group-hover:bg-lime-400 group-hover:text-[#064e3b] transition-colors">
                        {{ $post->type }}
                    </div>

                    <div class="flex flex-col md:flex-row gap-8">
                        @if($post->cover_image)
                        <div class="w-full md:w-48 h-48 rounded-[2rem] overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/' . $post->cover_image) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 scale-100 group-hover:scale-110">
                        </div>
                        @endif

                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="text-[9px] font-black uppercase text-lime-600 tracking-tighter">{{ $post->category->name ?? 'Uncategorized' }}</span>
                                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                    <span class="text-[9px] font-bold text-slate-300 uppercase">{{ $post->reading_time }} min read</span>
                                </div>
                                <a href="{{ route('gen-posts.show', $post->slug) }}">
                                    <h2 class="text-2xl font-black text-[#064e3b] leading-tight uppercase group-hover:text-lime-600 transition-colors">
                                        {{ $post->title }}
                                    </h2>
                                </a>
                                <p class="text-sm text-slate-400 mt-4 font-medium line-clamp-2">
                                    {{ $post->excerpt }}
                                </p>
                            </div>

                            <div class="mt-8 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 border border-white overflow-hidden">
                                        <img src="https://ui-avatars.com/api/?name={{ $post->author->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <span class="text-[10px] font-black uppercase text-[#064e3b] tracking-widest">{{ $post->author->name }}</span>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('gen-posts.edit', $post->id) }}" class="p-2 bg-slate-50 text-slate-400 rounded-xl hover:bg-lime-100 hover:text-lime-700 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('gen-posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Archive this masterpiece?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 bg-slate-50 text-slate-400 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="py-12">
                    {{ $posts->links() }}
                </div>
            </div>

            <div class="col-span-12 lg:col-span-4 space-y-8">
                <div class="bg-[#064e3b] p-10 rounded-[3rem] text-white overflow-hidden relative">
                    <div class="relative z-10">
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-lime-400 mb-6 italic">Popular Now</h3>
                        <div class="space-y-6">
                            @foreach($posts->sortByDesc('views_count')->take(3) as $pop)
                            <div class="group cursor-pointer">
                                <span class="text-[40px] font-black text-white/10 block leading-none group-hover:text-lime-400/20 transition-colors">0{{ $loop->iteration }}</span>
                                <h4 class="text-sm font-bold uppercase -mt-4 leading-tight">{{ $pop->title }}</h4>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-lime-400 rounded-full blur-3xl opacity-20"></div>
                </div>

                <div class="bg-white p-10 rounded-[3rem] border border-slate-100">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-300 mb-8 italic">Scientific Meta</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-4 bg-slate-50 rounded-2xl">
                            <span class="text-[9px] font-black uppercase tracking-widest">Active Journals</span>
                            <span class="text-lg font-black text-[#064e3b]">{{ $posts->where('type', 'journal')->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-slate-50 rounded-2xl">
                            <span class="text-[9px] font-black uppercase tracking-widest">Global Views</span>
                            <span class="text-lg font-black text-[#064e3b]">{{ number_format($posts->sum('views_count')) }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
