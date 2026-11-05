@extends('omc.layouts.app')

@section('content')
<div class="bg-white min-h-screen pt-32 pb-20 px-4 font-['Plus_Jakarta_Sans']"
     x-data="{
        stats: [{value: '', label_id: '', label_en: '', sub_id: '', sub_en: ''}],
        stories: [{text_id: '', text_en: ''}]
     }">

    <form action="{{ route('omc.impact.store') }}" method="POST" enctype="multipart/form-data" class="max-w-6xl mx-auto">
        @csrf

        <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12 border-b border-slate-100 pb-10">
            <div>
                <h1 class="text-5xl font-black uppercase tracking-tighter text-[#052c24]">
                    Create <span class="text-blue-600">Impact</span>
                </h1>
                <p class="text-slate-400 font-bold mt-2 uppercase text-[10px] tracking-[0.3em]">OMC Impact Reporting System v2.0</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('omc.impact.index') }}" class="px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest text-slate-400 hover:bg-slate-50 transition-all">Cancel</a>
                <button type="submit" class="bg-[#052c24] text-[#BEF264] px-10 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:shadow-2xl hover:shadow-green-200 transition-all">Publish Report</button>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 space-y-8">

                <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-slate-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-blue-600">Judul Laporan (ID)</label>
                            <input type="text" name="title[id]" required placeholder="E.g. Pemulihan Ekosistem Mangrove" class="w-full border-none rounded-xl p-4 shadow-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-blue-600">Report Title (EN)</label>
                            <input type="text" name="title[en]" required placeholder="E.g. Mangrove Ecosystem Restoration" class="w-full border-none rounded-xl p-4 shadow-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <div class="space-y-2">
        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Deskripsi Singkat (ID)</label>
        <textarea name="description[id]" class="w-full border-none bg-white rounded-xl p-4 shadow-sm" required></textarea>
    </div>
    <div class="space-y-2">
        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Short Description (EN)</label>
        <textarea name="description[en]" class="w-full border-none bg-white rounded-xl p-4 shadow-sm" required></textarea>
    </div>
</div>
                </div>

                <div class="bg-blue-600 p-10 rounded-[3rem] shadow-xl shadow-blue-100">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-white font-black uppercase tracking-widest text-sm italic">Impact Statistics (Numbers)</h3>
                        <button type="button" @click="stats.push({value: '', label_id: '', label_en: '', sub_id: '', sub_en: ''})" class="bg-white/20 hover:bg-white/40 text-white px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all">+ Add Stat</button>
                    </div>

                    <div class="space-y-4">
                        <template x-for="(stat, index) in stats" :key="index">
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-3 bg-blue-700/50 p-5 rounded-2xl relative border border-blue-400/30">
                                <div class="col-span-1">
                                    <label class="text-[8px] text-blue-200 font-bold uppercase mb-1 block">Value (120+)</label>
                                    <input type="text" x-model="stat.value" :name="`stats_data[${index}][value]`" class="w-full bg-white/10 border-none rounded-lg text-white text-xs placeholder-blue-300">
                                </div>
                                <div class="col-span-1">
                                    <label class="text-[8px] text-blue-200 font-bold uppercase mb-1 block">Label (ID)</label>
                                    <input type="text" x-model="stat.label_id" :name="`stats_data[${index}][label_id]`" class="w-full bg-white/10 border-none rounded-lg text-white text-xs">
                                </div>
                                <div class="col-span-1">
                                    <label class="text-[8px] text-blue-200 font-bold uppercase mb-1 block">Label (EN)</label>
                                    <input type="text" x-model="stat.label_en" :name="`stats_data[${index}][label_en]`" class="w-full bg-white/10 border-none rounded-lg text-white text-xs">
                                </div>
                                <div class="col-span-2">
                                    <label class="text-[8px] text-blue-200 font-bold uppercase mb-1 block">Sub-text (ID)</label>
                                    <input type="text" x-model="stat.sub_id" :name="`stats_data[${index}][sub_id]`" class="w-full bg-white/10 border-none rounded-lg text-white text-xs">
                                </div>
                                <button type="button" @click="stats.splice(index, 1)" class="absolute -right-2 -top-2 bg-white text-red-500 rounded-full p-1 shadow-lg">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="bg-slate-50 p-10 rounded-[3rem] border border-slate-100 space-y-8">
                    <h3 class="text-[#052c24] font-black uppercase tracking-widest text-sm">Program Deep-Dive</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 italic">Goals (ID)</label>
                            <textarea name="goals[id]" rows="4" class="w-full border-none rounded-2xl p-4 shadow-sm"></textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 italic">Methodology (ID)</label>
                            <textarea name="methodology[id]" rows="4" class="w-full border-none rounded-2xl p-4 shadow-sm"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">

                <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white">
                    <div class="space-y-6">
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-3 block">Category</label>
                            <select name="category" class="w-full bg-white/10 border-none rounded-xl p-4 text-xs font-bold text-[#BEF264]">
                                <option value="Program">Program Social</option>
                                <option value="Environment">Lingkungan / Bibit</option>
                                <option value="Education">Buku / Pendidikan</option>
                                <option value="Disaster">Tanggap Bencana</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-3 block">Document Link (PDF)</label>
                            <input type="url" name="pdf_path" placeholder="https://external-link.com/file.pdf" class="w-full bg-white/10 border-none rounded-xl p-4 text-xs text-blue-300">
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-3 block">Publish Date</label>
                            <input type="date" name="published_at" value="{{ date('Y-m-d') }}" class="w-full bg-white/10 border-none rounded-xl p-4 text-xs">
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] border-2 border-dashed border-slate-200">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4 block text-center">Cover Image Report</label>
                    <input type="file" name="cover" class="block w-full text-[10px] text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-slate-100 file:text-[#052c24] file:font-black">
                </div>

                <div class="bg-green-50 p-8 rounded-[2.5rem] border border-green-100">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-green-700 mb-6 flex justify-between items-center">
                        Impact Stories
                        <button type="button" @click="stories.push({text_id: '', text_en: ''})" class="text-blue-600 text-[18px]">+</button>
                    </h4>
                    <div class="space-y-4">
                        <template x-for="(story, idx) in stories" :key="idx">
                            <div class="relative bg-white p-4 rounded-2xl shadow-sm border border-green-100">
                                <textarea :name="`impact_stories[${idx}][id]`" placeholder="Cerita dampak..." class="w-full border-none text-xs p-0 mb-2 focus:ring-0"></textarea>
                                <button type="button" @click="stories.splice(idx, 1)" class="absolute -right-2 -top-2 text-red-400">×</button>
                            </div>
                        </template>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
