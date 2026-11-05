@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .trace-card { background: #fff; border-radius: 35px; border: 1px solid #f1f5f9; padding: 35px; }
    .presence-circle { width: 12px; height: 12px; border-radius: 50%; }
    .timeline-dot { position: absolute; left: -6px; top: 0; width: 12px; height: 12px; border-radius: 50%; background: #064e3b; border: 3px solid #fff; }
    .timeline-line { position: absolute; left: -1px; top: 0; bottom: 0; width: 2px; background: #f1f5f9; }
</style>

<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-6xl mx-auto">

        <div class="flex items-center gap-5 mb-12">
            <a href="{{ route('audit.performance.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#064e3b] shadow-sm hover:bg-lime-400 transition-all border border-slate-100">
                <i class="fas fa-chevron-left text-xs"></i>
            </a>
            <div>
                <h1 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                    Performance <span class="text-slate-300">Trace.</span>
                </h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2 italic">Dossier ID: #TRC-{{ $user->id }}{{ date('Y') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-1 space-y-6">
                <div class="trace-card text-center">
                    <div class="w-28 h-28 bg-[#064e3b] rounded-[35px] flex items-center justify-center text-3xl font-black text-lime-400 mx-auto mb-6 shadow-2xl shadow-emerald-900/20">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <h3 class="text-xl font-black text-[#064e3b] uppercase tracking-tight">{{ $user->name }}</h3>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">{{ $user->division->name ?? 'Lintas Divisi' }}</p>

                    <div class="grid grid-cols-2 gap-3 pt-6 border-t border-slate-50">
                        <div class="p-4 bg-slate-50 rounded-2xl">
                            <p class="text-[8px] font-black text-slate-300 uppercase mb-1">Attendance</p>
                            <p class="text-lg font-black text-[#064e3b]">{{ round(($presences->where('status', 'hadir')->count() / max($presences->count(), 1)) * 100) }}%</p>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-2xl">
                            <p class="text-[8px] font-black text-slate-300 uppercase mb-1">Evaluations</p>
                            <p class="text-lg font-black text-[#064e3b]">{{ $evaluations->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-red-600 rounded-[30px] p-8 text-white relative overflow-hidden shadow-xl">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.3em] mb-3">Oversight Alert</h4>
                    <p class="text-xs font-bold leading-relaxed opacity-90 italic">Status ALPHA akan otomatis tercatat jika pengurus tidak melakukan konfirmasi kehadiran hingga waktu agenda dimulai.</p>
                    <i class="fas fa-exclamation-triangle absolute -bottom-4 -right-4 text-7xl opacity-10"></i>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8" x-data="{ view: 'attendance' }">

                <div class="flex p-2 bg-white rounded-3xl border border-slate-100 shadow-sm w-fit">
                    <button @click="view = 'attendance'" :class="view === 'attendance' ? 'bg-[#064e3b] text-white' : 'text-slate-400'" class="px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all">Attendance Log</button>
                    <button @click="view = 'evaluations'" :class="view === 'evaluations' ? 'bg-[#064e3b] text-white' : 'text-slate-400'" class="px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all">Evaluation Notes</button>
                </div>

                <div x-show="view === 'attendance'" x-transition class="space-y-4">
                    @forelse($presences as $p)
                        @php $label = $p->status_label; @endphp
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 flex items-center justify-between group hover:shadow-md transition-all">
                            <div class="flex items-center gap-6">
                                <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-xl">
                                    {{ $label['icon'] }}
                                </div>
                                <div>
                                    <h5 class="text-sm font-black text-[#064e3b] uppercase tracking-tight">{{ $p->agenda->title }}</h5>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase mt-1">{{ $p->agenda->start_time->format('d M Y • H:i') }}</p>
                                </div>
                            </div>
                            <span class="px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest {{ $label['class'] }}">
                                {{ $label['text'] }}
                            </span>
                        </div>
                    @empty
                        <p class="text-center py-10 text-[10px] font-black text-slate-300 uppercase italic">Belum ada riwayat absensi.</p>
                    @endforelse
                </div>

                <div x-show="view === 'evaluations'" x-transition class="relative pl-8 space-y-10">
                    <div class="timeline-line"></div>
                    @forelse($evaluations as $e)
                        <div class="relative">
                            <div class="timeline-dot"></div>
                            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <p class="text-[8px] font-black text-lime-600 uppercase tracking-[0.2em] mb-1 italic">Note by {{ $e->author->name }}</p>
                                        <h5 class="text-sm font-black text-[#064e3b] uppercase leading-tight">{{ $e->title }}</h5>
                                    </div>
                                    <span class="text-[9px] font-bold text-slate-300 uppercase italic">{{ $e->created_at->format('M Y') }}</span>
                                </div>
                                <p class="text-xs font-bold text-slate-500 italic leading-relaxed border-l-4 border-slate-100 pl-4">"{{ $e->content }}"</p>
                                <div class="mt-4 flex gap-2">
                                    <span class="text-[8px] font-black bg-slate-100 px-3 py-1 rounded-md text-slate-400 uppercase tracking-widest">{{ $e->label }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center py-10 text-[10px] font-black text-slate-300 uppercase italic">Belum ada catatan evaluasi.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
