@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .dossier-card { background: #fff; border-radius: 40px; border: 1px solid #f1f5f9; position: relative; overflow: hidden; }
    .status-badge-lg { padding: 8px 20px; border-radius: 15px; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; }
    .amount-box { background: #064e3b; border-radius: 25px; padding: 30px; color: #bef264; }
</style>

<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-5xl mx-auto">

        <div class="flex items-center justify-between mb-12">
            <div class="flex items-center gap-6">
                <a href="{{ route('audit.admin.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#064e3b] shadow-sm hover:bg-lime-400 transition-all border border-slate-100">
                    <i class="fas fa-chevron-left text-xs"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                        Proposal <span class="text-slate-300 font-normal">Audit.</span>
                    </h1>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">Ref: {{ $proposal->reference_number ?? 'BREADCRUMB-UNSET' }}</p>
                </div>
            </div>
            <span class="status-badge-lg {{ $proposal->status_color }}">
                {{ $proposal->status }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-1 space-y-6">
                <div class="amount-box shadow-2xl shadow-emerald-900/20">
                    <p class="text-[9px] font-black uppercase tracking-[0.3em] opacity-60 mb-4">Estimated Budget</p>
                    <h2 class="text-3xl font-black italic">{{ $proposal->formatted_cost }}</h2>
                    <div class="mt-6 pt-6 border-t border-white/10 flex justify-between items-center">
                        <span class="text-[8px] font-black uppercase opacity-50">Currency</span>
                        <span class="text-[10px] font-black uppercase italic">IDR - Indonesian Rupiah</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h4 class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-6">Stakeholders</h4>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-[10px] font-black text-[#064e3b] border border-slate-100">P</div>
                            <div>
                                <p class="text-[11px] font-black text-[#064e3b] uppercase">{{ $proposal->user->name }}</p>
                                <p class="text-[8px] font-bold text-slate-400 uppercase">Proposer ({{ $proposal->division->name }})</p>
                            </div>
                        </div>
                        @if($proposal->reviewer)
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-[10px] font-black text-blue-600 border border-blue-100 italic text-xs">R</div>
                            <div>
                                <p class="text-[11px] font-black text-[#064e3b] uppercase">{{ $proposal->reviewer->name }}</p>
                                <p class="text-[8px] font-bold text-slate-400 uppercase italic">Reviewer Stage</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">
                <div class="dossier-card p-10 shadow-sm">
                    <div class="mb-10 pb-10 border-b border-slate-50">
                        <span class="text-[9px] font-black text-lime-600 uppercase tracking-widest block mb-2">{{ $proposal->category_label }}</span>
                        <h3 class="text-2xl font-black text-[#064e3b] uppercase tracking-tight italic leading-tight">{{ $proposal->title }}</h3>
                    </div>

                    <div class="prose max-w-none">
                        <h4 class="text-xs font-black text-[#064e3b] uppercase tracking-widest mb-4 italic">Executive Summary</h4>
                        <p class="text-sm font-bold text-slate-500 leading-relaxed italic">
                            {{ $proposal->description }}
                        </p>
                    </div>

                    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-6 bg-slate-50 rounded-3xl border border-transparent hover:border-slate-100 transition-all">
                            <h5 class="text-[9px] font-black text-slate-300 uppercase mb-3">Reviewer Notes</h5>
                            <p class="text-[11px] font-bold text-slate-600 italic">"{{ $proposal->notes_from_reviewer ?? 'No specific technical notes.' }}"</p>
                        </div>
                        <div class="p-6 bg-[#064e3b]/5 rounded-3xl border border-[#064e3b]/10 transition-all">
                            <h5 class="text-[9px] font-black text-[#064e3b] uppercase mb-3 italic">Director Decision</h5>
                            <p class="text-[11px] font-black text-[#064e3b] italic">"{{ $proposal->notes_from_director ?? 'Waiting for final approval notes.' }}"</p>
                        </div>
                    </div>

                    @if($proposal->document_url)
                    <div class="mt-12">
                        <a href="{{ $proposal->document_url }}" target="_blank" class="w-full bg-slate-50 border-2 border-dashed border-slate-200 p-8 rounded-[2.5rem] flex flex-col items-center justify-center hover:border-lime-400 group transition-all">
                            <i class="fas fa-file-invoice-dollar text-3xl text-slate-200 group-hover:text-lime-500 mb-3 transition-colors"></i>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Open Detailed Document Archive</span>
                        </a>
                    </div>
                    @endif
                </div>

                <div class="flex justify-between items-center px-10 py-6 bg-slate-50 rounded-[2rem] border border-slate-100 italic">
                    <div class="flex gap-10">
                        <div>
                            <span class="text-[8px] font-black text-slate-300 uppercase block">Reviewed At</span>
                            <span class="text-[10px] font-black text-slate-500">{{ $proposal->reviewed_at ? $proposal->reviewed_at->format('d M Y, H:i') : '-' }}</span>
                        </div>
                        <div>
                            <span class="text-[8px] font-black text-slate-300 uppercase block">Approved At</span>
                            <span class="text-[10px] font-black text-slate-500">{{ $proposal->approved_at ? $proposal->approved_at->format('d M Y, H:i') : '-' }}</span>
                        </div>
                    </div>
                    <i class="fas fa-stamp text-slate-100 text-4xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
