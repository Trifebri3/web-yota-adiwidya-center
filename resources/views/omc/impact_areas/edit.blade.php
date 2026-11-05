@extends('omc.layouts.app')

@section('title', 'Kelola Pilar: ' . ($impactArea->name ?? 'Impact Area') . ' - OMC')

@section('content')
<div class="py-12 bg-slate-50 min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

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
                color: '{{ old('color', $impactArea->color ?? '#0361a4') }}',
                logoPreview: '{{ $impactArea->logo_url ?? '' }}',
                motifPreview: '{{ $impactArea->motif_url ?? '' }}',
             }">

            {{-- Form Header --}}
            <div class="p-8 md:p-10 border-b border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-slate-50/50">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl p-2 bg-white shadow-sm border border-slate-200 flex items-center justify-center shrink-0">
                        <img :src="logoPreview" alt="{{ $impactArea->name }}" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-2.5 h-2.5 rounded-full" :style="`background-color: ${color}`"></span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.25em]">PILAR {{ $impactArea->code ?? '01' }}</span>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-black text-[#052c24] uppercase tracking-tight">
                            Kelola Pilar: {{ $impactArea->name }}
                        </h1>
                    </div>
                </div>

                <a href="{{ route('omc.impact-areas.index') }}" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-2xl text-xs font-bold hover:bg-slate-100 transition-all flex items-center gap-2 shadow-sm">
                    ← Kembali
                </a>
            </div>

            <form action="{{ route('omc.impact-areas.update', $impactArea->id) }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-10 space-y-10">
                @csrf
                @method('PUT')

                {{-- Group 1: Identitas & Warna Khas --}}
                <div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-[#052c24] mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <span>1. IDENTITAS & WARNA KHAS PILAR</span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Pilar --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                Nama Pilar Program <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $impactArea->name) }}" required
                                   class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">
                        </div>

                        {{-- Warna Hex --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                Warna Khas Pilar (Hex Code) <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" x-model="color" class="w-14 h-14 rounded-2xl border border-slate-200 p-1 cursor-pointer bg-white">
                                <input type="text" name="color" x-model="color" required placeholder="#0361a4"
                                       class="flex-1 bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold font-mono text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">
                            </div>
                        </div>

                        {{-- Tagline --}}
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                Tagline / Slogan Pilar
                            </label>
                            <input type="text" name="tagline" value="{{ old('tagline', $impactArea->tagline) }}" placeholder="Contoh: Empowering the Next Generation of Leaders & Innovators"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">
                        </div>

                        {{-- Deskripsi Lengkap --}}
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                Narasi / Deskripsi Strategis Pilar <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" rows="4" required
                                      class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">{{ old('description', $impactArea->description) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Group 2: Upload Logo & Motif Poster Khas --}}
                <div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-[#052c24] mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <span>2. ASSET VISUAL (LOGO & MOTIF KHAS)</span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Logo Upload --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                Logo Ikon Pilar (PNG / SVG Transparan)
                            </label>
                            <div class="p-6 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center relative hover:border-lime-400 transition-colors">
                                <input type="file" name="logo" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10"
                                       @change="const f = $event.target.files[0]; if(f) logoPreview = URL.createObjectURL(f)">
                                
                                <div class="w-20 h-20 rounded-2xl bg-white shadow-sm p-3 border border-slate-200 mb-3 flex items-center justify-center">
                                    <img :src="logoPreview" class="w-full h-full object-contain">
                                </div>
                                <p class="text-xs font-bold text-slate-600 uppercase">Klik untuk ganti logo</p>
                                <p class="text-[10px] text-slate-400">Rekomendasi rasio 1:1 transparan</p>
                            </div>
                        </div>

                        {{-- Motif Poster Upload --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                Motif Mosaik / Poster Khas Pilar
                            </label>
                            <div class="p-6 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center relative hover:border-lime-400 transition-colors">
                                <input type="file" name="motif" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10"
                                       @change="const f = $event.target.files[0]; if(f) motifPreview = URL.createObjectURL(f)">
                                
                                <div class="w-32 h-20 rounded-xl overflow-hidden shadow-sm border border-slate-200 mb-3 bg-slate-900">
                                    <img :src="motifPreview" class="w-full h-full object-cover">
                                </div>
                                <p class="text-xs font-bold text-slate-600 uppercase">Klik untuk ganti poster motif</p>
                                <p class="text-[10px] text-slate-400">Asset bawaan: public/pilar/pilar*</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Group 3: Area Fokus & Sasaran --}}
                <div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-[#052c24] mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <span>3. AREA FOKUS & SASARAN STRATEGIS</span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Area Fokus --}}
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                Daftar Area Fokus (Tulis satu per baris atau pisahkan dengan koma)
                            </label>
                            <textarea name="focus_areas" rows="4" placeholder="Youth Development&#10;Education and E-Learning&#10;Volunteer Activities"
                                      class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">{{ is_array($impactArea->focus_areas) ? implode("\n", $impactArea->focus_areas) : $impactArea->focus_areas }}</textarea>
                        </div>

                        {{-- Target Penerima Manfaat --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                Target Penerima Manfaat
                            </label>
                            <input type="text" name="target_beneficiaries" value="{{ old('target_beneficiaries', $impactArea->target_beneficiaries) }}" placeholder="Contoh: Pelajar, pemuda desa, dan mahasiswa"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">
                        </div>

                        {{-- Arah Strategis --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                Arah Strategis Organisasi
                            </label>
                            <input type="text" name="strategic_direction" value="{{ old('strategic_direction', $impactArea->strategic_direction) }}" placeholder="Contoh: Mencetak 10.000 pemuda berdaya saing global"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">
                        </div>
                    </div>
                </div>

                {{-- Group 4: Kerangka 5W1H --}}
                <div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-[#052c24] mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <span>4. KERANGKA 5W1H PILAR</span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- WHAT --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                WHAT (Apa yang menjadi fokus pilar ini?)
                            </label>
                            <textarea name="what_desc" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">{{ old('what_desc', $impactArea->what_desc) }}</textarea>
                        </div>

                        {{-- WHY --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                WHY (Mengapa pilar ini penting?)
                            </label>
                            <textarea name="why_desc" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">{{ old('why_desc', $impactArea->why_desc) }}</textarea>
                        </div>

                        {{-- WHO --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                WHO (Siapa target penerima manfaat & mitra?)
                            </label>
                            <textarea name="who_desc" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">{{ old('who_desc', $impactArea->who_desc) }}</textarea>
                        </div>

                        {{-- WHERE --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                WHERE (Di mana program pilar ini diimplementasikan?)
                            </label>
                            <textarea name="where_desc" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">{{ old('where_desc', $impactArea->where_desc) }}</textarea>
                        </div>

                        {{-- WHEN --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                WHEN (Kapan program diimplementasikan?)
                            </label>
                            <textarea name="when_desc" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">{{ old('when_desc', $impactArea->when_desc) }}</textarea>
                        </div>

                        {{-- HOW --}}
                        <div class="space-y-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500">
                                HOW (Bagaimana strategi & penciptaan dampaknya?)
                            </label>
                            <textarea name="how_desc" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-lime-400 transition-all">{{ old('how_desc', $impactArea->how_desc) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Status Aktif & Urutan --}}
                <div class="p-6 bg-slate-50 rounded-2xl flex flex-col sm:flex-row items-center justify-between border border-slate-100 gap-4">
                    <div class="flex items-center gap-4">
                        <label class="text-xs font-black uppercase tracking-wider text-[#052c24]">Urutan Tampil:</label>
                        <input type="number" name="order" value="{{ old('order', $impactArea->order ?? 1) }}" min="0" class="w-20 bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-center">
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-slate-600">Status Aktif di Website:</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ ($impactArea->is_active ?? true) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-lime-500"></div>
                        </label>
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="pt-4 flex items-center justify-end gap-4 border-t border-slate-100">
                    <a href="{{ route('omc.impact-areas.index') }}" class="px-6 py-4 rounded-2xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-all">
                        Batal
                    </a>
                    <button type="submit" class="bg-[#052c24] text-[#BEF264] px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:scale-105 hover:shadow-xl transition-all shadow-md flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Perubahan Pilar
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

