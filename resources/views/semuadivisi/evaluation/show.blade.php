@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-10">
    <div class="max-w-4xl mx-auto">

        <a href="{{ route('evaluation.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#064e3b] mb-10 transition-all">
            <i class="fas fa-chevron-left"></i> Kembali ke Daftar
        </a>

        <div class="bg-white rounded-[3.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative">
            <div class="h-4 w-full bg-gradient-to-r from-lime-400 via-[#064e3b] to-emerald-900"></div>

            <div class="p-10 md:p-20">
                <div class="text-center mb-16">
                    <div class="flex justify-center gap-3 mb-8">
                        @if($evaluation->type == 'user')
                            <span class="px-6 py-2 bg-red-50 text-red-600 rounded-xl text-[10px] font-black uppercase tracking-[0.3em] border border-red-100">Private Appraisal</span>
                        @else
                            <span class="px-6 py-2 bg-emerald-50 text-emerald-600 rounded-xl text-[10px] font-black uppercase tracking-[0.3em] border border-emerald-100">Division Appraisal</span>
                        @endif
                    </div>

                    <h1 class="text-4xl md:text-6xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-none mb-10">
                        {{ $evaluation->title }}
                    </h1>

                    <div class="flex flex-wrap items-center justify-center gap-6 text-slate-400 text-[11px] font-bold uppercase tracking-widest">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-lime-500"></i> {{ $evaluation->created_at->format('d M Y') }}
                        </div>
                        <div class="w-1.5 h-1.5 bg-slate-200 rounded-full"></div>
                        <div class="flex items-center gap-2 text-[#064e3b]">
                            <i class="fas fa-user-tie"></i> From: {{ $evaluation->author->name }}
                        </div>
                    </div>
                </div>

                <div class="prose prose-xl prose-slate max-w-none mb-20
                            prose-headings:text-[#064e3b] prose-headings:font-black
                            prose-p:text-slate-600 prose-p:leading-relaxed prose-p:font-light
                            prose-blockquote:border-l-4 prose-blockquote:border-lime-500 prose-blockquote:bg-slate-50 prose-blockquote:rounded-r-2xl prose-blockquote:py-4">
                    {!! nl2br($evaluation->content) !!}
                </div>

                <div class="pt-12 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($evaluation->author->name) }}&background=064e3b&color=BEF264" class="w-14 h-14 rounded-2xl shadow-lg">
                        <div class="text-left">
                            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest leading-none mb-1">Divalidasi Oleh</p>
                            <p class="text-lg font-black text-[#064e3b] italic leading-none">{{ $evaluation->author->name }}</p>
                            <p class="text-[9px] font-bold text-lime-600 uppercase mt-1 tracking-widest">Director of Yota Adiwidya Center</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button onclick="window.print()" class="px-8 py-4 bg-slate-50 text-slate-400 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-[#064e3b] hover:text-white transition-all">
                            <i class="fas fa-print me-2"></i> Print Archive
                        </button>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-lime-500/20 to-transparent"></div>
        </div>
    </div>
</div>
@endsection
