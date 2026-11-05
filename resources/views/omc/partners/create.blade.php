@extends('omc.layouts.app')

@section('content')
<div class="p-6 md:p-10 font-['Plus_Jakarta_Sans']" x-data="{ lang: 'id' }">

    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-black text-[#052c24] tracking-tighter uppercase">Add <span class="text-slate-300 italic-none">Strategic Partner</span></h1>
            <p class="text-slate-400 text-sm font-medium">Perluas ekosistem kolaborasi YOTA dengan mitra baru.</p>
        </div>
        <a href="{{ route('omc.partners.index') }}" class="text-slate-400 hover:text-[#052c24] font-black text-xs uppercase tracking-widest transition-all">
            ← Back to Network
        </a>
    </div>

    <form action="{{ route('omc.partners.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        @csrf

        {{-- Kolom Kiri: Main Info & Multilingual Description (8 Columns) --}}
        <div class="lg:col-span-8 space-y-6">

            {{-- Nama Mitra --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Official Name</label>
                <input type="text" name="name" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-lime-500 transition-all" placeholder="Contoh: Kementerian Lingkungan Hidup">
            </div>

            {{-- Tab Switcher Deskripsi --}}
            <div class="flex bg-slate-100 p-1.5 rounded-2xl w-fit border border-slate-200">
                <button type="button" @click="lang = 'id'" :class="lang === 'id' ? 'bg-white text-[#052c24] shadow-sm' : 'text-slate-400'" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Indonesia</button>
                <button type="button" @click="lang = 'en'" :class="lang === 'en' ? 'bg-white text-[#052c24] shadow-sm' : 'text-slate-400'" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">English</button>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <div x-show="lang === 'id'">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Profil Singkat (ID)</label>
                    <textarea name="description_id" rows="4" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-lime-500 transition-all" placeholder="Ceritakan peran mitra ini dalam kolaborasi..."></textarea>
                </div>
                <div x-show="lang === 'en'" x-cloak>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Partner Profile (EN)</label>
                    <textarea name="description_en" rows="4" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-lime-500 transition-all" placeholder="Describe the partner's role in the collaboration..."></textarea>
                </div>
            </div>

            {{-- Link Website --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Website URL</label>
                <div class="flex items-center bg-slate-50 rounded-2xl px-6">
                    <span class="text-slate-300 text-sm font-bold pr-4 border-r border-slate-200">https://</span>
                    <input type="text" name="website_url" class="w-full bg-transparent border-none py-4 text-sm font-bold focus:ring-0" placeholder="www.partner.com">
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Identity & Status (4 Columns) --}}
        <div class="lg:col-span-4 space-y-6">

            {{-- Logo Upload --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-6">Partner Logo</label>
                <div class="relative group cursor-pointer border-2 border-dashed border-slate-200 rounded-[2rem] p-4 hover:border-lime-500 transition-all text-center">
                    <input type="file" name="logo" required class="absolute inset-0 opacity-0 cursor-pointer">
                    <div class="py-10">
                        <svg class="w-10 h-10 text-slate-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">PNG / SVG Transparent Recommended</p>
                    </div>
                </div>
            </div>

            {{-- Category & Sorting --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Partner Type</label>
                    <select name="type" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-black text-[#052c24] focus:ring-2 focus:ring-lime-500 transition-all">
                        <option value="Government">Government</option>
                        <option value="NGO">NGO / Foundation</option>
                        <option value="Corporate">Corporate / Private</option>
                        <option value="Community">Community</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Display Order</label>
                    <input type="number" name="order" value="1" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold" placeholder="1">
                    <p class="text-[8px] text-slate-400 mt-2 italic font-medium">Urutan tampilan di website (Angka terkecil tampil pertama).</p>
                </div>
            </div>

            {{-- Submit Action --}}
            <button type="submit" class="w-full bg-[#052c24] text-[#BEF264] py-6 rounded-[2.5rem] font-black text-xs uppercase tracking-[0.3em] hover:bg-lime-500 hover:text-[#052c24] transition-all shadow-xl shadow-[#052c24]/20 active:scale-95">
                Save Partner Data
            </button>
        </div>
    </form>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
