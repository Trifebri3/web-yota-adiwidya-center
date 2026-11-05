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

            {{-- Lokasi & Info Teknis --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Nama Lokasi</label>
                    <input type="text" name="location_name" value="{{ $program->location_name }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Koordinat GPS</label>
                    <input type="text" name="coordinates" value="{{ $program->coordinates }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold" placeholder="-6.914, 107.609">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Link Google Maps</label>
                    <input type="url" name="location_link" value="{{ $program->location_link }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold">
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
@endsection
