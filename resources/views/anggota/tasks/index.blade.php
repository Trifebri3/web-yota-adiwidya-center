@extends('anggota.layouts.app')

@section('content')
<div class="p-8 bg-[#FDFDFB] min-h-screen font-['Plus_Jakarta_Sans']">

    <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-12">
        <div>
            <span class="text-[10px] font-black text-lime-500 uppercase tracking-[0.5em] block mb-2">Operational Center</span>
            <h1 class="text-5xl font-black text-[#064e3b] uppercase tracking-tighter leading-none">
                Mission <span class="text-lime-500 italic font-serif">Board</span>
            </h1>
        </div>

        <div class="flex gap-4">
            <div class="bg-white px-6 py-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="text-right">
                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Tugas Aktif</p>
                    <p class="text-lg font-black text-red-500">{{ $tasks->whereIn('status', ['pending', 'revised'])->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-fire-alt text-xs"></i>
                </div>
            </div>
            <div class="bg-[#064e3b] px-6 py-4 rounded-2xl shadow-lg flex items-center gap-4">
                <div class="text-right">
                    <p class="text-[8px] font-black text-lime-400/50 uppercase tracking-widest">Selesai</p>
                    <p class="text-lg font-black text-white">{{ $tasks->where('status', 'completed')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-lime-400 rounded-xl flex items-center justify-center text-[#064e3b]">
                    <i class="fas fa-check-double text-xs"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- 1. SECTION: TUGAS AKTIF (PENDING / REVISED) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        @php $activeTasks = $tasks->whereIn('status', ['pending', 'revised', 'in_progress']); @endphp

        @forelse($activeTasks as $task)
            <div class="bg-white rounded-[3rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/20 hover:shadow-2xl transition-all group relative overflow-hidden">
                @if($task->status == 'revised')
                    <div class="absolute top-0 right-0 bg-red-500 text-white text-[8px] font-black px-4 py-1 rounded-bl-2xl uppercase tracking-widest animate-pulse">REVISI</div>
                @endif

                <div class="flex justify-between items-start mb-8">
                    <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest {{ $task->status == 'revised' ? 'bg-red-100 text-red-600' : 'bg-slate-100 text-slate-500' }}">
                        {{ $task->status }}
                    </span>
                    <span class="text-[9px] font-black {{ $task->team_id ? 'text-lime-600' : 'text-[#064e3b]' }} uppercase italic">
                        {{ $task->team_id ? 'Team' : 'Personal' }}
                    </span>
                </div>

                <a href="{{ route('anggota.tugas.show', $task->id) }}" class="block mb-6">
                    <h3 class="text-2xl font-black text-[#064e3b] uppercase italic leading-tight group-hover:text-lime-600 transition-all">
                        {{ $task->title }}
                    </h3>
                </a>

                <div class="flex items-center gap-2 text-red-500 text-[10px] font-bold mb-8">
                    <i class="far fa-clock"></i> {{ $task->deadline->diffForHumans() }}
                </div>

                <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-2 text-[9px] font-black text-slate-400 uppercase">
                        From: <span class="text-[#064e3b]">{{ $task->kabid->name }}</span>
                    </div>
                    <a href="{{ route('anggota.tugas.show', $task->id) }}" class="w-10 h-10 bg-slate-900 text-white rounded-xl flex items-center justify-center hover:bg-lime-400 hover:text-[#064e3b] transition-all">
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-emerald-50 rounded-[3rem] border-2 border-dashed border-emerald-100">
                <p class="text-emerald-700 font-black uppercase tracking-widest text-xs italic">✨ Semua tugas sudah aman. Good job!</p>
            </div>
        @endforelse
    </div>

    {{-- 2. SECTION: ARSIP (SUBMITTED / COMPLETED) --}}
    @php $archivedTasks = $tasks->whereIn('status', ['submitted', 'completed']); @endphp

    @if($archivedTasks->count() > 0)
    <div class="mt-20">
        <button onclick="toggleArchive()" class="flex items-center gap-4 group">
            <div class="h-[1px] w-12 bg-slate-200 group-hover:w-20 transition-all"></div>
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] group-hover:text-[#064e3b]">
                Tampilkan Arsip Selesai ({{ $archivedTasks->count() }})
            </span>
            <i id="archive-icon" class="fas fa-chevron-down text-[10px] text-slate-300 transition-transform"></i>
        </button>

        <div id="archive-content" class="hidden mt-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($archivedTasks as $task)
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 opacity-60 hover:opacity-100 transition-all grayscale hover:grayscale-0">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-[8px] font-black uppercase px-3 py-1 {{ $task->status == 'completed' ? 'bg-emerald-100 text-emerald-600' : 'bg-blue-50 text-blue-500' }} rounded-lg">
                            {{ $task->status }}
                        </span>
                        <i class="fas {{ $task->status == 'completed' ? 'fa-check-circle text-emerald-500' : 'fa-history text-blue-400' }} text-xs"></i>
                    </div>
                    <h4 class="text-sm font-black text-[#064e3b] uppercase leading-tight mb-4">{{ $task->title }}</h4>
                    <a href="{{ route('anggota.tugas.show', $task->id) }}" class="text-[9px] font-black text-slate-400 uppercase hover:text-lime-600 transition-colors tracking-widest">
                        Review Laporan <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    function toggleArchive() {
        const content = document.getElementById('archive-content');
        const icon = document.getElementById('archive-icon');

        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>
@endsection
