@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-10">
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('timeline.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#064e3b] mb-12 transition-all">
            <i class="fas fa-arrow-left"></i> Back to Masterplan
        </a>

        <div class="mb-16">
            <h1 class="text-4xl md:text-5xl font-black text-[#064e3b] uppercase italic tracking-tighter mb-4">{{ $timeline->title }}</h1>
            <p class="text-slate-500 font-medium leading-relaxed">{{ $timeline->description }}</p>
        </div>

        <div class="relative pl-8 md:pl-12 border-l-2 border-slate-100 ml-4 space-y-12">
            @foreach($timeline->stages as $stage)
            <div class="relative">
                <div class="absolute -left-[41px] md:-left-[53px] top-0 w-6 h-6 rounded-full border-4 border-white shadow-lg {{ $stage->is_completed ? 'bg-lime-400' : 'bg-slate-200' }}"></div>

                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                    <div class="flex flex-wrap justify-between items-start gap-4 mb-4">
                        <div>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Termin 0{{ $loop->iteration }}</span>
                            <h4 class="text-xl font-black text-[#064e3b] uppercase italic">{{ $stage->stage_name }}</h4>
                        </div>
                        <div class="px-4 py-1.5 rounded-lg {{ $stage->is_completed ? 'bg-lime-50 text-lime-600' : 'bg-slate-50 text-slate-400' }} text-[9px] font-black uppercase">
                            {{ $stage->is_completed ? 'Completed' : 'Upcoming' }}
                        </div>
                    </div>

                    <p class="text-sm text-slate-500 mb-6 font-medium">{{ $stage->task_detail }}</p>

                    <div class="flex gap-6 pt-6 border-t border-slate-50">
                        <div class="text-[9px] font-black uppercase text-slate-400">
                            Duration: <span class="text-[#064e3b] ml-1">{{ $stage->start_date->format('d M') }} - {{ $stage->end_date->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
