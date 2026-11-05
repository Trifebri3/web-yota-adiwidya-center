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

            {{-- Lokasi & Kuota --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Nama Lokasi</label>
                    <input type="text" name="location_name" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="Contoh: Bandung, Jawa Barat">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Link Google Maps</label>
                    <input type="url" name="location_link" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="https://goo.gl/maps/...">
                </div>
                {{-- Letakkan di dalam grid Lokasi --}}
<div>
    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Koordinat GPS (Lat, Long)</label>
    <input type="text" name="coordinates" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="-6.914, 107.609">
</div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Kuota Relawan / Peserta</label>
                    <input type="number" name="quota_total" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="0">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Status Publikasi</label>
                    <select name="status" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all">
                        <option value="upcoming">Upcoming (Akan Datang)</option>
                        <option value="ongoing">Ongoing (Sedang Jalan)</option>
                        <option value="history">History (Selesai)</option>
                    </select>
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

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
