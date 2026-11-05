@extends('omc.layouts.app')

@section('content')
<div class="bg-white min-h-screen pt-32 px-4 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-12">
            <div>
                <h1 class="text-4xl font-black uppercase tracking-tighter text-[#052c24]">Impact <span class="text-blue-600">Statistics</span></h1>
                <p class="text-slate-400 font-medium">Konversi program dan kegiatan menjadi angka nyata.</p>
            </div>
            <a href="{{ route('omc.impact.create') }}" class="bg-[#052c24] text-[#BEF264] px-10 py-5 rounded-[2rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-blue-600 hover:text-white transition-all shadow-xl shadow-blue-100">
                Buat Laporan Baru
            </a>
        </div>

        <div class="bg-white rounded-[3rem] border border-slate-100 shadow-2xl shadow-slate-200/50 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Program & Kategori</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Ringkasan Dampak</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Dokumen</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($reports as $report)
                    <tr class="hover:bg-blue-50/30 transition-colors group">
                        <td class="px-8 py-6">
                            <p class="font-bold text-[#052c24] text-lg mb-1">{{ $report->title['id'] }}</p>
                            <span class="text-[10px] font-black uppercase tracking-widest text-blue-500 bg-blue-50 px-3 py-1 rounded-full">
                                {{ $report->category }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex flex-wrap gap-2">
                                @if($report->stats_data)
                                    @foreach(array_slice($report->stats_data, 0, 3) as $stat)
                                        <div class="bg-slate-100 px-3 py-1 rounded-lg">
                                            <span class="font-black text-[#052c24] text-xs">{{ $stat['value'] }}</span>
                                            <span class="text-[9px] text-slate-400 uppercase font-bold">{{ $stat['label_id'] }}</span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            @if($report->pdf_path)
                                <a href="{{ $report->pdf_path }}" target="_blank" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-blue-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    View PDF
                                </a>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('omc.impact.edit', $report->id) }}" class="p-3 bg-slate-50 text-slate-400 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('omc.impact.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Data dampak akan dihapus permanen?')">
                                    @csrf @method('DELETE')
                                    <button class="p-3 bg-slate-50 text-slate-400 rounded-2xl group-hover:bg-red-600 group-hover:text-white transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-8">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
