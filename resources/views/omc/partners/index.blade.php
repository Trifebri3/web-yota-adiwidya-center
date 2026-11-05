@extends('omc.layouts.app')

@section('content')
<div class="p-10 font-['Plus_Jakarta_Sans']">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h1 class="text-3xl font-black text-[#052c24] uppercase tracking-tighter">
                Network <span class="text-slate-300">Partners</span>
            </h1>
            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-2">
                Manajemen Ekosistem Kolaborasi YOTA
            </p>
        </div>

        <div class="flex items-center gap-4">
            <form action="{{ route('omc.partners.index') }}" method="GET" class="flex gap-2">
                <select name="period" onchange="this.form.submit()" class="bg-white border border-slate-200 text-[#052c24] px-4 py-3 rounded-xl font-bold text-[10px] uppercase tracking-widest focus:ring-2 focus:ring-lime-400 outline-none shadow-sm">
                    <option value="all">Semua Periode</option>
                    <option value="2024" {{ request('period') == '2024' ? 'selected' : '' }}>Tahun 2024</option>
                    <option value="2023" {{ request('period') == '2023' ? 'selected' : '' }}>Tahun 2023</option>
                    </select>
            </form>

            <a href="{{ route('omc.partners.create') }}" class="bg-[#052c24] text-[#BEF264] px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-lime-500 hover:text-[#052c24] transition-all shadow-xl">
                + Tambah Mitra
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($partners as $partner)
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
            <div class="flex justify-between items-start mb-6">
                <div class="w-20 h-20 rounded-2xl bg-slate-50 border border-slate-50 flex items-center justify-center p-4 overflow-hidden">
                    <img src="{{ asset('storage/' . $partner->logo) }}" class="max-w-full max-h-full object-contain" loading="lazy">
                </div>
                <span class="px-4 py-1.5 bg-slate-100 rounded-xl text-[8px] font-black uppercase tracking-widest text-slate-400">
                    {{ $partner->type }}
                </span>
            </div>

            <h3 class="text-xl font-black text-[#052c24] mb-2">{{ $partner->name }}</h3>
            <p class="text-slate-400 text-[10px] font-bold italic line-clamp-2 mb-6">
                {{ $partner->getDesc('id') }}
            </p>

            <div class="flex gap-2 pt-6 border-t border-slate-50">
                <a href="{{ route('omc.partners.edit', $partner->id) }}" class="flex-grow text-center py-3 bg-slate-50 rounded-xl text-[9px] font-black uppercase tracking-widest text-slate-400 hover:bg-[#052c24] hover:text-white transition-all">Edit</a>
                <form action="{{ route('omc.partners.destroy', $partner->id) }}" method="POST" onsubmit="return confirm('Hapus mitra ini?')">
                    @csrf @method('DELETE')
                    <button class="px-4 py-3 bg-white border border-slate-100 rounded-xl text-slate-300 hover:text-red-500 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Tidak ada mitra ditemukan untuk periode ini.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $partners->links() }}
    </div>
</div>
@endsection
