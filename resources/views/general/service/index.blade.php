@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .service-card {
        background: #ffffff;
        border-radius: 30px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }
    .service-card:hover {
        border-color: #bef264;
        box-shadow: 0 20px 40px -10px rgba(6, 78, 59, 0.05);
    }
    .tab-btn.active {
        background: #064e3b;
        color: #bef264;
        box-shadow: 0 10px 20px rgba(6, 78, 59, 0.2);
    }
    .status-badge-service {
        padding: 6px 14px;
        border-radius: 12px;
        font-size: 8px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
</style>

<div class="min-h-screen bg-[#fafafa] p-6 md:p-12 font-['Plus_Jakarta_Sans']">
    <div class="max-w-6xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div>
                <span class="text-[10px] font-black text-lime-600 uppercase tracking-[0.5em] block mb-2">Internal Service Hub</span>
                <h1 class="text-5xl font-black text-[#064e3b] tracking-tighter uppercase leading-none">
                    Service <span class="italic font-serif text-slate-300">Tickets.</span>
                </h1>
            </div>

            <button onclick="document.getElementById('modal-request').style.display='flex'"
                class="bg-[#064e3b] text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-xl flex items-center gap-3">
                <i class="fas fa-paper-plane text-[10px]"></i> New Request
            </button>
        </div>

        <div class="flex p-2 bg-slate-100 rounded-[2rem] mb-10 w-fit">
            <button onclick="switchTab('inbox')" id="btn-inbox" class="tab-btn active px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2">
                <i class="fas fa-inbox"></i> Inbox Divisi ({{ $incomingRequests->count() }})
            </button>
            <button onclick="switchTab('outbox')" id="btn-outbox" class="tab-btn px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2 text-slate-400">
                <i class="fas fa-paper-plane"></i> Request Saya ({{ $myRequests->count() }})
            </button>
        </div>

        <div id="section-inbox" class="space-y-4">
            @forelse($incomingRequests as $inc)
            <div class="service-card p-6 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div class="w-14 h-14 bg-slate-50 rounded-[20px] flex items-center justify-center text-[#064e3b] border border-slate-100 shrink-0">
                        <i class="fas fa-envelope-open-text text-xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <span class="text-[9px] font-black text-lime-600 uppercase tracking-tighter">{{ $inc->ticket_number }}</span>
                            <span class="text-[8px] font-black text-slate-300 uppercase italic">Dari: {{ $inc->requesterDivision->name }}</span>
                        </div>
                        <h3 class="text-lg font-black text-[#064e3b] uppercase tracking-tight">{{ $inc->title }}</h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">Oleh: {{ $inc->requester->name }} • {{ $inc->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 w-full md:w-auto justify-between md:justify-end">
                    <span class="status-badge-service
                        @if($inc->status == 'pending') bg-orange-100 text-orange-600 @elseif($inc->status == 'approved') bg-blue-100 text-blue-600 @elseif($inc->status == 'in_progress') bg-indigo-100 text-indigo-600 @elseif($inc->status == 'completed') bg-emerald-500 text-white @else bg-red-100 text-red-600 @endif">
                        {{ $inc->status }}
                    </span>

                    @if($inc->status == 'pending' && Auth::user()->role->value == 'kabid')
                        <form action="{{ route('general.service.approve', $inc->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="bg-[#064e3b] text-white px-6 py-3 rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all">Approve</button>
                        </form>
                    @elseif($inc->status == 'approved')
                        <form action="{{ route('general.service.take', $inc->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-black text-[9px] uppercase tracking-widest">Ambil Tugas</button>
                        </form>
                    @elseif($inc->status == 'in_progress' && $inc->handler_id == Auth::id())
                        <button onclick="openSubmitModal('{{ $inc->id }}')" class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-black text-[9px] uppercase tracking-widest">Kirim Hasil</button>
                    @endif
                </div>
            </div>
            @empty
            <p class="py-20 text-center text-slate-400 font-bold uppercase tracking-widest text-xs italic">Belum ada permintaan masuk ke divisi lo.</p>
            @endforelse
        </div>

        <div id="section-outbox" class="hidden space-y-4">
            @forelse($myRequests as $my)
            <div class="service-card p-6 flex flex-col md:flex-row items-center justify-between gap-6 border-l-4 @if($my->status == 'completed') border-l-emerald-500 @else border-l-slate-200 @endif">
                <div class="flex items-center gap-6">
                    <div class="text-center w-12 shrink-0">
                        <p class="text-[10px] font-black text-slate-300 uppercase mb-1">{{ $my->created_at->format('M') }}</p>
                        <p class="text-xl font-black text-[#064e3b] leading-none">{{ $my->created_at->format('d') }}</p>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <span class="text-[9px] font-black text-blue-500 uppercase tracking-tighter">{{ $my->ticket_number }}</span>
                            <span class="text-[8px] font-black text-slate-300 uppercase italic">Tujuan: {{ $my->targetDivision->name }}</span>
                        </div>
                        <h3 class="text-lg font-black text-[#064e3b] uppercase tracking-tight">{{ $my->title }}</h3>
                        @if($my->handler_id)
                            <p class="text-[9px] text-indigo-500 font-black uppercase mt-1">Dikerjakan Oleh: {{ $my->handler->name }}</p>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <span class="status-badge-service @if($my->status == 'completed') bg-emerald-500 text-white @else bg-slate-100 text-slate-500 @endif">
                        {{ $my->status }}
                    </span>
@if($my->status == 'completed' && $my->submission_file)
    <a href="{{ $my->submission_file }}" target="_blank"
       class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center hover:bg-[#064e3b] hover:text-white transition-all shadow-sm"
       title="Buka Link Hasil">
        <i class="fas fa-external-link-alt text-xs"></i>
    </a>
@endif
                </div>
            </div>
            @empty
            <p class="py-20 text-center text-slate-400 font-bold uppercase tracking-widest text-xs italic">Kamu belum pernah ngirim permintaan apapun.</p>
            @endforelse
        </div>
    </div>
</div>

{{-- MODAL REQUEST (Outbox) --}}
<div id="modal-request" style="display:none;" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[99] items-center justify-center p-6">
    <div class="bg-white w-full max-w-xl rounded-[3rem] p-10 overflow-hidden shadow-2xl">
        <h3 class="text-2xl font-black text-[#064e3b] uppercase italic mb-8">Create <span class="text-lime-500">Service Ticket</span></h3>
        <form action="{{ route('general.service.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Divisi Tujuan</label>
                <select name="target_division_id" required class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-[#064e3b]">
                    @foreach($divisions as $div)
                        <option value="{{ $div->id }}">{{ $div->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Subjek Permintaan</label>
                <input type="text" name="title" required placeholder="Contoh: Permintaan Surat Keputusan" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-[#064e3b]">
            </div>
            <div>
                <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Penjelasan</label>
                <textarea name="description" rows="4" required class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-medium text-slate-600"></textarea>
            </div>
            <div class="flex gap-4 pt-6">
                <button type="button" onclick="this.closest('#modal-request').style.display='none'" class="flex-1 text-[10px] font-black uppercase text-slate-400">Batal</button>
                <button type="submit" class="flex-[2] bg-[#064e3b] text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl">Kirim Tiket</button>
            </div>
        </form>
    </div>
</div>
{{-- MODAL SUBMIT WORK (Hanya untuk Handler) --}}
<div id="modal-submit-work" style="display:none;" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[99] items-center justify-center p-6">
    <div class="bg-white w-full max-w-xl rounded-[3rem] p-10 overflow-hidden shadow-2xl border border-slate-100">
        <h3 class="text-2xl font-black text-[#064e3b] uppercase italic mb-8 italic">Submit <span class="text-indigo-500">Completion</span></h3>

        <form id="form-submit-work" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Catatan Hasil Kerja</label>
                <textarea name="submission_notes" rows="4" required placeholder="Jelaskan ringkasan pekerjaan yang telah selesai..."
                    class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-medium text-slate-600 focus:ring-2 focus:ring-indigo-400 outline-none"></textarea>
            </div>

<div>
        <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Tautan Hasil (G-Drive / Link Tautan)</label>
        <input type="url" name="submission_link" required placeholder="https://drive.google.com/..."
            class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-blue-600 focus:ring-2 focus:ring-blue-400 outline-none">
        <p class="text-[8px] text-slate-400 mt-2 ml-2 italic">*Pastikan link dapat diakses oleh pemohon (Public/Shared Link).</p>
    </div>

            <div class="flex gap-4 pt-6">
                <button type="button" onclick="document.getElementById('modal-submit-work').style.display='none'" class="flex-1 text-[10px] font-black uppercase text-slate-400">Batal</button>
                <button type="submit" class="flex-[2] bg-indigo-600 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl hover:bg-black transition-all">
                    Konfirmasi Selesai
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function switchTab(type) {
        const btnInbox = document.getElementById('btn-inbox');
        const btnOutbox = document.getElementById('btn-outbox');
        const secInbox = document.getElementById('section-inbox');
        const secOutbox = document.getElementById('section-outbox');

        if(type === 'inbox') {
            btnInbox.classList.add('active', 'text-lime-400');
            btnInbox.classList.remove('text-slate-400');
            btnOutbox.classList.remove('active', 'text-lime-400');
            btnOutbox.classList.add('text-slate-400');
            secInbox.classList.remove('hidden');
            secOutbox.classList.add('hidden');
        } else {
            btnOutbox.classList.add('active', 'text-lime-400');
            btnOutbox.classList.remove('text-slate-400');
            btnInbox.classList.remove('active', 'text-lime-400');
            btnInbox.classList.add('text-slate-400');
            secOutbox.classList.remove('hidden');
            secInbox.classList.add('hidden');
        }
    }

    function openSubmitModal(requestId) {
        const modal = document.getElementById('modal-submit-work');
        const form = document.getElementById('form-submit-work');

        // Set action form secara dinamis ke route submit lo
        // Pastikan prefix URL-nya sesuai dengan route lo (misal: /service-request/...)
        form.action = `/service-request/${requestId}/submit`;

        modal.style.display = 'flex';
    }

    // Close modal kalau klik di luar area modal
    window.onclick = function(event) {
        const modalRequest = document.getElementById('modal-request');
        const modalSubmit = document.getElementById('modal-submit-work');
        if (event.target == modalRequest) modalRequest.style.display = "none";
        if (event.target == modalSubmit) modalSubmit.style.display = "none";
    }
</script>
@endsection
