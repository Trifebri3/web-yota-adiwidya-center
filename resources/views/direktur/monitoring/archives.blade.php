@extends('direktur.layouts.app')


@section('content')
<div class="p-6">
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Monitoring Arsip & Perpustakaan Digital</h2>
            <p class="text-sm text-gray-600">Daftar seluruh dokumen statis, regulasi, dan arsip yang tersimpan dalam sistem.</p>
        </div>

        <form action="{{ route('dir.monitoring.archives') }}" method="GET" class="flex items-center gap-2">
            <select name="category" onchange="this.form.submit()" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                <option value="">Semua Kategori</option>
                <option value="legal" {{ request('category') == 'legal' ? 'selected' : '' }}>Legalitas</option>
                <option value="finance" {{ request('category') == 'finance' ? 'selected' : '' }}>Keuangan</option>
                <option value="hr" {{ request('category') == 'hr' ? 'selected' : '' }}>SDM / HR</option>
                <option value="operation" {{ request('category') == 'operation' ? 'selected' : '' }}>Operasional</option>
            </select>
            @if(request('category'))
                <a href="{{ route('dir.monitoring.archives') }}" class="text-xs text-red-600 hover:underline">Reset</a>
            @endif
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($archives as $archive)
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
                <div class="h-2 w-full" style="background-color: {{ $archive->label_color ?? '#64748b' }}"></div>

                <div class="p-5">
                    <div class="flex justify-between items-start mb-3">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                            {{ $archive->category }}
                        </span>
                        @if($archive->is_public)
                            <span class="bg-green-100 text-green-700 text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Publik</span>
                        @else
                            <span class="bg-gray-100 text-gray-600 text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Internal</span>
                        @endif
                    </div>

                    <h3 class="font-bold text-gray-800 mb-1 line-clamp-2" title="{{ $archive->title }}">
                        {{ $archive->title }}
                    </h3>

                    <p class="text-xs text-gray-500 line-clamp-3 mb-4 h-12">
                        {{ $archive->description ?? 'Tidak ada deskripsi arsip.' }}
                    </p>

                    <div class="pt-4 border-t border-gray-100 flex flex-col gap-2">
                        <div class="flex items-center text-[10px] text-gray-400">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Pemilik: {{ $archive->user->name }}
                        </div>

                        <div class="flex gap-2 mt-2">
                            @if($archive->attachment_path)
                                <a href="{{ $archive->attachment_url }}" target="_blank" class="flex-1 text-center py-2 bg-blue-50 text-blue-600 text-xs font-bold rounded hover:bg-blue-600 hover:text-white transition">
                                    FILE
                                </a>
                            @endif
                            @if($archive->link_url)
                                <a href="{{ $archive->link_url }}" target="_blank" class="flex-1 text-center py-2 bg-slate-50 text-slate-600 text-xs font-bold rounded hover:bg-slate-800 hover:text-white transition">
                                    LINK
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center bg-white rounded-xl border border-dashed border-gray-300">
                <p class="text-gray-400">Belum ada arsip yang diunggah.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $archives->links() }}
    </div>
</div>
@endsection
