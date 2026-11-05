@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .yota-proposal-card {
        background: #ffffff;
        border-radius: 30px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #f1f5f9;
    }
    .yota-proposal-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px -12px rgba(6, 78, 59, 0.08);
        border-color: #bef264;
    }
    .status-badge {
        padding: 6px 16px;
        border-radius: 12px;
        text-transform: uppercase;
        font-size: 9px;
        font-weight: 900;
        letter-spacing: 0.1em;
    }
    .btn-action-yota {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        transition: all 0.3s ease;
    }
    /* Hide scrollbar for clean look */
    .no-scrollbar::-webkit-scrollbar { display: none; }
</style>

<div class="min-h-screen bg-[#fafafa] p-6 md:p-12 font-['Plus_Jakarta_Sans'] no-scrollbar">
    <div class="max-w-6xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-6">
            <div class="text-center md:text-left">
                <h1 class="text-5xl font-black text-[#064e3b] tracking-tighter uppercase leading-none">
                    Proposal <span class="text-lime-500 italic">Feed</span>
                </h1>
                <p class="text-slate-400 text-[11px] font-bold uppercase tracking-[0.3em] mt-3">Yota Adiwidya Center Submission</p>
            </div>

            <a href="{{ route('kabid.proposal.create') }}"
               class="bg-[#064e3b] text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-xl flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                </svg>
                Buat Pengajuan
            </a>
        </div>

        <div class="space-y-4">
            @forelse($proposals as $prop)
            <div class="yota-proposal-card p-6 flex flex-col md:flex-row items-center justify-between gap-6">

                <div class="flex flex-col md:flex-row items-center gap-6 w-full md:w-auto">
                    <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-[#064e3b] shrink-0 border border-slate-100">
                        @switch($prop->category)
                            @case('program') <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg> @break
                            @case('inventory') <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg> @break
                            @default <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        @endswitch
                    </div>

                    <div class="text-center md:text-left">
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-2">
                            <span class="text-[9px] font-black text-lime-600 uppercase tracking-tighter">{{ $prop->reference_number }}</span>
                            <span class="text-[9px] font-bold text-slate-300">•</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $prop->category_label }}</span>
                        </div>
                        <h3 class="text-xl font-black text-[#064e3b] uppercase tracking-tight leading-none mb-2">{{ $prop->title }}</h3>
                        <p class="text-slate-400 text-[10px] font-medium uppercase">Dikirim: {{ $prop->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-6 w-full md:w-auto justify-between md:justify-end border-t md:border-t-0 pt-4 md:pt-0 border-slate-50">
                    <div class="status-badge {{ $prop->status_color }}">
                        {{ $prop->status }}
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('kabid.proposal.show', $prop->id) }}" class="btn-action-yota bg-slate-50 text-[#064e3b] hover:bg-[#064e3b] hover:text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </a>

                        @if(in_array($prop->status, ['pending', 'revised']))
                        <a href="{{ route('kabid.proposal.edit', $prop->id) }}" class="btn-action-yota bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </a>

                        <form action="{{ route('kabid.proposal.destroy', $prop->id) }}" method="POST" onsubmit="return confirm('Tarik pengajuan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action-yota bg-red-50 text-red-500 hover:bg-red-500 hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="py-32 text-center bg-white rounded-[40px] border-2 border-dashed border-slate-100">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-200">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <h3 class="text-xl font-black text-[#064e3b] uppercase tracking-tighter">Belum Ada Pengajuan</h3>
                <p class="text-slate-400 text-sm mt-2">Arsip proposal divisi lo bakal muncul di sini.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $proposals->links() }}
        </div>
    </div>
</div>
@endsection
