@extends('omc.layouts.app')

@section('content')
<div class="bg-white min-h-screen pt-32 pb-20 px-4 font-['Plus_Jakarta_Sans']">
    <div class="max-w-4xl mx-auto">
        <header class="mb-10">
            <a href="{{ route('omc.docs.index') }}" class="text-[10px] font-black uppercase text-slate-400 tracking-widest flex items-center gap-2 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg> Kembali
            </a>
            <h1 class="text-4xl font-black uppercase tracking-tighter text-[#052c24]">Edit Dokumen</h1>
        </header>

        <form action="{{ route('omc.docs.update', $doc->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Kategori</label>
                    <select name="category" class="w-full bg-white border-none rounded-2xl px-6 py-4 shadow-sm focus:ring-2 focus:ring-[#BEF264]">
                        <option value="annual_report" {{ $doc->category == 'annual_report' ? 'selected' : '' }}>Annual Report</option>
                        <option value="policy_brief" {{ $doc->category == 'policy_brief' ? 'selected' : '' }}>Policy Brief</option>
                        <option value="official_statement" {{ $doc->category == 'official_statement' ? 'selected' : '' }}>Pernyataan Resmi</option>
                    </select>
                </div>
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Tanggal Terbit</label>
                    <input type="date" name="published_at" value="{{ $doc->published_at->format('Y-m-d') }}" class="w-full bg-white border-none rounded-2xl px-6 py-4 shadow-sm focus:ring-2 focus:ring-[#BEF264]">
                </div>
            </div>

            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Judul Dokumen</label>
                <input type="text" name="title" value="{{ $doc->title }}" class="w-full bg-white border-none rounded-2xl px-6 py-4 shadow-sm focus:ring-2 focus:ring-[#BEF264]">
            </div>

            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Link PDF (External)</label>
                <input type="url" name="pdf_path" value="{{ $doc->pdf_path }}" placeholder="https://drive.google.com/..." class="w-full bg-white border-none rounded-2xl px-6 py-4 shadow-sm focus:ring-2 focus:ring-[#BEF264]">
            </div>

            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Deskripsi / Isi Ringkas</label>
                <textarea name="description" rows="5" class="w-full bg-white border-none rounded-2xl px-6 py-4 shadow-sm focus:ring-2 focus:ring-[#BEF264]">{{ $doc->description }}</textarea>
            </div>

            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Ganti Cover Image (Opsional)</label>
                @if($doc->cover_image)
                    <img src="{{ asset('storage/'.$doc->cover_image) }}" class="w-32 h-32 object-cover rounded-xl mb-4 border-4 border-white shadow-sm">
                @endif
                <input type="file" name="cover" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-[#052c24] file:text-[#BEF264]">
            </div>

            <button type="submit" class="w-full bg-[#052c24] text-[#BEF264] py-6 rounded-2xl font-black uppercase tracking-[0.2em] shadow-xl hover:scale-[1.02] transition-all">
                Update Dokumen
            </button>
        </form>
    </div>
</div>
@endsection
