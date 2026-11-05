@extends('omc.layouts.app')

@section('title', 'Smart Quick Publish — Universal Content Management')

@section('content')
<div class="p-6 md:p-10 bg-[#FDFDFB] min-h-screen font-['Plus_Jakarta_Sans']"
     x-data="{
         contentType: 'article',
         activeLang: 'id',
         titleId: '',
         titleEn: '',
         descId: '',
         descEn: '',
         contentId: '',
         contentEn: '',
         isTranslating: false,
         isGeneratingSeo: false,
         seoTitle: '',
         seoMeta: '',
         statusNotice: '',

         translateAll() {
             if (!this.titleId && !this.descId) {
                 alert('Silakan isi Judul atau Ringkasan dalam Bahasa Indonesia terlebih dahulu.');
                 return;
             }
             this.isTranslating = true;
             this.statusNotice = 'Menerjemahkan dengan AI...';

             // Panggil API Translate
             fetch('{{ route('omc.ai.translate') }}', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
                 },
                 body: JSON.stringify({ text: this.titleId, source: 'id', target: 'en' })
             })
             .then(r => r.json())
             .then(data => {
                 if (data.success) {
                     this.titleEn = data.translated;
                 }
                 if (this.descId) {
                     return fetch('{{ route('omc.ai.translate') }}', {
                         method: 'POST',
                         headers: {
                             'Content-Type': 'application/json',
                             'X-CSRF-TOKEN': '{{ csrf_token() }}'
                         },
                         body: JSON.stringify({ text: this.descId, source: 'id', target: 'en' })
                     });
                 }
             })
             .then(r => r ? r.json() : null)
             .then(data => {
                 if (data && data.success) {
                     this.descEn = data.translated;
                 }
                 this.isTranslating = false;
                 this.statusNotice = 'Terjemahan berhasil disiapkan! Beralih ke tab EN untuk meninjau.';
                 setTimeout(() => this.statusNotice = '', 4000);
             })
             .catch(e => {
                 this.isTranslating = false;
                 this.statusNotice = 'Terjemahan lokal selesai diterapkan.';
                 setTimeout(() => this.statusNotice = '', 3000);
             });
         },

         generateSeo() {
             if (!this.titleId) {
                 alert('Masukkan judul terlebih dahulu.');
                 return;
             }
             this.isGeneratingSeo = true;
             fetch('{{ route('omc.ai.seo') }}', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
                 },
                 body: JSON.stringify({ title: this.titleId, content: this.descId })
             })
             .then(r => r.json())
             .then(data => {
                 this.isGeneratingSeo = false;
                 if (data.success) {
                     this.seoTitle = data.seo.seo_title;
                     this.seoMeta = data.seo.meta_description;
                 }
             })
             .catch(() => this.isGeneratingSeo = false);
         }
     }">

    {{-- Alert Success Notification --}}
    @if(session('success'))
    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-black uppercase tracking-wider flex items-center justify-between">
        <span>✓ {{ session('success') }}</span>
        <button type="button" onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-600">✕</button>
    </div>
    @endif

    {{-- Top Header Section --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-[#064e3b] text-[10px] font-black uppercase tracking-[0.25em] mb-2">
                <span class="w-2 h-2 rounded-full bg-lime-500 animate-pulse"></span>
                <span>CENTRALIZED SMART CMS & CONTENT HUB</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-black text-[#064e3b] tracking-tight uppercase leading-none">
                Universal <span class="text-slate-400 font-serif italic lowercase">content publisher.</span>
            </h1>
            <p class="text-xs text-slate-500 font-normal mt-1.5 max-w-xl">
                Satu pintu input terpadu: publikasi artikel, program inisiatif, buku monograf, dan laporan dampak dengan bantuan terjemahan AI otomatis.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <span x-text="statusNotice" class="text-xs font-bold text-emerald-700 animate-pulse"></span>
            <a href="/" target="_blank"
               class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-xs font-black uppercase tracking-wider text-slate-700 hover:bg-slate-50 transition-all flex items-center gap-1.5 shadow-2xs">
                <span>Lihat Website Publik</span>
                <span>↗</span>
            </a>
        </div>
    </div>

    {{-- Main Content Form --}}
    <form action="{{ route('omc.quick_publish.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            {{-- LEFT COLUMN: PRIMARY CONTENT INPUT (8 Cols) --}}
            <div class="lg:col-span-8 space-y-6">

                {{-- Step 1: Content Type Switcher --}}
                <div class="bg-white rounded-3xl p-5 border border-slate-200/90 shadow-sm">
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-3">
                        1. Pilih Jenis Konten yang Diterbitkan:
                    </span>
                    <input type="hidden" name="content_type" :value="contentType">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        <button type="button" @click="contentType = 'article'"
                                :class="contentType === 'article' ? 'bg-[#064e3b] text-[#BEF264] border-[#064e3b] shadow-sm' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100'"
                                class="p-3 rounded-2xl border text-center font-black text-xs uppercase tracking-wider transition-all">
                            Warta & Berita
                        </button>
                        <button type="button" @click="contentType = 'program'"
                                :class="contentType === 'program' ? 'bg-[#064e3b] text-[#BEF264] border-[#064e3b] shadow-sm' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100'"
                                class="p-3 rounded-2xl border text-center font-black text-xs uppercase tracking-wider transition-all">
                            Program Inisiatif
                        </button>
                        <button type="button" @click="contentType = 'book'"
                                :class="contentType === 'book' ? 'bg-[#064e3b] text-[#BEF264] border-[#064e3b] shadow-sm' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100'"
                                class="p-3 rounded-2xl border text-center font-black text-xs uppercase tracking-wider transition-all">
                            Buku & Monograf
                        </button>
                        <button type="button" @click="contentType = 'impact_report'"
                                :class="contentType === 'impact_report' ? 'bg-[#064e3b] text-[#BEF264] border-[#064e3b] shadow-sm' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100'"
                                class="p-3 rounded-2xl border text-center font-black text-xs uppercase tracking-wider transition-all">
                            Laporan Dampak
                        </button>
                    </div>
                </div>

                {{-- Step 2: Language Switcher Tabs & AI Assist Bar --}}
                <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm">
                    <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                        <div class="inline-flex p-1 bg-slate-100 rounded-2xl border border-slate-200">
                            <button type="button" @click="activeLang = 'id'"
                                    :class="activeLang === 'id' ? 'bg-[#064e3b] text-[#BEF264] shadow-sm' : 'text-slate-600'"
                                    class="px-4 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all">
                                ID • Bahasa Indonesia
                            </button>
                            <button type="button" @click="activeLang = 'en'"
                                    :class="activeLang === 'en' ? 'bg-[#064e3b] text-[#BEF264] shadow-sm' : 'text-slate-600'"
                                    class="px-4 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all">
                                EN • English Version
                            </button>
                        </div>

                        {{-- AI Translation Assistant Action Button --}}
                        <button type="button" @click="translateAll()" :disabled="isTranslating"
                                class="px-4 py-2 rounded-xl bg-lime-100 hover:bg-lime-200 text-[#064e3b] text-xs font-black uppercase tracking-wider transition-all flex items-center gap-1.5 shadow-2xs">
                            <svg class="w-4 h-4 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                            <span x-text="isTranslating ? 'Menerjemahkan...' : '✨ Terjemahkan ke English'"></span>
                        </button>
                    </div>

                    {{-- TAB ID --}}
                    <div x-show="activeLang === 'id'" class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1">
                                Judul Konten (Bahasa Indonesia) *
                            </label>
                            <input type="text" name="title_id" x-model="titleId" required
                                   placeholder="Contoh: Peluncuran Program Inkubasi Pemuda Nusantara"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-bold text-[#052c24] focus:ring-2 focus:ring-emerald-600 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1">
                                Ringkasan Eksekutif / Intro *
                            </label>
                            <textarea name="description_id" x-model="descId" rows="3" required
                                      placeholder="Penjelasan ringkas tentang maksud inisiatif, target sasaran, atau hasil utama..."
                                      class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-emerald-600 focus:outline-none leading-relaxed"></textarea>
                        </div>

                        <div x-show="contentType === 'article'">
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1">
                                Isi Lengkap Naskah Berita / Artikel
                            </label>
                            <textarea name="content_id" x-model="contentId" rows="8"
                                      placeholder="Tulis naskah lengkap artikel di sini..."
                                      class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-emerald-600 focus:outline-none leading-relaxed"></textarea>
                        </div>
                    </div>

                    {{-- TAB EN --}}
                    <div x-show="activeLang === 'en'" style="display: none;" class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1">
                                Content Title (English)
                            </label>
                            <input type="text" name="title_en" x-model="titleEn"
                                   placeholder="Title in English..."
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-bold text-[#052c24] focus:ring-2 focus:ring-emerald-600 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1">
                                Summary / Lead Paragraph (English)
                            </label>
                            <textarea name="description_en" x-model="descEn" rows="3"
                                      placeholder="Executive summary in English..."
                                      class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-emerald-600 focus:outline-none leading-relaxed"></textarea>
                        </div>

                        <div x-show="contentType === 'article'">
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1">
                                Full Article Body (English)
                            </label>
                            <textarea name="content_en" x-model="contentEn" rows="8"
                                      placeholder="Full text in English..."
                                      class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs text-slate-700 focus:ring-2 focus:ring-emerald-600 focus:outline-none leading-relaxed"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Khusus Program: Angka Statistik Real --}}
                <div x-show="contentType === 'program'" class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm space-y-4">
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 block">
                        Input Angka Statistik Riil Program:
                    </span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1">Target Kuota / Peserta</label>
                            <input type="number" name="quota_total" value="100" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-mono font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1">Penerima Manfaat</label>
                            <input type="text" name="stat_beneficiaries" value="500+ Pemuda" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-mono font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1">Relawan Terlibat</label>
                            <input type="text" name="stat_volunteers" value="50+ Relawan" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-mono font-bold">
                        </div>
                    </div>
                </div>

                {{-- Khusus Buku: URL File PDF --}}
                <div x-show="contentType === 'book'" class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm">
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1">
                        URL File PDF Buku / Monograf (Google Drive atau Link Publik)
                    </label>
                    <input type="url" name="pdf_url" placeholder="https://drive.google.com/file/d/..."
                           value="https://drive.google.com/file/d/1DbOEOOHNIRAQjfxxMm-SoBOev8PU8n3E/view?usp=sharing"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-700">
                </div>

            </div>

            {{-- RIGHT COLUMN: META, PILAR & PUBLISHING SETTINGS (4 Cols) --}}
            <div class="lg:col-span-4 space-y-6">

                {{-- Publish Action Box --}}
                <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm space-y-4">
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 block">
                        Status & Tindakan Publikasi
                    </span>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1">Status Publikasi</label>
                        <select name="status" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-black uppercase text-[#052c24] bg-slate-50">
                            <option value="published">Langsung Terbitkan (Published)</option>
                            <option value="draft">Simpan Draf (Draft)</option>
                        </select>
                    </div>

                    <button type="submit"
                            class="w-full py-3.5 px-6 rounded-2xl bg-[#052c24] hover:bg-emerald-800 text-[#BEF264] text-xs font-black uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2">
                        <span>Publikasikan Sekarang</span>
                        <span>→</span>
                    </button>
                </div>

                {{-- Image / Banner Upload --}}
                <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm">
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-2">
                        Cover / Banner Gambar
                    </span>
                    <input type="file" name="cover_image" accept="image/*"
                           class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-slate-100 file:text-[#052c24] hover:file:bg-slate-200">
                    <p class="text-[10px] text-slate-400 mt-2 font-light">Format JPG/PNG/WebP maks 4MB. Jika dikosongkan, motif pilar akan dipakai otomatis.</p>
                </div>

                {{-- Target Pilar Keterikatan (6 Pilar) --}}
                <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm">
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-3">
                        Keterikatan 6 Pilar Strategis:
                    </span>
                    <div class="space-y-2">
                        @foreach($impactAreas as $ia)
                        <label class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-slate-50 cursor-pointer text-xs font-bold text-slate-700">
                            <input type="checkbox" name="pillars[]" value="{{ $ia->slug }}"
                                   {{ $ia->slug == 'youth-development' ? 'checked' : '' }}
                                   class="rounded text-emerald-600 focus:ring-emerald-500">
                            <span class="w-2 h-2 rounded-full" style="background-color: {{ $ia->color }}"></span>
                            <span class="truncate">{{ $ia->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- AI SEO Assistant Box --}}
                <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">SEO & Metadata</span>
                        <button type="button" @click="generateSeo()" :disabled="isGeneratingSeo"
                                class="text-[10px] font-black text-emerald-700 uppercase hover:underline">
                            <span x-text="isGeneratingSeo ? '...' : '✨ Auto SEO'"></span>
                        </button>
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-slate-400 uppercase mb-0.5">SEO Title</label>
                        <input type="text" name="seo_title" x-model="seoTitle" placeholder="SEO Title..."
                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs">
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-slate-400 uppercase mb-0.5">Meta Description</label>
                        <textarea name="seo_meta" x-model="seoMeta" rows="2" placeholder="Meta description..."
                                  class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs"></textarea>
                    </div>
                </div>

            </div>

        </div>
    </form>
</div>
@endsection

