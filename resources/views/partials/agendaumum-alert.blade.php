@php
    // Mencari agenda umum hari ini
    $todayAgendas = \App\Models\Agenda::whereDate('start_time', \Carbon\Carbon::today())
        ->orderBy('start_time', 'asc')
        ->get();
@endphp

@if($todayAgendas->count() > 0)
    <div class="max-w-5xl mx-auto mb-10 px-4 md:px-0">
        <div class="relative p-[2px] overflow-hidden rounded-[2.5rem] bg-gradient-to-r from-lime-400 via-yellow-400 to-emerald-500 animate-gradient-x shadow-[0_20px_50px_rgba(132,204,22,0.3)]">

            <div class="bg-[#064e3b] rounded-[2.4rem] p-8 relative overflow-hidden group">

                <div class="absolute -top-24 -left-24 w-64 h-64 bg-lime-500/20 rounded-full blur-[80px] group-hover:bg-lime-500/30 transition-all duration-700"></div>
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-emerald-500/20 rounded-full blur-[80px]"></div>

                <div class="flex flex-col lg:flex-row items-center justify-between gap-8 relative z-10">

                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <div class="w-20 h-20 bg-gradient-to-br from-lime-400 to-lime-600 rounded-[1.8rem] flex items-center justify-center shadow-[0_10px_30px_rgba(163,230,53,0.4)] transform -rotate-6 group-hover:rotate-0 transition-transform duration-500">
                                <svg class="w-10 h-10 text-[#064e3b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="absolute -top-2 -right-2 flex h-6 w-6">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-lime-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-6 w-6 bg-lime-500 border-4 border-[#064e3b] items-center justify-center text-[8px] font-black text-[#064e3b]">{{ $todayAgendas->count() }}</span>
                            </span>
                        </div>

                        <div>
                            <h4 class="text-3xl font-black text-white uppercase italic tracking-tighter leading-none">
                                Attention <span class="text-lime-400">Required!</span>
                            </h4>
                            <p class="text-lime-400/80 text-xs font-black uppercase tracking-[0.3em] mt-2 flex items-center gap-2">
                                <span class="w-8 h-[2px] bg-lime-400"></span>
                                Agenda Penting Hari Ini
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 overflow-x-auto pb-2 lg:pb-0 w-full lg:w-auto no-scrollbar">
                        @foreach($todayAgendas->take(2) as $today)
                            <div class="min-w-[180px] p-4 bg-white/5 backdrop-blur-xl border border-white/10 rounded-[1.5rem] hover:bg-white/10 transition-colors">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="w-2 h-2 rounded-full bg-lime-400 animate-pulse"></span>
                                    <span class="text-lime-400 font-black text-[10px] uppercase">{{ \Carbon\Carbon::parse($today->start_time)->format('H:i') }} WIB</span>
                                </div>
                                <p class="text-white text-sm font-bold truncate">{{ $today->title }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="shrink-0 w-full lg:w-auto">
                        <a href="{{ route('user.agendas') }}"
                           class="group/btn relative inline-flex items-center justify-center w-full lg:w-auto px-10 py-5 bg-lime-500 hover:bg-white text-[#064e3b] rounded-2xl font-black uppercase text-xs tracking-[0.2em] transition-all duration-300 shadow-[0_15px_30px_rgba(163,230,53,0.3)] hover:-translate-y-1">
                            Check Schedule
                            <svg class="w-4 h-4 ml-2 group-hover/btn:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes gradient-x {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .animate-gradient-x {
            background-size: 200% 200%;
            animation: gradient-x 3s linear infinite;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endif
