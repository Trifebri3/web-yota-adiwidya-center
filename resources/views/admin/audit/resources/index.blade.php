@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                    Resource <span class="text-slate-300">Oversight.</span>
                </h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-3">Perencanaan Strategis & Arsip Digital</p>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('audit.index') }}" class="bg-white text-[#064e3b] px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest border border-slate-100 shadow-sm hover:bg-[#064e3b] hover:text-white transition-all flex items-center gap-2">
                    <i class="fas fa-th-large"></i> System Oversight
                </a>

                <div class="flex gap-4 bg-white p-3 px-6 rounded-3xl border border-slate-100 shadow-sm">
                    <div class="text-center px-4 border-r border-slate-100">
                        <p class="text-[8px] font-black text-slate-300 uppercase">Arsip Digital</p>
                        <p class="text-lg font-black text-[#064e3b]">{{ $archiveStats['total'] }}</p>
                    </div>
                    <div class="text-center px-4">
                        <p class="text-[8px] font-black text-slate-300 uppercase">Timeline Aktif</p>
                        <p class="text-lg font-black text-[#064e3b]">{{ $timelines->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">Master Timeline Progress</h3>
                        <span class="text-[9px] font-black text-slate-200 uppercase tracking-[0.2em]">Live Tracking</span>
                    </div>

                    <div class="space-y-10">
                        @foreach($timelines as $time)
                        <div class="relative group">
                            <div class="flex justify-between items-end mb-3">
                                <div>
                                    <h4 class="text-sm font-black text-[#064e3b] uppercase tracking-tight group-hover:text-lime-600 transition-colors">{{ $time->title }}</h4>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase">{{ $time->start_date->format('M Y') }} - {{ $time->end_date->format('M Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-black text-[#064e3b] block">{{ $time->progress_percentage }}%</span>
                                    <span class="text-[8px] font-black text-slate-300 uppercase italic">Completion</span>
                                </div>
                            </div>
                            <div class="w-full h-3 bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                                <div class="h-full bg-lime-400 rounded-full transition-all duration-1000 shadow-[0_0_10px_rgba(190,242,100,0.5)]" style="width: {{ $time->progress_percentage }}%"></div>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-[8px] font-black text-slate-300 uppercase tracking-widest">
                                    <i class="fas fa-layer-group mr-1"></i> {{ $time->stages->count() }} Tahapan Kerja
                                </span>
                                <a href="{{ route('audit.resources.timeline', $time->id) }}" class="bg-[#064e3b] text-white px-4 py-2 rounded-xl text-[8px] font-black uppercase tracking-widest hover:bg-black transition-all flex items-center gap-2 shadow-lg shadow-emerald-900/10">
                                    Analyze Stages <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-[#064e3b] rounded-[3rem] p-12 text-white relative overflow-hidden shadow-2xl shadow-emerald-900/20">
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-1.5 h-6 bg-lime-400 rounded-full"></div>
                            <h3 class="text-2xl font-black uppercase italic tracking-tighter leading-none">Digital Archive Repository</h3>
                        </div>
                        <p class="text-xs opacity-70 mb-10 max-w-md leading-relaxed">Akses tersentralisasi untuk dokumen legal, sertifikat, dan aset digital. Pastikan transparansi data terjaga.</p>
                        <a href="{{ route('audit.resources.archive') }}" class="inline-flex items-center gap-3 bg-lime-400 text-[#064e3b] px-10 py-4 rounded-[2rem] font-black text-[10px] uppercase tracking-widest hover:scale-105 transition-all shadow-xl shadow-lime-400/20">
                            <i class="fas fa-folder-open"></i> Buka Direktori Arsip
                        </a>
                    </div>
                    <i class="fas fa-archive absolute -bottom-10 -right-10 text-[15rem] opacity-5 rotate-12"></i>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white rounded-[3rem] p-8 border border-slate-100 shadow-sm">
                    <h3 class="text-sm font-black text-[#064e3b] uppercase tracking-widest mb-8 border-b border-slate-50 pb-4 flex items-center gap-2">
                        <i class="fas fa-calendar-day text-slate-200"></i> Upcoming Agendas
                    </h3>

                    <div class="space-y-6">
                        @foreach($globalAgendas as $ga)
                        <div class="flex gap-4 group">
                            <div class="flex-none w-10 h-10 {{ $ga->type_color }} rounded-2xl flex items-center justify-center font-black text-[10px] uppercase shadow-sm group-hover:scale-110 transition-transform">
                                {{ substr($ga->type, 0, 1) }}
                            </div>
                            <div>
                                <h5 class="text-[11px] font-black text-[#064e3b] uppercase leading-tight group-hover:text-lime-600 transition-colors">{{ $ga->title }}</h5>
                                <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase tracking-tighter">{{ $ga->start_time->format('d M, H:i') }}</p>
                            </div>
                        </div>
                        @endforeach

                        <div class="pt-6 border-t border-slate-50">
                            <div class="flex items-center gap-2 mb-6">
                                <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest italic">Division Specific</span>
                                <div class="flex-1 h-[1px] bg-slate-50"></div>
                            </div>

                            @foreach($divisionAgendas as $da)
                            <div class="mb-5 p-4 bg-slate-50/50 rounded-2xl border border-transparent hover:border-slate-100 hover:bg-white transition-all">
                                <h5 class="text-[10px] font-black text-[#064e3b] uppercase mb-1">{{ $da->title }}</h5>
                                <div class="flex justify-between items-center">
                                    <p class="text-[8px] font-bold text-lime-600 uppercase tracking-tighter">{{ $da->division->name }}</p>
                                    <p class="text-[8px] font-black text-slate-300 uppercase">{{ $da->start_time->format('d M') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
