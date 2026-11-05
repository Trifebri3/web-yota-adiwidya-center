@php
    // Ambil slide dari controller jika ada, atau query langsung dengan fallback aman
    $heroSlidesList = $heroSlides ?? null;

    if (!$heroSlidesList) {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('hero_slides')) {
                $heroSlidesList = \App\Models\HeroSlide::active()->ordered()->get();
            }
        } catch (\Throwable $e) {
            $heroSlidesList = collect();
        }
    }

    // Jika belum ada data di database, gunakan default slides bernuansa Pertamina & Yota
    if (!$heroSlidesList || $heroSlidesList->isEmpty()) {
        $heroSlidesList = collect([
            (object)[
                'id' => 1,
                'category' => 'BEASISWA SOBAT BUMI 2026',
                'title' => 'Pengumuman Penerima Beasiswa Yota Sobat Bumi 2026',
                'summary' => 'Hasil akhir penerima Beasiswa Yota Sobat Bumi 2026 telah resmi tersedia. Cek hasilmu dan selamat untuk melanjutkan perjalanan menjadi bagian dari agen masa depan!',
                'button_text' => 'Cek penerima',
                'button_link' => route('public.publications.index'),
                'image_url' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1920&q=80',
            ],
            (object)[
                'id' => 2,
                'category' => 'KOMPETISI & RISET',
                'title' => 'Dibuka Kompetisi Program Riset & Inovasi Masa Depan 2026',
                'summary' => 'Kompetisi inovasi teknologi dan resiliensi yang diselenggarakan oleh Yota Adiwidya Center sebagai wadah kolaborasi peneliti, akademisi, dan inovator muda Indonesia.',
                'button_text' => 'Daftar sekarang',
                'button_link' => route('public.publications.index'),
                'image_url' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=1920&q=80',
            ],
            (object)[
                'id' => 3,
                'category' => 'PUBLIKASI UTAMA',
                'title' => 'Kajian Ilmiah: Membangun Resiliensi Peradaban Berbasis STEAM',
                'summary' => 'Dokumen kajian mutakhir mengenai integrasi sains, teknologi, dan nilai nurani kemanusiaan dalam memitigasi bencana lingkungan di nusantara.',
                'button_text' => 'Baca publikasi',
                'button_link' => route('public.kajianilmiah.index'),
                'image_url' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1920&q=80',
            ],
            (object)[
                'id' => 4,
                'category' => 'PEMBERDAYAAN MASYARAKAT',
                'title' => 'Pengumuman Inkubasi 350 Inovator Sosial Desa Binaan Yota',
                'summary' => 'Daftar komprehensif inisiatif komunitas lokal yang lolos ke tahap pendampingan intensif dan dukungan pendanaan modal berdampak.',
                'button_text' => 'Lihat daftar terpilih',
                'button_link' => route('public.programs.index'),
                'image_url' => 'https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&fit=crop&w=1920&q=80',
            ],
        ]);
    }

    $slidesArray = $heroSlidesList->map(function($slide) {
        return [
            'id' => $slide->id,
            'category' => $slide->category ?? 'PENGUMUMAN',
            'title' => $slide->title,
            'summary' => $slide->summary ?? '',
            'button_text' => $slide->button_text ?? 'Baca Selengkapnya',
            'button_link' => $slide->button_link ?? '#',
            'image' => $slide->image_url ?? (isset($slide->image) ? asset('storage/' . $slide->image) : 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1920&q=80')
        ];
    })->values();
@endphp

{{-- ========================================================================= --}}
{{-- HERO CAROUSEL ARTIKEL & PUBLIKASI (GAYA RESMI PERTAMINA FOUNDATION)        --}}
{{-- ========================================================================= --}}
<section class="relative w-full bg-[#052c24] text-white overflow-hidden select-none"
    x-data="{
        slides: {{ Js::from($slidesArray) }},
        active: 0,
        autoplay: true,
        progress: 0,
        progressIntervalId: null,
        duration: 6500, // Durasi per slide (6.5 detik)
        stepTime: 50,   // Update progress bar tiap 50ms

        init() {
            this.startTimer();
        },

        startTimer() {
            this.progress = 0;
            clearInterval(this.progressIntervalId);
            
            const stepIncrement = (this.stepTime / this.duration) * 100;
            
            this.progressIntervalId = setInterval(() => {
                if (this.autoplay) {
                    this.progress += stepIncrement;
                    if (this.progress >= 100) {
                        this.nextSlide();
                    }
                }
            }, this.stepTime);
        },

        goTo(index) {
            this.active = index;
            this.startTimer();
        },

        nextSlide() {
            this.active = (this.active + 1) % this.slides.length;
            this.startTimer();
        },

        prevSlide() {
            this.active = (this.active - 1 + this.slides.length) % this.slides.length;
            this.startTimer();
        }
    }"
    @mouseenter="autoplay = false"
    @mouseleave="autoplay = true"
    @keydown.right.window="nextSlide()"
    @keydown.left.window="prevSlide()"
