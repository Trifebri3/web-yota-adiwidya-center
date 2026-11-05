@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] p-4 md:p-10">
    <div class="max-w-6xl mx-auto">

        <div class="mb-12">
            <h1 class="text-5xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-none">
                Official <span class="text-lime-500">Bulletins.</span>
            </h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mt-4">Pusat Informasi & Instruksi Direksi</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($announcements as $item)
                @php
                    $colors = [
                        'urgent' => ['bg' => 'bg-red-600', 'text' => 'text-white'],
                        'high'   => ['bg' => 'bg-orange-500', 'text' => 'text-white'],
                        'medium' => ['bg' => 'bg-blue-500', 'text' => 'text-white'],
                        'low'    => ['bg' => 'bg-slate-500', 'text' => 'text-white'],
                    ][$item->priority] ?? ['bg' => 'bg-slate-500', 'text' => 'text-white'];
                @endphp

                {{-- Link dibungkus ke seluruh card agar user experience lebih mudah --}}
                <div class="bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 group relative flex flex-col">
                    
                    <div class="h-2 {{ $colors['bg'] }}"></div>

                    <div class="p-8 flex-1">
                        <div class="flex justify-between items-start mb-6">
                            <span class="{{ $colors['bg'] }} {{ $colors['text'] }} px-4 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">
                                {{ $item->priority }}
                            </span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                                {{ $item->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <h2 class="text-2xl font-black text-[#064e3b] uppercase italic leading-tight mb-4 group-hover:text-lime-600 transition-colors">
                            {{ $item->title }}
                        </h2>

                        <div class="text-slate-600 text-sm leading-relaxed mb-6 line-clamp-3 font-medium">
                            {{ strip_tags($item->content) }}
                        </div>

                        <div class="flex items-center gap-4 pt-6 border-t border-dashed border-slate-100">
                            <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center font-black text-[#064e3b] text-xs">
                                {{ substr($item->author->name, 0, 2) }}
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase text-[#064e3b] leading-none">{{ $item->author->name }}</p>
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Direktur Utama</p>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol sekarang menggunakan tag <a> ke route show --}}
                    <a href="{{ route('announcements.show', $item->id) }}" 
                       class="w-full py-4 bg-slate-50 border-t border-slate-100 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:bg-[#064e3b] hover:text-white transition-all text-center block">
                        Baca Selengkapnya
                    </a>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-[3rem] border-4 border-dashed border-slate-100">
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.5em]">Belum Ada Pengumuman Baru</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $announcements->links() }}
        </div>
    </div>
</div>
@endsection