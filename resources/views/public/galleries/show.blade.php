@extends('public.layouts.app')

@section('content')
<div class="bg-[#FDFDFB] min-h-screen pb-32">
    <div class="max-w-7xl mx-auto px-6 pt-12">
        <a href="{{ route('public.gallery.index') }}" class="inline-flex items-center gap-3 group text-[#064e3b] font-black text-[10px] uppercase tracking-widest">
            <span class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center group-hover:bg-[#064e3b] group-hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </span>
            Kembali ke Galeri
        </a>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

            <div class="lg:col-span-7">
                <div class="relative group">
                    <div class="absolute inset-0 bg-lime-400 translate-x-4 translate-y-4 rounded-[3rem] -z-10 opacity-20 group-hover:translate-x-6 group-hover:translate-y-6 transition-transform"></div>
                    <img src="{{ asset('storage/' . $gallery->image) }}"
                         alt="{{ $gallery->title }}"
                         class="w-full aspect-[4/5] object-cover rounded-[3rem] shadow-2xl border-8 border-white">
                </div>
            </div>

            <div class="lg:col-span-5 pt-8">
                <span class="inline-block px-4 py-1.5 rounded-full bg-lime-100 text-[#064e3b] text-[10px] font-black tracking-[0.3em] uppercase mb-8">
                    {{ $gallery->category }}
                </span>

                <h1 class="text-4xl md:text-5xl font-black text-slate-900 uppercase tracking-tighter leading-none mb-8">
                    {{ $gallery->title }}
                </h1>

                <div class="prose prose-slate prose-lg italic text-slate-600 font-serif leading-relaxed">
                    @if($gallery->description)
                        {!! nl2br(e($gallery->description)) !!}
                    @else
                        <p>Dokumentasi ini menunjukkan proses nyata transformasi sosial melalui inovasi yang berkelanjutan. Setiap detail mencerminkan komitmen kami dalam membangun ekosistem yang lebih baik bagi masyarakat luas.</p>
                    @endif
                </div>

                <div class="mt-12 pt-12 border-t border-slate-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-[#064e3b] rounded-2xl flex items-center justify-center text-lime-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu Dokumentasi</p>
                            <p class="font-bold text-slate-900">{{ $gallery->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-32">
        <div class="flex items-center justify-between mb-12">
            <h3 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Dokumentasi <span class="italic text-lime-600 font-serif">Terkait</span></h3>
            <div class="h-px flex-grow mx-8 bg-slate-100 hidden md:block"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($related as $rel)
            <a href="{{ route('public.gallery.show', $rel->slug) }}" class="group block">
                <div class="aspect-square rounded-[2rem] overflow-hidden mb-4 relative">
                    <img src="{{ asset('storage/' . $rel->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-[#064e3b]/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                </div>
                <h5 class="font-bold text-slate-900 text-sm line-clamp-1 leading-tight group-hover:text-lime-600 transition-colors">{{ $rel->title }}</h5>
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1">{{ $rel->category }}</p>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
