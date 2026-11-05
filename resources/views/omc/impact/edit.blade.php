@extends('omc.layouts.app')

@section('content')
<div class="bg-white min-h-screen pt-32 pb-20 px-4 font-['Plus_Jakarta_Sans']" x-data="{ stats: {{ json_encode($impact->stats_data ?? []) }} }">
    <form action="{{ route('omc.impact.update', $impact->id) }}" method="POST" enctype="multipart/form-data" class="max-w-5xl mx-auto">
        @csrf
        @method('PUT')

        <header class="flex items-center justify-between mb-12">
            <div>
                <a href="{{ route('omc.impact.index') }}" class="text-[10px] font-black uppercase text-slate-400 tracking-widest flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg> Back
                </a>
                <h1 class="text-4xl font-black uppercase tracking-tighter text-[#052c24]">Update <span class="text-blue-600">Impact</span></h1>
            </div>
            <button type="submit" class="bg-[#052c24] text-[#BEF264] px-10 py-5 rounded-[2rem] font-black uppercase text-xs tracking-[0.2em] shadow-xl">Update Report</button>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-10">
            <div class="bg-slate-50 p-8 rounded-[2.5rem] space-y-6">
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Judul (Indonesia)</label>
                    <input type="text" name="title[id]" value="{{ $impact->title['id'] }}" class="w-full border-none bg-white rounded-xl p-4 shadow-sm">
                </div>
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Title (English)</label>
                    <input type="text" name="title[en]" value="{{ $impact->title['en'] }}" class="w-full border-none bg-white rounded-xl p-4 shadow-sm">
                </div>
            </div>

            <div class="bg-slate-50 p-8 rounded-[2.5rem] space-y-6">
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">PDF Link</label>
                    <input type="url" name="pdf_path" value="{{ $impact->pdf_path }}" class="w-full border-none bg-white rounded-xl p-4 shadow-sm">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Category</label>
                        <select name="category" class="w-full border-none bg-white rounded-xl p-4 shadow-sm text-xs font-bold">
                            <option value="Program" {{ $impact->category == 'Program' ? 'selected' : '' }}>Program</option>
                            <option value="Lingkungan" {{ $impact->category == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                            <option value="Buku" {{ $impact->category == 'Buku' ? 'selected' : '' }}>Buku</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Publish Date</label>
                        <input type="date" name="published_at" value="{{ $impact->published_at->format('Y-m-d') }}" class="w-full border-none bg-white rounded-xl p-4 shadow-sm">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-blue-600 p-10 rounded-[3rem] text-white">
            <h3 class="text-sm font-black uppercase tracking-[0.3em] mb-8">Update Impact Figures</h3>
            <div class="space-y-4">
                <template x-for="(stat, index) in stats" :key="index">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-3 bg-blue-700/50 p-6 rounded-2xl relative border border-blue-400/30">
                        <input type="text" x-model="stat.value" :name="`stats_data[${index}][value]`" placeholder="Value (e.g. 120+)" class="bg-white/10 border-none rounded-lg text-white placeholder-blue-300 text-sm">
                        <input type="text" x-model="stat.label_id" :name="`stats_data[${index}][label_id]`" placeholder="Label ID" class="bg-white/10 border-none rounded-lg text-white placeholder-blue-300 text-sm">
                        <input type="text" x-model="stat.label_en" :name="`stats_data[${index}][label_en]`" placeholder="Label EN" class="bg-white/10 border-none rounded-lg text-white placeholder-blue-300 text-sm">
                        <input type="text" x-model="stat.sub_id" :name="`stats_data[${index}][sub_id]`" placeholder="Sub-text ID" class="bg-white/10 border-none rounded-lg text-white placeholder-blue-300 text-sm col-span-2">

                        <button type="button" @click="stats.splice(index, 1)" class="absolute -right-2 -top-2 bg-white text-blue-600 rounded-full p-1 shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </template>
                <button type="button" @click="stats.push({label_id: '', label_en: '', value: '', sub_id: '', sub_en: ''})" class="w-full py-4 border-2 border-dashed border-blue-400 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-white hover:text-blue-600 transition-all">
                    + Add New Statistic Field
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
