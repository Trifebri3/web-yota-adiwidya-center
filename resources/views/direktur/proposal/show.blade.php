@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .decision-btn {
        padding: 20px 40px;
        border-radius: 20px;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.2em;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .modal-decision {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 999;
        background: rgba(6, 78, 59, 0.4);
        backdrop-filter: blur(10px);
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
</style>

<div class="min-h-screen bg-[#fafafa] p-6 md:p-12 font-['Plus_Jakarta_Sans']">
    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-10">
            <a href="{{ route('direktur.proposal.index') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#064e3b] flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Inbox
            </a>
            <span class="px-5 py-2 rounded-full {{ $proposal->status_color }} text-[9px] font-black uppercase tracking-widest shadow-sm">
                {{ $proposal->status }}
            </span>
        </div>

        <div class="bg-white rounded-[40px] border border-slate-100 shadow-2xl overflow-hidden mb-10">
            <div class="p-10 md:p-20">
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="bg-[#064e3b] text-lime-400 text-[8px] font-black px-4 py-1 rounded-lg uppercase tracking-widest">{{ $proposal->division->name }}</span>
                        <span class="text-[9px] font-bold text-slate-300 uppercase tracking-widest">{{ $proposal->reference_number }}</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none mb-4">
                        {{ $proposal->title }}
                    </h1>
                    <p class="text-slate-400 text-xs font-medium uppercase italic">Dibuat Oleh: <span class="text-[#064e3b] font-black">{{ $proposal->user->name }}</span></p>
                </div>

                <div class="mb-12">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6 flex items-center gap-4">
                        <span class="w-10 h-[1px] bg-slate-200"></span> Substansi Pengajuan
                    </h3>
                    <div class="text-slate-600 font-medium leading-relaxed italic text-lg p-8 bg-slate-50 rounded-[30px] border border-slate-100">
                        {!! nl2br(e($proposal->description)) !!}
                    </div>
                </div>

                @if($proposal->document_url)
                <div class="mb-12">
                    <a href="{{ $proposal->document_url }}" target="_blank" class="flex items-center gap-4 text-[#064e3b] hover:text-lime-600 transition-colors">
                        <div class="w-12 h-12 bg-lime-50 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest underline italic">Buka Dokumen Pendukung</span>
                    </a>
                </div>
                @endif
            </div>

            @if(in_array($proposal->status, ['pending', 'review']))
            <div class="bg-[#064e3b] p-10 flex flex-wrap justify-center gap-6">
                <button onclick="openModal('approve')" class="decision-btn bg-lime-400 text-[#064e3b] hover:bg-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    Setujui
                </button>
                <button onclick="openModal('revise')" class="decision-btn bg-orange-500 text-white hover:bg-orange-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Revisi
                </button>
                <button onclick="openModal('reject')" class="decision-btn bg-red-500 text-white hover:bg-red-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                    Tolak
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

@foreach(['approve' => 'Setujui', 'reject' => 'Tolak', 'revise' => 'Revisi'] as $key => $label)
<div id="modal-{{ $key }}" class="modal-decision">
    <div class="bg-white w-full max-w-md rounded-[40px] p-10 shadow-2xl">
        <h3 class="text-2xl font-black text-[#064e3b] uppercase italic mb-6">Konfirmasi <span class="text-lime-500">{{ $label }}</span></h3>
        <form action="{{ route('direktur.proposal.' . $key, $proposal->id) }}" method="POST">
            @csrf @method('PATCH')
            <div class="mb-8">
                <label class="text-[9px] font-black uppercase text-slate-400 tracking-widest block mb-3 ml-2">Berikan Catatan/Alasan</label>
                <textarea name="notes_from_director" required rows="4" class="w-full bg-slate-50 border-none rounded-2xl p-6 text-sm italic focus:ring-2 focus:ring-lime-400 outline-none" placeholder="Tulis catatan Anda di sini..."></textarea>
            </div>
            <div class="flex gap-4">
                <button type="button" onclick="closeModal('{{ $key }}')" class="flex-1 text-[10px] font-black uppercase text-slate-400">Batal</button>
                <button type="submit" class="flex-[2] py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest text-white {{ $key == 'approve' ? 'bg-[#064e3b]' : 'bg-red-500' }}">Konfirmasi {{ $label }}</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<script>
    function openModal(key) { document.getElementById('modal-' + key).style.display = 'flex'; }
    function closeModal(key) { document.getElementById('modal-' + key).style.display = 'none'; }
    window.onclick = function(event) { if (event.target.className === 'modal-decision') { event.target.style.display = 'none'; } }
</script>
@endsection
