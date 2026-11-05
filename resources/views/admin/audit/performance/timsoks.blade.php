@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .timsoks-card {
        background: #fff; border-radius: 40px; border: 1px solid #f1f5f9;
        padding: 40px; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative; overflow: hidden;
    }
    .timsoks-card:hover { transform: translateY(-10px); border-color: #bef264; shadow: 0 25px 50px -12px rgba(6, 78, 59, 0.1); }
    .rank-badge {
        position: absolute; top: 25px; right: 25px;
        width: 45px; height: 45px; border-radius: 15px;
        display: flex; align-items: center; justify-content: center;
        font-weight: 900; font-size: 1.2rem;
    }
    .progress-bar-mini { height: 6px; border-radius: 10px; background: #f1f5f9; overflow: hidden; }
</style>

<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-6">
            <div>
                <span class="text-[10px] font-black text-lime-600 uppercase tracking-[0.6em] block mb-3">Collective Intelligence</span>
                <h1 class="text-6xl font-black text-[#064e3b] tracking-tighter uppercase leading-none italic">
                    TIM<span class="text-slate-300">SOKS.</span>
                </h1>
                <p class="text-xs font-bold text-slate-400 mt-4 max-w-md italic">Analisis efektivitas divisi dan departemen berdasarkan konsistensi kehadiran & kualitas evaluasi sistem.</p>
            </div>

            <div class="flex gap-4">
                <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm text-center min-w-[150px]">
                    <p class="text-[8px] font-black text-slate-300 uppercase mb-1">Top Division</p>
                    <p class="text-sm font-black text-[#064e3b] uppercase italic">{{ $teamPerformance->sortByDesc('presence_rate')->first()['name'] ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($teamPerformance->sortByDesc('presence_rate') as $index => $team)
            <div class="timsoks-card shadow-sm">
                <div class="rank-badge {{ $index == 0 ? 'bg-lime-400 text-[#064e3b]' : 'bg-slate-50 text-slate-300 border border-slate-100' }}">
                    #{{ $index + 1 }}
                </div>

                <div class="mb-10">
                    <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest block mb-1">Divisional Hub</span>
                    <h3 class="text-2xl font-black text-[#064e3b] uppercase tracking-tighter italic">{{ $team['name'] }}</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">
                        <i class="fas fa-users mr-1"></i> {{ $team['member_count'] }} Personnel Active
                    </p>
                </div>

                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">Attendance Rate</span>
                            <span class="text-[10px] font-black text-[#064e3b]">{{ $team['presence_rate'] }} Hits</span>
                        </div>
                        <div class="progress-bar-mini">
                            <div class="h-full bg-[#064e3b] rounded-full" style="width: {{ min(($team['presence_rate'] / 50) * 100, 100) }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">Evaluation Impact</span>
                            <span class="text-[10px] font-black text-[#064e3b]">{{ $team['evaluation_score'] }} Notes</span>
                        </div>
                        <div class="progress-bar-mini">
                            <div class="h-full bg-lime-400 rounded-full" style="width: {{ min(($team['evaluation_score'] / 20) * 100, 100) }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 pt-8 border-t border-slate-50 flex justify-between items-center">
                    <div class="flex -space-x-3">
                        @for($i=0; $i < min($team['member_count'], 4); $i++)
                            <div class="w-8 h-8 rounded-xl border-2 border-white bg-slate-100 flex items-center justify-center text-[8px] font-black text-[#064e3b]">
                                {{ chr(65 + $i) }}
                            </div>
                        @endfor
                        @if($team['member_count'] > 4)
                            <div class="w-8 h-8 rounded-xl border-2 border-white bg-lime-100 flex items-center justify-center text-[8px] font-black text-[#064e3b]">
                                +{{ $team['member_count'] - 4 }}
                            </div>
                        @endif
                    </div>

                    <a href="{{ route('audit.performance.index') }}" class="text-[9px] font-black text-[#064e3b] uppercase tracking-widest border-b-2 border-lime-400 pb-1 hover:text-lime-600 transition-all">
                        Deep Trace <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-20 bg-[#064e3b] p-12 rounded-[3.5rem] text-white relative overflow-hidden shadow-2xl shadow-emerald-900/40">
            <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-3xl font-black uppercase italic tracking-tighter mb-4 italic">Instruction for Board of Oversight</h3>
                    <p class="text-sm font-medium opacity-70 leading-relaxed italic">Gunakan data TIMSOKS untuk menentukan restrukturisasi divisi atau pemberian reward tahunan. Divisi dengan tingkat kehadiran di bawah 40% memerlukan audit tatap muka segera.</p>
                </div>
                <div class="flex justify-end gap-4">
                    <button onclick="window.print()" class="bg-lime-400 text-[#064e3b] px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl hover:scale-105 transition-all">Export Strategic Data</button>
                </div>
            </div>
            <i class="fas fa-chart-pie absolute -bottom-10 -left-10 text-[15rem] opacity-5"></i>
        </div>

    </div>
</div>
@endsection
