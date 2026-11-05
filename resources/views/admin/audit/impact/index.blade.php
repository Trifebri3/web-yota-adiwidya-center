@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-6">
            <div>
                <span class="text-[10px] font-black text-lime-600 uppercase tracking-[0.6em] block mb-3">Philanthropy Oversight</span>
                <h1 class="text-6xl font-black text-[#064e3b] tracking-tighter uppercase leading-none italic">
                    Impact <span class="text-slate-300">Report.</span>
                </h1>
                <p class="text-xs font-bold text-slate-400 mt-4 max-w-md italic">Audit transparansi dana masyarakat dan realisasi dampak sosial Yayasan Yota.</p>
            </div>

            <div class="flex gap-4 bg-white p-5 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <div class="text-center px-6 border-r border-slate-100">
                    <p class="text-[8px] font-black text-slate-300 uppercase mb-1">Total Dana Terhimpun</p>
                    <p class="text-2xl font-black text-[#064e3b]">Rp{{ number_format($financialStats['total_raised'], 0, ',', '.') }}</p>
                </div>
                <div class="text-center px-6">
                    <p class="text-[8px] font-black text-slate-300 uppercase mb-1">Donatur Terverifikasi</p>
                    <p class="text-2xl font-black text-[#064e3b]">{{ number_format($financialStats['total_donors'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
            @foreach($globalImpacts->take(4) as $impact)
            <div class="bg-[#064e3b] p-8 rounded-[3rem] text-white relative overflow-hidden group hover:scale-105 transition-all">
                <p class="text-[9px] font-black text-lime-400 uppercase tracking-widest mb-4 opacity-70">{{ $impact['label_id'] }}</p>
                <h3 class="text-4xl font-black italic">{{ $impact['value'] }}{{ $impact['symbol'] }}</h3>
                <p class="text-[10px] font-bold opacity-50 mt-2 uppercase tracking-tighter">{{ $impact['sub_id'] }}</p>
                <i class="fas fa-heart absolute -bottom-4 -right-4 text-6xl opacity-10 group-hover:scale-125 transition-transform"></i>
            </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                    <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter mb-8 italic">Active Fundraising Audit</h3>

                    <div class="space-y-10">
                        @foreach($activeCampaigns as $camp)
                        <div class="group">
                            <div class="flex justify-between items-end mb-3">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 overflow-hidden border border-slate-200">
                                        <img src="{{ asset('storage/' . $camp->image) }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-[#064e3b] uppercase tracking-tight">{{ $camp->title['id'] }}</h4>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $camp->donations_count }} Donatur Terlibat</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-black text-[#064e3b] block">{{ $camp->progress_percentage }}%</span>
                                    <span class="text-[8px] font-black text-slate-300 uppercase">Progres</span>
                                </div>
                            </div>
                            <div class="w-full h-2.5 bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                                <div class="h-full bg-lime-400 rounded-full shadow-[0_0_10px_rgba(190,242,100,0.4)]" style="width: {{ $camp->progress_percentage }}%"></div>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-[9px] font-black text-[#064e3b]">Rp{{ number_format($camp->current_amount, 0, ',', '.') }} <span class="text-slate-300 font-bold mx-1">/</span> Rp{{ number_format($camp->target_amount, 0, ',', '.') }}</span>
                                <a href="{{ route('audit.impact.campaign', $camp->slug) }}" class="text-[9px] font-black text-slate-400 uppercase underline hover:text-[#064e3b]">Trace Donations</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white rounded-[3rem] p-8 border border-slate-100 shadow-sm">
                    <h3 class="text-sm font-black text-[#064e3b] uppercase tracking-widest mb-8 border-b border-slate-50 pb-4 flex items-center gap-2">
                        <i class="fas fa-file-contract text-slate-200"></i> Verified Reports
                    </h3>

                    <div class="space-y-6">
                        @foreach($latestReports as $report)
                        <div class="p-4 bg-slate-50 rounded-2xl hover:bg-white border border-transparent hover:border-slate-100 transition-all cursor-pointer">
                            <span class="text-[8px] font-black text-lime-600 uppercase tracking-widest mb-1 block">{{ $report->category }}</span>
                            <h5 class="text-[11px] font-black text-[#064e3b] uppercase leading-tight">{{ $report->title['id'] }}</h5>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-[8px] font-bold text-slate-400 uppercase italic">{{ $report->location }}</span>
                                <a href="{{ route('audit.impact.report', $report->slug) }}" class="w-7 h-7 bg-white rounded-lg flex items-center justify-center text-[#064e3b] shadow-sm border border-slate-100">
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
