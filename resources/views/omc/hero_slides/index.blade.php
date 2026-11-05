@extends('omc.layouts.app')

@section('title', 'Hero Slider Publikasi - OMC')

@section('content')
<div class="py-12 bg-slate-50 min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="mb-8 p-5 bg-lime-50 border-l-4 border-lime-500 rounded-2xl flex items-center gap-4 shadow-sm animate-fade-in">
                <div class="w-10 h-10 bg-lime-500 rounded-full flex items-center justify-center text-[#052c24] shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-black text-[#052c24] uppercase tracking-wider">Sukses!</h4>
                    <p class="text-xs text-slate-600 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-1 bg-[#BEF264] rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Homepage Interactive Banner</span>
                </div>
                <h1 class="text-4xl font-black text-[#052c24] tracking-tighter uppercase">Hero Slider Publikasi</h1>
                <p class="text-slate-500 font-medium">Kelola artikel unggulan, beasiswa, dan program beranda bergaya interaktif Pertamina Foundation.</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('home') }}" target="_blank" class="bg-white text-slate-700 border border-slate-200 px-6 py-4 rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-slate-100 transition-all flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Beranda
                </a>

                <a href="{{ route('omc.hero-slides.create') }}" class="bg-[#052c24] text-[#BEF264] px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:shadow-2xl hover:scale-105 transition-all shadow-xl shadow-[#052c24]/20 flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Slide Baru
                </a>
            </div>
        </div>

        {{-- Metric Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5">
                <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-[#052c24]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Banner Slide</p>
                    <p class="text-2xl font-black text-[#052c24]">{{ $slides->total() }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5">
                <div class="w-12 h-12 bg-lime-50 rounded-2xl flex items-center justify-center text-lime-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Slide Aktif Ditampilkan</p>
                    <p class="text-2xl font-black text-lime-600">{{ $slides->where('is_active', true)->count() }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5">
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Autoplay Carousel</p>
                    <p class="text-sm font-bold text-slate-700">6 Detik + Progress Bar</p>
                </div>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/60 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100">
                            <th class="p-6 text-center w-16">Urutan</th>
                            <th class="p-6">Informasi Slide & Banner</th>
                            <th class="p-6">Kategori</th>
                            <th class="p-6">Tombol CTA</th>
                            <th class="p-6 text-center">Status</th>
                            <th class="p-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($slides as $slide)
                        <tr class="hover:bg-slate-50/40 transition-colors group">
                            {{-- Urutan --}}
                            <td class="p-6 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-slate-100 text-xs font-black text-slate-700">
                                    {{ $slide->order }}
                                </span>
                            </td>

                            {{-- Info Slide & Banner --}}
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-28 h-16 rounded-xl overflow-hidden bg-slate-100 relative shrink-0 shadow-sm border border-slate-200">
                                        <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <div class="max-w-md">
                                        <h3 class="font-black text-slate-900 text-sm mb-1 group-hover:text-emerald-900 transition-colors line-clamp-1">
                                            {{ $slide->title }}
                                        </h3>
                                        <p class="text-xs text-slate-500 line-clamp-1 font-medium">
                                            {{ $slide->summary ?: 'Tidak ada ringkasan' }}
                                        </p>
                                        @if($slide->publication)
                                            <span class="inline-block mt-1 text-[10px] font-bold text-lime-700 bg-lime-50 px-2 py-0.5 rounded-md">
                                                🔗 Terhubung: {{ Str::limit($slide->publication->title['id'] ?? $slide->publication->title, 35) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Kategori --}}
                            <td class="p-6">
                                <span class="px-3 py-1 bg-slate-100 text-[#052c24] rounded-lg text-[10px] font-black uppercase tracking-wider">
                                    {{ $slide->category }}
                                </span>
                            </td>

                            {{-- CTA Button --}}
                            <td class="p-6">
                                <div class="text-xs font-bold text-slate-800">
                                    {{ $slide->button_text }}
                                </div>
                                <a href="{{ $slide->button_link }}" target="_blank" class="text-[10px] text-lime-600 hover:underline font-mono truncate max-w-[180px] block">
                                    {{ $slide->button_link }}
                                </a>
                            </td>

                            {{-- Status Toggle --}}
                            <td class="p-6 text-center">
                                <form action="{{ route('omc.hero-slides.toggle', $slide) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest transition-all {{ $slide->is_active ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                                        <span class="w-2 h-2 rounded-full {{ $slide->is_active ? 'bg-emerald-500 animate-pulse' : 'bg-slate-400' }}"></span>
                                        {{ $slide->is_active ? 'Aktif' : 'Draft' }}
                                    </button>
                                </form>
                            </td>

                            {{-- Aksi --}}
                            <td class="p-6 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('omc.hero-slides.edit', $slide) }}" class="p-2.5 bg-slate-50 hover:bg-lime-100 hover:text-[#052c24] text-slate-600 rounded-xl transition-all shadow-sm" title="Edit Slide">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>

                                    <form action="{{ route('omc.hero-slides.destroy', $slide) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus hero slide ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2.5 bg-slate-50 hover:bg-red-50 hover:text-red-600 text-slate-600 rounded-xl transition-all shadow-sm" title="Hapus Slide">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-16 text-center">
                                <div class="max-w-sm mx-auto">
                                    <div class="w-16 h-16 bg-lime-50 text-lime-600 rounded-3xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <h3 class="text-base font-black text-slate-800 uppercase tracking-tight mb-1">Belum Ada Slide Banner</h3>
                                    <p class="text-xs text-slate-500 font-medium mb-6">Website saat ini menampilkan slide artikel default. Tambahkan slide khusus sekarang untuk menggantikannya.</p>
                                    <a href="{{ route('omc.hero-slides.create') }}" class="inline-flex items-center gap-2 bg-[#052c24] text-[#BEF264] px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:scale-105 transition-all shadow-lg">
                                        + Buat Slide Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($slides->hasPages())
                <div class="p-6 border-t border-slate-100">
                    {{ $slides->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

