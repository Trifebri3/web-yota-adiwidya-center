@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-10 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">
        <div class="max-w-3xl mb-16">
            <h1 class="text-6xl md:text-8xl font-black text-[#064e3b] tracking-tighter leading-[0.9]">
                The <br><span class="text-lime-500">Appraisal.</span>
            </h1>
            <p class="mt-8 text-xl text-slate-500 font-light leading-relaxed italic">
                Catatan evaluasi, apresiasi, dan arahan strategis langsung dari jajaran Direktur Yota Adiwidya Center.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($evaluations as $eval)
            <div class="group relative bg-white border border-slate-100 rounded-[2.5rem] p-8 hover:shadow-2xl transition-all duration-500 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 opacity-[0.03] group-hover:opacity-[0.07] transition-opacity">
                    <i class="fas fa-quote-right text-9xl"></i>
                </div>

                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        @if($eval->type == 'user')
                            <span class="px-4 py-1.5 bg-red-50 text-red-600 rounded-full text-[9px] font-black uppercase tracking-widest border border-red-100">
                                <i class="fas fa-user-lock me-1"></i> Personal
                            </span>
                        @else
                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-black uppercase tracking-widest border border-emerald-100">
                                <i class="fas fa-users me-1"></i> Team: {{ $eval->division->name }}
                            </span>
                        @endif

                        <div class="text-right">
                            <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest mb-1">Diterbitkan</p>
                            <p class="text-[10px] font-bold text-slate-500">{{ $eval->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <a href="{{ route('evaluation.show', $eval->id) }}" class="block group-hover:translate-x-2 transition-transform duration-300">
                        <h3 class="text-2xl font-black text-[#064e3b] leading-tight mb-4 uppercase italic tracking-tighter">
                            {{ $eval->title }}
                        </h3>
                    </a>

                    <div class="flex items-center gap-2 mb-8">
                        @php
                            $labels = [
                                'praise' => ['bg' => 'bg-lime-400', 'text' => 'text-[#064e3b]', 'icon' => 'fa-star', 'label' => 'Apresiasi'],
                                'warning' => ['bg' => 'bg-red-500', 'text' => 'text-white', 'icon' => 'fa-exclamation-triangle', 'label' => 'Peringatan'],
                                'improvement' => ['bg' => 'bg-[#064e3b]', 'text' => 'text-lime-400', 'icon' => 'fa-rocket', 'label' => 'Perbaikan'],
                                'general' => ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'icon' => 'fa-info-circle', 'label' => 'Umum'],
                            ];
                            $style = $labels[$eval->label] ?? $labels['general'];
                        @endphp
                        <div class="{{ $style['bg'] }} {{ $style['text'] }} px-4 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest flex items-center gap-2">
                            <i class="fas {{ $style['icon'] }}"></i> {{ $style['label'] }}
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-50 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($eval->author->name) }}&background=064e3b&color=BEF264" class="w-6 h-6 rounded-md">
                            <span class="text-[9px] font-black text-[#064e3b] uppercase">{{ $eval->author->name }}</span>
                        </div>
                        <a href="{{ route('evaluation.show', $eval->id) }}" class="text-[9px] font-black uppercase tracking-widest text-slate-400 hover:text-lime-600 flex items-center gap-2">
                            Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                <i class="fas fa-clipboard-check text-4xl text-slate-200 mb-4"></i>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-sm">Belum ada catatan evaluasi untuk Anda.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $evaluations->links() }}
        </div>
    </div>
</div>
@endsection
