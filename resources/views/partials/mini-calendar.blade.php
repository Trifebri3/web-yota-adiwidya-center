@php
    // Ambil bulan & tahun dari request untuk navigasi
    $month = request('month', now()->month);
    $year = request('year', now()->year);
    $date = \Carbon\Carbon::create($year, $month, 1);

    $startOfCalendar = $date->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
    $endOfCalendar = $date->copy()->endOfMonth()->endOfWeek(\Carbon\Carbon::SUNDAY);

    $agendas = \App\Models\Agenda::whereMonth('start_time', $month)
                ->whereYear('start_time', $year)
                ->get()
                ->groupBy(fn($q) => $q->start_time->format('Y-m-d'));

    // URL Navigasi
    $prevMonth = $date->copy()->subMonth();
    $nextMonth = $date->copy()->addMonth();
@endphp

<div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-[0_20px_50px_rgba(0,0,0,0.02)] font-['Plus_Jakarta_Sans'] relative overflow-hidden">

    <div class="absolute -top-10 -right-10 w-40 h-40 bg-lime-50 rounded-full blur-3xl opacity-50"></div>

    <div class="mb-10">
        <h2 class="text-[10px] font-black text-lime-500 uppercase tracking-[0.4em] mb-2">Internal Schedule</h2>
        <div class="flex items-end justify-between">
            <h1 class="text-4xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                Monthly <span class="text-slate-300">Agenda.</span>
            </h1>

            <div class="flex gap-3">
                <a href="?month={{ $prevMonth->month }}&year={{ $prevMonth->year }}"
                   class="w-10 h-10 rounded-2xl bg-slate-50 flex items-center justify-center text-[#064e3b] hover:bg-[#064e3b] hover:text-white transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <a href="?month={{ $nextMonth->month }}&year={{ $nextMonth->year }}"
                   class="w-10 h-10 rounded-2xl bg-slate-50 flex items-center justify-center text-[#064e3b] hover:bg-[#064e3b] hover:text-white transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-4 mb-8">
        <div class="px-6 py-2 bg-[#064e3b] rounded-full">
            <span class="text-xs font-black text-white uppercase tracking-widest">{{ $date->format('F') }}</span>
        </div>
        <span class="text-sm font-bold text-slate-300 tracking-widest">{{ $year }}</span>
    </div>

    <div class="grid grid-cols-7 gap-y-6 text-center">
        @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $day }}</span>
        @endforeach

        @while($startOfCalendar <= $endOfCalendar)
            @php
                $isCurrentMonth = $startOfCalendar->month == $month;
                $isToday = $startOfCalendar->isToday();
                $dateKey = $startOfCalendar->format('Y-m-d');
                $hasAgenda = $agendas->has($dateKey);
            @endphp

            <div class="relative py-3 flex flex-col items-center group">
                <div class="absolute inset-0 mx-auto w-10 h-10 rounded-2xl bg-slate-50 opacity-0 group-hover:opacity-100 transition-all duration-300 -mt-1"></div>

                <span class="relative text-[12px] font-bold z-10 transition-colors duration-300
                    {{ $isCurrentMonth ? 'text-slate-700' : 'text-slate-200' }}
                    {{ $isToday ? 'text-white' : '' }}">
                    {{ $startOfCalendar->day }}
                </span>

                @if($isToday)
                    <div class="absolute inset-0 mx-auto w-10 h-10 bg-[#064e3b] rounded-2xl -mt-1 shadow-lg shadow-[#064e3b]/20 transition-all group-hover:scale-110"></div>
                @endif

                @if($hasAgenda)
                    <div class="absolute bottom-0 w-1.5 h-1.5 bg-lime-500 rounded-full ring-4 ring-white"></div>

                    <div class="absolute bottom-full mb-4 hidden group-hover:block z-[100] w-48 bg-slate-900 rounded-2xl p-4 shadow-2xl scale-in-center">
                        <div class="text-[8px] font-black text-lime-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                            <span class="w-4 h-[1px] bg-lime-400"></span> {{ $startOfCalendar->format('d M') }}
                        </div>
                        @foreach($agendas[$dateKey] as $a)
                            <div class="text-[10px] text-white font-medium leading-tight mb-2 last:mb-0">
                                • {{ Str::limit($a->title, 30) }}
                            </div>
                        @endforeach
                        <div class="absolute top-full left-1/2 -translate-x-1/2 border-8 border-transparent border-t-slate-900"></div>
                    </div>
                @endif
            </div>

            @php $startOfCalendar->addDay(); @endphp
        @endwhile
    </div>

    <div class="mt-10 pt-8 border-t border-slate-50 flex items-center justify-between">
        <div class="flex gap-6">
            <div class="flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-lime-500 shadow-sm shadow-lime-500/50"></span>
                <span class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em]">Planned Events</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-[#064e3b]"></span>
                <span class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em]">Current Date</span>
            </div>
        </div>
        <a href="{{ route('user.agendas') }}" class="group flex items-center gap-3">
            <span class="text-[10px] font-black text-[#064e3b] uppercase tracking-widest">Full Schedule</span>
            <div class="w-8 h-8 rounded-xl bg-lime-50 flex items-center justify-center text-[#064e3b] group-hover:bg-lime-500 group-hover:text-white transition-all duration-300">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </div>
        </a>
    </div>
</div>

<style>
    .scale-in-center {
        animation: scale-in-center 0.2s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }
    @keyframes scale-in-center {
        0% { transform: scale(0.5); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>
