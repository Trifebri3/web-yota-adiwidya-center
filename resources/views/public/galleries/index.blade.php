@extends('public.layouts.app')

@section('content')
<div class="bg-[#FDFDFB] min-h-screen">
    <div class="bg-[#064e3b] py-24 px-6 relative overflow-hidden">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <span class="inline-block px-4 py-1.5 rounded-full bg-lime-400 text-[#064e3b] text-[10px] font-black tracking-[0.3em] uppercase mb-6">
                Visual Journey
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-6">
                Lensa <span class="text-lime-400 italic font-serif">Aksi & Dampak.</span>
            </h1>
            <p class="text-lime-100/60 text-lg max-w-2xl mx-auto font-light">
                Dokumentasi perjalanan kami dalam menciptakan perubahan nyata melalui inovasi sosial dan teknologi di lapangan.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-16">

        <div class="flex flex-wrap justify-center gap-3 mb-16">
            <a href="{{ route('public.gallery.index') }}"
               class="px-8 py-3 rounded-full text-[10px] font-black uppercase tracking-widest transition-all {{ !request('category') ? 'bg-[#064e3b] text-white shadow-xl shadow-green-900/20' : 'bg-white text-slate-400 border border-slate-100 hover:bg-slate-50' }}">
                Semua Foto
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('public.gallery.index', ['category' => $cat]) }}"
               class="px-8 py-3 rounded-full text-[10px] font-black uppercase tracking-widest transition-all {{ request('category') == $cat ? 'bg-[#064e3b] text-white shadow-xl shadow-green-900/20' : 'bg-white text-slate-400 border border-slate-100 hover:bg-slate-50' }}">
                {{ $cat }}
            </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="gallery-container">
            @forelse($galleries as $gallery)
            <div class="group relative bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer"
                 onclick="openLightbox('{{ asset('storage/' . $gallery->image) }}', '{{ $gallery->title }}', '{{ $gallery->category }}')">

                <div class="aspect-[4/5] overflow-hidden">
                    <img src="{{ asset('storage/' . $gallery->image) }}"
                         alt="{{ $gallery->title }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-[#064e3b]/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 p-8 flex flex-col justify-end">
                    <span class="text-lime-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">{{ $gallery->category }}</span>
                    <h3 class="text-white text-xl font-bold leading-tight">{{ $gallery->title }}</h3>
                    <p class="text-lime-100/60 text-xs mt-2 line-clamp-2 font-light italic">
                        {{ $gallery->description ?? 'Lihat detail dokumentasi kegiatan.' }}
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-full py-32 text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-slate-400 italic">Belum ada dokumentasi di kategori ini.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-20">
            {{ $galleries->links() }}
        </div>
    </div>
</div>

<div id="lightbox" class="fixed inset-0 bg-[#064e3b]/95 backdrop-blur-xl z-[99] hidden flex items-center justify-center p-6 md:p-12 transition-all duration-500">
    <button onclick="closeLightbox()" class="absolute top-10 right-10 text-white/50 hover:text-white transition-colors">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18"/></svg>
    </button>

    <div class="max-w-5xl w-full flex flex-col items-center">
        <img id="lightbox-img" src="" class="max-h-[70vh] w-auto rounded-3xl shadow-2xl border border-white/10 mb-8">
        <div class="text-center">
            <span id="lightbox-cat" class="text-lime-400 text-[10px] font-black uppercase tracking-[0.3em] block mb-2"></span>
            <h2 id="lightbox-title" class="text-3xl md:text-4xl font-black text-white uppercase tracking-tight"></h2>
        </div>
    </div>
</div>

<script>
    function openLightbox(src, title, cat) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-title').innerText = title;
        document.getElementById('lightbox-cat').innerText = cat;
        document.getElementById('lightbox').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Stop scroll
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.body.style.overflow = 'auto'; // Enable scroll
    }

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });
</script>
@endsection
