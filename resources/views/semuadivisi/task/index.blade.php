@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-10 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-end gap-8 mb-16">
            <div class="max-w-2xl">
                <span class="text-[10px] font-black text-lime-500 uppercase tracking-[0.5em] block mb-4">Collective Responsibility</span>
                <h1 class="text-6xl md:text-8xl font-black text-[#064e3b] tracking-tighter leading-[0.8] uppercase italic">
                    Team <br>Mission.
                </h1>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-6">
                <div class="text-right">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Divisi Anda</p>
                    <p class="text-sm font-black text-[#064e3b] uppercase">{{ Auth::user()->division->name }}</p>
                </div>
                <div class="w-12 h-12 bg-lime-400 rounded-2xl flex items-center justify-center shadow-lg shadow-lime-200">
                    <i class="fas fa-shield-alt text-[#064e3b]"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
            @php
                $statusCounts = [
                    'pending' => $tasks->where('status', 'pending')->count(),
                    'doing' => $tasks->where('status', 'doing')->count(),
                    'submitted' => $tasks->where('status', 'submitted')->count(),
                    'completed' => $tasks->where('status', 'completed')->count(),
                ];
            @endphp
            <div class="bg-white p-6 rounded-3xl border border-slate-50">
                <p class="text-[8px] font-black text-slate-400 uppercase mb-1">Menunggu</p>
                <p class="text-2xl font-black text-[#064e3b]">{{ $statusCounts['pending'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-50">
                <p class="text-[8px] font-black text-amber-400 uppercase mb-1">Proses</p>
                <p class="text-2xl font-black text-amber-600">{{ $statusCounts['doing'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-50">
                <p class="text-[8px] font-black text-purple-400 uppercase mb-1">Ditinjau</p>
                <p class="text-2xl font-black text-purple-600">{{ $statusCounts['submitted'] }}</p>
            </div>
            <div class="bg-[#064e3b] p-6 rounded-3xl shadow-xl shadow-emerald-900/10">
                <p class="text-[8px] font-black text-lime-400 uppercase mb-1">Selesai</p>
                <p class="text-2xl font-black text-white">{{ $statusCounts['completed'] }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($tasks as $task)
            <div class="group bg-white rounded-[3rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/20 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 relative overflow-hidden">

                <div class="flex justify-between items-start mb-8">
                    <div class="px-4 py-2 rounded-xl {{ $task->status_color }} text-[9px] font-black uppercase tracking-widest">
                        {{ $task->status }}
                    </div>
                    <div class="text-right">
                        <p class="text-[8px] font-black text-slate-300 uppercase mb-1">Tenggat</p>
                        <p class="text-[10px] font-bold {{ $task->deadline->isPast() ? 'text-red-500' : 'text-slate-600' }}">
                            {{ $task->deadline->format('d M Y') }}
                        </p>
                    </div>
                </div>

                <a href="{{ route('task.show', $task->id) }}" class="block mb-6">
                    <h3 class="text-2xl font-black text-[#064e3b] uppercase italic leading-tight group-hover:text-lime-600 transition-colors">
                        {{ $task->title }}
                    </h3>
                </a>

                <div class="space-y-4 mb-8">
                    <div class="flex items-center gap-3 text-slate-400">
                        <i class="fas fa-user-tie text-[10px]"></i>
                        <span class="text-[10px] font-bold uppercase tracking-tight">Pemberi: {{ $task->author->name }}</span>
                    </div>
                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                        {{ $task->description ?? 'Tidak ada deskripsi tambahan untuk misi ini.' }}
                    </p>
                </div>

                <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-100 flex items-center justify-center text-[8px] font-black">YU</div>
                        <div class="w-8 h-8 rounded-full border-2 border-white bg-lime-400 flex items-center justify-center text-[8px] font-black">YO</div>
                    </div>

                    <a href="{{ route('task.show', $task->id) }}" class="inline-flex items-center gap-2 bg-[#064e3b] text-white px-6 py-3 rounded-2xl text-[9px] font-black uppercase tracking-widest hover:bg-black transition-all">
                        Ambil Misi <i class="fas fa-chevron-right text-[8px]"></i>
                    </a>
                </div>

                <div class="absolute -bottom-6 -right-6 text-slate-50 opacity-10 pointer-events-none transition-transform group-hover:scale-150">
                    <i class="fas fa-tasks text-9xl"></i>
                </div>
            </div>
            @empty
            <div class="col-span-full py-32 text-center bg-white rounded-[4rem] border-2 border-dashed border-slate-100">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-rocket text-2xl text-slate-200"></i>
                </div>
                <h3 class="text-xl font-black text-[#064e3b] uppercase italic">Belum Ada Misi Baru</h3>
                <p class="text-slate-400 text-sm mt-2">Semua tugas tim Anda sudah terorganisir dengan baik.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection
