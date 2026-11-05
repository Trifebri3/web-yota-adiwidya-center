@extends('omc.layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 pb-20 pt-10">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight uppercase">Inovasi Sosial</h1>
                <p class="text-slate-500 text-sm font-medium">Manajemen produk tepat guna, teknologi, dan edukasi dari OMC Office.</p>
            </div>
            <a href="{{ route('omc.products.create') }}" class="px-8 py-4 bg-[#052c24] text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-800 transition-all shadow-lg flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg> Tambah Produk
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Inovasi</p>
                <p class="text-3xl font-black text-slate-900">{{ $products->total() }}</p>
            </div>
            <div class="bg-blue-500 p-6 rounded-[2rem] shadow-sm text-white">
                <p class="text-[10px] font-black text-white/50 uppercase tracking-widest mb-1">Kategori</p>
                <p class="text-3xl font-black">{{ $products->unique('category')->count() }}</p>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Dokumen PDF</p>
                <p class="text-3xl font-black text-slate-900">{{ $products->whereNotNull('pdf_url')->count() }}</p>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Video Demo</p>
                <p class="text-3xl font-black text-slate-900">{{ $products->whereNotNull('video_url')->count() }}</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Produk & Kategori</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Bahasa Tersedia</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Resource</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($products as $product)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/'.$product->banner_image) }}" class="w-14 h-14 rounded-2xl object-cover shadow-sm">
                                <div>
                                    <p class="font-bold text-slate-900 text-sm">{{ $product->name['id'] }}</p>
                                    <span class="text-[9px] font-black uppercase tracking-widest bg-slate-100 text-slate-500 px-2 py-0.5 rounded">
                                        {{ $product->category }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-6">
                            <div class="flex gap-1">
                                <span class="w-5 h-5 flex items-center justify-center bg-lime-100 text-lime-700 text-[8px] font-black rounded shadow-sm" title="Indonesia">ID</span>
                                <span class="w-5 h-5 flex items-center justify-center bg-blue-100 text-blue-700 text-[8px] font-black rounded shadow-sm" title="English">EN</span>
                            </div>
                        </td>
                        <td class="px-6 py-6">
                            <div class="flex gap-3">
                                @if($product->pdf_url)
                                    <a href="{{ $product->pdf_url }}" target="_blank" class="text-red-500 hover:scale-110 transition-transform" title="Lihat PDF">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9v-2h2v2zm0-4H9V7h2v5z"/></svg>
                                    </a>
                                @endif
                                @if($product->video_url)
                                    <a href="{{ $product->video_url }}" target="_blank" class="text-blue-600 hover:scale-110 transition-transform" title="Tonton Video">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
                                    </a>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-6">
                            <span class="px-3 py-1 bg-green-100 text-green-600 text-[9px] font-black uppercase tracking-widest rounded-full">
                                Terbit
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('omc.products.edit', $product->slug) }}" class="p-2 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-xl transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('omc.products.destroy', $product->slug) }}" method="POST" onsubmit="return confirm('Hapus produk inovasi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center text-slate-400 italic text-sm">Belum ada produk inovasi sosial yang terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-8 py-6 bg-slate-50">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
