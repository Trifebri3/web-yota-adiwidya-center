@extends('omc.layouts.app')

@section('content')
<div class="bg-white min-h-screen font-['Plus_Jakarta_Sans']" x-data="{ lang: 'id' }">
    <header class="bg-[#052c24] pt-32 pb-20 px-4">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-3xl md:text-5xl font-black text-white tracking-tighter leading-tight mb-4 uppercase">
                Terbitkan Artikel Ilmiah
            </h1>
            <p class="text-white/60 text-sm font-medium tracking-wide">Pastikan data yang dimasukkan telah diverifikasi oleh tim redaksi.</p>
        </div>
    </header>

    <div class="max-w-5xl mx-auto px-4 -mt-10">
        <form action="{{ route('omc.scientific.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 p-8 md:p-12 border border-slate-100">

                <div class="flex gap-2 mb-10 bg-slate-100 p-1.5 rounded-2xl w-fit">
                    <button type="button" @click="lang = 'id'" :class="lang === 'id' ? 'bg-white shadow-sm text-[#052c24]' : 'text-slate-400'" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Indonesia</button>
                    <button type="button" @click="lang = 'en'" :class="lang === 'en' ? 'bg-white shadow-sm text-[#052c24]' : 'text-slate-400'" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">English</button>
                </div>

                <div class="mb-10">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4 block">Penulis / Authors</label>
                    <select name="user_ids[]" multiple class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-[#BEF264] min-h-[150px]">
                        <option value="default" selected class="font-bold text-[#052c24]">[DEFAULT] PUSAT INFORMASI DAN KOMUNIKASI</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <p class="mt-3 text-[10px] text-slate-400 italic font-medium">* Tahan Ctrl/Cmd untuk memilih lebih dari satu penulis.</p>
                </div>

                <hr class="mb-10 border-slate-100">

                <div class="grid grid-cols-1 gap-8 mb-10">
                    <div x-show="lang === 'id'">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Judul Artikel (ID)</label>
                        <input type="text" name="title_id" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-lg font-bold placeholder:text-slate-300 focus:ring-2 focus:ring-[#BEF264]" placeholder="Masukkan judul bahasa Indonesia...">
                    </div>
                    <div x-show="lang === 'en'">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Article Title (EN)</label>
                        <input type="text" name="title_en" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-lg font-bold placeholder:text-slate-300 focus:ring-2 focus:ring-[#BEF264]" placeholder="Enter English title...">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Banner Cover (JPG/PNG)</label>
                        <input type="file" name="banner" class="w-full text-xs text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-[#052c24] file:text-white hover:file:bg-[#BEF264] hover:file:text-[#052c24] transition-all">
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Full PDF Document</label>
                        <input type="file" name="pdf_file" class="w-full text-xs text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-[#052c24] file:text-white hover:file:bg-[#BEF264] hover:file:text-[#052c24] transition-all">
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
                @endphp

                @foreach($fields as $key => $label)
                <div class="mb-10 p-6 bg-slate-50 rounded-[2rem] border border-slate-100">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#052c24] mb-4 block">{{ $label }}</label>

                    <div x-show="lang === 'id'">
                        <textarea name="{{ $key }}_id" rows="4" class="w-full bg-white border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#BEF264]" placeholder="Isi bagian ini (Markdown didukung)..."></textarea>
                    </div>
                    <div x-show="lang === 'en'">
                        <textarea name="{{ $key }}_en" rows="4" class="w-full bg-white border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#BEF264]" placeholder="Fill this section (Markdown supported)..."></textarea>
                    </div>
                </div>
                @endforeach

                <div class="flex justify-end pt-6">
                    <button type="submit" class="bg-[#BEF264] text-[#052c24] px-12 py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:scale-105 transition-all shadow-xl shadow-[#BEF264]/20">
                        Terbitkan Artikel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
