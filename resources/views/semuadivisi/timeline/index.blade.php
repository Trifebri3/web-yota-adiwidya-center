@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="p-8 bg-[#FDFDFB] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
        <div>
            <span class="text-[10px] font-black text-lime-500 uppercase tracking-[0.5em] block mb-2">Institutional Roadmap</span>
            <h1 class="text-4xl md:text-5xl font-black text-[#064e3b] uppercase tracking-tighter leading-none">
                Project <span class="text-lime-500 italic font-serif">Masterplan</span>
            </h1>
            <p class="text-slate-400 text-xs mt-2 font-medium">Pantau alur kerja besar dan target capaian Yayasan Yota secara transparan.</p>
        </div>

        <div class="bg-white px-6 py-3 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="text-right">
                <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Project Aktif</p>
                <p class="text-sm font-black text-[#064e3b]">{{ $timelines->where('status', '!=', 'completed')->count() }} Proyek</p>
            </div>
            <div class="w-10 h-10 bg-lime-400 rounded-xl flex items-center justify-center text-[#064e3b] shadow-lg shadow-lime-100">
                <i class="fas fa-layer-group"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-10">
        @forelse($timelines as $timeline)
        <div class="bg-white rounded-[3.5rem] p-8 md:p-12 shadow-xl shadow-slate-200/40 border border-slate-50 group transition-all duration-500 relative overflow-hidden">

            <div class="flex flex-col lg:flex-row gap-12 relative z-10">

                <div class="lg:w-1/3">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="px-4 py-1.5 bg-slate-50 text-[#064e3b] text-[9px] font-black uppercase rounded-lg tracking-widest border border-slate-100">
                            {{ $timeline->category ?? 'General Project' }}
                        </span>
                        @php
                            $statusStyle = $timeline->status == 'completed'
                                ? 'bg-emerald-50 text-emerald-600 border-emerald-100'
                                : 'bg-amber-50 text-amber-600 border-amber-100';
                        @endphp
                        <span class="px-4 py-1.5 {{ $statusStyle }} text-[9px] font-black uppercase rounded-lg tracking-widest border">
                            {{ str_replace('_', ' ', $timeline->status) }}
                        </span>
                    </div>

                    <h2 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-tight mb-4">
                        {{ $timeline->title }}
                    </h2>
                    <p class="text-slate-500 text-sm font-medium leading-relaxed mb-8">
                        {{ $timeline->description ?? 'Deskripsi project ini belum ditambahkan oleh Direktur.' }}
                    </p>

                    <div class="bg-slate-50 p-6 rounded-[2rem] border border-slate-100">
                        <div class="flex justify-between items-end mb-3">
                            <span class="text-[9px] font-black text-[#064e3b] uppercase tracking-widest">Capaian Lembaga</span>
                            <span class="text-2xl font-black text-lime-500">{{ $timeline->progress_percentage }}%</span>
                        </div>
                        <div class="w-full h-3 bg-white rounded-full overflow-hidden p-0.5 border border-slate-100">
                            <div class="h-full bg-gradient-to-r from-lime-400 to-[#064e3b] rounded-full transition-all duration-1000"
                                 style="width: {{ $timeline->progress_percentage }}%"></div>
                        </div>
                        <div class="mt-4 flex justify-between items-center text-[9px] font-black text-slate-400 uppercase tracking-tighter">
                            <span>Mulai: {{ $timeline->start_date->format('d M Y') }}</span>
                            <span class="text-red-500 italic">Target: {{ $timeline->end_date->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="lg:w-2/3 lg:pl-12 lg:border-l border-slate-100">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Agenda & Tahapan Strategis</h3>
                        <span class="text-[9px] font-bold text-slate-300 italic">{{ $timeline->stages->count() }} Tahapan Terdaftar</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($timeline->stages->sortBy('order') as $stage)
                        <div class="group/stage flex items-center gap-4 p-5 rounded-[1.5rem] transition-all duration-300 {{ $stage->is_completed ? 'bg-emerald-50 border border-emerald-100' : 'bg-slate-50/50 border border-transparent hover:border-slate-200' }}">
                            <div class="flex-shrink-0">
                                @if($stage->is_completed)
                                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-100">
                                        <i class="fas fa-check text-xs"></i>
                                    </div>
                                @else
                                    <div class="w-10 h-10 bg-white border-2 border-slate-100 text-slate-300 rounded-2xl flex items-center justify-center font-black text-xs group-hover/stage:text-[#064e3b] transition-colors">
                                        {{ $loop->iteration }}
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <h4 class="text-xs font-black text-[#064e3b] uppercase leading-tight mb-1 {{ $stage->is_completed ? 'line-through opacity-50' : '' }}">
                                    {{ $stage->stage_name }}
                                </h4>
                                <div class="flex items-center gap-2">
                                    <i class="far fa-clock text-[8px] text-slate-400"></i>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">
                                        {{ $stage->start_date->format('d M') }} — {{ $stage->end_date->format('d M') }}
                                    </p>
                                </div>
                            </div>

                            @if($stage->is_completed)
                                <div class="text-emerald-500">
                                    <i class="fas fa-medal text-sm"></i>
                                </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-10 flex justify-end">
                        <a href="{{ route('timeline.show', $timeline->id) }}" class="inline-flex items-center gap-3 px-8 py-4 bg-[#064e3b] text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-lime-500 hover:text-[#064e3b] transition-all shadow-xl shadow-slate-200">
                            Review Progress Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="absolute -bottom-10 -right-10 text-[#064e3b] opacity-[0.02] pointer-events-none group-hover:scale-110 transition-transform duration-700">
                <i class="fas fa-project-diagram text-[15rem]"></i>
            </div>
        </div>
        @empty
        <div class="py-32 text-center bg-white rounded-[4rem] border-2 border-dashed border-slate-100">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-200">
                <i class="fas fa-map-signs text-3xl"></i>
            </div>
            <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter">Belum Ada Rencana Besar</h3>
            <p class="text-slate-400 text-sm mt-2">Yayasan sedang menyusun langkah strategis berikutnya.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
