@extends(Auth::user()->role->value . '.layouts.app')


@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-12" x-data="{ type: '{{ $post->type }}' }">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-3 py-1 bg-lime-100 text-lime-700 rounded-full text-[8px] font-black uppercase tracking-widest">{{ $post->status }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Post ID: #{{ $post->id }}</span>
                </div>
                <h1 class="text-4xl font-black text-[#064e3b] tracking-tighter uppercase italic">Revise <span class="text-lime-500">Content.</span></h1>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('gen-posts.index') }}" class="px-6 py-3 bg-white border border-slate-200 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-400 hover:bg-slate-50 transition-all">Cancel</a>
                <button form="postForm" class="px-8 py-3 bg-[#064e3b] text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-lime-100 hover:bg-lime-400 hover:text-[#064e3b] transition-all">Update Changes</button>
            </div>
        </div>

        <form action="{{ route('gen-posts.update', $post->id) }}" method="POST" id="postForm" enctype="multipart/form-data" class="grid grid-cols-12 gap-8">
            @csrf
            @method('PUT')

            <div class="col-span-12 lg:col-span-8 space-y-6">
                <div class="bg-white p-8 md:p-12 rounded-[3rem] border border-slate-100 shadow-sm">
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full text-3xl md:text-5xl font-black text-[#064e3b] border-none focus:ring-0 p-0 mb-8 uppercase italic tracking-tighter" required>

                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-300 block mb-4 italic">Edit Content</label>
                    <textarea name="content" id="editor" rows="15" class="w-full border-none focus:ring-0 p-0 text-lg text-slate-600 leading-relaxed font-serif">{{ old('content', $post->content) }}</textarea>
                </div>

                <div x-show="type === 'journal'" class="bg-lime-50 p-10 rounded-[3rem] border border-lime-100">
                    <h3 class="text-xs font-black text-lime-800 uppercase tracking-[0.3em] mb-8 italic">Scientific Metadata</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase text-lime-700 ml-2">DOI Number</label>
                            <input type="text" name="doi" value="{{ $post->meta->doi ?? '' }}" class="w-full bg-white border-none rounded-2xl py-4 px-6 text-sm font-bold shadow-sm focus:ring-2 focus:ring-lime-400">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase text-lime-700 ml-2">ISSN</label>
                            <input type="text" name="issn" value="{{ $post->meta->issn ?? '' }}" class="w-full bg-white border-none rounded-2xl py-4 px-6 text-sm font-bold shadow-sm focus:ring-2 focus:ring-lime-400">
                        </div>
                        <div class="col-span-2 space-y-2">
                            <label class="text-[9px] font-black uppercase text-lime-700 ml-2">References</label>
                            <textarea name="references" rows="4" class="w-full bg-white border-none rounded-2xl py-4 px-6 text-sm font-bold shadow-sm focus:ring-2 focus:ring-lime-400">{{ $post->meta->references ?? '' }}</textarea>
                        </div>
                        <div class="col-span-2 p-6 bg-white/50 rounded-[2rem] border border-dashed border-lime-200">
                            @if($post->meta && $post->meta->pdf_version)
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-[9px] font-black text-lime-600 uppercase">Current PDF: {{ basename($post->meta->pdf_version) }}</span>
                                    <a href="{{ asset('storage/' . $post->meta->pdf_version) }}" target="_blank" class="text-[9px] font-black text-blue-500 underline uppercase italic">Preview</a>
                                </div>
                            @endif
                            <label class="text-[9px] font-black uppercase text-lime-700 block mb-2">Replace PDF Document</label>
                            <input type="file" name="pdf_version" class="w-full text-xs">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-4 space-y-6">
                <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm">
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6">Visual Identity</h3>
                    @if($post->cover_image)
                        <div class="mb-4 rounded-2xl overflow-hidden aspect-video bg-slate-100">
                            <img src="{{ asset('storage/' . $post->cover_image) }}" class="w-full h-full object-cover grayscale">
                        </div>
                    @endif
                    <div class="relative group cursor-pointer border-2 border-dashed border-slate-100 rounded-[2rem] p-4 text-center hover:border-lime-400 transition-all">
                        <input type="file" name="cover_image" class="absolute inset-0 opacity-0 cursor-pointer">
                        <p class="text-[9px] font-black uppercase text-slate-400 py-4">Replace Cover Image</p>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm space-y-8">
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 block mb-4 italic">Visibility</label>
                        <select name="status" class="w-full border-none bg-slate-50 rounded-2xl py-4 px-6 text-[10px] font-black uppercase tracking-widest text-[#064e3b]">
                            <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft Mode</option>
                            <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Public Access</option>
                            <option value="archived" {{ $post->status == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 block mb-4 italic">Classification</label>
                        <select name="category_id" class="w-full border-none bg-slate-50 rounded-2xl py-4 px-6 text-[10px] font-black uppercase tracking-widest text-[#064e3b]">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $post->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="p-8 bg-[#064e3b] rounded-[3rem] text-center">
                    <p class="text-[10px] font-black text-lime-400 uppercase tracking-[0.2em] mb-2 italic">Views Impact</p>
                    <span class="text-4xl font-black text-white italic tracking-tighter">{{ number_format($post->views_count) }}</span>
                    <p class="text-[8px] font-bold text-white/40 uppercase mt-2 tracking-widest">Total readers reached</p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
