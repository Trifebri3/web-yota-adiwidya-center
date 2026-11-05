@php
    $lang = app()->getLocale();

    // 1. Query program dari database
    $dbPrograms = collect();
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('programs')) {
            $dbPrograms = \App\Models\Program::with('impactAreas')->get();
        }
    } catch (\Throwable $e) {
        $dbPrograms = collect();
    }

    // 2. Data Master Sebaran Program Terikat 6 Pilar di Indonesia
    // (Menggabungkan data DB jika ada koordinat, ditambah titik aksi kurasi pilar representatif)
    $curatedLocations = [
        // ================= PILAR 01: YOUTH DEVELOPMENT (#0361a4) =================
        [
            'id' => 101,
            'title' => 'Peluncuran Platform Belajar Digital YOTA',
            'pillar_code' => '01',
            'pillar_name' => 'Youth Development',
            'pillar_color' => '#0361a4',
            'pillar_slug' => 'youth-development',
            'location_name' => 'Bandung, Jawa Barat',
            'region' => 'Jawa & Bali',
            'lat' => -6.9175,
            'lng' => 107.6191,
            'status' => 'Sedang Berjalan',
            'status_color' => '#16a34a',
            'beneficiaries' => '1.450+ Siswa & Pemuda',
            'url' => route('public.programs.index'),
            'desc' => 'Akselerasi literasi teknologi, modul STEAM terapan, dan kurikulum masa depan untuk pelajar.',
        ],
        [
            'id' => 102,
            'title' => 'Inkubasi STEAM & Youth Leadership Academy',
            'pillar_code' => '01',
            'pillar_name' => 'Youth Development',
            'pillar_color' => '#0361a4',
            'pillar_slug' => 'youth-development',
            'location_name' => 'Sleman, D.I. Yogyakarta',
            'region' => 'Jawa & Bali',
            'lat' => -7.7956,
            'lng' => 110.3695,
            'status' => 'Open Recruitment',
            'status_color' => '#2563eb',
            'beneficiaries' => '320 Pemimpin Muda',
            'url' => route('public.programs.index'),
            'desc' => 'Bootcamp intensif inovator muda dalam menciptakan solusi teknologi tepat guna di daerah.',
        ],
        [
            'id' => 103,
            'title' => 'Youth Innovation Fellowship Sumatera',
            'pillar_code' => '01',
            'pillar_name' => 'Youth Development',
            'pillar_color' => '#0361a4',
            'pillar_slug' => 'youth-development',
            'location_name' => 'Medan, Sumatera Utara',
            'region' => 'Sumatera',
            'lat' => 3.5952,
            'lng' => 98.6722,
            'status' => 'Tahap Persiapan',
            'status_color' => '#d97706',
            'beneficiaries' => '180 Inovator Kampus',
            'url' => route('public.programs.index'),
            'desc' => 'Jejaring talenta muda lintas universitas untuk riset aksi dan kepemimpinan digital.',
        ],

        // ================= PILAR 02: COMMUNITY EMPOWERMENT (#b8984b) =================
        [
            'id' => 201,
            'title' => 'The Community Space - Digitalisasi Desa',
            'pillar_code' => '02',
            'pillar_name' => 'Community Empowerment',
            'pillar_color' => '#b8984b',
            'pillar_slug' => 'community-empowerment',
            'location_name' => 'Bandung Barat, Jawa Barat',
            'region' => 'Jawa & Bali',
            'lat' => -6.8402,
            'lng' => 107.5147,
            'status' => 'Sedang Berjalan',
            'status_color' => '#16a34a',
            'beneficiaries' => '42 Kelompok Warga',
            'url' => route('public.programs.index'),
            'desc' => 'Pusat pemberdayaan warga berbasis komunitas untuk digitalisasi layanan dan literasi inklusif.',
        ],
        [
            'id' => 202,
            'title' => 'Sentra Agrowisata & Tenun Mandiri Komunitas',
            'pillar_code' => '02',
            'pillar_name' => 'Community Empowerment',
            'pillar_color' => '#b8984b',
            'pillar_slug' => 'community-empowerment',
            'location_name' => 'Lombok Utara, Nusa Tenggara Barat',
            'region' => 'Nusa Tenggara',
            'lat' => -8.3582,
            'lng' => 116.1554,
            'status' => 'Sedang Berjalan',
            'status_color' => '#16a34a',
            'beneficiaries' => '120 Pengrajin Lokal',
            'url' => route('public.programs.index'),
            'desc' => 'Penguatan rantai pasok ekonomi kerajinan tenun dan ekowisata berbasis kearifan lokal.',
        ],
        [
            'id' => 203,
            'title' => 'Kemitraan Petani Kopi Berkelanjutan Toraja',
            'pillar_code' => '02',
            'pillar_name' => 'Community Empowerment',
            'pillar_color' => '#b8984b',
            'pillar_slug' => 'community-empowerment',
            'location_name' => 'Tana Toraja, Sulawesi Selatan',
            'region' => 'Sulawesi',
            'lat' => -3.0366,
            'lng' => 119.8655,
            'status' => 'Open Recruitment',
            'status_color' => '#2563eb',
            'beneficiaries' => '85 Petani Kopi',
            'url' => route('public.programs.index'),
            'desc' => 'Pendampingan sertifikasi organik, fair trade, dan pengolahan pascapanen kopi lereng.',
        ],

        // ================= PILAR 03: ENVIRONMENTAL CONSERVATION (#34763d) =================
        [
            'id' => 301,
            'title' => 'Green Forestry & BioTag Initiative',
            'pillar_code' => '03',
            'pillar_name' => 'Environmental Conservation',
            'pillar_color' => '#34763d',
            'pillar_slug' => 'environmental-conservation',
            'location_name' => 'Ciwidey & Pangalengan, Jawa Barat',
            'region' => 'Jawa & Bali',
            'lat' => -7.1086,
            'lng' => 107.4912,
            'status' => 'Sedang Berjalan',
            'status_color' => '#16a34a',
            'beneficiaries' => '12.000+ Bibit Tertanam',
            'url' => route('public.programs.index'),
            'desc' => 'Penanaman pohon endemik dengan penanda QR BioTag untuk transparansi pertumbuhan pohon berbasis data.',
        ],
        [
            'id' => 302,
            'title' => 'Restorasi Hutan Gambut & Koridor Satwa',
            'pillar_code' => '03',
            'pillar_name' => 'Environmental Conservation',
            'pillar_color' => '#34763d',
            'pillar_slug' => 'environmental-conservation',
            'location_name' => 'Kutai Timur, Kalimantan Timur',
            'region' => 'Kalimantan',
            'lat' => 0.4286,
            'lng' => 117.2917,
            'status' => 'Tahap Persiapan',
            'status_color' => '#d97706',
            'beneficiaries' => '450 Hektar Kawasan Lindung',
            'url' => route('public.programs.index'),
            'desc' => 'Restorasi tutupan hutan penyangga dan reboisasi koridor satwa bersama masyarakat adat.',
        ],
        [
            'id' => 303,
            'title' => 'Konservasi Terumbu Karang & Ekowisata Bahari',
            'pillar_code' => '03',
            'pillar_name' => 'Environmental Conservation',
            'pillar_color' => '#34763d',
            'pillar_slug' => 'environmental-conservation',
            'location_name' => 'Raja Ampat, Papua Barat Daya',
            'region' => 'Maluku & Papua',
            'lat' => -0.2333,
            'lng' => 130.5167,
            'status' => 'Sedang Berjalan',
            'status_color' => '#16a34a',
            'beneficiaries' => '8 Zona Terumbu Karang',
            'url' => route('public.programs.index'),
            'desc' => 'Adopsi terumbu karang buatan dan pemantauan biota laut terancam berbasis patroli nelayan muda.',
        ],

        // ================= PILAR 04: INNOVATION & RESEARCH (#04717f) =================
        [
            'id' => 401,
            'title' => 'AgroSense: Smart Agriculture IoT Desa Binaan',
            'pillar_code' => '04',
            'pillar_name' => 'Innovation & Research',
            'pillar_color' => '#04717f',
            'pillar_slug' => 'innovation-research',
            'location_name' => 'Garut & Sumedang, Jawa Barat',
            'region' => 'Jawa & Bali',
            'lat' => -7.2279,
            'lng' => 107.9087,
            'status' => 'Sedang Berjalan',
            'status_color' => '#16a34a',
            'beneficiaries' => '16 Kelompok Tani',
            'url' => route('public.programs.index'),
            'desc' => 'Pemasangan sensor tanah IoT dan analitik cloud untuk memprediksi waktu panen dan efisiensi air 40%.',
        ],
        [
            'id' => 402,
            'title' => 'CleanTech & Sensor Pemantauan Air DAS Pesisir',
            'pillar_code' => '04',
            'pillar_name' => 'Innovation & Research',
            'pillar_color' => '#04717f',
            'pillar_slug' => 'innovation-research',
            'location_name' => 'Denpasar & Gianyar, Bali',
            'region' => 'Jawa & Bali',
            'lat' => -8.6705,
            'lng' => 115.2126,
            'status' => 'Open Recruitment',
            'status_color' => '#2563eb',
            'beneficiaries' => '6 Titik Sensor Real-Time',
            'url' => route('public.programs.index'),
            'desc' => 'Purwarupa stasiun telemetri kualitas air berbasis tenaga surya untuk deteksi limbah dini.',
        ],
        [
            'id' => 403,
            'title' => 'Pusat Uji Inovasi Sensor Iklim Pesisir Teluk',
            'pillar_code' => '04',
            'pillar_name' => 'Innovation & Research',
            'pillar_color' => '#04717f',
            'pillar_slug' => 'innovation-research',
            'location_name' => 'Balikpapan, Kalimantan Timur',
            'region' => 'Kalimantan',
            'lat' => -1.2654,
            'lng' => 116.8312,
            'status' => 'Sedang Berjalan',
            'status_color' => '#16a34a',
            'beneficiaries' => '3 Stasiun Cuaca Mandiri',
            'url' => route('public.programs.index'),
            'desc' => 'Pengembangan mikrosensor cuaca dan kelembaban udara lokal untuk ketahanan iklim nelayan.',
        ],

        // ================= PILAR 05: DISASTER RESILIENCE (#8f2c2d) =================
        [
            'id' => 501,
            'title' => 'Sekolah Tangguh Gempa & Simulasi Mandiri',
            'pillar_code' => '05',
            'pillar_name' => 'Disaster Resilience',
            'pillar_color' => '#8f2c2d',
            'pillar_slug' => 'disaster-resilience',
            'location_name' => 'Cianjur, Jawa Barat',
            'region' => 'Jawa & Bali',
            'lat' => -6.8167,
            'lng' => 107.1333,
            'status' => 'Sedang Berjalan',
            'status_color' => '#16a34a',
            'beneficiaries' => '24 Sekolah Dasar',
            'url' => route('public.programs.index'),
            'desc' => 'Penguatan kapasitas evakuasi mandiri, jalur rambu ramah anak, dan modul komik keselamatan bencana.',
        ],
        [
            'id' => 502,
            'title' => 'Early Warning Sensor Mitigasi Sesar & Tsunami',
            'pillar_code' => '05',
            'pillar_name' => 'Disaster Resilience',
            'pillar_color' => '#8f2c2d',
            'pillar_slug' => 'disaster-resilience',
            'location_name' => 'Padang, Sumatera Barat',
            'region' => 'Sumatera',
            'lat' => -0.9471,
            'lng' => 100.4172,
            'status' => 'Tahap Persiapan',
            'status_color' => '#d97706',
            'beneficiaries' => '1.200 Keluarga Pesisir',
            'url' => route('public.programs.index'),
            'desc' => 'Integrasi sirine nirkabel komunitas dan pelatihan relawan tanggap darurat RT/RW zona merah tsunami.',
        ],
        [
            'id' => 503,
            'title' => 'Pos Resiliensi Bencana Sesar Aktif',
            'pillar_code' => '05',
            'pillar_name' => 'Disaster Resilience',
            'pillar_color' => '#8f2c2d',
            'pillar_slug' => 'disaster-resilience',
            'location_name' => 'Palu, Sulawesi Tengah',
            'region' => 'Sulawesi',
            'lat' => -0.9003,
            'lng' => 119.8779,
            'status' => 'Sedang Berjalan',
            'status_color' => '#16a34a',
            'beneficiaries' => '500+ Relawan Terlatih',
            'url' => route('public.programs.index'),
            'desc' => 'Pusat logistik darurat, pemetaan kerentanan likuefaksi, dan latihan evakuasi berkala warga.',
        ],

        // ================= PILAR 06: KNOWLEDGE & PUBLICATION (#55307f) =================
        [
            'id' => 601,
            'title' => 'Diseminasi Whitepaper & Policy Brief Transisi Sosial',
            'pillar_code' => '06',
            'pillar_name' => 'Knowledge & Publication',
            'pillar_color' => '#55307f',
            'pillar_slug' => 'knowledge-publication',
            'location_name' => 'DKI Jakarta',
            'region' => 'Jawa & Bali',
            'lat' => -6.1754,
            'lng' => 106.8272,
            'status' => 'Sedang Berjalan',
            'status_color' => '#16a34a',
            'beneficiaries' => '32 Kementerian & Lembaga',
            'url' => route('public.programs.index'),
            'desc' => 'Advokasi kebijakan publik berbasis bukti ilmiah lapangan dan rekomendasi intervensi sosial.',
        ],
        [
            'id' => 602,
            'title' => 'Simposium Kebijakan Ketahanan Pesisir Indonesia Timur',
            'pillar_code' => '06',
            'pillar_name' => 'Knowledge & Publication',
            'pillar_color' => '#55307f',
            'pillar_slug' => 'knowledge-publication',
            'location_name' => 'Makassar, Sulawesi Selatan',
            'region' => 'Sulawesi',
            'lat' => -5.1477,
            'lng' => 119.4327,
            'status' => 'Tahap Persiapan',
            'status_color' => '#d97706',
            'beneficiaries' => '250 Peneliti & Akademisi',
            'url' => route('public.programs.index'),
            'desc' => 'Penerbitan prosiding monograf terbuka mengenai adaptasi sosial ekonomi masyarakat kepulauan.',
        ],
        [
            'id' => 603,
            'title' => 'Dokumentasi Kearifan Lokal & Konservasi Sasi Adat',
            'pillar_code' => '06',
            'pillar_name' => 'Knowledge & Publication',
            'pillar_color' => '#55307f',
            'pillar_slug' => 'knowledge-publication',
            'location_name' => 'Ambon, Maluku',
            'region' => 'Maluku & Papua',
            'lat' => -3.6547,
            'lng' => 128.1906,
            'status' => 'Sedang Berjalan',
            'status_color' => '#16a34a',
            'beneficiaries' => '14 Komunitas Adat',
            'url' => route('public.programs.index'),
            'desc' => 'Pencatatan antropologis dan penerbitan buku digital sasi laut sebagai hukum adat konservasi hayati.',
        ],
    ];

    // Sisipkan data dari DB jika ada koordinat valid
    foreach ($dbPrograms as $dbp) {
        if (!empty($dbp->coordinates) && str_contains($dbp->coordinates, ',')) {
            $coords = explode(',', $dbp->coordinates);
            if (count($coords) === 2 && is_numeric(trim($coords[0])) && is_numeric(trim($coords[1]))) {
                $pTitle = is_array($dbp->title) ? ($dbp->title[$lang] ?? $dbp->title['id']) : $dbp->title;
                $firstPillar = $dbp->impactAreas->first();
                $curatedLocations[] = [
                    'id' => 900 + $dbp->id,
                    'title' => $pTitle,
                    'pillar_code' => $firstPillar->code ?? '01',
                    'pillar_name' => $firstPillar->name ?? 'Youth Development',
                    'pillar_color' => $firstPillar->color ?? '#0361a4',
                    'pillar_slug' => $firstPillar->slug ?? 'youth-development',
                    'location_name' => $dbp->location_name ?? 'Indonesia',
                    'region' => 'Nasional',
                    'lat' => (float)trim($coords[0]),
                    'lng' => (float)trim($coords[1]),
                    'status' => $dbp->status == 'ongoing' ? 'Sedang Berjalan' : ($dbp->status == 'upcoming' ? 'Akan Datang' : 'Selesai'),
                    'status_color' => $dbp->status == 'ongoing' ? '#16a34a' : ($dbp->status == 'upcoming' ? '#2563eb' : '#64748b'),
                    'beneficiaries' => 'Program Terdaftar',
                    'url' => route('public.programs.show', $dbp->slug),
                    'desc' => is_array($dbp->goal ?? null) ? ($dbp->goal[$lang] ?? $dbp->goal['id'] ?? '') : ($dbp->goal ?? ''),
                ];
            }
        }
    }

    $pillarsMeta = [
        ['code' => 'ALL', 'name' => 'Semua Pilar', 'color' => '#052c24'],
        ['code' => '01', 'name' => 'Youth Development', 'color' => '#0361a4'],
        ['code' => '02', 'name' => 'Community Empowerment', 'color' => '#b8984b'],
        ['code' => '03', 'name' => 'Environmental Conservation', 'color' => '#34763d'],
        ['code' => '04', 'name' => 'Innovation & Research', 'color' => '#04717f'],
        ['code' => '05', 'name' => 'Disaster Resilience', 'color' => '#8f2c2d'],
        ['code' => '06', 'name' => 'Knowledge & Publication', 'color' => '#55307f'],
    ];

    $totalTitik = count($curatedLocations);
