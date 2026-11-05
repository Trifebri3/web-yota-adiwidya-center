@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .impact-header { background: #064e3b; border-radius: 40px; padding: 60px; color: #fff; position: relative; overflow: hidden; }
    .stat-pill { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 20px; padding: 20px; }
    .story-card { background: #fff; border-radius: 30px; border-left: 6px solid #bef264; padding: 30px; border-top: 1px solid #f1f5f9; border-right: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; }
</style>

<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-6xl mx-auto">

        <div class="flex items-center gap-5 mb-10">
            <a href="{{ route('audit.impact.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#064e3b] shadow-sm hover:bg-lime-400 transition-all border border-slate-100">
                <i class="fas fa-chevron-left text-xs"></i>
            </a>
            <div>
                <h1 class="text-2xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">Impact <span class="text-slate-300">Analysis.</span></h1>
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-2 italic">Report ID: #IMP-{{ $report->id }}{{ $report->published_at->format('Y') }}</p>
            </div>
        </div>

        <div class="impact-header shadow-2xl mb-12">
            <div class="relative z-10">
                <span class="px-4 py-1.5 bg-lime-400 text-[#064e3b] rounded-lg text-[9px] font-black uppercase tracking-widest mb-6 inline-block">
                    {{ $report->category }}
                </span>
                <h2 class="text-4xl md:text-5xl font-black italic tracking-tighter leading-tight mb-8 max-w-3xl">
                    {{ $report->title['id'] }}
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 pt-10 border-t border-white/10">
                    <div>
                        <p class="text-[8px] font-black text-lime-400 uppercase tracking-widest mb-1">Impact Value</p>
                        <p class="text-2xl font-black italic">Rp{{ number_format($report->impact_value, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-[8px] font-black text-lime-400 uppercase tracking-widest mb-1">Location</p>
                        <p class="text-2xl font-black italic">{{ $report->province ?? $report->location }}</p>
                    </div>
                    <div>
                        <p class="text-[8px] font-black text-lime-400 uppercase tracking-widest mb-1">Status</p>
                        <p class="text-2xl font-black italic uppercase text-sm mt-1">
                            <i class="fas fa-check-circle mr-1"></i> Verified
                        </p>
                    </div>
                </div>
            </div>
            <i class="fas fa-chart-line absolute -bottom-10 -right-10 text-[20rem] opacity-5 rotate-12"></i>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h3 class="text-xs font-black text-[#064e3b] uppercase tracking-widest mb-6 italic">Key Statistics</h3>
                    <div class="space-y-6">
                        @foreach($report->stats_data as $stat)
                        <div class="flex justify-between items-end border-b border-slate-50 pb-4">
                            <div>
                                <p class="text-[10px] font-black text-[#064e3b] uppercase">{{ $stat['label_id'] }}</p>
                                <p class="text-[8px] font-bold text-slate-300 uppercase italic">{{ $stat['sub_id'] ?? 'Target Reached' }}</p>
                            </div>
                            <span class="text-xl font-black text-[#064e3b] italic">{{ $stat['value'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white">
                    <h3 class="text-[10px] font-black text-lime-400 uppercase tracking-widest mb-4 italic">Methodology</h3>
                    <p class="text-xs font-medium opacity-70 leading-relaxed italic">
                        {{ $report->methodology['id'] ?? 'Analisis dilakukan menggunakan sampling data penerima manfaat secara acak.' }}
                    </p>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-10">
                <div class="prose max-w-none">
                    <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter mb-4">Executive Summary</h3>
                    <p class="text-sm font-bold text-slate-500 leading-relaxed italic">
                        {{ $report->description['id'] }}
                    </p>
                </div>

                <div>
                    <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter mb-6">Impact Stories</h3>
<div class="space-y-6">
    @foreach($report->impact_stories as $story)
    <div class="story-card shadow-sm group hover:scale-[1.02] transition-all">
        {{-- Gunakan ?? untuk memberikan fallback jika key tidak ditemukan --}}
        <h5 class="text-sm font-black text-[#064e3b] uppercase mb-2">
            {{ $story['title'] ?? 'Testimoni Dampak' }}
        </h5>

        <p class="text-xs font-bold text-slate-500 italic leading-relaxed">
            {{-- Bagian ini yang bikin error tadi, sekarang kita amanin --}}
            "{{ $story['content'] ?? $story['description'] ?? 'Tidak ada detail cerita.' }}"
        </p>

        <div class="mt-4 text-[9px] font-black text-slate-300 uppercase italic">
            — {{ $story['author'] ?? $story['name'] ?? 'Beneficiary' }}
        </div>
    </div>
    @endforeach
</div>
                </div>

                @if($report->pdf_path)
                <div class="pt-10">
                    <a href="{{ asset('storage/' . $report->pdf_path) }}" target="_blank" class="w-full bg-white border-2 border-dashed border-slate-200 p-8 rounded-[2.5rem] flex flex-col items-center justify-center hover:border-lime-400 transition-all group">
                        <i class="fas fa-file-pdf text-3xl text-slate-200 group-hover:text-red-500 mb-3 transition-colors"></i>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Download Full Audit PDF</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
