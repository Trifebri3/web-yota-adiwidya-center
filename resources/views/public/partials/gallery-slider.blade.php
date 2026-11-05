@php
    // Mengambil 5 foto terbaru yang aktif
    $featured = \App\Models\Gallery::where('is_active', true)->latest()->limit(5)->get();
    $locale = app()->getLocale();
@endphp

@if($featured->count() > 0)
<section class="py-24 bg-[#FDFDFB] overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

            <div class="lg:col-span-4 order-2 lg:order-1" data-aos="fade-right">
                <div class="relative">
                    <span class="text-lime-600 font-black text-[10px] uppercase tracking-[0.4em] mb-6 block drop-shadow-sm">
                        {{ __('gallery.snapshot') }}
                    </span>
                    <h2 class="text-5xl lg:text-6xl font-black text-[#064e3b] uppercase tracking-tighter leading-[0.85] mb-8">
                        {{ __('gallery.title_part1') }} <br>
                        <span class="italic font-serif text-lime-500 text-4xl lg:text-5xl normal-case tracking-normal">
                            {{ __('gallery.title_part2') }}
                        </span>
                    </h2>
                    <p class="text-slate-500 text-base leading-relaxed mb-10 max-w-sm font-light">
                        {{ __('gallery.desc') }}
                    </p>

                    <a href="{{ route('public.gallery.index') }}" class="group inline-flex items-center gap-6">
                        <span class="text-[#064e3b] font-black text-[11px] uppercase tracking-[0.2em] group-hover:text-lime-600 transition-colors">
                            {{ __('gallery.button') }}
                        </span>
                        <div class="relative flex items-center justify-center">
                            <div class="absolute inset-0 bg-lime-400 rounded-full scale-0 group-hover:scale-100 transition-transform duration-500"></div>
                            <div class="w-14 h-14 rounded-full border border-slate-200 flex items-center justify-center relative z-10 group-hover:border-transparent group-hover:text-[#064e3b] transition-all">
                                <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-8 order-1 lg:order-2 relative h-[450px] md:h-[550px] flex items-center justify-center">
                <div class="relative w-full h-full" id="interactive-slider">
                    @foreach($featured as $index => $item)
                        <div class="gallery-card absolute inset-0 m-auto transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)] cursor-pointer overflow-hidden rounded-[2.5rem] md:rounded-[3.5rem] shadow-2xl border-[6px] border-white group"
                             onclick="setSlide({{ $index }})"
                             data-index="{{ $index }}">

                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover scale-110 group-hover:scale-100 transition-transform duration-1000">

                            <div class="absolute inset-0 bg-gradient-to-t from-[#064e3b] via-transparent to-transparent opacity-60"></div>

                            <div class="absolute inset-0 p-8 md:p-12 flex flex-col justify-end opacity-0 card-info transition-all duration-700 translate-y-4">
                                <span class="text-lime-400 text-[10px] font-black uppercase tracking-[0.3em] mb-3 block">
                                    {{ $item->category }}
                                </span>
                                <h3 class="text-white text-2xl md:text-3xl font-black uppercase tracking-tighter leading-none mb-2">
                                    {{ $locale == 'en' && isset($item->title_en) ? $item->title_en : $item->title }}
                                </h3>
                                <div class="w-12 h-1 bg-lime-400 rounded-full"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="absolute -bottom-6 lg:bottom-10 right-6 lg:-right-6 flex gap-3 z-30">
                    <button onclick="prevSlide()" class="nav-btn w-14 h-14 rounded-2xl bg-white text-[#064e3b] flex items-center justify-center shadow-xl border border-slate-50 hover:bg-[#064e3b] hover:text-white transition-all duration-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button onclick="nextSlide()" class="nav-btn w-14 h-14 rounded-2xl bg-[#064e3b] text-white flex items-center justify-center shadow-xl hover:bg-lime-400 hover:text-[#064e3b] transition-all duration-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    /* Ukuran responsif kartu */
    .gallery-card {
        width: 280px;
        height: 380px;
    }
    @media (min-width: 768px) {
        .gallery-card {
            width: 450px;
            height: 500px;
        }
    }

    /* Animasi info saat aktif */
    .gallery-card.is-active .card-info {
        opacity: 1;
        translate: 0;
    }

    .nav-btn:active {
        scale: 0.9;
    }
</style>

<script>
    let currentIndex = 0;
    const cards = document.querySelectorAll('.gallery-card');
    const totalCards = cards.length;

    function updateSlider() {
        cards.forEach((card, i) => {
            // Logika kalkulasi jarak indeks secara melingkar
            let offset = i - currentIndex;

            if (offset < 0) offset += totalCards;

            card.classList.remove('is-active');

            if (offset === 0) {
                // Kartu Utama (Fokus)
                card.classList.add('is-active');
                card.style.transform = "translateX(0) scale(1) rotate(0deg)";
                card.style.zIndex = "20";
                card.style.opacity = "1";
                card.style.filter = "blur(0px)";
            } else if (offset === 1) {
                // Kartu Kedua (Belakang kanan)
                card.style.transform = "translateX(60px) scale(0.9) rotate(2deg)";
                card.style.zIndex = "10";
                card.style.opacity = "0.8";
                card.style.filter = "blur(1px)";
            } else if (offset === 2) {
                // Kartu Ketiga (Lebih belakang)
                card.style.transform = "translateX(120px) scale(0.8) rotate(4deg)";
                card.style.zIndex = "5";
                card.style.opacity = "0.4";
                card.style.filter = "blur(2px)";
            } else {
                // Kartu sisanya (Sembunyi)
                card.style.transform = "translateX(180px) scale(0.7) rotate(6deg)";
                card.style.zIndex = "1";
                card.style.opacity = "0";
                card.style.filter = "blur(4px)";
            }
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalCards;
        updateSlider();
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalCards) % totalCards;
        updateSlider();
    }

    function setSlide(index) {
        currentIndex = index;
        updateSlider();
    }

    // Auto Play (Opsional)
    let autoPlay = setInterval(nextSlide, 5000);

    // Stop auto play on hover
    const sliderContainer = document.getElementById('interactive-slider');
    sliderContainer.addEventListener('mouseenter', () => clearInterval(autoPlay));
    sliderContainer.addEventListener('mouseleave', () => autoPlay = setInterval(nextSlide, 5000));

    // Initialize
    updateSlider();
</script>
@endif
