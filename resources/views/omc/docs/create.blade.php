@extends('omc.layouts.app')

@section('content')
<div class="bg-white min-h-screen pt-32 pb-20 px-4 font-['Plus_Jakarta_Sans']">
    <div class="max-w-4xl mx-auto">
        <header class="mb-10 text-center md:text-left">
            <a href="{{ route('omc.docs.index') }}" class="text-[10px] font-black uppercase text-slate-400 tracking-widest flex items-center justify-center md:justify-start gap-2 mb-4 group transition-all">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-4xl font-black uppercase tracking-tighter text-[#052c24]">Terbitkan <span class="text-slate-300">Dokumen</span></h1>
        </header>

        <form action="{{ route('omc.docs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-slate-50 p-6 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-sm">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Kategori Dokumen</label>
                    <select name="category" required class="w-full bg-white border-none rounded-2xl px-6 py-4 shadow-sm focus:ring-2 focus:ring-[#BEF264] transition-all">
                        <option value="annual_report">Annual Report</option>
                        <option value="policy_brief">Policy Brief / Research Highlight</option>
                        <option value="official_statement">Pernyataan Resmi Organisasi</option>
                    </select>
                </div>

                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Tanggal Publikasi</label>
                    <input type="date" name="published_at" value="{{ date('Y-m-d') }}" required class="w-full bg-white border-none rounded-2xl px-6 py-4 shadow-sm focus:ring-2 focus:ring-[#BEF264] transition-all">
                </div>
            </div>

            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Judul Dokumen</label>
                <input type="text" name="title" required placeholder="Contoh: Laporan Tahunan Strategis 2025" class="w-full bg-white border-none rounded-2xl px-6 py-4 shadow-sm focus:ring-2 focus:ring-[#BEF264] transition-all">
            </div>

            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block italic">URL Link PDF (Google Drive / S3 / External)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-[#052c24]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </div>
                    <input type="url" name="pdf_path" required placeholder="https://drive.google.com/file/d/..." class="w-full bg-white border-none rounded-2xl pl-14 pr-6 py-4 shadow-sm focus:ring-2 focus:ring-[#BEF264] transition-all font-mono text-sm">
                </div>
                <p class="mt-2 text-[9px] text-slate-400 font-medium tracking-wide">*Pastikan link memiliki akses publik agar bisa diunduh oleh pengunjung.</p>
            </div>

            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Deskripsi Singkat / Ringkasan</label>
                <textarea name="description" rows="5" required placeholder="Berikan ringkasan isi dokumen untuk memudahkan pencarian..." class="w-full bg-white border-none rounded-2xl px-6 py-4 shadow-sm focus:ring-2 focus:ring-[#BEF264] transition-all"></textarea>
            </div>

            <div x-data="{ coverPreview: null }">
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Cover Image (Thumbnail)</label>
                <div class="flex flex-col md:flex-row items-center gap-6 p-6 bg-white rounded-3xl border border-dashed border-slate-200">
                    <template x-if="coverPreview">
                        <img :src="coverPreview" class="w-32 h-44 object-cover rounded-xl shadow-md border-4 border-slate-100">
                    </template>
                    <template x-if="!coverPreview">
                        <div class="w-32 h-44 bg-slate-100 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </template>
                    <div class="flex-grow">
                        <input type="file" name="cover" @change="const file = $event.target.files[0]; if (file) { coverPreview = URL.createObjectURL(file) }" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-[#052c24] file:text-[#BEF264] file:cursor-pointer">
                        <p class="mt-3 text-[9px] text-slate-400">Rekomendasi rasio portrait 3:4, Maks. 2MB (JPG, PNG)</p>
                    </div>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full bg-[#052c24] text-[#BEF264] py-6 rounded-2xl font-black uppercase tracking-[0.3em] shadow-xl hover:bg-[#BEF264] hover:text-[#052c24] hover:scale-[1.01] transition-all flex items-center justify-center gap-3 group">
                    Terbitkan Dokumen Sekarang
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
