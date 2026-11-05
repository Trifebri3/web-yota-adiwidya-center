@extends('omc.layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 pb-20 pt-10">
    <div class="max-w-5xl mx-auto px-6">

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight uppercase">Edit Inovasi</h1>
                <p class="text-slate-500 text-sm font-medium italic">Slug: {{ $product->slug }}</p>
            </div>
            <a href="{{ route('omc.products.index') }}" class="px-6 py-3 bg-white border border-slate-200 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">
                Batal
            </a>
        </div>

        <form action="{{ route('omc.products.update', $product->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <div class="lg:col-span-8 space-y-6">

                    <div class="flex bg-slate-200 p-1 rounded-2xl w-fit shadow-inner">
                        <button type="button" onclick="switchLang('id')" id="btn-id" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all bg-white text-slate-900 shadow-sm">
                            Indonesia
                        </button>
                        <button type="button" onclick="switchLang('en')" id="btn-en" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all text-slate-500">
                            English
                        </button>
                    </div>

                    <div id="form-id" class="space-y-6">
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Nama Produk (ID)</label>
                                    <input type="text" name="name_id" value="{{ $product->name['id'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold focus:ring-2 focus:ring-lime-400 outline-none">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Deskripsi (ID)</label>
                                    <textarea name="description_id" rows="4" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-lime-400 outline-none">{{ $product->description['id'] ?? '' }}</textarea>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Fungsi Utama (ID)</label>
                                        <textarea name="features_id" rows="3" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-lime-400 outline-none">{{ $product->features['id'] ?? '' }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Manfaat (ID)</label>
                                        <textarea name="benefits_id" rows="3" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-lime-400 outline-none">{{ $product->benefits['id'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="form-en" class="space-y-6 hidden">
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 border-l-4 border-l-blue-500">
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-blue-400 mb-2">Product Name (EN)</label>
                                    <input type="text" name="name_en" value="{{ $product->name['en'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold focus:ring-2 focus:ring-blue-400 outline-none">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-blue-400 mb-2">Description (EN)</label>
                                    <textarea name="description_en" rows="4" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-blue-400 outline-none">{{ $product->description['en'] ?? '' }}</textarea>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-blue-400 mb-2">Main Features (EN)</label>
                                        <textarea name="features_en" rows="3" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-blue-400 outline-none">{{ $product->features['en'] ?? '' }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-blue-400 mb-2">Benefits (EN)</label>
                                        <textarea name="benefits_en" rows="3" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-blue-400 outline-none">{{ $product->benefits['en'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-2 h-6 bg-blue-500 rounded-full"></div>
                            <h2 class="font-black uppercase tracking-widest text-sm text-slate-800">Resource Links</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Link Video (YouTube)</label>
                                <input type="url" name="video_url" value="{{ $product->video_url }}" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-blue-400 outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Link PDF (Drive/Cloud)</label>
                                <input type="url" name="pdf_url" value="{{ $product->pdf_url }}" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-blue-400 outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4 text-center">Banner Produk</label>
                        <div class="relative group cursor-pointer border-2 border-dashed border-slate-200 rounded-3xl overflow-hidden p-2">
                            <input type="file" name="banner_image" class="absolute inset-0 opacity-0 z-10 cursor-pointer" onchange="previewImg(event)">

                            <img id="img-preview" src="{{ asset('storage/' . $product->banner_image) }}" class="aspect-square w-full object-cover rounded-2xl">

                            <div id="placeholder" class="hidden aspect-square bg-slate-50 flex flex-col items-center justify-center text-slate-400 rounded-2xl">
                                <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                                <span class="text-[8px] font-black uppercase tracking-widest">Ganti Banner</span>
                            </div>
                        </div>
                        <p class="text-[9px] text-center text-slate-400 mt-3 italic font-medium">Klik gambar untuk mengganti banner</p>
                    </div>

                    <div class="bg-[#052c24] p-8 rounded-[2.5rem] shadow-xl">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-white/50 mb-2">Kategori Produk</label>
                                <select name="category" class="w-full bg-white/10 border-none rounded-xl p-3 text-sm text-white font-bold outline-none">
                                    <option value="Teknologi Tepat Guna" {{ $product->category == 'Teknologi Tepat Guna' ? 'selected' : '' }} class="text-slate-900">Teknologi Tepat Guna</option>
                                    <option value="Inovasi Sosial" {{ $product->category == 'Inovasi Sosial' ? 'selected' : '' }} class="text-slate-900">Inovasi Sosial</option>
                                    <option value="Edukasi & Literasi" {{ $product->category == 'Edukasi & Literasi' ? 'selected' : '' }} class="text-slate-900">Edukasi & Literasi</option>
                                    <option value="Kesehatan" {{ $product->category == 'Kesehatan' ? 'selected' : '' }} class="text-slate-900">Kesehatan</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full py-4 bg-lime-400 text-[#052c24] rounded-2xl font-black uppercase text-[11px] tracking-widest hover:bg-white transition-all shadow-lg shadow-lime-500/20">
                                Perbarui Inovasi
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    function switchLang(lang) {
        const formId = document.getElementById('form-id');
        const formEn = document.getElementById('form-en');
        const btnId = document.getElementById('btn-id');
        const btnEn = document.getElementById('btn-en');

        if(lang === 'id') {
            formId.classList.remove('hidden');
            formEn.classList.add('hidden');
            btnId.classList.add('bg-white', 'text-slate-900', 'shadow-sm');
            btnEn.classList.remove('bg-white', 'text-slate-900', 'shadow-sm');
            btnEn.classList.add('text-slate-500');
        } else {
            formId.classList.add('hidden');
            formEn.classList.remove('hidden');
            btnEn.classList.add('bg-white', 'text-slate-900', 'shadow-sm');
            btnId.classList.remove('bg-white', 'text-slate-900', 'shadow-sm');
            btnId.classList.add('text-slate-500');
        }
    }

    function previewImg(event) {
        const preview = document.getElementById('img-preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection
