@extends('public.layouts.app')

@section('content')
<div class="bg-slate-50">
    <div class="relative h-[60vh] w-full">
        <img src="{{ asset('storage/' . $product->banner_image) }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="max-w-4xl text-center px-6">
                <span class="bg-lime-400 text-[#052c24] px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest mb-4 inline-block">{{ $product->category }}</span>
                <h1 class="text-4xl md:text-6xl font-black text-white uppercase">{{ $product->translation('name') }}</h1>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 -mt-20 relative z-10 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <div class="lg:col-span-8">
                <div class="bg-white p-10 md:p-16 rounded-[3rem] shadow-xl border border-slate-100">
                    <div class="mb-12">
                        <h2 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 mb-6 flex items-center gap-4">
                            <span class="w-10 h-[2px] bg-lime-400"></span> Tentang Inovasi
                        </h2>
                        <div class="text-slate-600 text-lg leading-relaxed font-medium">
                            {!! nl2br(e($product->translation('description'))) !!}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div>
                            <h3 class="text-sm font-black uppercase tracking-widest text-[#052c24] mb-4">Fungsi Utama</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">{{ $product->translation('features') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-black uppercase tracking-widest text-[#052c24] mb-4">Manfaat Sosial</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">{{ $product->translation('benefits') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-[#052c24] p-10 rounded-[3rem] text-white sticky top-10 shadow-2xl">
                    <h3 class="text-xl font-black mb-6 uppercase tracking-tight">Resource Hub</h3>
                    <div class="space-y-4">
                        @if($product->pdf_url)
                        <a href="{{ $product->pdf_url }}" target="_blank" class="flex items-center justify-between bg-white/10 p-5 rounded-2xl hover:bg-lime-400 hover:text-[#052c24] transition-all group">
                            <span class="font-bold text-sm">Download Guideline</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </a>
                        @endif

                        @if($product->video_url)
                        <a href="{{ $product->video_url }}" target="_blank" class="flex items-center justify-between bg-white/10 p-5 rounded-2xl hover:bg-red-500 transition-all group">
                            <span class="font-bold text-sm">Tonton Demo Video</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path d="M21 12.a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </a>
                        @endif

                        @if($product->external_link)
                        <a href="{{ $product->external_link }}" target="_blank" class="flex items-center justify-between bg-lime-400 text-[#052c24] p-5 rounded-2xl hover:bg-white transition-all font-black uppercase text-[10px] tracking-widest">
                            Kunjungi Website
                        </a>
                        @endif
                    </div>

                    <div class="mt-10 pt-10 border-t border-white/10">
                        <p class="text-[10px] font-black uppercase tracking-widest text-white/40 mb-2">Dipublikasikan Oleh</p>
                        <p class="font-bold text-lime-400">{{ $product->published_by }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
