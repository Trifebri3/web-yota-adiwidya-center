@extends('omc.layouts.app')

@section('header')
    <h2 class="font-black text-2xl text-[#052c24] leading-tight tracking-tighter uppercase">
        {{ __('Perbarui Publikasi Resmi Node') }}
    </h2>
@endsection

@section('content')
<div class="py-12 bg-slate-50 min-h-screen font-['Plus_Jakarta_Sans']" x-data="{ tab: 'id', bannerPreview: '{{ asset('storage/' . $publication->banner) }}' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Alert Error --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-2xl flex items-center gap-3 animate-pulse">
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <span class="text-xs font-black text-red-700 uppercase tracking-widest">Update Gagal. Periksa inputan di tab ID & EN.</span>
            </div>
        @endif

        <form action="{{ route('omc.update', $publication->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Left Side: Content Editor --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 overflow-hidden border border-slate-100">
                        <div class="flex gap-2 p-2 bg-slate-100/50 border-b border-slate-100">
                            <button type="button" @click="tab = 'id'"
                                :class="tab === 'id' ? 'bg-white text-[#052c24] shadow-sm' : 'text-slate-400'"
                                class="relative px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] transition-all">
                                🇮🇩 Indonesia
                                @if($errors->has('title_id') || $errors->has('content_id'))
                                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
                                @endif
                            </button>
                            <button type="button" @click="tab = 'en'"
                                :class="tab === 'en' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-400'"
                                class="relative px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] transition-all">
                                🇺🇸 English
                                @if($errors->has('title_en') || $errors->has('content_en'))
                                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
                                @endif
                            </button>
                        </div>

                        <div class="p-8 md:p-12">
                            {{-- ID CONTENT --}}
                            <div x-show="tab === 'id'" class="space-y-8 animate-fadeIn">
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3">Judul Publikasi (ID)</label>
                                    <input type="text" name="title_id" value="{{ old('title_id', $publication->title['id']) }}" class="w-full bg-slate-50 border-slate-100 rounded-2xl p-5 text-xl font-black placeholder:text-slate-300 focus:bg-white focus:ring-[#BEF264] transition-all">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3">Ringkasan Deskripsi (ID)</label>
                                    <textarea name="desc_id" rows="3" class="w-full bg-slate-50 border-slate-100 rounded-2xl p-5 text-sm font-medium focus:bg-white">{{ old('desc_id', $publication->description['id']) }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3">Isi Konten (ID)</label>
                                    <div class="rounded-2xl overflow-hidden border border-slate-100 shadow-sm">
                                        <textarea name="content_id" id="editor_id">{{ old('content_id', $publication->content['id']) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- EN CONTENT --}}
                            <div x-show="tab === 'en'" class="space-y-8 animate-fadeIn" x-cloak>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-blue-400 mb-3">Publication Title (EN)</label>
                                    <input type="text" name="title_en" value="{{ old('title_en', $publication->title['en']) }}" class="w-full bg-blue-50/20 border-blue-50 rounded-2xl p-5 text-xl font-black italic focus:bg-white focus:ring-blue-400 transition-all">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-blue-400 mb-3">Short Summary (EN)</label>
                                    <textarea name="desc_en" rows="3" class="w-full bg-blue-50/20 border-blue-50 rounded-2xl p-5 text-sm font-medium italic focus:bg-white">{{ old('desc_en', $publication->description['en']) }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-blue-400 mb-3">Main Content (EN)</label>
                                    <div class="rounded-2xl overflow-hidden border border-blue-50 shadow-sm">
                                        <textarea name="content_en" id="editor_en">{{ old('content_en', $publication->content['en']) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Side: Metadata & Media --}}
                <div class="space-y-8">
                    {{-- Media Card --}}
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                        <h3 class="text-[#052c24] font-black text-[10px] uppercase tracking-[0.3em] mb-8 flex items-center gap-3">
                            <span class="w-2 h-2 bg-[#BEF264] rounded-full"></span> Media Assets
                        </h3>

                        <div class="space-y-8">
                            <div>
                                <label class="block text-[9px] font-black uppercase text-slate-400 mb-4 tracking-widest">Banner Utama</label>
                                <div class="relative group rounded-[2rem] overflow-hidden border-2 border-slate-100 shadow-inner bg-slate-50 h-48 flex items-center justify-center">
                                    <img :src="bannerPreview" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <label for="banner" class="cursor-pointer bg-[#BEF264] text-[#052c24] px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest shadow-2xl">Ubah Banner</label>
                                    </div>
                                    <input type="file" id="banner" name="banner" class="hidden" accept="image/*"
                                        @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { bannerPreview = e.target.result }; reader.readAsDataURL(file) }">
                                </div>
                            </div>

                            <div class="p-6 bg-slate-50 rounded-[2rem] border border-dashed border-slate-200">
                                <label class="block text-[9px] font-black uppercase text-slate-400 mb-3 tracking-widest">Update Dokumen PDF</label>
                                @if($publication->pdf_file)
                                    <div class="flex items-center gap-3 mb-4 p-3 bg-white rounded-xl border border-slate-100">
                                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path></svg>
                                        <span class="text-[9px] font-bold text-slate-500 truncate uppercase tracking-tighter">PDF Tersimpan</span>
                                    </div>
                                @endif
                                <input type="file" name="pdf_file" class="text-[9px] text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[9px] file:font-black file:bg-[#052c24] file:text-[#BEF264] transition-all">
                            </div>
                        </div>
                    </div>

                    {{-- Settings Card --}}
                    <div class="bg-[#052c24] p-10 rounded-[3rem] shadow-2xl shadow-[#052c24]/30 text-white relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#BEF264]/10 rounded-full blur-2xl"></div>

                        <h3 class="text-[#BEF264] font-black text-[10px] uppercase tracking-[0.3em] mb-10">Governance Setting</h3>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-[9px] font-bold text-white/40 uppercase mb-2 tracking-widest">Tipe Publikasi</label>
                            <select name="type" class="w-full bg-slate-50 border-slate-100 rounded-2xl p-4 text-sm font-bold focus:ring-[#BEF264] focus:bg-white transition-all">
                                <option value="berita_resmi">Berita Resmi YOTA</option>
                                <option value="kegiatan_yota">Kegiatan & Program</option>
                                <option value="lingkungan">Lingkungan & Keberlanjutan</option>
                                <option value="bencana">Bencana & Tanggap Darurat</option>
                                <option value="edukasi">Edukasi & Literasi</option>
                                <option value="opini">Opini & Perspektif</option>
                            </select>
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-white/40 uppercase mb-2 tracking-widest">Tanggal Publikasi</label>
                                <input type="date" name="published_at" value="{{ $publication->published_at->format('Y-m-d') }}" class="w-full bg-white/5 border-white/10 rounded-2xl text-sm font-bold text-white focus:ring-[#BEF264]">
                            </div>
                        </div>

                        <div class="mt-12 space-y-4">
                            <button type="submit" class="w-full bg-[#BEF264] hover:bg-white text-[#052c24] py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl transition-all active:scale-95 flex items-center justify-center gap-3 group">
                                <span>Perbarui Data</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                            <a href="{{ route('omc.index') }}" class="block text-center text-[10px] font-black text-white/30 hover:text-red-400 uppercase tracking-[0.2em] transition-all">Batalkan Perubahan</a>
                        </div>
                    </div>

                    {{-- Mascot Trust Badge --}}
                    <div class="text-center">
                        <img src="{{ asset('image/haran-mascot-read.png') }}" class="w-24 h-24 mx-auto opacity-50 grayscale hover:grayscale-0 transition-all duration-700">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- CKEditor 5 Script --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    const editorConfig = {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo' ],
    };

    ClassicEditor.create(document.querySelector('#editor_id'), editorConfig);
    ClassicEditor.create(document.querySelector('#editor_en'), editorConfig);
</script>

<style>
    .ck-editor__editable { min-height: 400px; border-radius: 0 0 2rem 2rem !important; border-color: #f1f5f9 !important; font-family: 'Plus Jakarta Sans', sans-serif; }
    .ck-toolbar { border-radius: 2rem 2rem 0 0 !important; background-color: #f8fafc !important; border-color: #f1f5f9 !important; padding: 10px !important; }
    [x-cloak] { display: none !important; }
    .animate-fadeIn { animation: fadeIn 0.4s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection
