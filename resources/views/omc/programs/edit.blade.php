@extends('omc.layouts.app')

@section('content')
<div class="p-6 md:p-10 font-['Plus_Jakarta_Sans']" x-data="{ lang: 'id' }">

    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-black text-[#052c24] tracking-tighter uppercase">Edit <span class="text-slate-300 italic-none">Program</span></h1>
            <p class="text-slate-400 text-sm font-medium">Perbarui informasi dan pantau perkembangan program ini.</p>
        </div>
        <a href="{{ route('omc.programs.index') }}" class="text-slate-400 hover:text-[#052c24] font-black text-xs uppercase tracking-widest transition-all">
            ← Cancel & Back
        </a>
    </div>

    <form action="{{ route('omc.programs.update', $program->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        @csrf
        @method('PUT')

        {{-- Kolom Kiri: Content Area --}}
        <div class="lg:col-span-8 space-y-6">

            {{-- Language Switcher --}}
            <div class="flex bg-slate-100 p-1.5 rounded-2xl w-fit border border-slate-200">
                <button type="button" @click="lang = 'id'" :class="lang === 'id' ? 'bg-white text-[#052c24] shadow-sm' : 'text-slate-400'" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Indonesia</button>
                <button type="button" @click="lang = 'en'" :class="lang === 'en' ? 'bg-white text-[#052c24] shadow-sm' : 'text-slate-400'" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">English</button>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                {{-- Judul Program (JSON Binding) --}}
                <div x-show="lang === 'id'">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Judul Program (ID)</label>
                    <input type="text" name="title_id" value="{{ $program->title['id'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all">
                </div>
                <div x-show="lang === 'en'" x-cloak>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Program Title (EN)</label>
                    <input type="text" name="title_en" value="{{ $program->title['en'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all">
                </div>

                {{-- Goal / Deskripsi --}}
                <div x-show="lang === 'id'">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Tujuan Program (ID)</label>
                    <textarea name="goal_id" rows="4" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-lime-500 transition-all">{{ $program->goal['id'] ?? '' }}</textarea>
                </div>
                <div x-show="lang === 'en'" x-cloak>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Program Goal (EN)</label>
                    <textarea name="goal_en" rows="4" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-lime-500 transition-all">{{ $program->goal['en'] ?? '' }}</textarea>
                </div>
            </div>

            {{-- Pilar Program --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Pilar Utama Program <span class="text-rose-500">*</span></label>
                <select name="pillar_code" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all text-[#052c24]" required>
                    <option value="01" {{ ($currentPillar ?? '01') == '01' ? 'selected' : '' }}>Pilar 01 • Youth Development (Biru)</option>
                    <option value="02" {{ ($currentPillar ?? '01') == '02' ? 'selected' : '' }}>Pilar 02 • Community Empowerment (Emas)</option>
                    <option value="03" {{ ($currentPillar ?? '01') == '03' ? 'selected' : '' }}>Pilar 03 • Environmental Conservation (Hijau)</option>
                    <option value="04" {{ ($currentPillar ?? '01') == '04' ? 'selected' : '' }}>Pilar 04 • Innovation & Research (Toska)</option>
                    <option value="05" {{ ($currentPillar ?? '01') == '05' ? 'selected' : '' }}>Pilar 05 • Disaster Resilience (Merah Terakota)</option>
                    <option value="06" {{ ($currentPillar ?? '01') == '06' ? 'selected' : '' }}>Pilar 06 • Knowledge & Publication (Ungu)</option>
                </select>
                <p class="text-[10px] text-slate-400 mt-2">Pilar ini menentukan warna pin dan filter pada Peta Sebaran Program di Halaman Utama.</p>
            </div>

            {{-- Hierarki Wilayah (Provinsi -> Kabupaten/Kota -> Detail Lokasi) & GPS --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                <div>
                    <h3 class="text-xs font-black uppercase tracking-wider text-[#052c24] flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        Hierarki Wilayah & Lokasi Geospasial
                    </h3>
                    <p class="text-[11px] text-slate-400 mt-1">Struktur berjenjang memastikan titik aksi tidak tabrakan di peta utama.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Blok 1: Provinsi --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Provinsi <span class="text-rose-500">*</span></label>
                        <select name="province" id="provinceSelect" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all text-[#052c24]" required>
                            @php
                                $selectedProv = $currentProvince ?: 'Jawa Barat';
                                $provinces = ['Jawa Barat', 'DKI Jakarta', 'Banten', 'Jawa Tengah', 'D.I. Yogyakarta', 'Jawa Timur', 'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Kepulauan Riau', 'Jambi', 'Sumatera Selatan', 'Bangka Belitung', 'Bengkulu', 'Lampung', 'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara', 'Sulawesi Utara', 'Gorontalo', 'Sulawesi Tengah', 'Sulawesi Barat', 'Sulawesi Selatan', 'Sulawesi Tenggara', 'Maluku', 'Maluku Utara', 'Papua', 'Papua Barat'];
                            @endphp
                            @foreach($provinces as $p)
                                <option value="{{ $p }}" {{ $selectedProv == $p ? 'selected' : '' }}>{{ $p }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Blok 2: Kabupaten / Kota --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Kabupaten / Kota <span class="text-rose-500">*</span></label>
                        <input type="text" name="city" id="cityInput" value="{{ $currentCity }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="Contoh: Kota Bandung, Kab. Bandung Barat, Kab. Sleman..." required>
                    </div>
                </div>

                {{-- Blok 3: Detail Titik Lokasi --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Detail Titik Lokasi / Alamat Aksi</label>
                        <input type="text" name="detail_address" value="{{ $currentDetail }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="Contoh: Desa Cibodas, Balai Warga RW 04">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Link Google Maps (Opsional)</label>
                        <input type="url" name="location_link" value="{{ $program->location_link }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="https://maps.app.goo.gl/...">
                    </div>
                </div>

                {{-- Koordinat GPS dengan Shortcut Helper --}}
                <div class="p-6 bg-slate-50/80 rounded-2xl border border-slate-200/80">
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Koordinat GPS Peta (Latitude, Longitude)</label>
                        <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">Klaster Peta Otomatis</span>
                    </div>
                    <input type="text" id="coordInput" name="coordinates" value="{{ $program->coordinates }}" class="w-full bg-white border border-slate-200 rounded-xl px-5 py-3.5 text-sm font-mono font-bold focus:ring-2 focus:ring-lime-500 transition-all text-[#052c24]" placeholder="-6.9175, 107.6191">
                    <p class="text-[11px] text-slate-500 mt-2">Format: <span class="font-mono font-bold">latitude, longitude</span> (Contoh Bandung: <code>-6.9175, 107.6191</code>). Klik salah satu kota di bawah untuk mengisi cepat:</p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <button type="button" onclick="setPresetLocation('Jawa Barat', 'Kota Bandung', '-6.9175, 107.6191')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Bandung</button>
                        <button type="button" onclick="setPresetLocation('Jawa Barat', 'Kab. Bandung Barat', '-6.8402, 107.5143')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Bandung Barat</button>
                        <button type="button" onclick="setPresetLocation('DKI Jakarta', 'Jakarta Pusat', '-6.2088, 106.8456')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">DKI Jakarta</button>
                        <button type="button" onclick="setPresetLocation('D.I. Yogyakarta', 'Kab. Sleman', '-7.7156, 110.3556')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">D.I. Yogyakarta / Sleman</button>
                        <button type="button" onclick="setPresetLocation('Jawa Barat', 'Kab. Sumedang', '-6.8586, 107.9266')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Sumedang</button>
                        <button type="button" onclick="setPresetLocation('Jawa Barat', 'Kab. Garut', '-7.2278, 107.9087')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Garut</button>
                        <button type="button" onclick="setPresetLocation('Jawa Barat', 'Kab. Cianjur', '-6.8167, 107.1333')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Cianjur</button>
                        <button type="button" onclick="setPresetLocation('Jawa Timur', 'Kota Surabaya', '-7.2575, 112.7521')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Surabaya</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Sidebar Settings --}}
        <div class="lg:col-span-4 space-y-6">

            {{-- Current Banner Preview --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-6">Banner Image</label>
                <div class="w-full h-40 rounded-2xl bg-slate-100 mb-4 overflow-hidden border border-slate-100">
                    <img src="{{ asset('storage/' . $program->banner_image) }}" class="w-full h-full object-cover">
                </div>
                <input type="file" name="banner_image" class="w-full text-[10px] font-bold text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-slate-100 file:text-[#052c24] hover:file:bg-lime-400 transition-all">
            </div>

            {{-- Status & Quota --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Status Program</label>
                    <select name="status" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-black text-[#052c24]">
                        <option value="upcoming" {{ $program->status == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="ongoing" {{ $program->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="history" {{ $program->status == 'history' ? 'selected' : '' }}>History</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[8px] font-black uppercase tracking-widest text-slate-400 mb-2">Total Quota</label>
                        <input type="number" name="quota_total" value="{{ $program->quota_total }}" class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm font-bold">
                    </div>
                    <div>
                        <label class="block text-[8px] font-black uppercase tracking-widest text-slate-400 mb-2">Used Quota</label>
                        <input type="number" name="quota_used" value="{{ $program->quota_used }}" class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm font-bold">
                    </div>
                </div>
            </div>

            {{-- Donation Info --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Target Dana (Rp)</label>
                    <input type="number" name="target_amount" value="{{ $program->target_amount }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-black text-lime-600">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Dana Terkumpul (Rp)</label>
                    <input type="number" name="current_amount" value="{{ $program->current_amount }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-black text-[#052c24]">
                </div>
            </div>

            <button type="submit" class="w-full bg-[#052c24] text-[#BEF264] py-6 rounded-[2rem] font-black text-xs uppercase tracking-[0.3em] hover:bg-lime-500 hover:text-[#052c24] transition-all shadow-xl shadow-[#052c24]/20">
                Update Program
            </button>
        </div>
    </form>
</div>

<script>
    function setPresetLocation(prov, city, coords) {
        document.getElementById('provinceSelect').value = prov;
        document.getElementById('cityInput').value = city;
        document.getElementById('coordInput').value = coords;
    }
</script>
@endsection
