@php
    $user = Auth::user();
    $month = request('month', now()->month);
    $year = request('year', now()->year);
    $date = \Carbon\Carbon::create($year, $month, 1);

    $startOfCalendar = $date->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
    $endOfCalendar = $date->copy()->endOfMonth()->endOfWeek(\Carbon\Carbon::SUNDAY);

    $generalAgendas = \App\Models\Agenda::whereMonth('start_time', $month)->whereYear('start_time', $year)
                        ->get()->groupBy(fn($q) => $q->start_time->format('Y-m-d'));

    $divisionAgendas = \App\Models\DivisionAgenda::where('division_id', $user->division_id)
                        ->whereMonth('start_time', $month)->whereYear('start_time', $year)
                        ->get()->groupBy(fn($q) => $q->start_time->format('Y-m-d'));
@endphp

<div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-2xl font-['Plus_Jakarta_Sans']">
    <div class="flex items-center justify-between mb-10">
        <div>
            <h3 class="text-2xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none flex items-center gap-3">
                <i class="fas fa-calendar-day text-lime-500"></i>
               {{ $user->division->name ?? 'GENERAL' }} <span class="text-slate-200">HUB</span>
            </h3>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mt-3">{{ $date->format('F Y') }}</p>
        </div>
        <div class="flex gap-2">
            <button class="w-10 h-10 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center text-[#064e3b] hover:bg-lime-400 transition-all shadow-sm">
                <i class="fas fa-chevron-left text-[10px]"></i>
            </button>
            <button class="w-10 h-10 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center text-[#064e3b] hover:bg-lime-400 transition-all shadow-sm">
                <i class="fas fa-chevron-right text-[10px]"></i>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-7 gap-y-4 text-center mb-10">
        @foreach(['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'] as $day)
            <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-4">{{ $day }}</span>
        @endforeach

        @while($startOfCalendar <= $endOfCalendar)
            @php
                $dayStr = $startOfCalendar->format('Y-m-d');
                $isCurrentMonth = $startOfCalendar->month == $month;
                $isToday = $startOfCalendar->isToday();
                $hasGen = $generalAgendas->has($dayStr);
                $hasDiv = $divisionAgendas->has($dayStr);
            @endphp

            <div class="relative py-4 flex flex-col items-center group cursor-pointer transition-all">
                @if($isToday)
                    <div class="absolute inset-0 mx-auto w-11 h-11 bg-[#064e3b] rounded-[18px] -mt-1 shadow-xl shadow-emerald-900/30 border-2 border-lime-400 z-0"></div>
                @elseif($hasGen && $hasDiv)
                    <div class="absolute inset-0 mx-auto w-10 h-10 bg-slate-50 rounded-2xl -mt-0.5 border-2 border-dashed border-slate-200 opacity-50"></div>
                @endif

                <span class="relative text-[13px] font-black z-10
                    {{ $isCurrentMonth ? 'text-slate-700' : 'text-slate-200' }}
                    {{ $isToday ? 'text-white' : '' }}">
                    {{ $startOfCalendar->day }}
                </span>

                <div class="absolute bottom-1.5 flex flex-col items-center gap-1 z-20 w-full px-2">
                    @if($hasGen)
                        <div class="w-full max-w-[18px] h-[3px] bg-lime-400 rounded-full shadow-[0_0_8px_rgba(163,230,53,0.8)]"></div>
                    @endif

                    @if($hasDiv)
                        <div class="flex gap-0.5">
                            @foreach($divisionAgendas[$dayStr] as $divItem)
                                <span class="w-1.5 h-1.5 rounded-full ring-1 ring-white" style="background: {{ $divItem->color ?? '#3b82f6' }}"></span>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if($hasGen || $hasDiv)
                <div class="absolute bottom-full mb-4 hidden group-hover:block z-[99] w-56 bg-[#064e3b] shadow-2xl rounded-3xl overflow-hidden animate-in fade-in zoom-in duration-200">
                    <div class="p-4 border-b border-white/10 bg-black/20">
                        <p class="text-[9px] font-black text-lime-400 uppercase tracking-widest italic leading-none">{{ $startOfCalendar->format('l, d M') }}</p>
                    </div>
                    <div class="p-4 space-y-4">
                        @if($hasGen)
                            <div>
                                <p class="text-[7px] font-black text-white/40 uppercase mb-2 tracking-widest">General Events</p>
                                @foreach($generalAgendas[$dayStr] as $g)
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-1 h-3 bg-lime-400 rounded-full"></div>
                                        <p class="text-[10px] font-black text-white uppercase leading-tight tracking-tight">{{ $g->title }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if($hasDiv)
                            <div>
                                <p class="text-[7px] font-black text-white/40 uppercase mb-2 tracking-widest">Division Task</p>
                                @foreach($divisionAgendas[$dayStr] as $d)
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-1 h-3 rounded-full" style="background: {{ $d->color }}"></div>
                                        <p class="text-[10px] font-black text-slate-300 uppercase leading-tight tracking-tight">{{ $d->title }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            @php $startOfCalendar->addDay(); @endphp
        @endwhile
    </div>

    <div class="flex items-center justify-between pt-8 border-t border-slate-100">
        <div class="flex gap-6">
            <div class="flex items-center gap-3">
                <div class="w-4 h-1 bg-lime-400 rounded-full shadow-[0_0_8px_rgba(163,230,53,0.8)]"></div>
                <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest italic">General</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-2 h-2 bg-blue-500 rounded-full ring-2 ring-blue-100"></div>
                <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest italic">Internal Divisi</span>
            </div>
        </div>
        <div class="hidden md:block">
             <span class="text-[9px] font-black text-slate-300 uppercase italic">Yota Adiwidya Center © 2026</span>
        </div>
    </div>
</div>
