@php
    $galleryDocs = \App\Models\DocPublication::getGallery();
    $locale = App::getLocale();
@endphp

<div class="py-20 bg-slate-50 rounded-[4rem] px-10 border border-slate-100 shadow-inner font-['Plus_Jakarta_Sans']">
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12">
        @foreach($galleryDocs as $doc)
        <div class="group relative">

            {{-- 1. Book 3D Container --}}
            <div class="relative z-10 aspect-[3/4] rounded-r-2xl overflow-hidden shadow-[15px_15px_30px_-10px_rgba(5,44,36,0.3)] group-hover:shadow-[25px_25px_45px_-10px_rgba(5,44,36,0.5)] group-hover:-translate-y-3 transition-all duration-700 bg-[#052c24] border-l-[6px] border-black/10">

                {{-- Cover Image Logic --}}
                @if($doc->cover_image)
                    <img src="{{ asset('storage/'.$doc->cover_image) }}" class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center bg-gradient-to-br from-[#052c24] to-[#0a4d3f]">
                        <svg class="w-8 h-8 text-[#BEF264]/20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <span class="text-[8px] font-black uppercase tracking-[0.2em] text-[#BEF264]/30 leading-relaxed italic">
                            {{ __('gallery.no_cover') }}
                        </span>
                    </div>
                @endif

                {{-- Book Spine Texture --}}
                <div class="absolute inset-y-0 left-0 w-4 bg-gradient-to-r from-black/30 via-transparent to-transparent"></div>
                <div class="absolute inset-y-0 left-1 w-[1px] bg-white/10"></div>

                {{-- Hover Overlay --}}
                <div class="absolute inset-0 bg-[#052c24]/90 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-sm">
                    <p class="text-[#BEF264] text-[8px] font-black uppercase tracking-[0.3em] mb-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">{{ __('gallery.official_access') }}</p>
                    <a href="{{ asset('storage/'.$doc->pdf_path) }}" target="_blank" class="bg-[#BEF264] text-[#052c24] p-4 rounded-2xl hover:scale-110 hover:bg-white transition-all shadow-xl shadow-black/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    </a>
                </div>
            </div>

            {{-- 2. Metadata Section (Fix for TypeError) --}}
            <div class="mt-8 px-2">
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-[8px] font-black uppercase tracking-[0.2em] text-[#052c24] bg-[#BEF264] px-2 py-0.5 rounded-md italic shadow-sm">
                        {{-- Cek jika category_label adalah array/json atau string biasa --}}
                        @if(is_array($doc->category_label))
                            {{ $doc->category_label[$locale] ?? $doc->category_label['id'] }}
                        @else
                            {{ $doc->category_label }}
                        @endif
                    </span>
                    <div class="h-px flex-grow bg-slate-200"></div>
                </div>

                <h4 class="text-[13px] font-black text-[#052c24] leading-snug line-clamp-2 uppercase tracking-tighter group-hover:text-lime-600 transition-colors duration-300 min-h-[2.5rem]">
                    {{-- Cek jika title adalah array/json atau string biasa --}}
                    @if(is_array($doc->title))
                        {{ $doc->title[$locale] ?? $doc->title['id'] }}
                    @else
                        {{ $doc->title }}
                    @endif
                </h4>

                <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3">
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">{{ __('gallery.year') }}</p>
                    <p class="text-[10px] text-[#052c24] font-black italic tracking-tighter">{{ $doc->published_at->format('Y') }}</p>
                </div>
            </div>

            {{-- 3. Realistic Book Shadow --}}
            <div class="absolute -bottom-6 left-0 right-0 h-6 bg-[#052c24]/10 rounded-[100%] blur-2xl -z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-700 scale-75"></div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* Custom Clamp untuk judul agar seragam */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
