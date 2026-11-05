@extends('direktur.layouts.app')

@section('content')
<div class="p-8 bg-[#FDFDFB] min-h-screen">
    <div class="mb-10">
        <a href="{{ route('direktur.timeline.index') }}" class="flex items-center gap-2 text-[#064e3b] font-black text-[10px] uppercase tracking-widest mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-4xl font-black text-[#064e3b] uppercase tracking-tighter">
            Edit <span class="text-lime-500 italic font-serif">Project Timeline</span>
        </h1>
    </div>

    <form action="{{ route('direktur.timeline.update', $timeline->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100 sticky top-8">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Informasi Master</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Nama Proyek</label>
                            <input type="text" name="title" value="{{ old('title', $timeline->title) }}" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-lime-400 transition-all text-sm font-bold text-[#064e3b]">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Status Project</label>
                            <select name="status" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-[#064e3b]">
                                <option value="planned" {{ $timeline->status == 'planned' ? 'selected' : '' }}>Planned</option>
                                <option value="on_progress" {{ $timeline->status == 'on_progress' ? 'selected' : '' }}>On Progress</option>
                                <option value="completed" {{ $timeline->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="delayed" {{ $timeline->status == 'delayed' ? 'selected' : '' }}>Delayed</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Tgl Mulai</label>
                                <input type="date" name="start_date" value="{{ $timeline->start_date->format('Y-m-d') }}" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-xs font-bold text-[#064e3b]">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Tgl Akhir</label>
                                <input type="date" name="end_date" value="{{ $timeline->end_date->format('Y-m-d') }}" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-xs font-bold text-[#064e3b]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-10">
                        <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Modifikasi Termin & Fase</h3>
                        <button type="button" id="add-stage-edit" class="bg-lime-400 hover:bg-[#064e3b] hover:text-white text-[#064e3b] px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all">
                            + Tambah Termin Baru
                        </button>
                    </div>

                    <div id="stages-wrapper-edit" class="space-y-4">
                        @foreach($timeline->stages as $index => $stage)
                        <div class="stage-item bg-slate-50 p-6 rounded-[2rem] relative group border border-transparent hover:border-lime-200 transition-all">
                            <input type="hidden" name="stages[{{ $index }}][id]" value="{{ $stage->id }}">

                            <button type="button" class="remove-stage-existing absolute -right-2 -top-2 bg-red-500 text-white w-6 h-6 rounded-full text-xs font-black opacity-0 group-hover:opacity-100 transition-opacity">×</button>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-4">
                                    <input type="text" name="stages[{{ $index }}][stage_name]" value="{{ $stage->stage_name }}" required class="w-full bg-white border-none rounded-xl px-5 py-3 text-sm font-bold text-[#064e3b]">
                                    <textarea name="stages[{{ $index }}][task_detail]" class="w-full bg-white border-none rounded-xl px-5 py-3 text-xs text-slate-500">{{ $stage->task_detail }}</textarea>
                                </div>
                                <div class="flex flex-col justify-between">
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="date" name="stages[{{ $index }}][start_date]" value="{{ $stage->start_date->format('Y-m-d') }}" required class="bg-white border-none rounded-xl px-4 py-3 text-[10px] font-bold">
                                        <input type="date" name="stages[{{ $index }}][end_date]" value="{{ $stage->end_date->format('Y-m-d') }}" required class="bg-white border-none rounded-xl px-4 py-3 text-[10px] font-bold">
                                    </div>
                                    <div class="mt-4 flex items-center gap-2">
                                        <input type="checkbox" name="stages[{{ $index }}][is_completed]" {{ $stage->is_completed ? 'checked' : '' }} class="rounded border-slate-300 text-lime-500 focus:ring-lime-500">
                                        <label class="text-[10px] font-black uppercase text-slate-400">Tandai Selesai</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-10 pt-8 border-t border-slate-50 flex justify-end gap-4">
                        <button type="button" onclick="window.history.back()" class="px-8 py-5 text-slate-400 font-black text-[10px] uppercase tracking-widest">Batalkan Perubahan</button>
                        <button type="submit" class="bg-[#064e3b] text-white px-12 py-5 rounded-2xl font-black text-[12px] uppercase tracking-[0.2em] shadow-2xl hover:bg-lime-500 hover:text-[#064e3b] transition-all">
                            Perbarui Master Timeline
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    let stageCount = {{ $timeline->stages->count() }};
    const wrapper = document.getElementById('stages-wrapper-edit');
    const addButton = document.getElementById('add-stage-edit');

    // Tambah termin baru di halaman edit
    addButton.addEventListener('click', () => {
        const newStage = document.createElement('div');
        newStage.className = 'stage-item bg-lime-50 p-6 rounded-[2rem] relative group border border-lime-100 animate-fadeIn';
        newStage.innerHTML = `
            <button type="button" class="remove-stage absolute -right-2 -top-2 bg-red-500 text-white w-6 h-6 rounded-full text-xs font-black transition-opacity">×</button>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-4">
                    <input type="text" name="stages[${stageCount}][stage_name]" required placeholder="Nama Termin Baru..." class="w-full bg-white border-none rounded-xl px-5 py-3 text-sm font-bold text-[#064e3b]">
                    <textarea name="stages[${stageCount}][task_detail]" placeholder="Detail tugas..." class="w-full bg-white border-none rounded-xl px-5 py-3 text-xs text-slate-500"></textarea>
                </div>
                <div class="flex flex-col justify-between">
                    <div class="grid grid-cols-2 gap-2">
                        <input type="date" name="stages[${stageCount}][start_date]" required class="bg-white border-none rounded-xl px-4 py-3 text-[10px] font-bold">
                        <input type="date" name="stages[${stageCount}][end_date]" required class="bg-white border-none rounded-xl px-4 py-3 text-[10px] font-bold">
                    </div>
                    <span class="text-[9px] font-black text-lime-600 uppercase mt-2">Termin Baru Tambahan</span>
                </div>
            </div>
        `;
        wrapper.appendChild(newStage);
        stageCount++;

        newStage.querySelector('.remove-stage').addEventListener('click', function() {
            newStage.remove();
        });
    });

    // Handle hapus termin yang sudah ada (existing)
    document.querySelectorAll('.remove-stage-existing').forEach(btn => {
        btn.addEventListener('click', function() {
            if(confirm('Termin ini akan dihapus secara permanen setelah Anda menyimpan. Lanjutkan?')) {
                this.closest('.stage-item').classList.add('hidden');
                // Tambahkan input hidden untuk memberi tahu controller bahwa ini harus dihapus
                const id = this.closest('.stage-item').querySelector('input[type="hidden"]').value;
                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'delete_stages[]';
                deleteInput.value = id;
                document.querySelector('form').appendChild(deleteInput);
            }
        });
    });
</script>

<style>
    @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out forwards; }
</style>
@endsection
