@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .timeline-container { position: relative; padding-left: 50px; }
    .timeline-line-vertical { position: absolute; left: 19px; top: 0; bottom: 0; width: 2px; background: #f1f5f9; z-index: 1; }
    .stage-node {
        position: absolute; left: 0; width: 40px; height: 40px;
        border-radius: 14px; display: flex; align-items: center; justify-content: center;
        z-index: 2; border: 4px solid #fff; transition: all 0.3s ease;
    }
    .stage-card {
        background: #fff; border-radius: 28px; border: 1px solid #f1f5f9;
        padding: 25px; transition: all 0.3s ease; margin-bottom: 30px;
    }
    .stage-card:hover { transform: translateX(10px); border-color: #bef264; }
</style>

<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-5xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div class="flex items-center gap-6">
                <a href="{{ route('audit.resources.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#064e3b] shadow-sm hover:bg-[#064e3b] hover:text-white transition-all border border-slate-100">
                    <i class="fas fa-chevron-left text-xs"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                        Project <span class="text-slate-300">Milestones.</span>
                    </h1>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mt-3 italic">{{ $timeline->title }}</p>
                </div>
            </div>

            <div class="bg-white px-6 py-4 rounded-3xl border border-slate-100 shadow-sm text-right">
                <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest mb-1">Overall Completion</p>
                <p class="text-2xl font-black text-[#064e3b] leading-none">{{ $timeline->progress_percentage }}%</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm mb-12">
            <h3 class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] mb-4 italic">Strategic Objectives</h3>
            <p class="text-sm font-bold text-slate-600 leading-relaxed italic">"{{ $timeline->description }}"</p>
            <div class="mt-6 flex gap-6">
                <div>
                    <span class="text-[8px] font-black text-slate-300 uppercase block">Launch Date</span>
                    <span class="text-[11px] font-black text-[#064e3b]">{{ $timeline->start_date->format('d M Y') }}</span>
                </div>
                <div>
                    <span class="text-[8px] font-black text-slate-300 uppercase block">Target Deadline</span>
                    <span class="text-[11px] font-black text-red-500">{{ $timeline->end_date->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <div class="timeline-container">
            <div class="timeline-line-vertical"></div>

            @forelse($timeline->stages as $index => $stage)
            <div class="relative pl-12">
                <div class="stage-node {{ $stage->is_completed ? 'bg-[#064e3b] text-lime-400' : 'bg-slate-100 text-slate-300' }}">
                    @if($stage->is_completed)
                        <i class="fas fa-check text-xs"></i>
                    @else
                        <span class="text-[10px] font-black">{{ $index + 1 }}</span>
                    @endif
                </div>

                <div class="stage-card shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="text-sm font-black text-[#064e3b] uppercase tracking-tight">{{ $stage->title }}</h4>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $stage->due_date ? 'Deadline: ' . $stage->due_date->format('d M Y') : 'No Deadline' }}</p>
                        </div>
                        <span class="px-4 py-1.5 rounded-xl text-[8px] font-black uppercase tracking-widest {{ $stage->is_completed ? 'bg-lime-100 text-lime-700' : 'bg-slate-100 text-slate-400' }}">
                            {{ $stage->is_completed ? 'Finished' : 'On Progress' }}
                        </span>
                    </div>
                    <p class="text-xs font-medium text-slate-500 leading-relaxed">{{ $stage->description }}</p>
                </div>
            </div>
            @empty
            <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200">
                <i class="fas fa-layer-group text-3xl text-slate-200 mb-4"></i>
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">No milestones defined for this timeline yet.</p>
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
