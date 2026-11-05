@extends('omc.layouts.app')

@section('content')
<div class="bg-white min-h-screen font-['Plus_Jakarta_Sans']" x-data="{ lang: 'id' }">
    <header class="bg-[#052c24] pt-32 pb-20 px-4">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center gap-3 mb-4">
                <a href="{{ route('omc.scientific.index') }}" class="text-[#BEF264] text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:opacity-70 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                    Kembali ke Index
                </a>
            </div>
            <h1 class="text-3xl md:text-5xl font-black text-white tracking-tighter leading-tight mb-4 uppercase">
                Edit Artikel Ilmiah
            </h1>
            <p class="text-white/60 text-sm font-medium tracking-wide italic">ID Artikel: {{ $article->id }} — Terakhir diperbarui: {{ $article->updated_at->format('d M Y, H:i') }}</p>
        </div>
    </header>

    <div class="max-w-5xl mx-auto px-4 -mt-10 pb-20">
        <form action="{{ route('omc.scientific.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 p-8 md:p-12 border border-slate-100">

                <div class="flex gap-2 mb-10 bg-slate-100 p-1.5 rounded-2xl w-fit">
                    <button type="button" @click="lang = 'id'" :class="lang === 'id' ? 'bg-white shadow-sm text-[#052c24]' : 'text-slate-400'" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Indonesia</button>
                    <button type="button" @click="lang = 'en'" :class="lang === 'en' ? 'bg-white shadow-sm text-[#052c24]' : 'text-slate-400'" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">English</button>
                </div>

                <div class="mb-10">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4 block">Edit Penulis / Authors</label>
                    <select name="user_ids[]" multiple class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-[#BEF264] min-h-[150px]">
                        {{-- Opsi Default terpilih jika tidak ada relasi authors --}}
                        <option value="default" {{ $article->authors->isEmpty() ? 'selected' : '' }} class="font-bold text-[#052c24]">[DEFAULT] PUSAT INFORMASI DAN KOMUNIKASI</option>

                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ $article->authors->contains($user->id) ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 gap-8 mb-10">
                    <div x-show="lang === 'id'">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Judul Artikel (ID)</label>
                        <input type="text" name="title_id" value="{{ $article->title['id'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-lg font-bold placeholder:text-slate-300 focus:ring-2 focus:ring-[#BEF264]">
                    </div>
                    <div x-show="lang === 'en'">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Article Title (EN)</label>
                        <input type="text" name="title_en" value="{{ $article->title['en'] ?? '' }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-lg font-bold placeholder:text-slate-300 focus:ring-2 focus:ring-[#BEF264]">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10 bg-slate-50 p-6 rounded-[2rem]">
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Ganti Banner (Kosongkan jika tidak diubah)</label>
                        @if($article->cover_image)
                            <p class="text-[9px] text-blue-600 mb-2 font-bold uppercase tracking-tight italic">File saat ini: {{ basename($article->cover_image) }}</p>
                        @endif
                        <input type="file" name="banner" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-slate-200">
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Ganti File PDF (Kosongkan jika tidak diubah)</label>
                        @if($article->pdf_version)
                            <p class="text-[9px] text-blue-600 mb-2 font-bold uppercase tracking-tight italic">File saat ini: {{ basename($article->pdf_version) }}</p>
                        @endif
                        <input type="file" name="pdf_file" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-slate-200">
                    </div>
                </div>

                @php
                    $fields = [
                        'abstract' => 'Abstrak / Abstract',
                        'intro' => 'Pendahuluan / Introduction',
                        'method' => 'Metodologi / Methodology',
                        'result' => 'Hasil / Results',
                        'discussion' => 'Diskusi / Discussion',
                        'conclusion' => 'Kesimpulan / Conclusion',
                        'ref' => 'Referensi / References'
                    ];

                    // Helper mapping untuk sinkronisasi key database vs key form
                    $dbMap = [
                        'intro' => 'introduction',
                        'method' => 'methodology',
                        'result' => 'results',
                        'ref' => 'references'
                    ];
                @endphp

                @foreach($fields as $key => $label)
                @php $dbKey = $dbMap[$key] ?? $key; @endphp
                <div class="mb-10 p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#052c24] mb-4 block">{{ $label }}</label>

                    <div x-show="lang === 'id'">
                        <textarea name="{{ $key }}_id" rows="6" class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#BEF264]">{{ $article->{$dbKey}['id'] ?? '' }}</textarea>
                    </div>
                    <div x-show="lang === 'en'">
                        <textarea name="{{ $key }}_en" rows="6" class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#BEF264]">{{ $article->{$dbKey}['en'] ?? '' }}</textarea>
                    </div>
                </div>
                @endforeach

                <div class="flex items-center justify-between pt-6 border-t border-slate-100">
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Pastikan semua referensi valid</p>
                    <button type="submit" class="bg-[#052c24] text-[#BEF264] px-12 py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-[#BEF264] hover:text-[#052c24] transition-all shadow-xl">
                        Update Artikel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
