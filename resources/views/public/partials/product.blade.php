@php
    // 1. Ambil data produk aktif
    $products = DB::table('social_products')
                ->where('is_active', true)
                ->latest()
                ->limit(2)
                ->get();

    // 2. Helper Translation
    if (!function_exists('getTranslation')) {
        function getTranslation($jsonField, $lang = null) {
            $lang = $lang ?? app()->getLocale();
            $data = json_decode($jsonField, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $jsonField;
            }
            return $data[$lang] ?? ($data['id'] ?? (reset($data) ?: '-'));
        }
    }
@endphp

<section class="bg-white py-16 md:py-20 relative overflow-hidden font-['Plus_Jakarta_Sans'] border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Compact Header --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10">
            <div>
                <span class="inline-block px-3 py-1 rounded-full bg-slate-100 text-[#064e3b] text-[10px] font-black tracking-[0.3em] uppercase mb-2 border border-slate-200">
                    {{ __('innovation.tag') }}
                </span>
                <h2 class="text-3xl md:text-5xl font-black text-[#064e3b] leading-tight tracking-tight uppercase">
                    {{ __('innovation.title_1') }} <span class="text-slate-400 italic font-serif lowercase">{{ __('innovation.title_accent') }}</span>
                </h2>
                <p class="text-slate-500 text-xs md:text-sm font-normal mt-1 max-w-xl">
                    {{ __('innovation.subtitle') }}
                </p>
            </div>

            <a href="{{ url('/innovation') }}" class="text-xs font-black uppercase tracking-wider text-[#064e3b] hover:text-lime-600 transition-colors flex items-center gap-2 group">
                <span>{{ __('innovation.portfolio') }}</span>
                <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>

        {{-- Compact Grid Produk (Hemat Ruang, Bersih) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($products as $index => $product)
            <div class="group bg-slate-50/70 hover:bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div>
                    {{-- Banner Image Image --}}
                    <div class="relative w-full h-48 rounded-2xl overflow-hidden bg-slate-200 mb-5">
                        <img src="{{ asset('storage/' . $product->banner_image) }}"
                             alt="{{ getTranslation($product->name) }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <div class="absolute top-3 left-3 px-3 py-1 bg-white/95 backdrop-blur-md rounded-xl text-[9px] font-black uppercase tracking-widest text-[#064e3b] shadow-sm">
                            {{ $product->category }}
                        </div>

                        <div class="absolute top-3 right-3 text-xs font-black font-mono text-white/80 bg-black/40 px-2 py-0.5 rounded-lg">
                            0{{ $index + 1 }}
                        </div>
                    </div>

                    {{-- Title & Desc --}}
                    <h3 class="text-xl font-black text-[#064e3b] uppercase tracking-tight mb-2 group-hover:text-lime-600 transition-colors line-clamp-1">
                        {{ getTranslation($product->name) }}
                    </h3>

                    <p class="text-xs text-slate-500 leading-relaxed font-normal line-clamp-2 mb-4">
                        {{ Str::limit(getTranslation($product->description), 140) }}
                    </p>

                    {{-- Features Mini Chip --}}
                    <div class="p-3 rounded-xl bg-white border border-slate-200/60 mb-5">
                        <span class="text-[9px] font-black uppercase tracking-wider text-lime-700 block mb-1">Key Features:</span>
                        <p class="text-[11px] font-bold text-slate-700 line-clamp-2">
                            {{ getTranslation($product->features) }}
                        </p>
                    </div>
                </div>

                {{-- CTA Button --}}
                <div class="pt-4 border-t border-slate-200/60 flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-400">Teknologi Tepat Guna</span>

                    <a href="{{ url('/innovation/' . $product->slug) }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#052c24] text-[#BEF264] hover:bg-lime-500 hover:text-[#052c24] text-xs font-black uppercase tracking-wider transition-all shadow-sm">
                        <span>{{ __('innovation.learn_more') }}</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
