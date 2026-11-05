@extends('direktur.layouts.app')


@section('content')
<div class="p-6">
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Monitoring Aset Digital</h2>
            <p class="text-sm text-gray-600">Pusat dokumen, laporan, dan link penting dari seluruh divisi.</p>
        </div>

        <form action="{{ route('dir.monitoring.documents') }}" method="GET" class="flex items-center gap-3">
            <div class="relative">
                <select name="division_id" onchange="this.form.submit()" class="appearance-none bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 pr-10">
                    <option value="">Filter Semua Divisi</option>
                    @foreach(\App\Models\Division::all() as $div)
                        <option value="{{ $div->id }}" {{ request('division_id') == $div->id ? 'selected' : '' }}>
                            {{ $div->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
            @if(request('division_id'))
                <a href="{{ route('dir.monitoring.documents') }}" class="text-xs text-red-600 hover:underline font-medium">Reset</a>
            @endif
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($documents as $doc)
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow flex flex-col">
                <div class="p-4 border-b border-gray-50">
                    <div class="flex justify-between items-start mb-2">
                        <span class="px-2 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-bold uppercase rounded">
                            {{ $doc->category }}
                        </span>
                        <span class="text-[10px] text-gray-400 font-medium">
                            {{ $doc->created_at->format('d M Y') }}
                        </span>
                    </div>
                    <h3 class="font-bold text-gray-800 line-clamp-1" title="{{ $doc->title }}">
                        {{ $doc->title }}
                    </h3>
                    <p class="text-xs text-indigo-600 font-semibold mt-1">
                        Divisi: {{ $doc->user->division->name ?? 'N/A' }}
                    </p>
                </div>

                <div class="p-4 flex-grow">
                    <p class="text-sm text-gray-600 line-clamp-3 italic">
                        "{{ $doc->description ?? 'Tidak ada deskripsi tambahan.' }}"
                    </p>
                    <div class="mt-4 flex items-center gap-2 text-[11px] text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Diterbitkan oleh: <strong>{{ $doc->user->name }}</strong></span>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-100 rounded-b-xl">
                    <a href="{{ $doc->link_url }}" target="_blank" class="flex items-center justify-center w-full px-4 py-2 bg-white border border-emerald-500 text-emerald-600 text-sm font-bold rounded-lg hover:bg-emerald-500 hover:text-white transition-colors gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        Buka Dokumen
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <p class="text-gray-500 font-medium">Belum ada aset digital yang diterbitkan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $documents->links() }}
    </div>
</div>
@endsection
