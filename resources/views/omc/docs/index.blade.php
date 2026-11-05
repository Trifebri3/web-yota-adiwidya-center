@extends('omc.layouts.app')

@section('content')
<div class="bg-white min-h-screen pt-32 px-4 font-['Plus_Jakarta_Sans']">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-3xl font-black uppercase tracking-tighter text-[#052c24]">Doc Publication</h1>
                <p class="text-slate-400 text-sm font-medium">Kelola Annual Report, Policy Brief, dan Pernyataan Resmi.</p>
            </div>
            <a href="{{ route('omc.docs.create') }}" class="bg-[#052c24] text-[#BEF264] px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-[#BEF264] hover:text-[#052c24] transition-all shadow-lg">
                Tambah Dokumen
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Judul & Kategori</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Tanggal Terbit</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Link File</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($docs as $doc)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <p class="font-bold text-[#052c24] mb-1">{{ $doc->title }}</p>
                            <span class="px-3 py-1 {{ $doc->category_color }} rounded-full text-[9px] font-black uppercase tracking-tighter">
                                {{ $doc->category_label }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-sm text-slate-500 font-medium">
                            {{ $doc->published_at->format('d M Y') }}
                        </td>
                        <td class="px-8 py-6">
                            <a href="{{ $doc->pdf_path }}" target="_blank" class="text-blue-600 hover:underline text-xs font-bold truncate max-w-[150px] block">
                                Buka Link Luar
                            </a>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('omc.docs.edit', $doc->id) }}" class="p-2 bg-slate-100 text-slate-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('omc.docs.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Yakin hapus dokumen ini?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 bg-slate-100 text-slate-600 rounded-lg hover:bg-red-600 hover:text-white transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-8 bg-slate-50">
                {{ $docs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
