@extends('omc.layouts.app')

@section('content')
<div class="bg-white min-h-screen pt-32 pb-20 px-4 font-['Plus_Jakarta_Sans']">
    <form action="{{ route('omc.campaign.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto">
        @csrf
        <header class="flex justify-between items-center mb-12">
            <div>
                <h1 class="text-4xl font-black uppercase tracking-tighter text-[#052c24]">New <span class="text-lime-500">Campaign</span></h1>
                <p class="text-slate-400 font-medium">Isi detail penggalangan dana dengan transparan.</p>
            </div>
            <button type="submit" class="bg-[#052c24] text-[#BEF264] px-10 py-5 rounded-[2rem] font-black uppercase text-xs tracking-widest shadow-xl">Publish Campaign</button>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-slate-100">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Judul Kampanye (ID)</label>
                    <input type="text" name="title[id]" required class="w-full border-none rounded-xl p-4 shadow-sm focus:ring-2 focus:ring-lime-500 mb-4" placeholder="Contoh: Berbagi Alat Tulis">

                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Campaign Title (EN)</label>
                    <input type="text" name="title[en]" required class="w-full border-none rounded-xl p-4 shadow-sm focus:ring-2 focus:ring-lime-500" placeholder="Example: School Kits Distribution">
                </div>

                <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-slate-100">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block">Deskripsi Lengkap (ID)</label>
                    <textarea name="description[id]" rows="5" class="w-full border-none rounded-xl p-4 shadow-sm focus:ring-2 focus:ring-lime-500"></textarea>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-[#052c24] p-8 rounded-[2.5rem] text-white">
                    <div class="mb-6">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-3 block">Target Dana (IDR)</label>
                        <input type="number" name="target_amount" required class="w-full bg-white/10 border-none rounded-xl p-4 text-[#BEF264] font-black text-xl" placeholder="10000000">
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-3 block">Tanggal Berakhir</label>
                        <input type="date" name="end_date" required class="w-full bg-white/10 border-none rounded-xl p-4 text-xs font-bold text-white">
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] border-2 border-dashed border-slate-200 text-center">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4 block italic">Cover Image (16:9)</label>
                    <input type="file" name="image" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-slate-100 file:text-[#052c24] file:font-black">
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
