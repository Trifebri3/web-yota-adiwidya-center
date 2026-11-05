@extends('omc.layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 pb-20 pt-10">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-900 uppercase">Gallery Management</h1>
                <p class="text-slate-500 text-sm">Dokumentasi visual kegiatan dan pencapaian.</p>
            </div>
            <button onclick="document.getElementById('modal-add').classList.remove('hidden')" class="bg-[#052c24] text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-lime-400 hover:text-[#052c24] transition-all">
                Tambah Foto
            </button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($galleries as $item)
            <div class="group relative bg-white rounded-[2rem] overflow-hidden shadow-sm border border-slate-100">
                <img src="{{ asset('storage/' . $item->image) }}" class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110">

                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 flex flex-col justify-end">
                    <span class="text-lime-400 text-[8px] font-black uppercase tracking-[0.2em] mb-1">{{ $item->category }}</span>
                    <h4 class="text-white font-bold text-sm mb-4">{{ $item->title }}</h4>

                    <form action="{{ route('omc.galleries.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                        @csrf @method('DELETE')
                        <button class="w-full py-2 bg-red-500 text-white rounded-xl text-[10px] font-black uppercase tracking-widest">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div id="modal-add" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-md rounded-[3rem] p-10 relative">
        <button onclick="document.getElementById('modal-add').classList.add('hidden')" class="absolute top-6 right-6 text-slate-400 hover:text-slate-900">✕</button>

        <h3 class="text-xl font-black uppercase mb-6 text-slate-900">Unggah Dokumentasi</h3>

        <form action="{{ route('omc.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="text" name="title" placeholder="Judul Foto" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-lime-400" required>

            <select name="category" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-lime-400">
                <option value="Kegiatan">Kegiatan Lapangan</option>
                <option value="Infrastruktur">Infrastruktur</option>
                <option value="Pemberdayaan">Pemberdayaan</option>
            </select>

            <div class="border-2 border-dashed border-slate-200 rounded-2xl p-4 text-center">
                <input type="file" name="image" class="text-xs text-slate-400" required>
            </div>

            <button type="submit" class="w-full py-4 bg-lime-400 text-[#052c24] rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl shadow-lime-500/20">
                Simpan ke Galeri
            </button>
        </form>
    </div>
</div>
@endsection
