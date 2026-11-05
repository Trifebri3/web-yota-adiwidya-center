@extends('public.layouts.app')

@section('content')
<div class="bg-white min-h-screen">
    <div class="bg-[#052c24] py-20 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4">Innovation Hub</h1>
            <p class="text-lime-400 font-medium text-lg max-w-2xl mx-auto">Kumpulan teknologi tepat guna dan inovasi sosial untuk masa depan berkelanjutan.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 -mt-8">
        <form action="{{ route('public.products.index') }}" method="GET" class="bg-white p-4 rounded-3xl shadow-xl flex flex-col md:flex-row gap-4 border border-slate-100">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari inovasi..." class="w-full border-none bg-slate-50 rounded-2xl p-4 focus:ring-2 focus:ring-lime-400 outline-none">
            </div>
            <select name="category" class="bg-slate-50 border-none rounded-2xl p-4 font-bold text-slate-700 outline-none">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-lime-400 text-[#052c24] px-8 py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-[#052c24] hover:text-white transition-all">Filter</button>
        </form>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($products as $product)
            <div class="group">
                <div class="relative overflow-hidden rounded-[2.5rem] mb-6 shadow-2xl aspect-[4/5]">
                    <img src="{{ asset('storage/' . $product->banner_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#052c24] via-transparent to-transparent opacity-80"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="text-lime-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2 block">{{ $product->category }}</span>
                        <h3 class="text-white text-2xl font-black leading-tight mb-4">{{ $product->translation('name') }}</h3>
                        <a href="{{ route('public.products.show', $product->slug) }}" class="inline-flex items-center gap-2 bg-white text-[#052c24] px-6 py-3 rounded-full text-xs font-black uppercase tracking-widest hover:bg-lime-400 transition-all">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
