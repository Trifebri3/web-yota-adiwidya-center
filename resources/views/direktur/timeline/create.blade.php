@extends('direktur.layouts.app')

@section('content')
<div class="p-8 bg-[#FDFDFB] min-h-screen">
    <div class="mb-10">
        <a href="{{ route('direktur.timeline.index') }}" class="flex items-center gap-2 text-[#064e3b] font-black text-[10px] uppercase tracking-widest mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-4xl font-black text-[#064e3b] uppercase tracking-tighter">
            Bentuk <span class="text-lime-500 italic font-serif">Project Baru</span>
        </h1>
    </div>

    <form action="{{ route('direktur.timeline.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Informasi Utama</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Nama Proyek Besar</label>
                            <input type="text" name="title" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-lime-400 transition-all text-sm font-bold text-[#064e3b]" placeholder="e.g. Open Recruitment 2026">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Kategori</label>
                            <select name="category" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-[#064e3b]">
                                <option value="Event">Event</option>
                                <option value="Project">Project</option>
                                <option value="Internal">Internal</option>
                                <option value="Riset">Riset</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Tgl Mulai</label>
                                <input type="date" name="start_date" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-xs font-bold text-[#064e3b]">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Tgl Berakhir</label>
                                <input type="date" name="end_date" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-xs font-bold text-[#064e3b]">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Deskripsi Singkat</label>
                            <textarea name="description" rows="4" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm text-slate-600" placeholder="Jelaskan tujuan timeline ini..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-10">
                        <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penyusunan Termin & Fase</h3>
                        <button type="button" id="add-stage" class="bg-lime-400 hover:bg-[#064e3b] hover:text-white text-[#064e3b] px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all">
                            + Tambah Termin
                        </button>
                    </div>

                    <div id="stages-wrapper" class="space-y-4">
                        <div class="stage-item bg-slate-50 p-6 rounded-[2rem] relative group border border-transparent hover:border-lime-200 transition-all">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-4">
                                    <input type="text" name="stages[0][stage_name]" required placeholder="Nama Termin (e.g. Persiapan Administrasi)" class="w-full bg-white border-none rounded-xl px-5 py-3 text-sm font-bold text-[#064e3b]">
                                    <textarea name="stages[0][task_detail]" placeholder="Detail tugas dalam termin ini..." class="w-full bg-white border-none rounded-xl px-5 py-3 text-xs text-slate-500"></textarea>
                                </div>
                                <div class="flex flex-col justify-between">
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="date" name="stages[0][start_date]" required class="bg-white border-none rounded-xl px-4 py-3 text-[10px] font-bold">
                                        <input type="date" name="stages[0][end_date]" required class="bg-white border-none rounded-xl px-4 py-3 text-[10px] font-bold">
                                    </div>
                                    <p class="text-[9px] text-slate-400 italic mt-2">Pastikan tanggal termin berada dalam rentang tanggal proyek utama.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 pt-8 border-t border-slate-50 flex justify-end">
                        <button type="submit" class="bg-[#064e3b] text-white px-12 py-5 rounded-2xl font-black text-[12px] uppercase tracking-[0.2em] shadow-2xl hover:scale-105 transition-transform">
                            Terbitkan Master Timeline
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    let stageCount = 1;
    const wrapper = document.getElementById('stages-wrapper');
    const addButton = document.getElementById('add-stage');

    addButton.addEventListener('click', () => {
        const newStage = document.createElement('div');
        newStage.className = 'stage-item bg-slate-50 p-6 rounded-[2rem] relative group border border-transparent hover:border-lime-200 transition-all animate-fadeIn';
        newStage.innerHTML = `
            <button type="button" class="remove-stage absolute -right-2 -top-2 bg-red-500 text-white w-6 h-6 rounded-full text-xs font-black opacity-0 group-hover:opacity-100 transition-opacity">×</button>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-4">
                    <input type="text" name="stages[${stageCount}][stage_name]" required placeholder="Nama Termin Selanjutnya..." class="w-full bg-white border-none rounded-xl px-5 py-3 text-sm font-bold text-[#064e3b]">
                    <textarea name="stages[${stageCount}][task_detail]" placeholder="Detail tugas..." class="w-full bg-white border-none rounded-xl px-5 py-3 text-xs text-slate-500"></textarea>
                </div>
                <div class="flex flex-col justify-between">
                    <div class="grid grid-cols-2 gap-2">
                        <input type="date" name="stages[${stageCount}][start_date]" required class="bg-white border-none rounded-xl px-4 py-3 text-[10px] font-bold">
                        <input type="date" name="stages[${stageCount}][end_date]" required class="bg-white border-none rounded-xl px-4 py-3 text-[10px] font-bold">
                    </div>
                </div>
            </div>
        `;
        wrapper.appendChild(newStage);
        stageCount++;

        // Fungsi Hapus Baris
        newStage.querySelector('.remove-stage').addEventListener('click', function() {
            newStage.remove();
        });
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out forwards; }
</style>
@endsection
