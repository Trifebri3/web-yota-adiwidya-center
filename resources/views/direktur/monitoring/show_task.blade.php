@extends('direktur.layouts.app')

@section('content')
<div class="p-6">
    <nav class="flex mb-5 text-gray-500 text-sm" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1">
            <li class="inline-flex items-center">
                <a href="{{ route('dir.monitoring.tasks') }}" class="hover:text-indigo-600 italic">Monitoring Tugas</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="text-gray-800 font-medium">Detail Tugas</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-start">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $task->title }}</h2>
                        <p class="text-sm text-indigo-600 font-medium mt-1">
                            Divisi: {{ $task->kabid->division->name }}
                            <span class="text-gray-300 mx-2">|</span>
                            Oleh: {{ $task->kabid->name }}
                        </p>
                    </div>
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'revised' => 'bg-orange-100 text-orange-800',
                            'completed' => 'bg-green-100 text-green-800'
                        ];
                    @endphp
                    <span class="px-4 py-1 rounded-full text-xs font-bold uppercase {{ $statusColors[$task->status] ?? 'bg-gray-100' }}">
                        {{ $task->status }}
                    </span>
                </div>
                <div class="p-6">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Deskripsi / Instruksi Tugas:</h4>
                    <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($task->description)) !!}
                    </div>
                </div>
            </div>

            @if($task->submission_link || $task->submission_notes)
            <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-6">
                <h4 class="text-emerald-800 font-bold text-sm mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Hasil Pekerjaan Staf
                </h4>
                <div class="bg-white border border-emerald-200 rounded-lg p-4 shadow-sm">
                    <p class="text-sm text-gray-700 mb-4">{{ $task->submission_notes ?? 'Tidak ada catatan pengumpulan.' }}</p>
                    @if($task->submission_link)
                    <a href="{{ $task->submission_link }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm font-bold rounded-lg hover:bg-emerald-700 transition">
                        Buka Link Hasil Kerja
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                    @endif
                </div>
            </div>
            @endif

            @if($task->revision_notes)
            <div class="bg-orange-50 border border-orange-100 rounded-xl p-6">
                <h4 class="text-orange-800 font-bold text-sm mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Catatan Revisi dari Kabid
                </h4>
                <p class="text-sm text-orange-900 italic">"{{ $task->revision_notes }}"</p>
            </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <h4 class="text-gray-900 font-bold text-sm mb-4 border-b pb-2">Timeline & Target</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Diberikan Kepada:</p>
                        <p class="text-sm font-semibold text-gray-800 mt-1">
                            {{ $task->team ? 'Tim: ' . $task->team->name : ($task->user->name ?? 'N/A') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Batas Waktu (Deadline):</p>
                        <p class="text-sm font-semibold {{ $task->deadline->isPast() ? 'text-red-600' : 'text-gray-800' }} mt-1">
                            {{ $task->deadline->format('d F Y, H:i') }}
                        </p>
                        <p class="text-[11px] text-gray-500">{{ $task->deadline->diffForHumans() }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Dibuat Pada:</p>
                        <p class="text-sm text-gray-800 mt-1">{{ $task->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-100 border border-gray-200 rounded-xl p-5 shadow-inner">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Anda mengakses halaman ini sebagai <strong>Direktur</strong>. Halaman ini bersifat pantauan (read-only). Segala perubahan status tugas hanya dapat dilakukan oleh Kabid terkait.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
