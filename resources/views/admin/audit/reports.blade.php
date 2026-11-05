@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .report-card {
        background: #ffffff;
        border-radius: 35px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }
    .status-indicator-bar {
        height: 8px;
        border-radius: 10px;
        background: #f1f5f9;
        overflow: hidden;
    }
</style>

<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <span class="text-[10px] font-black text-lime-600 uppercase tracking-[0.5em] block mb-3">Institutional Accountability</span>
                <h1 class="text-6xl font-black text-[#064e3b] tracking-tighter uppercase leading-none">
                    Program <span class="italic font-serif text-slate-300">Insights.</span>
                </h1>
            </div>
            <div class="flex gap-3">
                <button onclick="window.print()" class="bg-white text-[#064e3b] px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest border border-slate-100 shadow-sm hover:bg-slate-50 transition-all flex items-center gap-2">
                    <i class="fas fa-print"></i> Export PDF
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            @php
                $approved = $proposals->where('status', 'approved')->count();
                $pending = $proposals->where('status', 'pending')->count();
                $rejected = $proposals->where('status', 'rejected')->count();
                $total = $proposals->count() ?: 1;
            @endphp

            <div class="report-card p-8">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Approval Rate</p>
                <h2 class="text-5xl font-black text-[#064e3b] mb-4">{{ round(($approved / $total) * 100) }}%</h2>
                <div class="status-indicator-bar">
                    <div class="h-full bg-emerald-500" style="width: {{ ($approved / $total) * 100 }}%"></div>
                </div>
            </div>

            <div class="report-card p-8">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Under Review</p>
                <h2 class="text-5xl font-black text-orange-500 mb-4">{{ $pending }}</h2>
                <div class="status-indicator-bar">
                    <div class="h-full bg-orange-400" style="width: {{ ($pending / $total) * 100 }}%"></div>
                </div>
            </div>

            <div class="report-card p-8">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Rejected/Revision</p>
                <h2 class="text-5xl font-black text-slate-300 mb-4">{{ $rejected }}</h2>
                <div class="status-indicator-bar">
                    <div class="h-full bg-slate-200" style="width: {{ ($rejected / $total) * 100 }}%"></div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-10 border-b border-slate-50">
                <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter">Strategic Proposal Tracking</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-10 py-6">ID & Title</th>
                            <th class="px-10 py-6">Division</th>
                            <th class="px-10 py-6">Submission Date</th>
                            <th class="px-10 py-6">Status</th>
                            <th class="px-10 py-6 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($proposals as $prop)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-10 py-6">
                                <span class="text-[9px] font-black text-lime-600 block mb-1">#{{ $prop->id }}</span>
                                <span class="text-sm font-black text-[#064e3b] uppercase tracking-tight">{{ Str::limit($prop->title, 40) }}</span>
                            </td>
                            <td class="px-10 py-6 text-[11px] font-bold text-slate-500 uppercase italic">
                                {{ $prop->division->name ?? 'General' }}
                            </td>
                            <td class="px-10 py-6 text-[11px] font-bold text-slate-400 uppercase">
                                {{ $prop->created_at->format('d M Y') }}
                            </td>
                            <td class="px-10 py-6">
                                <span class="px-4 py-1.5 rounded-lg text-[9px] font-black uppercase
                                    @if($prop->status == 'approved') bg-emerald-100 text-emerald-600
                                    @elseif($prop->status == 'pending') bg-orange-100 text-orange-600
                                    @else bg-slate-100 text-slate-400 @endif">
                                    {{ $prop->status }}
                                </span>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <a href="#" class="text-[#064e3b] hover:text-lime-500 transition-colors">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center text-slate-300 font-bold uppercase tracking-widest text-xs">
                                No proposal data found for this period.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
