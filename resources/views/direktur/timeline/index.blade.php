@extends('direktur.layouts.app')

@section('content')
<div class="p-8 bg-[#FDFDFB] min-h-screen">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-4xl font-black text-[#064e3b] uppercase tracking-tighter">
                Master <span class="text-lime-500 italic font-serif">Timeline</span>
            </h1>
            <p class="text-slate-500 text-sm">Monitoring alur kerja besar dan pencapaian termin lembaga.</p>
        </div>
        <button onclick="toggleModal('modal-timeline')" class="bg-[#064e3b] hover:bg-lime-500 hover:text-[#064e3b] text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all shadow-lg flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
            Buat Timeline Baru
        </button>
    </div>

    <div class="grid grid-cols-1 gap-8">
        @forelse($timelines as $timeline)
        <div class="bg-white rounded-[3rem] p-8 shadow-sm border border-slate-100 group hover:shadow-xl transition-all duration-500">
            <div class="flex flex-col lg:flex-row gap-8">

                <div class="lg:w-1/3">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-4 py-1 bg-slate-100 text-[#064e3b] text-[9px] font-black uppercase rounded-full tracking-widest">
                            {{ $timeline->category ?? 'General Project' }}
                        </span>
                        <span class="px-4 py-1 {{ $timeline->status == 'completed' ? 'bg-lime-100 text-lime-700' : 'bg-amber-100 text-amber-700' }} text-[9px] font-black uppercase rounded-full tracking-widest">
                            {{ str_replace('_', ' ', $timeline->status) }}
                        </span>
                    </div>
                    <h2 class="text-2xl font-black text-[#064e3b] uppercase leading-tight mb-2">{{ $timeline->title }}</h2>
                    <p class="text-slate-400 text-xs italic mb-6">{{ $timeline->description }}</p>

                    <div class="mb-2 flex justify-between items-end">
                        <span class="text-[10px] font-black text-[#064e3b] uppercase">Overall Progress</span>
                        <span class="text-xl font-black text-lime-500">{{ $timeline->progress_percentage }}%</span>
                    </div>
                    <div class="w-full h-4 bg-slate-100 rounded-full overflow-hidden p-1">
                        <div class="h-full bg-[#064e3b] rounded-full transition-all duration-1000" style="width: {{ $timeline->progress_percentage }}%"></div>
                    </div>
                    <p class="text-[9px] text-slate-400 mt-2 uppercase font-bold tracking-tighter">
                        Periode: {{ $timeline->start_date->format('d M') }} - {{ $timeline->end_date->format('d M Y') }}
                    </p>
                </div>

                <div class="lg:w-2/3 border-l border-slate-50 lg:pl-8">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Termin & Tahapan Pelaksanaan</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($timeline->stages as $stage)
                        <div class="flex items-center gap-4 p-4 rounded-2xl {{ $stage->is_completed ? 'bg-lime-50 border border-lime-100' : 'bg-slate-50' }}">
                            <div class="flex-shrink-0">
                                @if($stage->is_completed)
                                    <div class="w-8 h-8 bg-lime-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-lime-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                @else
                                    <div class="w-8 h-8 bg-white border-2 border-slate-200 text-slate-300 rounded-full flex items-center justify-center font-black text-xs">
                                        {{ $loop->iteration }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="text-xs font-black text-[#064e3b] uppercase leading-none mb-1">{{ $stage->stage_name }}</h4>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">
                                    {{ $stage->start_date->format('d M') }} - {{ $stage->end_date->format('d M') }}
                                </p>
                            </div>

                            <form action="{{ route('direktur.timeline.stage.update', $stage->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="is_completed" value="{{ $stage->is_completed ? 0 : 1 }}">
                                <button type="submit" class="p-2 {{ $stage->is_completed ? 'text-lime-600' : 'text-slate-300 hover:text-[#064e3b]' }} transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="mt-8 pt-6 border-t border-slate-50 flex justify-between items-center">
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full bg-lime-100 border-2 border-white flex items-center justify-center text-[10px] font-black text-lime-700">PIK</div>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('direktur.timeline.show', $timeline->id) }}" class="text-[10px] font-black uppercase text-slate-400 hover:text-[#064e3b] tracking-widest transition-colors">Lihat Detail Laporan</a>
                    <form action="{{ route('direktur.timeline.destroy', $timeline->id) }}" method="POST" onsubmit="return confirm('Hapus seluruh project ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-[10px] font-black uppercase text-red-400 hover:text-red-600 tracking-widest transition-colors">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-[3rem] p-20 text-center border-2 border-dashed border-slate-100">
            <p class="text-slate-400 italic">Belum ada timeline besar yang direncanakan.</p>
        </div>
        @endforelse
    </div>
</div>

<div id="modal-timeline" class="fixed inset-0 z-[99] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-4xl rounded-[3rem] shadow-2xl overflow-y-auto max-h-[90vh] p-10">
        <h2 class="text-2xl font-black text-[#064e3b] uppercase mb-8 italic font-serif">Bentuk <span class="not-italic font-sans text-lime-500">Master Project</span></h2>

        <form action="{{ route('direktur.timeline.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-2">Judul Proyek Besar</label>
                        <input type="text" name="title" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-lime-400 transition-all" placeholder="Contoh: Penerimaan Anggota Baru 2026">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-2">Tgl Mulai Proyek</label>
                            <input type="date" name="start_date" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-2">Tgl Selesai Proyek</label>
                            <input type="date" name="end_date" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm">
                        </div>
                    </div>
                </div>

                <div id="stages-container" class="space-y-4 bg-slate-50 p-6 rounded-[2rem]">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-2">Termin / Tahapan (Minimal 1)</label>
                    <div class="stage-row space-y-2 pb-4 border-b border-slate-200">
                        <input type="text" name="stages[0][stage_name]" placeholder="Nama Termin (e.g. Persiapan)" class="w-full bg-white border-none rounded-xl px-4 py-2 text-xs mb-2">
                        <div class="grid grid-cols-2 gap-2">
                            <input type="date" name="stages[0][start_date]" class="bg-white border-none rounded-xl px-4 py-2 text-[10px]">
                            <input type="date" name="stages[0][end_date]" class="bg-white border-none rounded-xl px-4 py-2 text-[10px]">
                        </div>
                    </div>
                    <p class="text-[9px] text-slate-400 italic">*Direktur bisa menambah termin lebih banyak melalui menu detail nanti.</p>
                </div>
            </div>

            <div class="flex gap-4 pt-4 border-t border-slate-50">
                <button type="button" onclick="toggleModal('modal-timeline')" class="flex-1 py-4 text-slate-400 font-bold uppercase text-[10px] tracking-widest">Batal</button>
                <button type="submit" class="flex-[2] bg-[#064e3b] text-white py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-lg">Simpan Timeline</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
</script>
@endsection
