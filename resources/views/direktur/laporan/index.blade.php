@extends('direktur.layouts.app')

@section('content')
<div class="min-h-screen bg-[#F4F7F6] p-4 md:p-10" x-data="{
    showReviewModal: false,
    selectedReport: { id: '', title: '', kabid: '', division: '' }
}">
    <div class="max-w-[1600px] mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-[#064e3b] p-8 rounded-[2.5rem] shadow-xl shadow-emerald-900/10">
                <p class="text-[9px] font-black text-emerald-300/50 uppercase tracking-[0.3em] mb-2">Total Submissions</p>
                <h2 class="text-4xl font-black text-white italic">{{ $reports->total() }}</h2>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.3em] mb-2">Waiting Review</p>
                <h2 class="text-4xl font-black text-amber-500 italic">{{ $reports->where('status', 'pending')->count() }}</h2>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.3em] mb-2">Approved</p>
                <h2 class="text-4xl font-black text-lime-500 italic">{{ $reports->where('status', 'approved')->count() }}</h2>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.3em] mb-2">Revisions</p>
                <h2 class="text-4xl font-black text-red-500 italic">{{ $reports->where('status', 'rejected')->count() }}</h2>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6 mb-8">
            <div>
                <h1 class="text-6xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-none">
                    Director's <br><span class="text-lime-500">Inspection.</span>
                </h1>
            </div>

            <form action="{{ route('direktur.laporan.index') }}" method="GET" class="flex flex-wrap gap-4 bg-white p-4 rounded-3xl shadow-sm border border-slate-100">
                <select name="division_id" class="bg-slate-50 border-none rounded-xl text-[10px] font-black uppercase text-[#064e3b] py-3 px-6">
                    <option value="">All Divisions</option>
                    @foreach($divisions as $div)
                        <option value="{{ $div->id }}" {{ request('division_id') == $div->id ? 'selected' : '' }}>{{ $div->name }}</option>
                    @endforeach
                </select>
                <select name="status" class="bg-slate-50 border-none rounded-xl text-[10px] font-black uppercase text-[#064e3b] py-3 px-6">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
                <button type="submit" class="bg-[#064e3b] text-white px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all">Filter</button>
            </form>
        </div>

        <div class="bg-white rounded-[3.5rem] overflow-hidden shadow-sm border border-slate-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-10 py-8 text-[9px] font-black uppercase text-slate-400 tracking-widest">Bidang / Kabid</th>
                        <th class="px-10 py-8 text-[9px] font-black uppercase text-slate-400 tracking-widest">Report Detail</th>
                        <th class="px-10 py-8 text-[9px] font-black uppercase text-slate-400 tracking-widest">Submission Date</th>
                        <th class="px-10 py-8 text-[9px] font-black uppercase text-slate-400 tracking-widest text-center">Status</th>
                        <th class="px-10 py-8 text-[9px] font-black uppercase text-slate-400 tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($reports as $r)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-10 py-8">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-lime-100 text-lime-700 rounded-xl flex items-center justify-center font-black text-xs italic">
                                    {{ substr($r->division->name, 0, 2) }}
                                </div>
                                <div>
                                    <h4 class="font-black text-[#064e3b] text-sm leading-tight">{{ $r->division->name }}</h4>
                                    <p class="text-[10px] font-bold text-slate-400 italic">{{ $r->user->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-8">
                            <h5 class="text-sm font-black text-[#064e3b] uppercase italic mb-1">{{ $r->title }}</h5>
                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest">Category: {{ $r->report_type }}</span>
                        </td>
                        <td class="px-10 py-8">
                            <p class="text-xs font-bold text-slate-500">{{ $r->created_at->format('d M, Y') }}</p>
                            <p class="text-[10px] text-slate-300">{{ $r->created_at->diffForHumans() }}</p>
                        </td>
                        <td class="px-10 py-8 text-center">
                            @if($r->status == 'pending')
                                <span class="px-4 py-2 bg-amber-50 text-amber-600 rounded-full text-[9px] font-black uppercase tracking-widest italic animate-pulse">Waiting Review</span>
                            @elseif($r->status == 'approved')
                                <span class="px-4 py-2 bg-lime-50 text-lime-600 rounded-full text-[9px] font-black uppercase tracking-widest italic">Validated (ACC)</span>
                            @else
                                <span class="px-4 py-2 bg-red-50 text-red-600 rounded-full text-[9px] font-black uppercase tracking-widest italic">Need Revision</span>
                            @endif
                        </td>
                        <td class="px-10 py-8 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ $r->report_link }}" target="_blank" class="p-3 bg-slate-50 text-slate-400 rounded-xl hover:bg-[#064e3b] hover:text-white transition-all shadow-sm" title="Open Link">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                                <button @click="
                                    selectedReport = { id: '{{ $r->id }}', title: '{{ $r->title }}', kabid: '{{ $r->user->name }}', division: '{{ $r->division->name }}' };
                                    showReviewModal = true"
                                    class="p-3 bg-slate-50 text-slate-400 rounded-xl hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-32 text-center">
                            <p class="text-[10px] font-black uppercase tracking-[0.5em] text-slate-300 italic">No reports waiting for inspection</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            {{ $reports->links() }}
        </div>
    </div>

    <div x-show="showReviewModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#064e3b]/95 backdrop-blur-md" x-cloak x-transition>
        <div @click.away="showReviewModal = false" class="bg-white w-full max-w-2xl rounded-[3.5rem] p-12 shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h2 class="text-3xl font-black text-[#064e3b] uppercase italic leading-none">Review <br><span class="text-lime-500">Submission.</span></h2>
                        <p class="text-[10px] font-bold text-slate-400 uppercase mt-2" x-text="`${selectedReport.division} | ${selectedReport.kabid}`"></p>
                    </div>
                    <button @click="showReviewModal = false" class="text-slate-200 hover:text-red-500 transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form :action="`/direktur/laporan/${selectedReport.id}/status`" method="POST" class="space-y-8">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-4">
                        <label class="text-[9px] font-black uppercase tracking-widest text-slate-300 ml-2">Final Decision</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="status" value="approved" class="peer sr-only" required>
                                <div class="p-6 border-2 border-slate-50 rounded-[2rem] text-center font-black uppercase text-[10px] tracking-widest text-slate-300 peer-checked:border-lime-400 peer-checked:text-lime-600 peer-checked:bg-lime-50 transition-all">
                                    ✅ Setujui (ACC)
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="status" value="rejected" class="peer sr-only">
                                <div class="p-6 border-2 border-slate-50 rounded-[2rem] text-center font-black uppercase text-[10px] tracking-widest text-slate-300 peer-checked:border-red-400 peer-checked:text-red-600 peer-checked:bg-red-50 transition-all">
                                    ❌ Revisi (Reject)
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest text-slate-300 ml-2">Executive Feedback / Notes</label>
                        <textarea name="feedback" rows="5" class="w-full bg-slate-50 border-none rounded-[2rem] p-6 text-sm font-medium focus:ring-2 focus:ring-lime-400" placeholder="Berikan evaluasi atau catatan revisi di sini..." required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-[#064e3b] text-white py-5 rounded-2xl font-black uppercase tracking-[0.3em] text-[10px] hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-xl shadow-lime-100">
                        Finalize Review
                    </button>
                </form>
            </div>
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-lime-400 rounded-full blur-[80px] opacity-20"></div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
