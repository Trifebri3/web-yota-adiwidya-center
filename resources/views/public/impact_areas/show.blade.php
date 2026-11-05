@extends('public.layouts.app')

@php
    $locale = app()->getLocale();
    $pillarCode = $impactArea->code ?? '01';
    $pillarSlug = $impactArea->slug ?? 'youth-development';
    $pillarName = $impactArea->name ?? 'Youth Development';
    $pillarColor = $impactArea->color ?? '#0361a4';

    // Data Master Program Representatif dengan Foto, Logo, dan Angka Statistik Real
    $programsPortfolio = [
        'youth-development' => [
            [
                'title' => 'CAP 2026: Collaborative Action Program',
                'slug' => 'cap-2026',
                'badge' => 'Open Call Inisiatif',
                'badge_color' => '#2563eb',
                'status' => 'Pendaftaran Dibuka',
                'logo_url' => asset('pilar/pilar6/6.png'),
                'banner_url' => asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png'),
                'description' => 'Program inkubasi intensif pemuda untuk merancang solusi aplikatif STEAM, mitigasi bencana, dan penguatan ekonomi sirkular desa binaan melalui hibah mikro dan pendampingan mentor.',
                'stats' => [
                    ['value' => '100', 'label' => 'Inovator Terpilih'],
                    ['value' => '10', 'label' => 'Desa Binaan'],
                    ['value' => '100%', 'label' => 'Hibah Aksi Lapangan']
                ],
                'url' => route('public.programs.show', 'cap-2026')
            ],
            [
                'title' => 'Platform Belajar Digital YOTA',
                'slug' => 'yota-digital-learning-platform-2026',
                'badge' => 'Pendidikan Inklusif',
                'badge_color' => '#16a34a',
                'status' => 'Sedang Berjalan',
                'logo_url' => asset('image/yt.png'),
                'banner_url' => asset('storage/programs/banners/1.jpg'),
                'description' => 'Akselerasi literasi teknologi dan kurikulum masa depan melalui modul STEAM terapan interaktif yang dapat diakses oleh pelajar dan pemuda di wilayah pelosok nusantara.',
                'stats' => [
                    ['value' => '1.450+', 'label' => 'Siswa Aktif'],
                    ['value' => '24', 'label' => 'Modul Terbuka'],
                    ['value' => '12', 'label' => 'Sekolah Rintisan']
                ],
                'url' => route('public.programs.show', 'yota-digital-learning-platform-2026')
            ],
            [
                'title' => 'Pelatihan Relawan Muda Tanggap Bencana',
                'slug' => 'youth-emergency-volunteer-training-2026',
                'badge' => 'Resiliensi Komunitas',
                'badge_color' => '#d97706',
                'status' => 'Tahap Seleksi',
                'logo_url' => asset('pilar/pilar1/1.png'),
                'banner_url' => asset('storage/programs/banners/20.jpg'),
                'description' => 'Bootcamp kepemimpinan lapangan dan sertifikasi kesiapsiagaan bencana bagi pemuda di zona sesar aktif dan pesisir rawan gempa, memadukan protokol evakuasi dan simulasi ramah anak.',
                'stats' => [
                    ['value' => '320', 'label' => 'Relawan Terlatih'],
                    ['value' => '5', 'label' => 'Zona Kerentanan'],
                    ['value' => '24', 'label' => 'Jam Simulasi Aksi']
                ],
                'url' => route('public.programs.show', 'youth-emergency-volunteer-training-2026')
            ],
            [
                'title' => 'YOTA Hub: Innovation & Youth Co-Creation Lab',
                'slug' => 'yota-hub',
                'badge' => 'Ekosistem Kolaborasi',
                'badge_color' => '#052c24',
                'status' => 'Platform Aktif',
                'logo_url' => asset('image/yt.png'),
                'banner_url' => asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png'),
                'description' => 'Pusat inkubasi digital dan jejaring talenta muda lintas universitas untuk menguji prototipe tepat guna, berjejaring dengan praktisi industri, dan mengadvokasi ide pembangunan berkelanjutan.',
                'stats' => [
                    ['value' => '12.500+', 'label' => 'Jejaring Pemuda'],
                    ['value' => '35+', 'label' => 'Kampus Mitra'],
                    ['value' => '14', 'label' => 'Prototipe Tepat Guna']
                ],
                'url' => 'https://hub.siyota.org'
            ]
        ],
        'community-empowerment' => [
            [
                'title' => 'The Community Space: Digitalisasi Desa Binaan',
                'slug' => 'the-community-space-village-digitalization-2026',
                'badge' => 'Pemberdayaan Warga',
                'badge_color' => '#b8984b',
                'status' => 'Sedang Berjalan',
                'logo_url' => asset('pilar/pilar5/5.png'),
                'banner_url' => asset('storage/programs/banners/18.jpg'),
                'description' => 'Pusat literasi digital dan pendampingan kelompok warga desa dalam mengadopsi pencatatan keuangan transparan dan akses pemasaran hasil bumi.',
                'stats' => [
                    ['value' => '42', 'label' => 'Kelompok Warga'],
                    ['value' => '120+', 'label' => 'UMKM Dampingan'],
                    ['value' => '4', 'label' => 'Kecamatan']
                ],
                'url' => route('public.programs.show', 'the-community-space-village-digitalization-2026')
            ],
            [
                'title' => 'The Community Space (Community Service)',
                'slug' => 'the-community-space-community-service-p9UMN',
                'badge' => 'Layanan Komunitas',
                'badge_color' => '#16a34a',
                'status' => 'Sedang Berjalan',
                'logo_url' => asset('pilar/pilar5/5.png'),
                'banner_url' => asset('pilar/pilar5/Earthy Community Empowerment Mosaic.png'),
                'description' => 'Ruang inklusif pertemuan antargenerasi untuk penguatan kapasitas keluarga, penanganan stunting, dan pengembangan kebun gizi komunal.',
                'stats' => [
                    ['value' => '850+', 'label' => 'Keluarga Penerima'],
                    ['value' => '18', 'label' => 'Posyandu Terpadu'],
                    ['value' => '98%', 'label' => 'Kepuasan Warga']
                ],
                'url' => route('public.programs.show', 'the-community-space-community-service-p9UMN')
            ]
        ],
        'environmental-conservation' => [
            [
                'title' => 'Green Forestry & BioTag Initiative',
                'slug' => 'green-forestry-biotag-initiative-2026',
                'badge' => 'Konservasi Cerdas',
                'badge_color' => '#34763d',
                'status' => 'Sedang Berjalan',
                'logo_url' => asset('pilar/pilar4/4.png'),
                'banner_url' => asset('storage/programs/banners/21.jpg'),
                'description' => 'Restorasi kawasan hulu DAS dengan penanaman ribuan pohon endemik dan penyematan penanda geospasial BioTag untuk pemantauan pertumbuhan pohon berbasis data terbuka.',
                'stats' => [
                    ['value' => '12.000+', 'label' => 'Pohon Tertanam'],
                    ['value' => '1.850 Ha', 'label' => 'Kawasan Terlindungi'],
                    ['value' => '100%', 'label' => 'Terpantau BioTag']
                ],
                'url' => route('public.programs.show', 'green-forestry-biotag-initiative-2026')
            ]
        ],
        'innovation-research' => [
            [
                'title' => 'Inovasi AgroSense: Smart Agriculture Desa Binaan',
                'slug' => 'smart-agriculture-agrosense',
                'badge' => 'Teknologi Presisi',
                'badge_color' => '#04717f',
                'status' => 'Sedang Berjalan',
                'logo_url' => asset('pilar/pilar3/3.png'),
                'banner_url' => asset('pilar/pilar3/Teal Innovation Research Grid.png'),
                'description' => 'Pemasangan sensor tanah nirkabel IoT dan stasiun cuaca mikro untuk memandu jadwal irigasi presisi dan pemupukan berimbang bagi petani sayur lereng gunung.',
                'stats' => [
                    ['value' => '34', 'label' => 'Sensor Terpasang'],
                    ['value' => '40%', 'label' => 'Efisiensi Air'],
                    ['value' => '28%', 'label' => 'Kenaikan Hasil Panen']
                ],
                'url' => route('public.programs.show', 'smart-agriculture-agrosense')
            ]
        ],
        'disaster-resilience' => [
            [
                'title' => 'YOTA Bencana: Siaga & Mitigasi Cincin Api',
                'slug' => 'yota-bencana',
                'badge' => 'Mitigasi Bencana',
                'badge_color' => '#8f2c2d',
                'status' => 'Sedang Berjalan',
                'logo_url' => asset('pilar/pilar1/1.png'),
                'banner_url' => asset('pilar/pilar1/Disaster Resilience Mosaic Poster.png'),
                'description' => 'Sistem mitigasi mandiri dan jalur evakuasi sekolah ramah anak di kawasan sesar aktif untuk meminimalkan risiko korban jiwa sejak bangku sekolah dasar.',
                'stats' => [
                    ['value' => '24', 'label' => 'Sekolah Tangguh'],
                    ['value' => '3.800+', 'label' => 'Anak Tersimulasi'],
                    ['value' => '100%', 'label' => 'Rambu Siaga Terpasang']
                ],
                'url' => route('public.programs.show', 'yota-bencana')
            ]
        ],
        'knowledge-publication' => [
            [
                'title' => 'Diseminasi Whitepaper & Policy Brief Transisi Sosial',
                'slug' => 'policy-brief-transisi-sosial',
                'badge' => 'Advokasi Kebijakan',
                'badge_color' => '#55307f',
                'status' => 'Diseminasi Terbuka',
                'logo_url' => asset('pilar/pilar2/2.png'),
                'banner_url' => asset('pilar/pilar2/Purple Knowledge Mosaic Poster.png'),
                'description' => 'Penerbitan monograf ilmiah dan ringkasan kebijakan berbasis bukti lapangan untuk mendorong replikasi inovasi desa pada tingkat perencanaan pembangunan daerah.',
                'stats' => [
                    ['value' => '142+', 'label' => 'Naskah Ilmiah'],
                    ['value' => '32', 'label' => 'Lembaga Terlibat'],
                    ['value' => '100%', 'label' => 'Akses Terbuka (Open Access)']
                ],
                'url' => route('public.docs.index')
            ]
        ]
    ];

    $curatedPrograms = $programsPortfolio[$pillarSlug] ?? $programsPortfolio['youth-development'];

    // Narasi Cerita Gerakan yang Kuat & Mendalam (User Feedback: Jangan Flat 5W1H)
    $pillarStories = [
        'youth-development' => [
            'headline' => 'Bukan Sekadar Relawan, Melainkan Arsitek Masa Depan.',
            'subheadline' => 'Mengapa kami memandang pemuda sebagai jangkar perubahan peradaban, bukan sekadar pelengkap seremonial.',
            'quote' => 'Generasi muda Indonesia tidak kekurangan potensi atau kecerdasan; mereka membutuhkan ruang percaya, metodologi aplikatif, dan panggung nyata untuk membuktikan baktinya pada bumi dan sesama.',
            'quote_author' => 'Dewan Pembina Yayasan Yota Wujudkan Asa',
            'chapters' => [
                [
                    'num' => '01',
                    'title' => 'Melampaui Jerat Seremoni: Mengapa Aksi Nyata Diperlukan?',
                    'content' => 'Di tengah gegap gempita bonus demografi dan disrupsi kecerdasan buatan, pemuda di daerah seringkali hanya diposisikan sebagai target pasif atau relawan jangka pendek. YOTA membalik cara pandang ini secara radikal: kami menempatkan pemuda sebagai co-creator yang merumuskan masalah langsung di lapangan dan mengeksekusi solusinya secara terukur.'
                ],
                [
                    'num' => '02',
                    'title' => 'Sains Tanpa Dinding: Menjembatani Laboratorium & Akar Rumput',
                    'content' => 'Melalui pendidikan STEAM terapan dan Collaborative Action Program (CAP), kami mengajak pemuda membumikan teknologi. Mahasiswa teknik merancang sensor tanah AgroSense bersama petani cabai; mahasiswa sains menyusun modul mitigasi gempa ramah anak di sekolah dasar lereng sesar. Inilah pembelajaran bermakna yang menyatukan kecakapan logika dan kepekaan rasa.'
                ],
                [
                    'num' => '03',
                    'title' => 'Resiliensi Berkelanjutan: Melahirkan Pemimpin Berintegritas',
                    'content' => 'Dampak sejati tidak berhenti saat sertifikat dibagikan. Melalui ekosistem YOTA Hub, kami membangun jejaring alumni mandiri yang terus berjejaring, mendirikan wirausaha sosial desa, dan menjadi mitra kritis pemerintah daerah dalam mengawal Tujuan Pembangunan Berkelanjutan (SDGs).'
                ]
            ],
            'theory_of_change' => [
                ['step' => 'Karakter & Empati', 'desc' => 'Menanamkan integritas moral, kepedulian lingkungan, dan penghormatan pada kearifan lokal.'],
                ['step' => 'Kapabilitas STEAM', 'desc' => 'Membekali keterampilan digital, metodologi riset aksi, dan teknologi tepat guna.'],
                ['step' => 'Inkubasi Lapangan', 'desc' => 'Penyaluran hibah mikro, pendampingan mentor praktisi, dan eksekusi di desa binaan.'],
                ['step' => 'Dampak Kebijakan', 'desc' => 'Mendokumentasikan bukti lapangan menjadi rekomendasi kebijakan publik nasional.']
            ]
        ],
        'default' => [
            'headline' => 'Dampak Terukur Berbasis Sains & Kerakyatan.',
            'subheadline' => 'Inisiatif strategis yang berpijak pada data lapangan dan bermuara pada kemandirian masyarakat.',
            'quote' => 'Setiap intervensi harus menyisakan kemandirian di tangan warga dan memulihkan keseimbangan ekosistem.',
            'quote_author' => 'Tim Pengarah Program YOTA',
            'chapters' => [
                [
                    'num' => '01',
                    'title' => 'Membaca Fakta dari Akar Rumput',
                    'content' => 'Kami tidak merancang program dari balik meja kantor. Seluruh inisiatif bermula dari penilaian kerentanan partisipatif bersama warga, mendengarkan apa yang sesungguhnya mereka butuhkan untuk bertahan dan berdaya.'
                ],
                [
                    'num' => '02',
                    'title' => 'Integrasi Teknologi Tepat Guna & Sains Terbuka',
                    'content' => 'Setiap rupiah dan energi yang dialokasikan dikawal dengan indikator capaian terverifikasi. Kami memadukan sensor modern dengan kearifan lokal agar solusi yang tercipta dapat dirawat mandiri oleh komunitas.'
                ],
                [
                    'num' => '03',
                    'title' => 'Replikasi Skala Luas & Berkelanjutan',
                    'content' => 'Hasil nyata di desa percontohan didokumentasikan dalam format monograf terbuka, membuka jalan bagi donor, korporasi CSR, dan pemerintah untuk mereplikasi model ini ke ratusan desa lainnya.'
                ]
            ],
            'theory_of_change' => [
                ['step' => 'Pemetaan Fakta', 'desc' => 'Riset lapangan partisipatif mengidentifikasi akar persoalan warga.'],
                ['step' => 'Ko-Desain Solusi', 'desc' => 'Merancang intervensi bersama tokoh lokal dan pakar multidisiplin.'],
                ['step' => 'Implementasi Aksi', 'desc' => 'Penerapan teknologi tepat guna dan pelatihan mandiri warga.'],
                ['step' => 'Evaluasi Terbuka', 'desc' => 'Pengukuran dampak nyata dan diseminasi pembelajaran nasional.']
            ]
        ]
    ];

    $storyData = $pillarStories[$pillarSlug] ?? $pillarStories['default'];
