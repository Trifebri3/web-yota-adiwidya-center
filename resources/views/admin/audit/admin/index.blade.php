@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                    Admin <span class="text-slate-300">Compliance.</span>
                </h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-3">Audit Proposal, Laporan Bidang & Status Program</p>
            </div>

            <div class="flex items-center gap-4">
                {{-- Tombol Balik ke Dashboard Audit Utama --}}
                <a href="{{ route('audit.index') }}" class="bg-white text-[#064e3b] px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest border border-slate-100 shadow-sm hover:bg-[#064e3b] hover:text-white transition-all flex items-center gap-2">
                    <i class="fas fa-th-large"></i> System Oversight
                </a>

                <div class="bg-white p-5 px-8 rounded-[2rem] border border-slate-100 shadow-sm text-center">
                    <p class="text-[8px] font-black text-slate-300 uppercase mb-1">Total Budget Approved</p>
                    <p class="text-xl font-black text-emerald-600">Rp{{ number_format($proposalStats['total_budget'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 space-y-8">

                {{-- Table Proposal --}}
                <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter">Budgetary Proposals</h3>
                        <span class="px-4 py-1.5 bg-slate-50 rounded-xl text-[9px] font-black text-slate-400 uppercase tracking-widest border border-slate-100">
                            {{ $proposalStats['approved'] }} Approved
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="text-[9px] font-black text-slate-300 uppercase tracking-[0.2em] border-b border-slate-50">
                                <tr>
                                    <th class="pb-4">Proposal Title</th>
                                    <th class="pb-4">Estimated Cost</th>
                                    <th class="pb-4">Status</th>
                                    <th class="pb-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach(\App\Models\Proposal::latest()->take(5)->get() as $prop)
                                <tr class="group">
                                    <td class="py-5">
                                        <span class="text-xs font-black text-[#064e3b] uppercase block">{{ Str::limit($prop->title, 40) }}</span>
                                        <span class="text-[9px] font-bold text-slate-300 uppercase italic">{{ $prop->division->name }}</span>
                                    </td>
                                    <td class="py-5">
                                        <span class="text-xs font-black text-slate-600">{{ $prop->formatted_cost }}</span>
                                    </td>
                                    <td class="py-5">
                                        <span class="px-3 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest {{ $prop->status_color }}">
                                            {{ $prop->status }}
                                        </span>
                                    </td>
                                    <td class="py-5 text-right">
                                        <a href="{{ route('audit.admin.proposal', $prop->id) }}" class="w-8 h-8 rounded-xl bg-slate-50 flex items-center justify-center text-[#064e3b] hover:bg-[#064e3b] hover:text-white transition-all ml-auto shadow-sm">
                                            <i class="fas fa-search-dollar text-[10px]"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Program Publik --}}
                <div class="bg-[#064e3b] rounded-[3rem] p-10 text-white relative overflow-hidden shadow-2xl">
                    <div class="relative z-10">
                        <h3 class="text-xl font-black uppercase italic tracking-tighter mb-8">Public Program Status</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($activePrograms as $prog)
                            <a href="{{ route('audit.admin.program', $prog->id) }}" class="p-6 bg-white/5 rounded-[2rem] border border-white/10 hover:bg-white/10 transition-all group">
                                <span class="px-3 py-1 {{ $prog->status_label['color'] }} text-white rounded-lg text-[7px] font-black uppercase tracking-widest mb-3 inline-block">
                                    {{ $prog->status_label['id_text'] }}
                                </span>
                                <h5 class="text-xs font-black uppercase tracking-tight mb-2 leading-tight group-hover:text-lime-400 transition-colors">{{ $prog->title['id'] ?? $prog->title }}</h5>
                                <p class="text-[9px] font-bold text-lime-400 italic">Remaining: {{ $prog->time_remaining }}</p>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <i class="fas fa-project-diagram absolute -bottom-10 -right-10 text-[15rem] opacity-5"></i>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white rounded-[3rem] p-8 border border-slate-100 shadow-sm">
                    <h3 class="text-sm font-black text-[#064e3b] uppercase tracking-widest mb-8 border-b border-slate-50 pb-4">Compliance Feed</h3>
                    <div class="space-y-8">
                        @foreach($latestReports as $report)
                        <div class="relative pl-6 border-l-2 border-slate-100 group">
                            <div class="absolute -left-[5px] top-0 w-2 h-2 rounded-full bg-slate-200 group-hover:bg-lime-400 transition-all"></div>

                            <span class="text-[8px] font-black text-slate-300 uppercase tracking-widest">{{ $report->report_date->format('d M Y') }}</span>

                            <a href="{{ route('audit.admin.report', $report->id) }}" class="block group mt-1">
                                <h5 class="text-[10px] font-black text-[#064e3b] uppercase group-hover:text-lime-600 transition-colors leading-tight">{{ $report->title }}</h5>
                            </a>

                            <p class="text-[8px] font-bold text-slate-400 italic mt-1">{{ $report->division->name }} • {{ $report->report_type }}</p>

                            {{-- Badge Status Laporan --}}
                            <div class="mt-2">
                                <span class="text-[7px] font-black uppercase px-2 py-0.5 rounded {{ $report->status == 'approved' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                    {{ $report->status }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if($latestReports->isEmpty())
                        <p class="text-center py-10 text-[10px] font-black text-slate-300 uppercase italic">No reports found</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
