@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-5xl mx-auto">

        <div class="flex items-center justify-between mb-12">
            <div class="flex items-center gap-6">
                <a href="{{ route('audit.admin.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#064e3b] shadow-sm hover:bg-lime-400 transition-all border border-slate-100">
                    <i class="fas fa-chevron-left text-xs"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                        Report <span class="text-slate-300 font-normal">Dossier.</span>
                    </h1>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">Log: {{ $report->report_type }} — {{ $report->report_date->format('F Y') }}</p>
                </div>
            </div>
            <span class="px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border {{ $report->status == 'approved' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-amber-50 text-amber-600 border-amber-100' }}">
                {{ $report->status }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h4 class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-6 border-b border-slate-50 pb-4 italic">Submission Info</h4>

                    <div class="space-y-6">
                        <div>
                            <span class="text-[8px] font-black text-slate-300 uppercase block mb-1">Division Unit</span>
                            <p class="text-xs font-black text-[#064e3b] uppercase tracking-tight">{{ $report->division->name }}</p>
                        </div>
                        <div>
                            <span class="text-[8px] font-black text-slate-300 uppercase block mb-1">Reporter</span>
                            <p class="text-xs font-black text-[#064e3b] uppercase tracking-tight">{{ $report->user->name }}</p>
                        </div>
                        <div>
                            <span class="text-[8px] font-black text-slate-300 uppercase block mb-1">Report Period</span>
                            <p class="text-xs font-black text-slate-600 italic">{{ $report->report_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#064e3b] p-8 rounded-[2.5rem] text-white relative overflow-hidden">
                    <h4 class="text-[9px] font-black text-lime-400 uppercase tracking-widest mb-4 italic">Director Feedback</h4>
                    <p class="text-xs font-medium opacity-80 leading-relaxed italic">
                        "{{ $report->feedback ?? 'Belum ada catatan koreksi dari Direktur.' }}"
                    </p>
                    <i class="fas fa-quote-right absolute -bottom-4 -right-4 text-6xl opacity-10"></i>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm">
                    <div class="mb-10 pb-6 border-b border-slate-50">
                        <span class="text-[9px] font-black text-lime-600 uppercase tracking-widest mb-2 block">Subject</span>
                        <h3 class="text-2xl font-black text-[#064e3b] uppercase tracking-tight italic">{{ $report->title }}</h3>
                    </div>

                    <div class="prose max-w-none mb-12">
                        <h4 class="text-xs font-black text-[#064e3b] uppercase tracking-widest mb-4 italic">Report Summary</h4>
                        <p class="text-sm font-bold text-slate-500 leading-relaxed italic">
                            {{ $report->description ?? 'Tidak ada ringkasan deskripsi yang dilampirkan.' }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-10 border-t border-slate-50">
                        @if($report->report_link)
                        <a href="{{ $report->report_link }}" target="_blank" class="p-6 bg-slate-50 rounded-3xl border border-transparent hover:border-lime-400 transition-all flex items-center gap-4 group">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-lime-600 shadow-sm group-hover:bg-lime-600 group-hover:text-white transition-all">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-black text-[#064e3b] uppercase block">Final Report</span>
                                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest italic">Open Document</span>
                            </div>
                        </a>
                        @endif

                        @if($report->instruction_link)
                        <a href="{{ $report->instruction_link }}" target="_blank" class="p-6 bg-slate-50 rounded-3xl border border-transparent hover:border-blue-400 transition-all flex items-center gap-4 group">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-blue-500 shadow-sm group-hover:bg-blue-500 group-hover:text-white transition-all">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-black text-[#064e3b] uppercase block">Instruction</span>
                                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest italic">View Briefing</span>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>

                @if($report->reviewed_at)
                <div class="px-10 py-6 bg-white rounded-[2.5rem] border border-slate-100 flex justify-between items-center italic">
                    <span class="text-[10px] font-black text-slate-300 uppercase">Verification Timestamp</span>
                    <span class="text-[10px] font-black text-[#064e3b] uppercase">{{ $report->reviewed_at->format('d M Y, H:i') }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