@endphp

@section('title', $pillarName . ' | 6 Pilar Program YOTA — SIYOTA.org')
@section('seo_title', $pillarName . ' - Pilar Strategis Yayasan Yota Wujudkan Asa')
@section('seo_description', Str::limit($impactArea->description ?? '', 160))
@section('og_title', $pillarName . ' | 6 Pilar Program YOTA — SIYOTA.org')
@section('og_image', $impactArea->motif_url ?? asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png'))

@section('content')
<div class="bg-[#FDFDFB] min-h-screen font-['Plus_Jakarta_Sans']">

    {{-- ========================================================================= --}}
    {{-- A. HERO BANNER PILAR                                                      --}}
    {{-- ========================================================================= --}}
    <section class="relative bg-slate-950 text-white overflow-hidden pt-24 pb-20 md:py-32">
        {{-- Background Motif Image --}}
        <img src="{{ $impactArea->motif_url ?? asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png') }}"
             alt="{{ $pillarName }}"
             class="absolute inset-0 w-full h-full object-cover opacity-35 object-center">

        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/95 via-black/85 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#052c24] via-transparent to-transparent opacity-80"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                {{-- Breadcrumb & Badge --}}
                <div class="flex items-center gap-2.5 mb-6 text-xs font-bold uppercase tracking-wider">
                    <a href="{{ route('public.impact-areas.index') }}" class="text-slate-300 hover:text-white transition-colors">
                        ← Semua Pilar
                    </a>
                    <span class="text-slate-500">•</span>
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider text-white border border-white/20 font-mono shadow-sm"
                          style="background-color: {{ $pillarColor }}">
                        PILAR {{ $pillarCode }}
                    </span>
                </div>

                {{-- Logo and Title --}}
                <div class="flex items-center gap-4 sm:gap-5 mb-4">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl p-2.5 bg-white shadow-2xl shrink-0 flex items-center justify-center border border-white/20">
                        <img src="{{ $impactArea->logo_url ?? asset('image/yt.png') }}" alt="{{ $pillarName }}" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h1 class="text-3xl sm:text-5xl md:text-6xl font-black tracking-tight text-white uppercase leading-none">
                            {{ $pillarName }}
                        </h1>
                        <p class="text-xs sm:text-sm md:text-base font-bold italic mt-2 text-[#BEF264]">
                            {{ $impactArea->tagline ?? '' }}
                        </p>
                    </div>
                </div>

                {{-- Description --}}
                <p class="text-slate-200 text-xs sm:text-sm md:text-base leading-relaxed font-light mt-4 max-w-2xl">
                    {{ $impactArea->description }}
                </p>

                {{-- Quick Nav Anchor Buttons --}}
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#programs" class="px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-wider text-white shadow-lg hover:scale-105 transition-all"
                       style="background-color: {{ $pillarColor }}">
                        Portofolio Program ↓
                    </a>
                    <a href="#story" class="px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-wider bg-white/10 hover:bg-white/20 text-white backdrop-blur border border-white/20 transition-all">
                        Kisah & Teori Perubahan
                    </a>
                    <a href="{{ route('public.tentangkami.kontak', ['kemitraan' => 'volunteer']) }}"
                       class="px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-wider bg-[#BEF264] text-[#052c24] hover:bg-white transition-all shadow-md">
                        Kolaborasi Bersama Kami →
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================================================= --}}
    {{-- B. REAL STATISTICAL IMPACT BAR (User Screenshot Aligned)                   --}}
    {{-- ========================================================================= --}}
    <section class="bg-white border-b border-slate-200/80 py-8 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($impactArea->stats ?? [
                    ['label' => 'YOUTH REACHED', 'value' => '12.500+'],
                    ['label' => 'ACTIVE VOLUNTEERS', 'value' => '1.200+'],
                    ['label' => 'PROGRAMS HELD', 'value' => '48+'],
                    ['label' => 'PARTNER CAMPUSES', 'value' => '35+'],
                ] as $st)
                <div class="text-center p-3 border-r last:border-none border-slate-100">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-black font-mono tracking-tight" style="color: {{ $pillarColor }}">
                        {{ $st['value'] }}
                    </div>
                    <div class="text-[9px] sm:text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mt-1">
                        {{ $st['label'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========================================================================= --}}
    {{-- C. ACTION PORTFOLIO: PROGRAM DENGAN FOTO, LOGO & ANGKA STATISTIK REAL      --}}
    {{-- ========================================================================= --}}
    <section id="programs" class="py-16 md:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-[#064e3b] text-[10px] font-black uppercase tracking-[0.25em] mb-2.5">
                    <span class="w-2 h-2 rounded-full" style="background-color: {{ $pillarColor }}"></span>
                    <span>ACTION PORTFOLIO & REAL INITIATIVES</span>
                </div>
                <h2 class="text-2xl sm:text-4xl font-black text-[#052c24] uppercase tracking-tight leading-tight">
                    Program Inisiatif {{ $pillarName }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 font-normal mt-1 max-w-2xl">
                    Implementasi nyata di lapangan lengkap dengan dokumentasi visual, status aktivitas, dan capaian statistik terverifikasi.
                </p>
            </div>

            <a href="{{ route('public.programs.index') }}"
               class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-wider text-[#052c24] hover:text-emerald-700 transition-colors shrink-0">
                <span>Lihat Semua Program Organisasi</span>
                <span>→</span>
            </a>
        </div>

        {{-- Bento Grid Program Cards dengan Foto, Logo, dan Metrik Angka Riil --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($curatedPrograms as $prog)
            <article class="group bg-white rounded-3xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">

                <div>
                    {{-- 1. Visual Banner Image with Logo Badge --}}
                    <div class="relative aspect-[16/10] overflow-hidden bg-slate-900">
                        <img src="{{ $prog['banner_url'] }}"
                             alt="{{ $prog['title'] }}"
                             loading="lazy"
                             decoding="async"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90 group-hover:opacity-100">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                        {{-- Category Badge --}}
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-xl bg-white/95 backdrop-blur text-[9px] font-black uppercase tracking-wider text-[#052c24] shadow-sm font-mono">
                                {{ $prog['badge'] }}
                            </span>
                        </div>

                        {{-- Floating Initiative Logo --}}
                        <div class="absolute -bottom-3 right-5 w-12 h-12 rounded-2xl bg-white p-2 shadow-xl border border-slate-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <img src="{{ $prog['logo_url'] }}" alt="Logo {{ $prog['title'] }}" class="w-full h-full object-contain">
                        </div>
                    </div>

                    {{-- 2. Card Body --}}
                    <div class="p-6 pt-5">
                        <div class="flex items-center gap-2 mb-2 text-[10px] font-bold">
                            <span class="w-2 h-2 rounded-full" style="background-color: {{ $prog['badge_color'] }}"></span>
                            <span class="text-emerald-700 uppercase font-black tracking-wider">{{ $prog['status'] }}</span>
                        </div>

                        <h3 class="text-lg font-black text-[#052c24] leading-snug uppercase tracking-tight group-hover:text-emerald-700 transition-colors mb-2.5">
                            <a href="{{ $prog['url'] }}">
                                {{ $prog['title'] }}
                            </a>
                        </h3>

                        <p class="text-xs text-slate-500 font-normal leading-relaxed line-clamp-3 mb-5">
                            {{ $prog['description'] }}
                        </p>

                        {{-- 3. Angka Statistik Real Berdasarkan Input Program --}}
                        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 grid grid-cols-3 gap-2 text-center mb-2">
                            @foreach($prog['stats'] as $metric)
                            <div class="p-1">
                                <span class="block text-xs sm:text-sm font-black text-[#052c24] font-mono leading-none">
                                    {{ $metric['value'] }}
                                </span>
                                <span class="block text-[8px] font-black uppercase tracking-wider text-slate-400 mt-1 leading-tight truncate">
                                    {{ $metric['label'] }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- 4. Card Action Footer --}}
                <div class="p-6 pt-0">
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[10px] font-mono font-bold text-slate-400">
                            Pilar {{ $pillarCode }}
                        </span>

                        <a href="{{ $prog['url'] }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider text-white shadow-xs transition-all hover:scale-105"
                           style="background-color: {{ $pillarColor }}">
                            <span>Detail Program</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>

            </article>
            @endforeach
        </div>
    </section>

    {{-- ========================================================================= --}}
    {{-- D. STORY GERAKAN & TEORI PERUBAHAN (MENGGANTIKAN 5W1H YANG KAKU & PLAT)     --}}
    {{-- ========================================================================= --}}
    <section id="story" class="py-16 md:py-24 bg-white border-y border-slate-200/80 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Story Header --}}
            <div class="max-w-3xl mb-12 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-[#064e3b] text-[10px] font-black uppercase tracking-[0.25em] mb-3">
                    <span class="w-2 h-2 rounded-full" style="background-color: {{ $pillarColor }}"></span>
                    <span>THE STORY & THEORY OF CHANGE</span>
                </div>
                <h2 class="text-2xl sm:text-4xl md:text-5xl font-black text-[#052c24] leading-tight tracking-tight uppercase">
                    {{ $storyData['headline'] }}
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-slate-500 font-normal mt-2 leading-relaxed">
                    {{ $storyData['subheadline'] }}
                </p>
            </div>

            {{-- Quote Callout --}}
            <div class="mb-14 p-6 sm:p-8 rounded-3xl bg-[#052c24] text-white shadow-xl relative overflow-hidden">
                <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-emerald-600/20 rounded-full blur-2xl pointer-events-none"></div>
                <blockquote class="text-base sm:text-xl font-medium leading-relaxed italic text-slate-100 mb-4 max-w-4xl relative z-10">
                    “{{ $storyData['quote'] }}”
                </blockquote>
                <div class="flex items-center gap-3 relative z-10">
                    <div class="w-2 h-2 rounded-full bg-[#BEF264]"></div>
                    <span class="text-xs font-black uppercase tracking-wider text-[#BEF264]">
                        {{ $storyData['quote_author'] }}
                    </span>
                </div>
            </div>

            {{-- 3 Chapters of Narrative Storytelling --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                @foreach($storyData['chapters'] as $ch)
                <div class="p-6 sm:p-7 rounded-3xl bg-slate-50/70 border border-slate-200/80 flex flex-col justify-between">
                    <div>
                        <span class="text-2xl sm:text-3xl font-black font-mono block mb-3" style="color: {{ $pillarColor }}">
                            {{ $ch['num'] }}
                        </span>
                        <h3 class="text-base font-black text-[#052c24] leading-snug uppercase tracking-tight mb-2.5">
                            {{ $ch['title'] }}
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 font-normal leading-relaxed">
                            {{ $ch['content'] }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Roadmap Arsitektur Perubahan (Theory of Change) --}}
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                    <div>
                        <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">METODOLOGI TRANSFORMASI</span>
                        <h4 class="text-base font-black text-[#052c24] uppercase tracking-tight">
                            Arsitektur Teori Perubahan (Theory of Change)
                        </h4>
                    </div>
                    <span class="text-[10px] font-mono font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                        Siklus Dampak Berkelanjutan
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($storyData['theory_of_change'] as $idx => $toc)
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-between relative group hover:bg-slate-100 transition-colors">
                        <div>
                            <span class="text-[10px] font-mono font-black uppercase tracking-wider text-slate-400 block mb-1">
                                TAHAP {{ sprintf('%02d', $idx + 1) }}
                            </span>
                            <h5 class="text-xs font-black text-[#052c24] uppercase mb-1.5">
                                {{ $toc['step'] }}
                            </h5>
                            <p class="text-[11px] text-slate-500 font-normal leading-relaxed">
                                {{ $toc['desc'] }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    {{-- ========================================================================= --}}
    {{-- E. SWITCHER KE PILAR LAIN                                                 --}}
    {{-- ========================================================================= --}}
    <section class="py-16 bg-[#FDFDFB]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-xs font-black uppercase tracking-widest text-slate-400 text-center mb-8">
                Jelajahi Pilar Strategis Lainnya:
            </h3>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                @foreach($allPillars as $p)
                <a href="{{ route('public.impact-areas.show', $p->slug) }}"
                   class="p-4 rounded-2xl border text-center transition-all hover:shadow-md hover:scale-105 {{ $p->slug == $pillarSlug ? 'bg-white border-2 shadow-md' : 'bg-white border-slate-200' }}"
                   style="{{ $p->slug == $pillarSlug ? 'border-color: ' . $p->color : '' }}">
                    <div class="w-10 h-10 rounded-xl p-1.5 bg-slate-50 mx-auto mb-2 flex items-center justify-center border border-slate-100">
                        <img src="{{ $p->logo_url ?? asset('image/yt.png') }}" alt="{{ $p->name }}" class="w-full h-full object-contain">
                    </div>
                    <div class="text-[11px] font-black text-slate-800 uppercase line-clamp-1 leading-tight">
                        {{ $p->name }}
                    </div>
                    <span class="text-[9px] font-mono font-bold text-slate-400 mt-0.5 block">Pilar {{ $p->code }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>

</div>
@endsection