@endphp

{{-- LEAFLET ASSETS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
    /* Styling Custom Pin Leaflet */
    .yota-map-pin {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        cursor: pointer;
    }
    .yota-map-pin:hover {
        transform: scale(1.3) translateY(-4px);
        z-index: 9999 !important;
    }
    .yota-map-pin-inner {
        width: 28px;
        height: 28px;
        border-radius: 9999px;
        border: 2.5px solid #ffffff;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-family: monospace;
        font-weight: 900;
        font-size: 11px;
    }
    .yota-pulse-wave {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 9999px;
        opacity: 0.5;
        animation: yotaPinPulse 2.2s infinite cubic-bezier(0.25, 1, 0.5, 1);
        pointer-events: none;
    }
    @keyframes yotaPinPulse {
        0% { transform: scale(0.9); opacity: 0.7; }
        70% { transform: scale(2.2); opacity: 0; }
        100% { transform: scale(2.4); opacity: 0; }
    }
    /* Popup Styling */
    .leaflet-popup-content-wrapper {
        border-radius: 1.25rem !important;
        padding: 0 !important;
        overflow: hidden !important;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.25) !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
    }
    .leaflet-popup-content {
        margin: 0 !important;
        line-height: 1.4 !important;
    }
    .leaflet-container {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
</style>

<div class="pt-16 pb-6 border-t border-slate-200/80 font-['Plus_Jakarta_Sans']" id="sebaran-pilar" x-data="{ viewMode: 'map' }">
    <div class="max-w-7xl mx-auto">

        {{-- Section Header --}}
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-8">
            <div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 border border-slate-200 text-[#064e3b] text-[10px] font-black uppercase tracking-[0.25em] mb-2.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                    <span>GEOSPASIAL AKSI & DAMPAK NASIONAL</span>
                </div>
                <h3 class="text-2xl md:text-4xl font-black text-[#052c24] tracking-tight uppercase leading-none">
                    Peta Persebaran Program <span class="text-slate-400 font-serif italic lowercase">terikat 6 pilar.</span>
                </h3>
                <p class="text-xs md:text-sm text-slate-500 max-w-2xl mt-2 font-normal">
                    Pantau sebaran titik implementasi inisiatif, mitra desa binaan, dan aksi nyata relawan YOTA di seluruh penjuru kepulauan Indonesia.
                </p>
            </div>

            {{-- Mode Switch (Peta vs Daftar Aksesibel) & Mini Counter --}}
            <div class="flex items-center gap-3">
                <div class="inline-flex p-1 bg-slate-100 rounded-2xl border border-slate-200" role="tablist" aria-label="Pilihan Tampilan Sebaran">
                    <button type="button" @click="viewMode = 'map'" :class="viewMode === 'map' ? 'bg-[#052c24] text-[#BEF264] shadow-sm' : 'text-slate-600 hover:text-slate-900'" class="px-3.5 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition-all flex items-center gap-1.5" role="tab" :aria-selected="viewMode === 'map'">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        <span>Peta Interaktif</span>
                    </button>
                    <button type="button" @click="viewMode = 'list'" :class="viewMode === 'list' ? 'bg-[#052c24] text-[#BEF264] shadow-sm' : 'text-slate-600 hover:text-slate-900'" class="px-3.5 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition-all flex items-center gap-1.5" role="tab" :aria-selected="viewMode === 'list'">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        <span>Daftar Aksesibel</span>
                    </button>
                </div>

                <div class="hidden sm:flex px-4 py-2.5 rounded-2xl bg-white border border-slate-200/90 shadow-sm items-center gap-2">
                    <span class="text-xs font-black text-slate-400">Total:</span>
                    <span class="text-sm font-black text-[#052c24] font-mono">{{ $totalTitik }} Titik</span>
                </div>
            </div>
        </div>

        {{-- Filter Tombol Pilar (Horizontal Scroll on Mobile) --}}
        <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-6 scrollbar-none select-none">
            @foreach($pillarsMeta as $meta)
            <button type="button"
                    onclick="filterMapPillar('{{ $meta['code'] }}', this)"
                    data-pillar="{{ $meta['code'] }}"
                    class="pillar-filter-btn px-4 py-2 rounded-full text-xs font-black uppercase tracking-wider transition-all duration-200 flex items-center gap-2 whitespace-nowrap shadow-sm border {{ $meta['code'] == 'ALL' ? 'bg-[#052c24] text-white border-[#052c24]' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50' }}"
                    data-color="{{ $meta['color'] }}">
                @if($meta['code'] != 'ALL')
                    <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $meta['color'] }}"></span>
                @else
                    <span class="w-2.5 h-2.5 rounded-full bg-lime-400"></span>
                @endif
                <span>{{ $meta['code'] == 'ALL' ? 'Semua Pilar' : 'Pilar ' . $meta['code'] . ' • ' . $meta['name'] }}</span>
            </button>
            @endforeach
        </div>

        {{-- Map Container & Interactive Card Layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch" x-show="viewMode === 'map'">

            {{-- MAP CANVAS (8 Cols on Desktop) --}}
            <div class="lg:col-span-8 bg-slate-900 rounded-[2.5rem] overflow-hidden border border-slate-200/90 shadow-lg relative min-h-[460px] md:min-h-[560px]">

                {{-- The Leaflet Map Element --}}
                <div id="yotaPillarsMap" class="w-full h-full min-h-[460px] md:min-h-[560px] z-10"></div>

                {{-- Map Overlay Controls (Top Right) --}}
                <div class="absolute top-4 right-4 z-20 flex flex-col gap-2">
                    <button type="button" onclick="resetMapView()"
                            class="px-3.5 py-2 rounded-xl bg-white/95 backdrop-blur text-[11px] font-black uppercase tracking-wider text-[#052c24] shadow-md border border-slate-200 hover:bg-white hover:scale-105 transition-all flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                        <span>Fokus Indonesia</span>
                    </button>
                </div>

                {{-- Map Legend (Bottom Left) --}}
                <div class="absolute bottom-4 left-4 z-20 bg-white/95 backdrop-blur-md px-3.5 py-2.5 rounded-2xl shadow-lg border border-slate-200 hidden sm:flex items-center gap-3">
                    <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">Pilar:</span>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1 text-[9px] font-black text-[#0361a4]"><span class="w-2 h-2 rounded-full bg-[#0361a4]"></span> 01</span>
                        <span class="inline-flex items-center gap-1 text-[9px] font-black text-[#b8984b]"><span class="w-2 h-2 rounded-full bg-[#b8984b]"></span> 02</span>
                        <span class="inline-flex items-center gap-1 text-[9px] font-black text-[#34763d]"><span class="w-2 h-2 rounded-full bg-[#34763d]"></span> 03</span>
                        <span class="inline-flex items-center gap-1 text-[9px] font-black text-[#04717f]"><span class="w-2 h-2 rounded-full bg-[#04717f]"></span> 04</span>
                        <span class="inline-flex items-center gap-1 text-[9px] font-black text-[#8f2c2d]"><span class="w-2 h-2 rounded-full bg-[#8f2c2d]"></span> 05</span>
                        <span class="inline-flex items-center gap-1 text-[9px] font-black text-[#55307f]"><span class="w-2 h-2 rounded-full bg-[#55307f]"></span> 06</span>
                    </div>
                </div>

            </div>

            {{-- SIDEBAR LIST / ACTIVE HIGHLIGHT (4 Cols on Desktop) --}}
            <div class="lg:col-span-4 flex flex-col justify-between space-y-4">

                {{-- Active Highlight Card --}}
                <div id="activeLocationCard" class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm transition-all">
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <span id="cardPillarBadge" class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase text-white shadow-sm bg-[#0361a4]">
                            PILAR 01 • YOUTH DEVELOPMENT
                        </span>
                        <span id="cardStatusBadge" class="text-[9px] font-black uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                            Sedang Berjalan
                        </span>
                    </div>

                    <h4 id="cardTitle" class="text-base md:text-lg font-black text-[#052c24] leading-snug uppercase tracking-tight mb-2">
                        Peluncuran Platform Belajar Digital YOTA
                    </h4>

                    <div class="flex items-center gap-2 text-slate-500 text-xs mb-3">
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span id="cardLocation" class="font-bold text-[#052c24]">Bandung, Jawa Barat</span>
                    </div>

                    <p id="cardDesc" class="text-xs text-slate-600 leading-relaxed font-normal mb-4">
                        Akselerasi literasi teknologi, modul STEAM terapan, dan kurikulum masa depan untuk pelajar.
                    </p>

                    <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-between text-xs mb-5">
                        <span class="text-slate-400 font-bold text-[11px]">Penerima Manfaat:</span>
                        <span id="cardBeneficiaries" class="font-black text-[#052c24] font-mono">1.450+ Siswa & Pemuda</span>
                    </div>

                    <a id="cardActionBtn" href="{{ route('public.programs.index') }}"
                       class="w-full py-3 rounded-2xl bg-[#052c24] text-[#BEF264] hover:bg-emerald-800 text-xs font-black uppercase tracking-wider transition-all flex items-center justify-center gap-2 shadow hover:scale-102">
                        <span>Buka Detail Program</span>
                        <span>→</span>
                    </a>
                </div>

                {{-- Scrollable List of Other Locations --}}
                <div class="bg-white rounded-3xl p-4 border border-slate-200/90 shadow-sm flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-3 px-2">
                        <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">
                            Daftar Titik Sebaran (<span id="filteredCount">{{ $totalTitik }}</span>)
                        </span>
                        <span class="text-[9px] font-bold text-slate-400">Klik untuk navigasi peta</span>
                    </div>

                    <div id="locationsScrollList" class="space-y-2 max-h-[220px] overflow-y-auto pr-1 scrollbar-thin">
                        @foreach($curatedLocations as $idx => $loc)
                        <div class="location-item-row p-3 rounded-2xl border border-slate-100 hover:border-slate-300 hover:bg-slate-50/80 transition-all cursor-pointer flex items-center justify-between gap-3"
                             data-id="{{ $loc['id'] }}"
                             data-pillar="{{ $loc['pillar_code'] }}"
                             onclick="selectLocationFromList({{ $loc['id'] }})">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <span class="w-3 h-3 rounded-full shrink-0" style="background-color: {{ $loc['pillar_color'] }}"></span>
                                <div class="min-w-0">
                                    <div class="text-xs font-black text-[#052c24] truncate uppercase tracking-tight">
                                        {{ $loc['title'] }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-medium truncate">
                                        {{ $loc['location_name'] }} • <span class="font-mono text-slate-500">Pilar {{ $loc['pillar_code'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <span class="text-slate-300 hover:text-slate-600 text-xs font-black shrink-0">→</span>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>

        {{-- ACCESSIBLE ALTERNATIVE LIST VIEW (WCAG 2.2 AA & Section 17 Requirement) --}}
        <div x-show="viewMode === 'list'" style="display: none;" class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-400 uppercase font-black tracking-wider text-[10px]">
                            <th class="py-3 px-4">Pilar</th>
                            <th class="py-3 px-4">Program & Inisiatif</th>
                            <th class="py-3 px-4">Lokasi & Wilayah</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Penerima Manfaat / Target</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($curatedLocations as $loc)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase text-white shadow-sm" style="background-color: {{ $loc['pillar_color'] }}">
                                    PILAR {{ $loc['pillar_code'] }}
                                </span>
                            </td>
                            <td class="py-3 px-4 font-bold text-[#052c24]">
                                {{ $loc['title'] }}
                                <p class="text-[11px] text-slate-500 font-normal mt-0.5 line-clamp-1">{{ $loc['desc'] }}</p>
                            </td>
                            <td class="py-3 px-4 text-slate-600 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span>{{ $loc['location_name'] }}</span>
                                </span>
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase text-emerald-800 bg-emerald-50 border border-emerald-200">
                                    {{ $loc['status'] }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-600 font-mono text-[11px] whitespace-nowrap">
                                {{ $loc['beneficiaries'] }}
                            </td>
                            <td class="py-3 px-4 text-right whitespace-nowrap">
                                <a href="{{ $loc['url'] }}" class="inline-flex items-center gap-1 px-3.5 py-1.5 rounded-xl bg-[#052c24] text-[#BEF264] text-[10px] font-black uppercase hover:bg-emerald-800 transition-all">
                                    <span>Detail</span>
                                    <span>→</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

{{-- JAVASCRIPT INICIALISASI MAP DAN INTERAKSI --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const locationsData = @json($curatedLocations);
        let activeFilter = 'ALL';
        let mapInstance = null;
        let markersGroup = null;
        const markersMap = {};

        // Inisialisasi Peta Leaflet
        function initMap() {
            const mapContainer = document.getElementById('yotaPillarsMap');
            if (!mapContainer || typeof L === 'undefined') return;

            // Pusatkan ke Geografis Indonesia
            mapInstance = L.map('yotaPillarsMap', {
                center: [-2.5, 118.0],
                zoom: 5,
                minZoom: 4,
                maxZoom: 16,
                zoomControl: false,
                scrollWheelZoom: false, // cegah scrolling tak sengaja di mobile
            });

            // Zoom control di kiri bawah
            L.control.zoom({ position: 'bottomright' }).addTo(mapInstance);

            // Layer Peta Elegan: Esri World Light Gray Base & Reference (Bebas Watermark API Key, Halus, Presisi)
            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
                attribution: '&copy; <a href="https://www.esri.com/">Esri</a>, HERE, Garmin, &copy; OpenStreetMap contributors | YOTA Adiwidya Center',
                maxZoom: 16
            }).addTo(mapInstance);

            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Reference/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 16
            }).addTo(mapInstance);

            markersGroup = L.layerGroup().addTo(mapInstance);

            renderMarkers('ALL');
        }

        // Render Marker Pin
        function renderMarkers(pillarFilter) {
            if (!mapInstance || !markersGroup) return;

            markersGroup.clearLayers();

            const bounds = [];

            locationsData.forEach(loc => {
                if (pillarFilter !== 'ALL' && loc.pillar_code !== pillarFilter) {
                    return;
                }

                // Buat Custom HTML Marker dengan Gelombang Pulse
                const customIcon = L.divIcon({
                    className: 'yota-map-pin',
                    html: `
                        <div class="relative flex items-center justify-center">
                            <span class="yota-pulse-wave" style="background-color: ${loc.pillar_color}"></span>
                            <div class="yota-map-pin-inner" style="background-color: ${loc.pillar_color}">
                                ${loc.pillar_code}
                            </div>
                        </div>
                    `,
                    iconSize: [32, 32],
                    iconAnchor: [16, 16],
                    popupAnchor: [0, -18]
                });

                const marker = L.marker([loc.lat, loc.lng], { icon: customIcon });

                // Custom Popup Content
                const popupContent = `
                    <div class="p-4 bg-white max-w-[260px] font-['Plus_Jakarta_Sans']">
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase text-white" style="background-color: ${loc.pillar_color}">
                                PILAR ${loc.pillar_code}
                            </span>
                            <span class="text-[8px] font-black uppercase text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">
                                ${loc.status}
                            </span>
                        </div>
                        <h5 class="text-xs font-black text-[#052c24] leading-snug uppercase mb-1">
                            ${loc.title}
                        </h5>
                        <p class="text-[10px] text-slate-500 font-medium mb-3 flex items-center gap-1">
                            <svg class="w-3 h-3 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>${loc.location_name}</span>
                        </p>
                        <a href="${loc.url}" class="block w-full py-1.5 text-center rounded-xl bg-[#052c24] text-[#BEF264] text-[9px] font-black uppercase tracking-wider hover:bg-emerald-800 transition-all">
                            Lihat Detail →
                        </a>
                    </div>
                `;

                marker.bindPopup(popupContent);

                marker.on('click', () => {
                    updateActiveCard(loc);
                });

                markersGroup.addLayer(marker);
                markersMap[loc.id] = marker;
                bounds.push([loc.lat, loc.lng]);
            });

            // Sesuaikan Zoom jika filter spesifik
            if (bounds.length > 0 && pillarFilter !== 'ALL') {
                mapInstance.fitBounds(bounds, { padding: [50, 50], maxZoom: 8 });
            }
        }

        // Update Card Informasi di Samping Peta
        function updateActiveCard(loc) {
            const cardPillar = document.getElementById('cardPillarBadge');
            const cardStatus = document.getElementById('cardStatusBadge');
            const cardTitle = document.getElementById('cardTitle');
            const cardLocation = document.getElementById('cardLocation');
            const cardDesc = document.getElementById('cardDesc');
            const cardBeneficiaries = document.getElementById('cardBeneficiaries');
            const cardActionBtn = document.getElementById('cardActionBtn');

            if (cardPillar) {
                cardPillar.innerText = `PILAR ${loc.pillar_code} • ${loc.pillar_name}`;
                cardPillar.style.backgroundColor = loc.pillar_color;
            }
            if (cardStatus) {
                cardStatus.innerText = loc.status;
            }
            if (cardTitle) {
                cardTitle.innerText = loc.title;
            }
            if (cardLocation) {
                cardLocation.innerText = loc.location_name;
            }
            if (cardDesc) {
                cardDesc.innerText = loc.desc;
            }
            if (cardBeneficiaries) {
                cardBeneficiaries.innerText = loc.beneficiaries;
            }
            if (cardActionBtn) {
                cardActionBtn.href = loc.url;
            }

            // Highlight item di scroll list
            document.querySelectorAll('.location-item-row').forEach(row => {
                if (row.getAttribute('data-id') == loc.id) {
                    row.classList.add('border-emerald-500', 'bg-emerald-50/40');
                    row.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else {
                    row.classList.remove('border-emerald-500', 'bg-emerald-50/40');
                }
            });
        }

        // Global Handler untuk Tombol Filter
        window.filterMapPillar = function (pillarCode, btnElement) {
            activeFilter = pillarCode;

            // Update Style Tombol
            document.querySelectorAll('.pillar-filter-btn').forEach(btn => {
                btn.classList.remove('bg-[#052c24]', 'text-white', 'border-[#052c24]');
                btn.classList.add('bg-white', 'text-slate-700', 'border-slate-200');
            });

            btnElement.classList.remove('bg-white', 'text-slate-700', 'border-slate-200');
            btnElement.classList.add('bg-[#052c24]', 'text-white', 'border-[#052c24]');

            renderMarkers(pillarCode);

            // Filter List di Kanan
            let count = 0;
            let firstVisibleLoc = null;

            document.querySelectorAll('.location-item-row').forEach(row => {
                const rowPillar = row.getAttribute('data-pillar');
                const rowId = row.getAttribute('data-id');
                const locObj = locationsData.find(l => l.id == rowId);

                if (pillarCode === 'ALL' || rowPillar === pillarCode) {
                    row.style.display = 'flex';
                    count++;
                    if (!firstVisibleLoc && locObj) firstVisibleLoc = locObj;
                } else {
                    row.style.display = 'none';
                }
            });

            const countEl = document.getElementById('filteredCount');
            if (countEl) countEl.innerText = count;

            if (firstVisibleLoc) {
                updateActiveCard(firstVisibleLoc);
            }
        };

        // Global Handler Klik dari List
        window.selectLocationFromList = function (locationId) {
            const loc = locationsData.find(l => l.id == locationId);
            if (!loc) return;

            updateActiveCard(loc);

            if (mapInstance) {
                mapInstance.flyTo([loc.lat, loc.lng], 9, { duration: 1.2 });
                const marker = markersMap[locationId];
                if (marker) {
                    setTimeout(() => marker.openPopup(), 1200);
                }
            }
        };

        // Reset View Map ke Seluruh Indonesia
        window.resetMapView = function () {
            if (mapInstance) {
                mapInstance.flyTo([-2.5, 118.0], 5, { duration: 1 });
            }
        };

        // Jalankan Inisialisasi
        initMap();
    });
</script>
