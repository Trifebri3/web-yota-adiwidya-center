@extends('omc.layouts.app')

@section('content')
<div class="p-6 md:p-10 font-['Plus_Jakarta_Sans']" x-data="{ lang: 'id' }">

    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-black text-[#052c24] tracking-tighter uppercase">Create <span class="text-slate-300 italic-none">New Program</span></h1>
            <p class="text-slate-400 text-sm font-medium">Publikasikan program baru ke platform YOTA.</p>
        </div>
        <a href="{{ route('omc.programs.index') }}" class="text-slate-400 hover:text-[#052c24] font-black text-xs uppercase tracking-widest transition-all">
            ← Back to List
        </a>
    </div>

    <form action="{{ route('omc.programs.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        @csrf

        {{-- Kolom Kiri: Main Content (Multilingual) --}}
        <div class="lg:col-span-8 space-y-6">

            {{-- Language Switcher --}}
            <div class="flex bg-slate-100 p-1.5 rounded-2xl w-fit border border-slate-200">
                <button type="button" @click="lang = 'id'" :class="lang === 'id' ? 'bg-white text-[#052c24] shadow-sm' : 'text-slate-400'" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Indonesia</button>
                <button type="button" @click="lang = 'en'" :class="lang === 'en' ? 'bg-white text-[#052c24] shadow-sm' : 'text-slate-400'" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">English</button>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                {{-- Judul Program --}}
                <div x-show="lang === 'id'">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Judul Program (ID)</label>
                    <input type="text" name="title_id" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="Masukkan judul dalam Bahasa Indonesia...">
                </div>
                <div x-show="lang === 'en'" x-cloak>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Program Title (EN)</label>
                    <input type="text" name="title_en" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="Enter title in English...">
                </div>

                {{-- Deskripsi / Goal --}}
                <div x-show="lang === 'id'">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Tujuan Program (ID)</label>
                    <textarea name="goal_id" rows="4" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-lime-500 transition-all" placeholder="Apa tujuan dari program ini?"></textarea>
                </div>
                <div x-show="lang === 'en'" x-cloak>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Program Goal (EN)</label>
                    <textarea name="goal_en" rows="4" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-lime-500 transition-all" placeholder="What is the goal of this program?"></textarea>
                </div>
            </div>

            {{-- Pilar Program & Status Publikasi --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Pilar Utama Program <span class="text-rose-500">*</span></label>
                    <select name="pillar_code" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all text-[#052c24]" required>
                        <option value="01">Pilar 01 • Youth Development (Biru)</option>
                        <option value="02">Pilar 02 • Community Empowerment (Emas)</option>
                        <option value="03">Pilar 03 • Environmental Conservation (Hijau)</option>
                        <option value="04">Pilar 04 • Innovation & Research (Toska)</option>
                        <option value="05">Pilar 05 • Disaster Resilience (Merah Terakota)</option>
                        <option value="06">Pilar 06 • Knowledge & Publication (Ungu)</option>
                    </select>
                    <p class="text-[10px] text-slate-400 mt-2">Pilar ini menentukan warna pin dan filter pada Peta Sebaran Program di Halaman Utama.</p>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Status Publikasi</label>
                    <select name="status" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all">
                        <option value="upcoming">Upcoming (Akan Datang)</option>
                        <option value="ongoing">Ongoing (Sedang Berjalan)</option>
                        <option value="history">History (Selesai)</option>
                    </select>
                </div>
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
                        <select name="province" id="provinceSelect" onchange="autoFillCoordsByRegion()" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all text-[#052c24]" required>
                            <option value="Jawa Barat" selected>Jawa Barat</option>
                            <option value="DKI Jakarta">DKI Jakarta</option>
                            <option value="Banten">Banten</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="D.I. Yogyakarta">D.I. Yogyakarta</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="Bali">Bali</option>
                            <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                            <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                            <option value="Sumatera Utara">Sumatera Utara</option>
                            <option value="Sumatera Barat">Sumatera Barat</option>
                            <option value="Riau">Riau</option>
                            <option value="Kepulauan Riau">Kepulauan Riau</option>
                            <option value="Jambi">Jambi</option>
                            <option value="Sumatera Selatan">Sumatera Selatan</option>
                            <option value="Bangka Belitung">Bangka Belitung</option>
                            <option value="Bengkulu">Bengkulu</option>
                            <option value="Lampung">Lampung</option>
                            <option value="Kalimantan Barat">Kalimantan Barat</option>
                            <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                            <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                            <option value="Kalimantan Timur">Kalimantan Timur</option>
                            <option value="Kalimantan Utara">Kalimantan Utara</option>
                            <option value="Sulawesi Utara">Sulawesi Utara</option>
                            <option value="Gorontalo">Gorontalo</option>
                            <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                            <option value="Sulawesi Barat">Sulawesi Barat</option>
                            <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                            <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                            <option value="Maluku">Maluku</option>
                            <option value="Maluku Utara">Maluku Utara</option>
                            <option value="Papua">Papua</option>
                            <option value="Papua Barat">Papua Barat</option>
                        </select>
                    </div>

                    {{-- Blok 2: Kabupaten / Kota --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Kabupaten / Kota <span class="text-rose-500">*</span></label>
                        <input type="text" name="city" id="cityInput" onchange="autoFillCoordsByCity()" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="Contoh: Kota Bandung, Kab. Bandung Barat, Kab. Sleman..." required>
                    </div>
                </div>

                {{-- Blok 3: Detail Titik Lokasi --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Detail Titik Lokasi / Alamat Aksi</label>
                        <input type="text" name="detail_address" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="Contoh: Desa Cibodas, Balai Warga RW 04">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Link Google Maps (Opsional)</label>
                        <input type="url" name="location_link" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="https://maps.app.goo.gl/...">
                    </div>
                </div>

                {{-- Koordinat GPS dengan Shortcut Helper & Anti-Tabrakan --}}
                <div class="p-6 bg-slate-50/80 rounded-2xl border border-slate-200/80">
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Koordinat GPS (Latitude, Longitude)</label>
                        <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">Klaster Peta Otomatis</span>
                    </div>
                    <input type="text" id="coordInput" name="coordinates" class="w-full bg-white border border-slate-200 rounded-xl px-5 py-3.5 text-sm font-mono font-bold focus:ring-2 focus:ring-lime-500 transition-all text-[#052c24]" placeholder="-6.9175, 107.6191">
                    <p class="text-[11px] text-slate-500 mt-2">Format: <span class="font-mono font-bold">lat, lng</span>. Jika berada di kota yang sama, sistem peta mengelompokkan secara pintar agar pin tidak bertumpukan. Pilih shortcut cepat:</p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <button type="button" onclick="setPresetLocation('Jawa Barat', 'Kota Bandung', '-6.9175, 107.6191')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Bandung</button>
                        <button type="button" onclick="setPresetLocation('Jawa Barat', 'Kab. Bandung Barat', '-6.8402, 107.5143')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Bandung Barat</button>
                        <button type="button" onclick="setPresetLocation('DKI Jakarta', 'Jakarta Pusat', '-6.2088, 106.8456')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">DKI Jakarta</button>
                        <button type="button" onclick="setPresetLocation('D.I. Yogyakarta', 'Kab. Sleman', '-7.7156, 110.3556')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Sleman / Jogja</button>
                        <button type="button" onclick="setPresetLocation('Jawa Barat', 'Kab. Sumedang', '-6.8586, 107.9266')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Sumedang</button>
                        <button type="button" onclick="setPresetLocation('Jawa Barat', 'Kab. Garut', '-7.2278, 107.9087')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Garut</button>
                        <button type="button" onclick="setPresetLocation('Jawa Barat', 'Kab. Cianjur', '-6.8167, 107.1333')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Cianjur</button>
                        <button type="button" onclick="setPresetLocation('Jawa Timur', 'Kota Surabaya', '-7.2575, 112.7521')" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:border-emerald-500 hover:text-emerald-700 transition-all">Surabaya</button>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Kuota Relawan / Peserta</label>
                    <input type="number" name="quota_total" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="Contoh: 100">
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Sidebar Settings --}}
        <div class="lg:col-span-4 space-y-6">

            {{-- Banner Image Upload --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-6">Banner Program</label>
                <div class="relative group cursor-pointer border-2 border-dashed border-slate-200 rounded-[2rem] p-4 hover:border-lime-500 transition-all text-center">
                    <input type="file" name="banner_image" class="absolute inset-0 opacity-0 cursor-pointer">
                    <div class="py-10">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Click to upload image</p>
                    </div>
                </div>
            </div>

            {{-- Donation Toggle (Optional) --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6" x-data="{ hasDonation: false }">
                <div class="flex items-center justify-between">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Aktifkan Donasi?</label>
                    <input type="checkbox" @change="hasDonation = !hasDonation" class="w-5 h-5 text-lime-500 rounded-md border-slate-200 focus:ring-lime-500">
                </div>

                <div x-show="hasDonation" x-transition>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Target Dana (Rp)</label>
                    <input type="number" name="target_amount" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-black text-[#052c24] focus:ring-2 focus:ring-lime-500 transition-all" placeholder="0">
                </div>
            </div>

            {{-- Waktu Program --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Tanggal Berakhir</label>
                    <input type="date" name="end_date" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold">
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="w-full bg-[#052c24] text-[#BEF264] py-6 rounded-[2rem] font-black text-xs uppercase tracking-[0.3em] hover:bg-lime-500 hover:text-[#052c24] transition-all shadow-xl shadow-[#052c24]/20">
                Publish Program
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

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
