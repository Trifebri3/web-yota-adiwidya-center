@extends('direktur.layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:block">
        <div class="p-6">
            <h1 class="text-xl font-bold text-indigo-400">DIR-PANEL</h1>
            <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wider">Sistem Monitoring Direktur</p>
        </div>

        <nav class="mt-2 px-4 space-y-1">
            <p class="text-[10px] font-bold text-slate-500 uppercase px-2 mb-2 tracking-widest text-opacity-70">Main Dashboard</p>
            <a href="{{ route('dir.monitoring') }}" class="flex items-center p-3 text-sm rounded-lg transition {{ request()->routeIs('dir.monitoring') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                <span class="mr-3">📊</span> Overview Statistik
            </a>

            <p class="text-[10px] font-bold text-slate-500 uppercase px-2 mt-6 mb-2 tracking-widest text-opacity-70">Operasional Divisi</p>
            <a href="{{ route('dir.monitoring.agenda') }}" class="flex items-center p-3 text-sm rounded-lg text-slate-300 hover:bg-slate-800 transition">
                <span class="mr-3">📅</span> Kalender Aktivitas
            </a>
            <a href="{{ route('dir.monitoring.tasks') }}" class="flex items-center p-3 text-sm rounded-lg text-slate-300 hover:bg-slate-800 transition">
                <span class="mr-3">📝</span> Progres Tugas
            </a>
            <a href="{{ route('dir.monitoring.service-requests') }}" class="flex items-center p-3 text-sm rounded-lg text-slate-300 hover:bg-slate-800 transition">
                <span class="mr-3">🎫</span> Tiket Layanan
            </a>

            <p class="text-[10px] font-bold text-slate-500 uppercase px-2 mt-6 mb-2 tracking-widest text-opacity-70">Finansial & Dokumen</p>
            <a href="{{ route('dir.monitoring.proposals') }}" class="flex items-center p-3 text-sm rounded-lg text-slate-300 hover:bg-slate-800 transition">
                <span class="mr-3">💰</span> Pengajuan Proposal
            </a>
            <a href="{{ route('dir.monitoring.documents') }}" class="flex items-center p-3 text-sm rounded-lg text-slate-300 hover:bg-slate-800 transition">
                <span class="mr-3">📁</span> Aset Digital Divisi
            </a>
            <a href="{{ route('dir.monitoring.archives') }}" class="flex items-center p-3 text-sm rounded-lg text-slate-300 hover:bg-slate-800 transition">
                <span class="mr-3">📚</span> Arsip & Dokumen Publik
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800">Monitoring Dashboard</h2>
                <p class="text-slate-500">Pemantauan aktivitas seluruh divisi secara real-time.</p>
            </div>
            <div class="text-right">
                <div class="text-sm font-bold text-slate-400 uppercase tracking-tighter italic">Hari Ini</div>
                <div class="text-lg font-medium text-slate-700">{{ now()->format('d F Y') }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="p-4 bg-blue-50 text-blue-600 rounded-xl mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase">Total Tugas</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $stats['total_tasks'] }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="p-4 bg-yellow-50 text-yellow-600 rounded-xl mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase">Sedang Berjalan</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $stats['pending_tasks'] }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="p-4 bg-emerald-50 text-emerald-600 rounded-xl mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase">Selesai</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $stats['completed_tasks'] }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="p-4 bg-purple-50 text-purple-600 rounded-xl mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase">Aset Digital</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $stats['total_documents'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-white">
                <h3 class="text-xl font-bold text-slate-800">Status Per Divisi</h3>
                <span class="px-4 py-1 bg-slate-100 text-slate-600 text-[10px] font-black uppercase rounded-full tracking-widest">Total {{ $divisions->count() }} Divisi</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-500 text-[10px] uppercase font-black tracking-widest">
                        <tr>
                            <th class="px-8 py-4">Nama Divisi</th>
                            <th class="px-8 py-4 text-center">Agenda Aktif</th>
                            <th class="px-8 py-4 text-center">Progres Tugas</th>
                            <th class="px-8 py-4 text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($divisions as $div)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-8 py-5">
                                <div class="font-extrabold text-slate-800">{{ $div->name }}</div>
                                <div class="text-[10px] text-slate-400 font-medium italic">Internal Code: DIV-{{ $div->id }}</div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">
                                    {{ $div->agendas_count ?? 0 }} Agenda
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center">
                                    <div class="flex-1 bg-slate-100 rounded-full h-2 mr-3 overflow-hidden">
                                        <div class="bg-emerald-500 h-2 rounded-full" style="width: 70%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-600">70%</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <a href="{{ route('dir.monitoring.tasks', ['division_id' => $div->id]) }}" class="text-xs bg-white border border-slate-200 px-4 py-2 rounded-lg font-bold text-slate-700 hover:bg-slate-800 hover:text-white transition shadow-sm">
                                    LIHAT DETAIL
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 p-4 bg-indigo-50 rounded-xl border border-indigo-100 flex items-center justify-between">
            <div class="flex items-center">
                <span class="text-2xl mr-3">📢</span>
                <p class="text-sm text-indigo-700 font-medium">Terdapat <strong>{{ $stats['active_announcements'] }} pengumuman</strong> yang sedang aktif di seluruh divisi.</p>
            </div>
            <a href="{{ route('dir.monitoring.agenda') }}" class="text-xs font-bold text-indigo-600 hover:underline">Lihat Kalender Perusahaan &rarr;</a>
        </div>
    </main>
</div>
@endsection
