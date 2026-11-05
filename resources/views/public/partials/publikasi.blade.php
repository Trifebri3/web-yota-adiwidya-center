{{-- =========================
    COMPACT MEDIA HUB
========================= --}}

@php
    use App\Models\Post;
    use App\Models\ScientificArticle;
    use Illuminate\Support\Str;

    $featured = \App\Models\Publication::where('is_verified', true)
        ->latest('published_at')
        ->first();

    $news = \App\Models\Publication::where('is_verified', true)
        ->latest('published_at')
        ->skip(1)
        ->take(3)
        ->get();

    $opinion = Post::latest()->first();

    $scientific = ScientificArticle::latest()->first();
@endphp

<section class="py-24 bg-[#f8faf7] relative overflow-hidden font-['Plus_Jakarta_Sans']">

    {{-- background glow --}}
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-lime-100/40 rounded-full blur-3xl"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 lg:px-8">

        {{-- heading --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">

            <div>
                <span class="text-[11px] uppercase tracking-[0.35em] text-lime-600 font-black">
                    Media Intelligence
                </span>

                <h2 class="mt-3 text-4xl lg:text-5xl font-black tracking-tight text-[#064e3b] leading-none">
                    News & Insight
                </h2>
            </div>

            <a href="{{ route('public.publications.index') }}"
               class="text-sm font-bold text-[#064e3b] hover:translate-x-1 transition">
                Explore All →
            </a>

        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">

            {{-- FEATURED --}}
            @if($featured)

                @php
                    $featuredImage = $featured->banner
                        ? asset('storage/' . $featured->banner)
                        : asset('image/default-cover.jpg');
                @endphp

                <a href="{{ route('public.publications.show', $featured->slug) }}"
                   class="lg:col-span-5 group relative overflow-hidden rounded-[2rem] bg-[#064e3b] min-h-[320px]">

                    <img src="{{ $featuredImage }}"
                         class="absolute inset-0 w-full h-full object-cover opacity-30 group-hover:scale-105 transition duration-700">

                    <div class="absolute inset-0 bg-gradient-to-t from-[#064e3b] via-[#064e3b]/80 to-transparent"></div>

                    <div class="relative z-10 h-full p-8 flex flex-col justify-end">

                        <span class="inline-flex w-fit px-3 py-1 rounded-full bg-lime-400/10 border border-lime-400/20 text-lime-300 text-[10px] font-black uppercase tracking-widest mb-5">
                            {{ strtoupper($featured->type) }}
                        </span>

                        <h3 class="text-2xl lg:text-3xl font-black text-white leading-tight mb-4 line-clamp-3">
                            {{ $featured->title[App::getLocale()] }}
                        </h3>

                        <p class="text-slate-300 text-sm leading-relaxed line-clamp-2">
                            {{ Str::limit(strip_tags($featured->content[App::getLocale()] ?? ''), 120) }}
                        </p>

                    </div>

                </a>

            @endif

            {{-- SIDE CONTENT --}}
            <div class="lg:col-span-7 grid sm:grid-cols-2 gap-5">

                {{-- NEWS --}}
                @foreach($news as $item)

                    @php
                        $newsImage = $item->banner
                            ? asset('storage/' . $item->banner)
                            : asset('image/default-cover.jpg');
                    @endphp

                    <a href="{{ route('public.publications.show', $item->slug) }}"
                       class="group bg-white border border-slate-100 rounded-[1.8rem] p-4 flex gap-4 shadow-sm hover:shadow-xl transition-all duration-500">

                        <div class="w-24 h-24 shrink-0 rounded-2xl overflow-hidden bg-slate-100">
                            <img src="{{ $newsImage }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>

                        <div class="min-w-0 flex-1">

                            <span class="text-[10px] uppercase tracking-[0.25em] text-lime-600 font-black">
                                {{ strtoupper($item->type) }}
                            </span>

                            <h4 class="mt-2 text-base font-black text-slate-900 leading-snug line-clamp-2 group-hover:text-[#064e3b] transition">
                                {{ $item->title[App::getLocale()] }}
                            </h4>

                            <p class="mt-2 text-xs text-slate-500 line-clamp-2">
                                {{ Str::limit(strip_tags($item->content[App::getLocale()] ?? ''), 70) }}
                            </p>

                        </div>

                    </a>

                @endforeach

                {{-- OPINION --}}
                @if($opinion)

                    @php
                        $opinionImage = $opinion->cover_image
                            ? asset('storage/' . $opinion->cover_image)
                            : asset('image/default-cover.jpg');
                    @endphp

                    <a href="https://siyota.org/cerita"
                       class="group rounded-[1.8rem] bg-gradient-to-br from-lime-50 to-white border border-lime-100 p-5 shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden">

                        <div class="flex gap-4">

                            <div class="w-24 h-24 rounded-2xl overflow-hidden shrink-0">
                                <img src="{{ $opinionImage }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>

                            <div class="flex-1 min-w-0">

                                <span class="text-[10px] uppercase tracking-[0.25em] text-lime-700 font-black">
                                    {{ strtoupper($opinion->type) }}
                                </span>

                                <h4 class="mt-2 text-lg font-black text-slate-900 leading-snug line-clamp-2">
                                    {{ $opinion->title }}
                                </h4>

                                <p class="mt-2 text-sm text-slate-600 line-clamp-2">
                                    {{ Str::limit($opinion->excerpt, 70) }}
                                </p>

                            </div>

                        </div>

                    </a>

                @endif

                {{-- SCIENTIFIC --}}
                @if($scientific)

                    @php
                        $scientificImage = $scientific->cover_image
                            ? asset('storage/' . $scientific->cover_image)
                            : asset('image/default-cover.jpg');
                    @endphp

                    <a href="{{ route('public.kajianilmiah.show', $scientific->slug) }}"
                       class="group rounded-[1.8rem] bg-gradient-to-br from-sky-50 to-white border border-sky-100 p-5 shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden">

                        <div class="flex gap-4">

                            <div class="w-24 h-24 rounded-2xl overflow-hidden shrink-0">
                                <img src="{{ $scientificImage }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>

                            <div class="flex-1 min-w-0">

                                <span class="text-[10px] uppercase tracking-[0.25em] text-sky-700 font-black">
                                    Scientific Journal
                                </span>

                                <h4 class="mt-2 text-lg font-black text-slate-900 leading-snug line-clamp-2">
                                    {{ $scientific->title['id'] ?? '-' }}
                                </h4>

                                <p class="mt-2 text-sm text-slate-600 line-clamp-2">
                                    {{ Str::limit(strip_tags($scientific->abstract['id'] ?? ''), 70) }}
                                </p>

                            </div>

                        </div>

                    </a>

                @endif

            </div>

        </div>

    </div>

</section>