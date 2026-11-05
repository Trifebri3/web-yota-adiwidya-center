@php
    // Ambil Timeline Master yang aktif
    $timeline = \App\Models\Timeline::with('stages')
                ->where('status', '!=', 'completed')
                ->latest()
                ->first();
@endphp

@if($timeline)
<div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-2xl font-['Plus_Jakarta_Sans'] overflow-hidden">

    <div class="flex justify-between items-center mb-16">
        <div>
            <h3 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                {{ $timeline->title }}
            </h3>
            <div class="flex items-center gap-3 mt-4">
                <span class="bg-lime-100 text-[#064e3b] text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest">
                    {{ $timeline->category ?? 'General Program' }}
                </span>
                <span class="text-slate-300 text-[10px] font-bold italic">
                    {{ $timeline->start_date->format('M Y') }} — {{ $timeline->end_date->format('M Y') }}
                </span>
            </div>
        </div>
        <div class="text-right">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 text-right">Master Progress</p>
            <span class="text-4xl font-black text-[#064e3b]">{{ $timeline->progress_percentage }}%</span>
        </div>
    </div>

    <div class="relative pt-10 pb-20">
        <div class="absolute top-12 left-0 w-full h-1.5 bg-slate-100 rounded-full"></div>

        <div class="absolute top-12 left-0 h-1.5 bg-lime-400 rounded-full shadow-[0_0_15px_rgba(163,230,53,0.8)] transition-all duration-1000 z-10"
             style="width: {{ $timeline->progress_percentage }}%"></div>

        <div class="relative z-20 flex justify-between">
            @foreach($timeline->stages as $index => $stage)
                @php
                    $isDone = $stage->is_completed;
                    $isActive = $stage->is_active; // Menggunakan helper is_active dari model
                    $isOverdue = $stage->is_overdue; // Menggunakan helper is_overdue dari model
                @endphp

                <div class="flex flex-col items-center group relative" style="width: {{ 100 / count($timeline->stages) }}%">

                    <div class="w-6 h-6 rounded-full border-4 transition-all duration-500 relative mb-6
                        {{ $isDone ? 'bg-lime-400 border-white shadow-lg shadow-lime-200' : 'bg-white border-slate-200' }}
                        {{ $isActive ? 'scale-150 bg-[#064e3b] border-lime-400 shadow-xl z-30' : '' }}
                        {{ $isOverdue ? 'bg-red-500 border-red-100 animate-pulse' : '' }}">

                        @if($isActive)
                            <span class="absolute inset-0 rounded-full animate-ping bg-lime-400 opacity-20"></span>
                        @endif
                    </div>

                    <div class="text-center">
                        <p class="text-[8px] font-black {{ $isActive ? 'text-[#064e3b]' : 'text-slate-300' }} uppercase tracking-widest leading-none mb-2">
                            {{ $stage->start_date->format('d M') }} - {{ $stage->end_date->format('d M') }}
                        </p>
                        <h4 class="text-[10px] font-black {{ $isActive ? 'text-[#064e3b]' : ($isDone ? 'text-slate-600' : 'text-slate-400') }} uppercase tracking-tight leading-tight px-2">
                            {{ $stage->stage_name }}
                        </h4>
                    </div>

                    @if($isActive)
                        <div class="absolute top-full mt-6 bg-[#064e3b] text-white p-4 rounded-2xl shadow-2xl w-48 text-left z-50 animate-in zoom-in duration-300">
                            <p class="text-[7px] font-black text-lime-400 uppercase tracking-widest mb-2 italic">Current Focus:</p>
                            <p class="text-[10px] font-bold leading-relaxed italic">{{ $stage->task_detail ?? 'Pengerjaan termin sedang berlangsung.' }}</p>
                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-[#064e3b] rotate-45"></div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4 pt-8 border-t border-slate-50 flex items-center justify-between">
        <div class="flex gap-6">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-lime-400"></span>
                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Selesai</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-[#064e3b] border-2 border-lime-400"></span>
                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">In Progress</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-red-500 animate-pulse"></span>
                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Overdue</span>
            </div>
        </div>
        <p class="text-[9px] font-black text-slate-300 uppercase italic tracking-widest">Yota Adiwidya Center © 2026</p>
    </div>
</div>
@endif
