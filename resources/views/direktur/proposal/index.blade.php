@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .dir-card-proposal {
        background: #ffffff;
        border-radius: 35px;
        border: 1px solid #f1f5f9;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .dir-card-proposal:hover {
        border-color: #bef264;
        box-shadow: 0 30px 60px -12px rgba(6, 78, 59, 0.12);
    }
    .badge-divisi {
        background: #064e3b;
        color: #bef264;
        padding: 4px 12px;
        border-radius: 10px;
        font-size: 8px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 6px;
    }
</style>

<div class="min-h-screen bg-[#fafafa] p-6 md:p-12 font-['Plus_Jakarta_Sans']">
    <div class="max-w-6xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-6">
            <div class="text-center md:text-left">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.5em] block mb-2">Executive Overview</span>
                <h1 class="text-5xl font-black text-[#064e3b] tracking-tighter uppercase leading-none">
                    Approval <span class="text-lime-500 italic">Inbox</span>
                </h1>
            </div>

            <div class="flex gap-4">
                <div class="bg-white px-6 py-3 rounded-2xl border border-slate-100 shadow-sm text-center">
                    <p class="text-[8px] font-black text-slate-400 uppercase">Perlu Tindakan</p>
                    <p class="text-xl font-black text-orange-500">{{ $proposals->whereIn('status', ['pending', 'review'])->count() }}</p>
                </div>
                <div class="bg-[#064e3b] px-6 py-3 rounded-2xl shadow-lg text-center">
                    <p class="text-[8px] font-black text-lime-400/50 uppercase">Selesai Bulan Ini</p>
                    <p class="text-xl font-black text-white">{{ $proposals->where('status', 'approved')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($proposals as $prop)
            <div class="dir-card-proposal p-8 flex flex-col md:flex-row items-center justify-between gap-6">

                <div class="flex items-center gap-6 w-full md:w-auto">
                    <div class="w-16 h-16 rounded-[22px] bg-slate-50 flex items-center justify-center text-[#064e3b] font-black text-xl border border-slate-100 shrink-0 uppercase">
                        {{ substr($prop->division->name, 0, 2) }}
                    </div>

                    <div class="text-center md:text-left">
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-2">
                            <span class="badge-divisi">{{ $prop->division->name }}</span>
                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest">{{ $prop->reference_number }}</span>
                        </div>
                        <h3 class="text-xl font-black text-[#064e3b] uppercase tracking-tight leading-none mb-2">{{ $prop->title }}</h3>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-tighter">
                            Pengaju: <span class="text-slate-600">{{ $prop->user->name }}</span> • {{ $prop->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-8 w-full md:w-auto justify-between md:justify-end border-t md:border-t-0 pt-6 md:pt-0 border-slate-50">
                    <div class="text-right hidden md:block">
                        <p class="text-[8px] font-black text-slate-300 uppercase mb-1 tracking-widest">Current Status</p>
                        <div class="flex items-center justify-end text-[10px] font-black uppercase {{ $prop->status_color }} bg-transparent p-0">
                             {{ $prop->status }}
                        </div>
                    </div>

                    <a href="{{ route('direktur.proposal.show', $prop->id) }}"
                       class="flex items-center gap-3 bg-[#064e3b] text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-lg group">
                        Review Proposal
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="py-32 text-center bg-white rounded-[40px] border-2 border-dashed border-slate-100">
                <p class="text-slate-400 font-black uppercase tracking-[0.3em] text-xs italic">Inbox Kosong. Belum ada pengajuan masuk.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $proposals->links() }}
        </div>
    </div>
</div>
@endsection
