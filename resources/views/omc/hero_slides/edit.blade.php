@extends('omc.layouts.app')

@section('title', 'Edit Hero Slide - OMC')

@section('content')
<div class="py-12 bg-slate-50 min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Error Alert --}}
        @if (isset($errors) && $errors->any())
            <div class="mb-6 p-5 bg-red-50 border-l-4 border-red-500 rounded-2xl flex items-center gap-4">
                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-black text-red-800 uppercase tracking-widest">Input Gagal</h4>
                    <ul class="text-xs text-red-600 font-medium list-disc list-inside mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="bg-white shadow-2xl rounded-[3rem] overflow-hidden border border-slate-100"
             x-data="{
                imagePreview: '{{ $heroSlide->image_url }}',
                selectedPublication: '{{ $heroSlide->publication_id }}',
                publications: {{ Js::from($publications->map(fn($p) => [
                    'id' => $p->id,
                    'title' => $p->title['id'] ?? $p->title,
                    'desc' => $p->description['id'] ?? $p->description ?? '',
                    'slug' => $p->slug,
                    'banner' => $p->banner ? asset('storage/' . $p->banner) : null
                ])) }},
                applyPublication() {
                    const pub = this.publications.find(p => p.id == this.selectedPublication);
                    if (pub) {
                        document.getElementById('input_title').value = pub.title;
                        document.getElementById('input_summary').value = pub.desc;
                        document.getElementById('input_button_link').value = '/publications/' + pub.slug;
                        if (pub.banner) {
                            this.imagePreview = pub.banner;
                        }
                    }
                }
             }">

            {{-- Form Header --}}
            <div class="p-8 md:p-10 border-b border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-slate-50/50">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-2.5 h-2.5 bg-lime-500 rounded-full"></span>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.25em]">Edit Hero Slide</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-black text-[#052c24] uppercase tracking-tight">Perbarui Hero Slide</h1>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Ubah banner, judul, tombol, atau urutan slide carousel.</p>
                </div>
                <a href="{{ route('omc.hero-slides.index') }}" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-2xl text-xs font-bold hover:bg-slate-100 transition-all flex items-center gap-2 shadow-sm">
                    ← Kembali
                </a>
            </div>

            <form action="{{ route('omc.hero-slides.update', $heroSlide) }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-10 space-y-8">
                @csrf
                @method('PUT')

                {{-- Tautkan ke Publikasi --}}
                <div class="p-6 bg-lime-50/60 border border-lime-200/80 rounded-2xl">
                    <label class="block text-xs font-black uppercase tracking-wider text-[#052c24] mb-2">
                        💡 Tautkan ke Artikel Publikasi (Opsional)
                    </label>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <select name="publication_id" x-model="selectedPublication" @change="applyPublication()" class="flex-1 bg-white border-slate-200 rounded-xl px-4 py-3 text-xs font-bold text-slate-700 focus:ring-2 focus:ring-lime-400">
                            <option value="">-- Slide Mandiri (Tidak Terikat Artikel) --</option>
                            @foreach($publications as $pub)
                                <option value="{{ $pub->id }}" {{ $heroSlide->publication_id == $pub->id ? 'selected' : '' }}>
                                    {{ Str::limit($pub->title['id'] ?? $pub->title, 60) }} ({{ $pub->published_at ? $pub->published_at->format('d M Y') : '-' }})
                                </option>
                            @endforeach
                        </select>
                        <button type="button" @click="applyPublication()" class="px-5 py-3 bg-[#052c24] text-[#BEF264] rounded-xl text-xs font-black uppercase tracking-wider hover:opacity-90 transition-all shrink-0">
                            Sinkronkan Data
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Judul Slide --}}
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                            Judul Headline Slide <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="input_title" value="{{ old('title', $heroSlide->title) }}" required
                               class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">
                    </div>

                    {{-- Kategori / Badge --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                            Kategori / Tag Badge <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="category" id="input_category" value="{{ old('category', $heroSlide->category) }}" required
                               class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">
                    </div>

                    {{-- Urutan Tampil --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                            Urutan Tampil (Order)
                        </label>
                        <input type="number" name="order" value="{{ old('order', $heroSlide->order) }}" min="0"
                               class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">
                    </div>

                    {{-- Ringkasan / Deskripsi --}}
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                            Ringkasan Deskripsi (Singkat)
                        </label>
                        <textarea name="summary" id="input_summary" rows="3"
                                  class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">{{ old('summary', $heroSlide->summary) }}</textarea>
                    </div>

                    {{-- Upload Banner --}}
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                            Gambar Banner Hero (Unggah baru untuk mengganti)
                        </label>
                        <div class="relative group h-64 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center hover:border-lime-400 transition-all overflow-hidden cursor-pointer">
                            <input type="file" name="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10"
                                   @change="const file = $event.target.files[0]; if (file) { imagePreview = URL.createObjectURL(file); }">
                            
                            <template x-if="imagePreview">
                                <div class="w-full h-full relative">
                                    <img :src="imagePreview" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="px-4 py-2 bg-white text-slate-900 rounded-xl text-xs font-black uppercase tracking-wider shadow">Klik untuk Ganti Gambar</span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Tombol CTA Text --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                            Teks Tombol Aksi (CTA) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="button_text" id="input_button_text" value="{{ old('button_text', $heroSlide->button_text) }}" required
                               class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">
                    </div>

                    {{-- Link URL Tombol --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                            Link URL Tujuan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="button_link" id="input_button_link" value="{{ old('button_link', $heroSlide->button_link) }}" required
                               class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">
                    </div>
                </div>

                {{-- Status Aktif Checkbox --}}
                <div class="p-6 bg-slate-50 rounded-2xl flex items-center justify-between border border-slate-100">
                    <div>
                        <h4 class="text-xs font-black uppercase tracking-wider text-[#052c24]">Status Publikasi Slide</h4>
                        <p class="text-xs text-slate-500 font-medium">Aktifkan untuk menampilkan slide ini di carousel beranda.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $heroSlide->is_active ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-lime-500"></div>
                    </label>
                </div>

                {{-- Submit Buttons --}}
                <div class="pt-4 flex items-center justify-end gap-4 border-t border-slate-100">
                    <a href="{{ route('omc.hero-slides.index') }}" class="px-6 py-4 rounded-2xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-all">
                        Batal
                    </a>
                    <button type="submit" class="bg-[#052c24] text-[#BEF264] px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:scale-105 hover:shadow-xl transition-all shadow-md flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Perbarui Hero Slide
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
