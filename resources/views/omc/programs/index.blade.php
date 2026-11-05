@extends('omc.layouts.app') {{-- Pastikan layout admin Anda sudah ada --}}

@section('content')
<div class="p-6 md:p-10 font-['Plus_Jakarta_Sans']">

    {{-- Header & Action --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h1 class="text-3xl font-black text-[#052c24] tracking-tighter uppercase">Program <span class="text-slate-300 italic-none">Management</span></h1>
            <p class="text-slate-400 text-sm font-medium">Kelola publikasi, kuota, dan transparansi dampak program YOTA.</p>
        </div>
        <a href="{{ route('omc.programs.create') }}" class="bg-[#052c24] text-[#BEF264] px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-lime-500 hover:text-[#052c24] transition-all shadow-xl shadow-[#052c24]/10 flex items-center gap-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
            Tambah Program
        </a>
    </div>

    {{-- Stats Mini Dashboard --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest block mb-2">Total Program</span>
            <span class="text-3xl font-black text-[#052c24]">{{ $programs->total() }}</span>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <span class="text-[10px] font-black text-lime-600 uppercase tracking-widest block mb-2">Active</span>
            <span class="text-3xl font-black text-[#052c24]">{{ \App\Models\Program::active()->count() }}</span>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Info Program</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Status & Waktu</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Donasi / Kuota</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($programs as $program)
                    <tr class="hover:bg-slate-50/30 transition-colors group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-2xl bg-slate-100 overflow-hidden flex-shrink-0 border border-slate-100">
                                    <img src="{{ asset('storage/' . $program->banner_image) }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-[#052c24] leading-tight mb-1 uppercase tracking-tight">
                                        {{ $program->title['id'] }}
                                    </h4>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                        Slug: {{ $program->slug }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex flex-col gap-2">
                                <span class="w-fit px-3 py-1 {{ $program->status_label['color'] }} text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-sm">
                                    {{ $program->status_label['id_text'] }}
                                </span>
                                <span class="text-[10px] font-bold text-slate-500 italic">
                                    Ends: {{ $program->end_date->format('d M Y') }}
                                </span>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            @if($program->has_donation)
                                <div class="w-40">
                                    <div class="flex justify-between text-[9px] font-black uppercase mb-1">
                                        <span class="text-slate-400">Donasi</span>
                                        <span class="text-lime-600">{{ $program->donation_percentage }}%</span>
                                    </div>
                                    <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-lime-500" style="width: {{ $program->donation_percentage }}%"></div>
                                    </div>
                                    <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase">Rp {{ number_format($program->current_amount, 0, ',', '.') }}</p>
                                </div>
                            @else
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-black text-slate-300 uppercase italic">Non-Donation</span>
                                    <span class="text-xs font-bold text-slate-500">Kuota: {{ $program->quota_used }}/{{ $program->quota_total }}</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('omc.programs.edit', $program->id) }}" class="p-3 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-[#052c24] hover:border-[#052c24] transition-all" title="Edit Program">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('omc.programs.destroy', $program->id) }}" method="POST" onsubmit="return confirm('Hapus program ini secara permanen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-3 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-red-600 hover:border-red-600 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                </div>
                                <h4 class="text-xs font-black text-slate-300 uppercase tracking-[0.3em]">Belum Ada Program</h4>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-8 py-6 border-t border-slate-100 bg-slate-50/50">
            {{ $programs->links() }}
        </div>
    </div>
</div>
@endsection
