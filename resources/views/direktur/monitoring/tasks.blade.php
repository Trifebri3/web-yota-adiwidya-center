@extends('direktur.layouts.app')

@section('content')
<div class="p-6">
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Monitoring Tugas & Proyek</h2>
            <p class="text-sm text-gray-600">Pantau progres distribusi tugas dari Kabid ke staf/tim di seluruh divisi.</p>
        </div>

        <form action="{{ route('dir.monitoring.tasks') }}" method="GET" class="flex flex-wrap items-center gap-3">
            <select name="division_id" class="bg-white border border-gray-300 text-sm rounded-lg p-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Semua Divisi</option>
                @foreach(\App\Models\Division::all() as $div)
                    <option value="{{ $div->id }}" {{ request('division_id') == $div->id ? 'selected' : '' }}>
                        {{ $div->name }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="bg-white border border-gray-300 text-sm rounded-lg p-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="revised" {{ request('status') == 'revised' ? 'selected' : '' }}>Revisi</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-indigo-700">
                Filter
            </button>

            @if(request('division_id') || request('status'))
                <a href="{{ route('dir.monitoring.tasks') }}" class="text-xs text-red-600 hover:underline">Reset</a>
            @endif
        </form>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-6 py-4">Tugas & Divisi</th>
                        <th class="px-6 py-4">Penerima Tugas</th>
                        <th class="px-6 py-4 text-center">Deadline</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4">Hasil Kerja</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($tasks as $task)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800">{{ $task->title }}</div>
                            <div class="flex items-center gap-1 mt-1">
                                <span class="text-[10px] px-2 py-0.5 bg-gray-100 text-gray-600 rounded">
                                    {{ $task->kabid->division->name ?? 'N/A' }}
                                </span>
                                <span class="text-[10px] text-gray-400">Oleh: {{ $task->kabid->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($task->team)
                                <div class="flex items-center text-sm font-medium text-blue-700">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Tim: {{ $task->team->name }}
                                </div>
                            @else
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $task->user->name ?? 'Tidak diketahui' }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="text-sm {{ $task->deadline->isPast() && $task->status != 'completed' ? 'text-red-600 font-bold' : 'text-gray-600' }}">
                                {{ $task->deadline->format('d/m/Y') }}
                            </div>
                            <div class="text-[10px] text-gray-400 italic">{{ $task->deadline->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'revised' => 'bg-orange-100 text-orange-800',
                                    'completed' => 'bg-green-100 text-green-800'
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $statusClasses[$task->status] ?? 'bg-gray-100' }}">
                                {{ $task->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($task->submission_link)
                                <a href="{{ $task->submission_link }}" target="_blank" class="flex items-center text-xs text-indigo-600 hover:underline font-medium">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    Lihat Lampiran
                                </a>
                            @else
                                <span class="text-xs text-gray-400 italic">Belum dikirim</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('dir.monitoring.tasks.show', $task->id) }}" class="p-2 text-gray-500 hover:text-indigo-600 transition" title="Lihat Detail">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            Tidak ditemukan data tugas pada kriteria ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tasks->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $tasks->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
