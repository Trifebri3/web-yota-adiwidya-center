@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-end mb-12">
            <div>
                <h1 class="text-4xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                    Performance <span class="text-slate-300">Auditor.</span>
                </h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-3">Monitoring Kedisiplinan & Catatan Evaluasi</p>
            </div>

            {{-- Tombol Kembali ke Dashboard Audit Utama --}}
            <a href="{{ route('audit.index') }}" class="bg-white text-[#064e3b] px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest border border-slate-100 shadow-sm hover:bg-[#064e3b] hover:text-white transition-all flex items-center gap-2">
                <i class="fas fa-th-large"></i> System Oversight
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-4">Total Kehadiran</p>
                <div class="flex items-center gap-4">
                    <span class="text-4xl font-black text-[#064e3b]">{{ $presenceStats['total_hadir'] }}</span>
                    <span class="text-[10px] bg-lime-100 text-lime-600 px-3 py-1 rounded-full font-black">PRESENCE</span>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-4">Pelanggaran Absensi</p>
                <div class="flex items-center gap-4">
                    <span class="text-4xl font-black text-red-500">{{ $presenceStats['total_alpha'] }}</span>
                    <span class="text-[10px] bg-red-100 text-red-600 px-3 py-1 rounded-full font-black animate-pulse">ALPHA</span>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-4">Izin & Sakit</p>
                <div class="flex items-center gap-4">
                    <span class="text-4xl font-black text-amber-500">{{ $presenceStats['total_izin'] }}</span>
                    <span class="text-[10px] bg-amber-100 text-amber-600 px-3 py-1 rounded-full font-black">LEAVE</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
            <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter mb-8 italic">Executive Evaluation Log</h3>

            <div class="space-y-6">
                @foreach($latestEvaluations as $eval)
                <div class="p-6 bg-slate-50 rounded-[2rem] border border-transparent hover:border-slate-200 transition-all group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-[#064e3b] flex items-center justify-center text-white text-[10px] font-black uppercase">
                                {{ substr($eval->author->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-[11px] font-black text-[#064e3b] uppercase tracking-tight">
                                    {{ $eval->author->name }} <span class="text-slate-300 font-bold italic mx-1">reviewed</span> {{ $eval->user->name ?? $eval->division->name }}
                                </p>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">{{ $eval->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        {{-- Tombol Trace Detail untuk User terkait --}}
                        @if($eval->user_id)
                        <a href="{{ route('audit.performance.user', $eval->user_id) }}" class="opacity-0 group-hover:opacity-100 bg-[#064e3b] text-white px-4 py-2 rounded-xl text-[8px] font-black uppercase tracking-widest transition-all flex items-center gap-2 shadow-lg shadow-emerald-900/20">
                            <i class="fas fa-fingerprint"></i> Trace Performance
                        </a>
                        @endif
                    </div>

                    <div class="flex justify-between items-end">
                        <p class="text-xs font-bold text-slate-600 italic leading-relaxed pl-14 max-w-2xl">"{{ $eval->content }}"</p>
                        <span class="px-3 py-1 bg-white rounded-lg text-[8px] font-black text-slate-400 uppercase tracking-widest border border-slate-100">{{ $eval->label }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $latestEvaluations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
