@extends('omc.layouts.app')

@section('content')
<div class="py-12 bg-slate-50 min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Alert Error --}}
        @if ($errors->any())
            <div class="mb-6 p-5 bg-red-50 border-l-4 border-red-500 rounded-2xl flex items-center gap-4 animate-pulse">
                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-black text-red-800 uppercase tracking-widest">Input Gagal</h4>
                    <p class="text-xs text-red-600 font-medium">Mohon lengkapi semua field wajib di tab Indonesia & English.</p>
                </div>
            </div>
        @endif

        <form action="{{ route('omc.store') }}" method="POST" enctype="multipart/form-data" x-data="{ tab: 'id', bannerPreview: null }">
            @csrf

            <div class="bg-white shadow-2xl rounded-[3rem] overflow-hidden border border-slate-100">

                {{-- Header --}}
                <div class="p-10 border-b border-slate-50 bg-white flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-2 h-2 bg-red-500 rounded-full animate-ping"></span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Drafting Mode</span>
                        </div>
                        <h1 class="text-3xl font-black text-[#052c24] uppercase tracking-tighter">Buat Publikasi Baru</h1>
                    </div>
                    <div class="flex items-center gap-3 px-6 py-3 bg-[#BEF264]/20 rounded-2xl border border-[#BEF264]/50">
                        <svg class="w-5 h-5 text-[#052c24]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A11.955 11.955 0 0112 21.75c4.627-1.38 8.006-5.707 8.006-10.824a11.955 11.955 0 01-8.618-3.04z"/></svg>
                        <span class="font-black text-[10px] text-[#052c24] uppercase tracking-widest">Verified PIKP Node</span>
                    </div>
                </div>

                <div class="p-10 space-y-12">

                    {{-- Row 1: Metadata --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-3">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-400">Kategori Publikasi</label>
                            <select name="type" class="w-full bg-slate-50 border-slate-100 rounded-2xl p-4 text-sm font-bold focus:ring-[#BEF264] focus:bg-white transition-all">
                                <option value="berita_resmi">Berita Resmi YOTA</option>
                                <option value="kegiatan_yota">Kegiatan & Program</option>
                                <option value="lingkungan">Lingkungan & Keberlanjutan</option>
                                <option value="bencana">Bencana & Tanggap Darurat</option>
                                <option value="edukasi">Edukasi & Literasi</option>
                                <option value="opini">Opini & Perspektif</option>
                            </select>
                        </div>
                        <div class="space-y-3">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-400">Tanggal Terbit</label>
                            <input type="date" name="published_at" value="{{ date('Y-m-d') }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl p-4 text-sm font-bold focus:ring-[#BEF264] focus:bg-white transition-all">
                        </div>
                    </div>

                    {{-- Row 2: Visual Banner --}}
                    <div class="space-y-4">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-400 block">Banner Utama (Recommended: 16:9)</label>
                        <div class="relative group h-64 bg-slate-50 rounded-[2.5rem] border-2 border-dashed border-slate-200 flex flex-col items-center justify-center transition-all hover:border-lime-400 overflow-hidden">
                            <template x-if="!bannerPreview">
                                <div class="text-center p-10">
                                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Klik atau seret gambar ke sini</p>
                                </div>
                            </template>
                            <template x-if="bannerPreview">
                                <img :src="bannerPreview" class="w-full h-full object-cover">
                            </template>
                            <input type="file" name="banner" accept="image/*" @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { bannerPreview = e.target.result }; reader.readAsDataURL(file) }" class="absolute inset-0 opacity-0 cursor-pointer">

                            <template x-if="bannerPreview">
                                <button type="button" @click="bannerPreview = null" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full shadow-xl">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- Multi Language Tabs --}}
                    <div class="space-y-8">
{{-- Update Tab Language Navigation --}}
<div class="flex gap-2 p-1.5 bg-slate-100 rounded-2xl w-fit">
    <button type="button" @click="tab = 'id'"
        :class="tab === 'id' ? 'bg-white shadow-sm text-[#052c24]' : 'text-slate-400'"
        class="relative px-10 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
        Indonesia
        @if($errors->has('title_id') || $errors->has('content_id'))
            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
        @endif
    </button>

    <button type="button" @click="tab = 'en'"
        :class="tab === 'en' ? 'bg-white shadow-sm text-blue-600' : 'text-slate-400'"
        class="relative px-10 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
        English
        @if($errors->has('title_en') || $errors->has('content_en'))
            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
        @endif
    </button>
</div>

                        {{-- TAB INDONESIA --}}
                        <div x-show="tab === 'id'" class="space-y-8 animate-fadeIn">
                            <div class="space-y-3">
                                <label class="text-xs font-black uppercase tracking-widest text-slate-400">Judul (ID)</label>
                                <input type="text" name="title_id" class="w-full bg-slate-50 border-slate-100 rounded-2xl p-5 text-xl font-black placeholder:text-slate-300 focus:bg-white focus:ring-[#BEF264]" placeholder="Contoh: YOTA Meluncurkan Sistem Deteksi Bencana Berbasis AI">
                            </div>
                            <div class="space-y-3">
                                <label class="text-xs font-black uppercase tracking-widest text-slate-400">Ringkasan Deskripsi (ID)</label>
                                <textarea name="desc_id" rows="3" class="w-full bg-slate-50 border-slate-100 rounded-2xl p-5 text-sm font-medium focus:bg-white"></textarea>
                            </div>
                            <div class="space-y-3">
                                <label class="text-xs font-black uppercase tracking-widest text-slate-400">Konten Utama (ID)</label>
                                <div class="rounded-2xl overflow-hidden border border-slate-100 shadow-sm">
                                    <textarea name="content_id" id="editor_id"></textarea>
                                </div>
                            </div>
                        </div>

                        {{-- TAB ENGLISH --}}
                        <div x-show="tab === 'en'" class="space-y-8 animate-fadeIn">
                            <div class="space-y-3">
                                <label class="text-xs font-black uppercase tracking-widest text-blue-400">Title (EN)</label>
                                <input type="text" name="title_en" class="w-full bg-blue-50/20 border-blue-50 rounded-2xl p-5 text-xl font-black italic focus:bg-white focus:ring-blue-400" placeholder="Example: YOTA Launches AI-Based Disaster Detection System">
                            </div>
                            <div class="space-y-3">
                                <label class="text-xs font-black uppercase tracking-widest text-blue-400">Short Description (EN)</label>
                                <textarea name="desc_en" rows="3" class="w-full bg-blue-50/20 border-blue-50 rounded-2xl p-5 text-sm font-medium italic focus:bg-white"></textarea>
                            </div>
                            <div class="space-y-3">
                                <label class="text-xs font-black uppercase tracking-widest text-blue-400">Main Content (EN)</label>
                                <div class="rounded-2xl overflow-hidden border border-blue-50 shadow-sm">
                                    <textarea name="content_en" id="editor_en"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Attachment --}}
                    <div class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2h-6a2 2 0 01-2-2v-2"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-black text-slate-700 uppercase tracking-widest">Lampiran PDF (Optional)</h4>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em]">Dokumen resmi atau laporan lengkap</p>
                            </div>
                        </div>
                        <input type="file" name="pdf_file" accept=".pdf" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#052c24] file:text-[#BEF264] cursor-pointer">
                    </div>
                </div>

                {{-- Action Footer --}}
                <div class="p-10 bg-slate-50 border-t border-slate-100 flex justify-between items-center">
                    <a href="{{ route('omc.index') }}" class="text-xs font-black uppercase tracking-widest text-slate-400 hover:text-red-500 transition">Batal</a>
                    <button type="submit" class="group bg-[#052c24] text-[#BEF264] px-12 py-5 rounded-[2rem] font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-[#052c24]/20 hover:scale-105 transition-all flex items-center gap-4">
                        <span>Konfirmasi & Terbitkan</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Menghilangkan border focus yang mengganggu di CKEditor */
    .cke_chrome { border: none !important; box-shadow: none !important; }
    .animate-fadeIn { animation: fadeIn 0.4s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>

{{-- Pastikan CKEditor dimuat --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    const editorConfig = {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo' ],
        placeholder: 'Tuliskan narasi publikasi di sini...'
    };

    // Inisialisasi Editor Indonesia
    ClassicEditor
        .create(document.querySelector('#editor_id'), editorConfig)
        .catch(error => { console.error(error); });

    // Inisialisasi Editor English
    ClassicEditor
        .create(document.querySelector('#editor_en'), editorConfig)
        .catch(error => { console.error(error); });
</script>

<style>
    /* Menyesuaikan tampilan CKEditor 5 agar tetap Luxury */
    .ck-editor__editable {
        min-height: 300px;
        border-radius: 0 0 1.5rem 1.5rem !important;
        border-color: #f1f5f9 !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .ck-toolbar {
        border-radius: 1.5rem 1.5rem 0 0 !important;
        background-color: #f8fafc !important;
        border-color: #f1f5f9 !important;
    }
</style>
@endsection
