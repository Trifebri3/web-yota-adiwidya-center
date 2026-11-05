@extends(Auth::user()->role->value . '.layouts.app')


@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-12" x-data="{ type: 'article' }">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-black text-[#064e3b] tracking-tighter uppercase italic">Draft <span class="text-lime-500">Creation.</span></h1>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Publish your thoughts, journals, or stories</p>
            </div>
<div class="flex gap-3">
    <!-- Tambahkan Hidden Input untuk menampung status -->
    <input type="hidden" name="status" id="statusInput" value="draft">
    
    <button type="button" 
            onclick="document.getElementById('statusInput').value='draft'; document.getElementById('postForm').submit();" 
            class="px-6 py-3 bg-white border border-slate-200 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-400 hover:bg-slate-50 transition-all">
            Save Draft
    </button>
    
    <button type="button" 
            onclick="document.getElementById('statusInput').value='published'; document.getElementById('postForm').submit();" 
            class="px-8 py-3 bg-[#064e3b] text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-lime-100 hover:bg-lime-400 hover:text-[#064e3b] transition-all">
            Publish Now
    </button>
</div>
        </div>

        <form action="{{ route('gen-posts.store') }}" method="POST" id="postForm" enctype="multipart/form-data" class="grid grid-cols-12 gap-8">
            @csrf

            <div class="col-span-12 lg:col-span-8 space-y-6">
                <div class="bg-white p-8 md:p-12 rounded-[3rem] border border-slate-100 shadow-sm">
                    <input type="text" name="title" placeholder="Enter an impactful title..." class="w-full text-3xl md:text-5xl font-black text-[#064e3b] placeholder:text-slate-100 border-none focus:ring-0 p-0 mb-8 uppercase italic tracking-tighter" required>

                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-300 block mb-4 italic">The Content</label>
                    <textarea name="content" id="editor" rows="15" class="w-full border-none focus:ring-0 p-0 text-lg text-slate-600 leading-relaxed placeholder:text-slate-200 font-serif" placeholder="Tell your story... (Supports HTML)"></textarea>
                </div>

                <div x-show="type === 'journal'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-4" class="bg-lime-50 p-10 rounded-[3rem] border border-lime-100">
                    <h3 class="text-xs font-black text-lime-800 uppercase tracking-[0.3em] mb-8 italic">Scientific Metadata (Journal Only)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase text-lime-700 ml-2">DOI Number</label>
                            <input type="text" name="doi" placeholder="e.g. 10.1000/xyz123" class="w-full bg-white border-none rounded-2xl py-4 px-6 text-sm font-bold shadow-sm focus:ring-2 focus:ring-lime-400">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase text-lime-700 ml-2">ISSN</label>
                            <input type="text" name="issn" placeholder="e.g. 1234-567X" class="w-full bg-white border-none rounded-2xl py-4 px-6 text-sm font-bold shadow-sm focus:ring-2 focus:ring-lime-400">
                        </div>
                        <div class="col-span-2 space-y-2">
                            <label class="text-[9px] font-black uppercase text-lime-700 ml-2">References (APA/MLA)</label>
                            <textarea name="references" rows="4" class="w-full bg-white border-none rounded-2xl py-4 px-6 text-sm font-bold shadow-sm focus:ring-2 focus:ring-lime-400" placeholder="List your citations here..."></textarea>
                        </div>
                        <div class="col-span-2 space-y-2">
                            <label class="text-[9px] font-black uppercase text-lime-700 ml-2">Upload PDF Version</label>
                            <input type="file" name="pdf_version" class="w-full bg-white border-none rounded-2xl py-4 px-6 text-xs font-bold shadow-sm">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-4 space-y-6">
                <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm">
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6">Cover Image</h3>
                    <div class="relative group cursor-pointer border-2 border-dashed border-slate-100 rounded-[2rem] p-4 text-center hover:border-lime-400 transition-all">
                        <input type="file" name="cover_image" class="absolute inset-0 opacity-0 cursor-pointer">
                        <div class="py-8">
                            <svg class="w-8 h-8 mx-auto text-slate-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-[9px] font-black uppercase text-slate-400">Drop your visual here</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm space-y-8">
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 block mb-4 italic">Post Type</label>
                        <select name="type" x-model="type" class="w-full border-none bg-slate-50 rounded-2xl py-4 px-6 text-[10px] font-black uppercase tracking-widest text-[#064e3b] focus:ring-2 focus:ring-lime-400">
                            <option value="article">Regular Article</option>
                            <option value="journal">Scientific Journal</option>
                            <option value="opinion">Personal Opinion</option>
                            <option value="story">Backstage Story</option>
                        </select>
                    </div>

<div>
    <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 block mb-4 italic">Category</label>
    <!-- UBAH DISINI: division_id menjadi category_id -->
    <select name="category_id" class="w-full border-none bg-slate-50 rounded-2xl py-4 px-6 text-[10px] font-black uppercase tracking-widest text-[#064e3b] focus:ring-2 focus:ring-lime-400" required>
        @forelse($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @empty
            <option value="" disabled>-- BELUM ADA DATA KATEGORI --</option>
        @endforelse
    </select>
</div>
                </div>

                <div class="bg-[#064e3b] p-8 rounded-[3rem] text-white">
                    <p class="text-[10px] leading-relaxed font-bold opacity-60 uppercase tracking-widest italic">
                        "Your words are the currency of impact. Make every paragraph count."
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Tambahkan ini di dalam <form> untuk mengecek apakah file input terbaca -->
<script>
document.getElementById('postForm').onsubmit = function() {
    console.log("Form dikirim!");
    // Anda bisa melihat di Console Browser (F12) apakah data berhasil divalidasi
};
</script>
{{-- Tip: Gunakan CKEditor atau Trix untuk pengalaman menulis yang lebih baik --}}
@endsection
