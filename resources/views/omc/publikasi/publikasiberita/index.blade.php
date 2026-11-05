@extends('omc.layouts.app')

@section('content')
<div class="py-12 bg-slate-50 min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-1 bg-[#BEF264] rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Official Media Center</span>
                </div>
                <h1 class="text-4xl font-black text-[#052c24] tracking-tighter uppercase">Manajemen Konten</h1>
                <p class="text-slate-500 font-medium">Kendali penuh publikasi dan informasi resmi Yayasan.</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <form action="{{ route('omc.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari publikasi..."
                        class="bg-white border-none rounded-2xl px-6 py-4 text-xs font-bold shadow-sm focus:ring-2 focus:ring-[#BEF264] w-64 transition-all">
                </form>

                <a href="{{ route('omc.create') }}" class="bg-[#052c24] text-[#BEF264] px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:shadow-2xl hover:scale-105 transition-all shadow-xl shadow-[#052c24]/20 flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                    Publikasi Baru
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5">
                <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-[#052c24]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Konten</p>
                    <p class="text-xl font-black text-[#052c24]">{{ $publications->total() }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5">
                <div class="w-12 h-12 bg-lime-50 rounded-2xl flex items-center justify-center text-lime-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Jangkauan (Views)</p>
                    <p class="text-xl font-black text-[#052c24]">{{ number_format($publications->sum('views')) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-50">
                            <th class="p-8">Informasi Publikasi</th>
                            <th class="p-8">Kategori</th>
                            <th class="p-8 text-center">Statistik</th>
                            <th class="p-8 text-center">Status</th>
                            <th class="p-8 text-right">Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($publications as $pub)
                        <tr class="hover:bg-slate-50/30 transition-colors group">
                            <td class="p-8">
                                <div class="flex items-center gap-5">
                                    <div class="relative flex-shrink-0">
                                        <img src="{{ asset('storage/' . $pub->banner) }}" class="w-24 h-16 rounded-2xl object-cover shadow-md group-hover:scale-105 transition-transform duration-500">
                                        @if($pub->pdf_file)
                                            <div class="absolute -top-2 -right-2 bg-red-500 text-white p-1 rounded-lg shadow-lg">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-black text-slate-900 text-base mb-1 line-clamp-1 group-hover:text-[#052c24] transition-colors">
                                            {{ $pub->title['id'] ?? $pub->title }}
                                        </p>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $pub->author }}</span>
                                            <span class="text-slate-200">•</span>
                                            <span class="text-[10px] font-bold text-[#052c24] uppercase tracking-widest">{{ $pub->published_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="p-8">
                                <div class="flex flex-col gap-1">
                                    <span class="w-fit text-[10px] font-black uppercase tracking-widest text-[#052c24] bg-[#BEF264]/30 border border-[#BEF264]/50 px-3 py-1 rounded-lg">
                                        {{ str_replace(['_', '-'], ' ', $pub->type) }}
                                    </span>
                                    <span class="text-[9px] font-medium text-slate-400 italic">Slug: {{ Str::limit($pub->slug, 12) }}</span>
                                </div>
                            </td>

                            <td class="p-8 text-center">
                                <div class="inline-flex flex-col items-center px-4 py-2 bg-slate-50 rounded-2xl border border-slate-100 group-hover:bg-white transition-all">
                                    <span class="text-lg font-black text-[#052c24]">{{ number_format($pub->views ?? 0) }}</span>
                                    <span class="text-[8px] font-bold text-slate-400 uppercase tracking-tighter">Pembaca</span>
                                </div>
                            </td>

                            <td class="p-8 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <div class="relative flex items-center justify-center">
                                        <div class="absolute w-2 h-2 bg-[#BEF264] rounded-full animate-ping opacity-75"></div>
                                        <div class="relative w-2 h-2 bg-[#BEF264] rounded-full"></div>
                                    </div>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-[#052c24]">Live</span>
                                </div>
                            </td>

                            <td class="p-8 text-right">
                                <div class="flex justify-end items-center gap-2">
                                    <a href="{{ route('omc.show', $pub) }}" class="p-3 bg-slate-50 text-slate-400 hover:bg-[#052c24] hover:text-[#BEF264] rounded-xl transition-all duration-300" title="Pratinjau">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>

                                    <a href="{{ route('omc.edit', $pub) }}" class="p-3 bg-slate-50 text-slate-400 hover:bg-[#052c24] hover:text-[#BEF264] rounded-xl transition-all duration-300" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>

                                    <form action="{{ route('omc.destroy', $pub->slug) }}" method="POST" class="inline" onsubmit="return confirm('Konfirmasi Penghapusan: Publikasi ini akan dihapus permanen.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-3 bg-red-50 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all duration-300 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <p class="font-black text-slate-400 uppercase tracking-widest text-xs">Belum ada publikasi resmi</p>
                                    <a href="{{ route('omc.create') }}" class="mt-4 text-[#052c24] font-bold text-xs underline uppercase tracking-widest">Terbitkan Sekarang</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($publications->hasPages())
            <div class="p-8 bg-slate-50/50 border-t border-slate-50">
                {{ $publications->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
