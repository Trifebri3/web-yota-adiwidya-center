@extends('omc.layouts.app')

@section('content')
<div class="bg-[#F8FAFC] min-h-screen font-['Plus_Jakarta_Sans']">
    <header class="bg-[#052c24] pt-32 pb-20 px-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-5xl font-black text-white tracking-tighter uppercase mb-2">
                    Scientific Repository
                </h1>
                <p class="text-white/50 text-xs font-bold uppercase tracking-[0.3em]">Official Media Center Publication</p>
            </div>
            <a href="{{ route('omc.scientific.create') }}" class="w-fit bg-[#BEF264] text-[#052c24] px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:scale-105 transition-all shadow-xl shadow-[#BEF264]/10">
                + Tambah Artikel Baru
            </a>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 -mt-10 pb-20">
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-50">
                            <th class="p-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Informasi Artikel</th>
                            <th class="p-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Penulis</th>
                            <th class="p-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Status</th>
                            <th class="p-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($articles as $art)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="p-8 max-w-md">
                                <div class="flex items-start gap-4">
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex-shrink-0 overflow-hidden border border-slate-200">
                                        @if($art->cover_image)
                                            <img src="{{ asset('storage/' . $art->cover_image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h2 class="font-black text-slate-900 text-base leading-tight mb-2 group-hover:text-[#052c24] transition-colors line-clamp-2 uppercase">
                                            {{ $art->title['id'] }}
                                        </h2>
                                        <div class="flex items-center gap-3">
                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">DOI: 10.5281/omc.{{ $art->id }}</span>
                                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $art->published_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="p-8">
                                <div class="flex items-center gap-3">
                                    <div class="flex -space-x-3">
                                        @if($art->authors->count() > 0)
                                            @foreach($art->authors->take(3) as $author)
                                                <div class="w-8 h-8 rounded-full bg-[#052c24] border-2 border-white flex items-center justify-center text-[10px] font-black text-[#BEF264]" title="{{ $author->name }}">
                                                    {{ substr($author->name, 0, 1) }}
                                                </div>
                                            @endforeach
                                            @if($art->authors->count() > 3)
                                                <div class="w-8 h-8 rounded-full bg-slate-200 border-2 border-white flex items-center justify-center text-[10px] font-black text-slate-500">
                                                    +{{ $art->authors->count() - 3 }}
                                                </div>
                                            @endif
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center text-[10px] font-black text-slate-400">P</div>
                                        @endif
                                    </div>
                                    <span class="text-[11px] font-bold text-slate-600">
                                        {{ $art->authors->count() > 0 ? $art->authors->pluck('name')->first() . ($art->authors->count() > 1 ? ' et al.' : '') : 'Pusat Informasi' }}
                                    </span>
                                </div>
                            </td>

                            <td class="p-8">
                                <span class="px-3 py-1 bg-green-50 text-green-600 text-[9px] font-black uppercase tracking-widest rounded-full border border-green-100">
                                    Verified
                                </span>
                            </td>

                            <td class="p-8 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('omc.scientific.show', $art->slug) }}" class="p-2 text-slate-400 hover:text-[#052c24] transition-colors" title="Lihat">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('omc.scientific.edit', $art->id) }}" class="p-2 text-slate-400 hover:text-blue-600 transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('omc.scientific.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition-colors" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-20 text-center">
                                <div class="flex flex-col items-center opacity-20">
                                    <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p class="font-black uppercase tracking-[0.3em]">Belum Ada Artikel</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($articles->hasPages())
                <div class="p-8 border-t border-slate-50 bg-slate-50/30">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