>

    {{-- Main Banner Area (Tinggi proporsional elegan) --}}
    <div class="relative w-full h-[520px] sm:h-[560px] md:h-[620px] lg:h-[680px] overflow-hidden">

        {{-- Slides Stack (Fade Halus Tanpa Geser-Geser Liar) --}}
        <template x-for="(slide, index) in slides" :key="slide.id">
            <div
                class="absolute inset-0 transition-opacity duration-700 ease-in-out"
                :class="active === index ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'"
            >
                {{-- Background Image (Diam & Tajam, LCP Optimized) --}}
                <div class="absolute inset-0 overflow-hidden">
                    <img
                        :src="slide.image"
                        :alt="slide.title"
                        :fetchpriority="index === 0 ? 'high' : 'auto'"
                        :loading="index === 0 ? 'eager' : 'lazy'"
                        decoding="async"
                        class="w-full h-full object-cover object-center"
                        width="1920"
                        height="800"
                    />
                </div>

                {{-- Dark Gradients Overlay untuk Kontras Teks Maksimal --}}
                <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/55 to-black/20"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>

                {{-- Slide Text Content --}}
                <div class="relative h-full max-w-7xl mx-auto px-6 lg:px-8 flex flex-col justify-center pb-24 md:pb-28 z-20">
                    <div class="max-w-3xl">
                        {{-- Badge Category --}}
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-[#BEF264] text-xs font-black tracking-widest uppercase mb-4 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-[#BEF264]"></span>
                            <span x-text="slide.category"></span>
                        </div>

                        {{-- Main Headline --}}
                        <h2 class="text-2xl sm:text-3xl md:text-5xl lg:text-5xl font-black tracking-tight text-white mb-4 leading-tight drop-shadow-md"
                            x-text="slide.title">
                        </h2>

                        {{-- Summary Paragraph --}}
                        <p class="text-sm sm:text-base md:text-lg text-slate-200/90 mb-8 leading-relaxed font-light line-clamp-3 max-w-2xl drop-shadow"
                           x-text="slide.summary">
                        </p>

                        {{-- Action CTA Button (Pill Button Rounded-Full Sesuai Pertamina) --}}
                        <div class="flex flex-wrap items-center gap-4">
                            <a :href="slide.button_link"
                               class="group inline-flex items-center gap-3 bg-transparent hover:bg-white text-white hover:text-[#052c24] border-2 border-white/90 hover:border-white px-8 py-3 rounded-full font-bold text-sm md:text-base tracking-wide transition-all duration-300 shadow-lg">
                                <span x-text="slide.button_text"></span>
                                <span class="group-hover:translate-x-1.5 transition-transform duration-300">→</span>
                            </a>

                            <a href="{{ route('public.publications.index') }}"
                               class="text-xs uppercase tracking-widest font-black text-slate-300 hover:text-[#BEF264] transition-colors py-3">
                                Lihat Berita Lainnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>

    </div>

    {{-- ========================================================================= --}}
    {{-- BOTTOM NAVIGATION TAB BAR PERSIS PERTAMINA FOUNDATION                     --}}
    {{-- (Tampil Pas Rata 1 Baris Grid, Tidak Ada Geser-Geser / Scrollbar Horisontal) --}}
    {{-- ========================================================================= --}}
    <div class="absolute bottom-0 inset-x-0 z-30 bg-black/65 backdrop-blur-md border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Grid terbagi rata sesuai jumlah slide (2 kolom di mobile, 4 kolom di desktop) --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6 py-3 md:py-4">
                <template x-for="(slide, index) in slides" :key="'tab-' + slide.id">
                    <button
                        type="button"
                        @click="goTo(index)"
                        class="relative text-left py-2 px-2.5 sm:px-3 rounded-lg transition-colors group cursor-pointer overflow-hidden"
                        :class="active === index ? 'text-white' : 'text-slate-400 hover:text-white'"
                    >
                        {{-- Tab Title with Dot --}}
                        <div class="flex items-center gap-2">
                            {{-- Bullet Dot (Cyan/Lime glowing saat aktif, abu saat non-aktif) --}}
                            <span
                                class="w-2 h-2 rounded-full shrink-0 transition-colors"
                                :class="active === index ? 'bg-[#38bdf8] ring-4 ring-[#38bdf8]/30' : 'bg-slate-400 group-hover:bg-slate-200'"
                            ></span>

                            {{-- Title Text (Rapi 1 atau 2 baris tanpa terpotong jelek) --}}
                            <span
                                class="text-[11px] sm:text-xs font-semibold line-clamp-1 leading-snug transition-colors"
                                :class="active === index ? 'text-white font-bold' : 'text-slate-300 group-hover:text-white'"
                                x-text="slide.title"
                            ></span>
                        </div>

                        {{-- Animated Progress Line di bawah tab aktif (khas Pertamina) --}}
                        <div class="absolute bottom-0 left-0 right-0 h-[2.5px] bg-white/15 overflow-hidden rounded-full mt-1.5">
                            <div
                                class="h-full bg-[#BEF264] transition-all duration-75"
                                :style="active === index ? `width: ${progress}%` : 'width: 0%'"
                            ></div>
                        </div>
                    </button>
                </template>
            </div>
        </div>
    </div>

</section>
