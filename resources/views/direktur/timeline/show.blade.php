@extends('direktur.layouts.app')

@section('content')
<div class="p-8 bg-slate-50 min-h-screen">
    <div class="flex items-center justify-between mb-8">
        <a href="{{ route('direktur.timeline.index') }}" class="flex items-center gap-2 text-[#064e3b] font-black text-[10px] uppercase tracking-widest">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Master
        </a>
        <div class="flex gap-2">
            <button class="bg-white border border-slate-200 text-[#064e3b] px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-sm">Cetak Report PDF</button>

            <button onclick="toggleModal('modal-add-stage')" class="bg-[#064e3b] text-white px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg hover:bg-lime-500 hover:text-[#064e3b] transition-all">
                Tambah Termin Baru
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="space-y-6">
            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100">
                <p class="text-[10px] font-black text-lime-600 uppercase tracking-[0.2em] mb-2">Project Stats</p>
                <h2 class="text-2xl font-black text-[#064e3b] uppercase leading-tight mb-6">{{ $timeline->title }}</h2>

                <div class="space-y-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400 font-bold">Total Termin</span>
                        <span class="text-[#064e3b] font-black">{{ $timeline->stages->count() }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400 font-bold">Termin Selesai</span>
                        <span class="text-lime-600 font-black">{{ $timeline->stages->where('is_completed', true)->count() }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400 font-bold">Durasi Total</span>
                        <span class="text-[#064e3b] font-black italic">{{ $timeline->start_date->diffInDays($timeline->end_date) }} Hari</span>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-50">
                    <p class="text-[10px] font-black text-slate-400 uppercase mb-4 tracking-widest text-center">Health Indicator</p>
                    <div class="relative w-32 h-32 mx-auto">
                        <svg class="w-full h-full" viewBox="0 0 36 36">
                            <path class="text-slate-100" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="text-lime-500" stroke-width="3" stroke-dasharray="{{ $timeline->progress_percentage }}, 100" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center font-black text-xl text-[#064e3b]">{{ $timeline->progress_percentage }}%</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100">
                <h3 class="text-sm font-black text-[#064e3b] uppercase tracking-widest mb-10 flex items-center gap-4">
                    Workflow Analysis
                    <span class="h-[1px] flex-1 bg-slate-100"></span>
                </h3>

                <div class="relative pl-8 border-l-2 border-dashed border-slate-100 space-y-12">
                    @foreach($timeline->stages as $stage)
                    <div class="relative">
                        <div class="absolute -left-[41px] top-0 w-5 h-5 rounded-full {{ $stage->is_completed ? 'bg-lime-500 shadow-lg shadow-lime-200' : 'bg-white border-4 border-slate-200' }}"></div>

                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <span class="text-[9px] font-black uppercase {{ $stage->is_overdue ? 'text-red-500' : 'text-slate-400' }} tracking-widest mb-1 block">
                                    {{ $stage->start_date->format('d M') }} — {{ $stage->end_date->format('d M Y') }}
                                    @if($stage->is_overdue) (TERLAMBAT) @endif
                                </span>
                                <h4 class="text-lg font-black text-[#064e3b] uppercase">{{ $stage->stage_name }}</h4>
                                <p class="text-slate-500 text-sm mt-1 italic">{{ $stage->task_detail ?? 'Tidak ada detail tugas tambahan.' }}</p>
                            </div>

                            <div class="flex items-center gap-4">
                                <form action="{{ route('direktur.timeline.stage.update', $stage->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="checkbox" name="is_completed" onchange="this.form.submit()" {{ $stage->is_completed ? 'checked' : '' }} class="w-6 h-6 rounded-lg border-slate-200 text-lime-500 focus:ring-lime-500 cursor-pointer">
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-add-stage" class="fixed inset-0 z-[99] hidden bg-[#064e3b]/40 backdrop-blur-md flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl p-10 animate-fadeIn">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-xl font-black text-[#064e3b] uppercase tracking-tighter">Tambah <span class="text-lime-500 italic font-serif">Termin Baru</span></h2>
            <button onclick="toggleModal('modal-add-stage')" class="text-slate-300 hover:text-red-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('direktur.timeline.addStage', $timeline->id) }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2 tracking-widest">Nama Tahapan/Termin</label>
                <input type="text" name="stage_name" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-[#064e3b] focus:ring-2 focus:ring-lime-400 outline-none" placeholder="Contoh: Evaluasi Tahap 1">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2 tracking-widest">Tgl Mulai</label>
                    <input type="date" name="start_date" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-xs font-bold text-[#064e3b] focus:ring-2 focus:ring-lime-400 outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2 tracking-widest">Tgl Selesai</label>
                    <input type="date" name="end_date" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-xs font-bold text-[#064e3b] focus:ring-2 focus:ring-lime-400 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2 tracking-widest">Detail Tugas (Opsional)</label>
                <textarea name="task_detail" rows="3" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm text-slate-600 focus:ring-2 focus:ring-lime-400 outline-none" placeholder="Apa saja yang harus dilakukan?"></textarea>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-[#064e3b] text-white py-5 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-xl hover:bg-lime-500 hover:text-[#064e3b] transition-all">
                    Simpan Termin
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.toggle('hidden');
        }
    }

    // Menutup modal jika klik di luar area modal (Overlay)
    window.onclick = function(event) {
        const modal = document.getElementById('modal-add-stage');
        if (event.target == modal) {
            modal.classList.add('hidden');
        }
    }
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-fadeIn { animation: fadeIn 0.2s ease-out forwards; }
</style>
@endsection
