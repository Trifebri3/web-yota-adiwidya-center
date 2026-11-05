@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .archive-card {
        background: #fff;
        border-radius: 30px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }
    .archive-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.03);
        border-color: #bef264;
    }
    .category-tag {
        font-[9px]; font-weight: 900; text-transform: uppercase; letter-spacing: 1px;
        padding: 4px 12px; border-radius: 8px;
    }
    .search-input {
        background: #fff; border: 1px solid #f1f5f9; border-radius: 15px;
        padding: 12px 20px; font-size: 12px; font-weight: 600; width: 300px;
    }
</style>

<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                    Digital <span class="text-slate-300 font-normal">Vault.</span>
                </h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mt-3">Arsip Dokumentasi & Asset Digital</p>
            </div>

            <form action="{{ route('audit.resources.archive') }}" method="GET" class="flex gap-3">
                <input type="text" name="search" placeholder="Cari judul atau kategori..." class="search-input shadow-sm focus:outline-none focus:ring-2 focus:ring-lime-400" value="{{ request('search') }}">
                <button type="submit" class="bg-[#064e3b] text-white px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg">Filter</button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($archives as $archive)
            <div class="archive-card flex flex-col">
                <div class="p-8 flex-1">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-[#064e3b] text-xl border border-slate-100">
                            @if($archive->attachment_path)
                                <i class="fas fa-file-pdf"></i>
                            @else
                                <i class="fas fa-link"></i>
                            @endif
                        </div>
                        <span class="category-tag" style="background: {{ $archive->label_color ?? '#f1f5f9' }}20; color: {{ $archive->label_color ?? '#64748b' }}">
                            {{ $archive->category }}
                        </span>
                    </div>

                    <h3 class="text-lg font-black text-[#064e3b] uppercase tracking-tight mb-2">{{ $archive->title }}</h3>
                    <p class="text-xs font-bold text-slate-400 leading-relaxed italic mb-6">"{{ Str::limit($archive->description, 100) }}"</p>

                    <div class="flex items-center gap-3 mt-auto pt-6 border-t border-slate-50">
                        <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[8px] font-black">
                            {{ substr($archive->user->name, 0, 1) }}
                        </div>
                        <span class="text-[9px] font-black text-slate-300 uppercase italic">Uploader: {{ $archive->user->name }}</span>
                    </div>
                </div>

                <div class="px-8 py-5 bg-slate-50/50 flex justify-between items-center border-t border-slate-50">
                    <span class="text-[8px] font-black uppercase tracking-widest {{ $archive->is_public ? 'text-emerald-500' : 'text-amber-500' }}">
                        <i class="fas {{ $archive->is_public ? 'fa-globe' : 'fa-lock' }} mr-1"></i>
                        {{ $archive->is_public ? 'Public Access' : 'Internal Only' }}
                    </span>

                    <div class="flex gap-2">
                        @if($archive->link_url)
                        <a href="{{ $archive->link_url }}" target="_blank" class="w-8 h-8 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-[#064e3b] hover:bg-lime-400 transition-all shadow-sm">
                            <i class="fas fa-external-link-alt text-[10px]"></i>
                        </a>
                        @endif
                        @if($archive->attachment_path)
                        <a href="{{ $archive->attachment_url }}" download class="w-8 h-8 rounded-lg bg-[#064e3b] flex items-center justify-center text-white hover:bg-black transition-all shadow-sm">
                            <i class="fas fa-download text-[10px]"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <i class="fas fa-box-open text-5xl text-slate-100 mb-4"></i>
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Belum ada arsip digital yang tersimpan.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $archives->links() }}
        </div>
    </div>
</div>
@endsection
