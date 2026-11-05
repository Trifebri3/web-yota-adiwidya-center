@extends('direktur.layouts.app')

@section('content')

<div class="space-y-4">
    @include('partials.birthday_alert')
</div>

<div class="p-8 bg-[#FDFDFB] min-h-screen">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div>
            <h1 class="text-4xl font-black text-[#064e3b] uppercase tracking-tighter italic font-serif">
                Executive <span class="text-lime-500 not-italic">Overview</span>
            </h1>
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.3em]">
                Monitoring System — {{ now()->format('D, d M Y') }}
            </p>
        </div>

        <div class="flex gap-3">
            <button onclick="window.print()" class="bg-white border border-slate-200 px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-sm hover:bg-slate-50 transition-all">
                Export Report
            </button>
            <div class="bg-lime-400 p-1 rounded-2xl flex items-center px-4 gap-3 shadow-lg shadow-lime-200">
                <span class="w-3 h-3 bg-[#064e3b] rounded-full animate-pulse"></span>
                <span class="text-[10px] font-black text-[#064e3b] uppercase tracking-widest italic">Live Data</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm group hover:border-lime-400 transition-all">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Total Timelines</p>
            <div class="flex items-end justify-between">
                <h2 class="text-5xl font-black text-[#064e3b]">{{ \App\Models\Timeline::count() }}</h2>
                <span class="text-lime-600 font-bold text-[10px] uppercase mb-2">Projects</span>
            </div>
        </div>

        @php
            $totalTasks = \App\Models\Task::count();
            $completedTasks = \App\Models\Task::where('status', 'completed')->count();
            $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
        @endphp
        <div class="bg-[#064e3b] p-8 rounded-[3rem] shadow-xl relative overflow-hidden group">
            <p class="text-[10px] font-black text-white/50 uppercase tracking-widest mb-4 text-center">Task Completion Rate</p>
            <div class="relative w-24 h-24 mx-auto">
                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                    <path class="text-white/10" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <path class="text-lime-400" stroke-width="3" stroke-dasharray="{{ $completionRate }}, 100" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                </svg>
                <div class="absolute inset-0 flex items-center justify-center font-black text-xl text-white">{{ $completionRate }}%</div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Active Delegations</p>
            <h2 class="text-5xl font-black text-[#064e3b]">{{ \App\Models\Delegation::where('status', '!=', 'completed')->count() }}</h2>
            <p class="text-[9px] font-bold text-slate-400 uppercase mt-2">Personal Mandates</p>
        </div>

        @php
            $overdueTasks = \App\Models\Task::where('status', '!=', 'completed')->where('deadline', '<', now())->count();
        @endphp
        <div class="bg-red-50 p-8 rounded-[3rem] border border-red-100 shadow-sm group">
            <p class="text-[10px] font-black text-red-400 uppercase tracking-widest mb-4 italic {{ $overdueTasks > 0 ? 'animate-pulse' : '' }}">Critical Issues</p>
            <h2 class="text-5xl font-black {{ $overdueTasks > 0 ? 'text-red-600' : 'text-slate-300' }}">{{ sprintf('%02d', $overdueTasks) }}</h2>
            <p class="text-[10px] font-bold text-red-400 uppercase mt-2 italic">Overdue Deadlines</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-8">

            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100">
                <h3 class="text-sm font-black text-[#064e3b] uppercase tracking-widest mb-10">Division Performance Matrix</h3>
                <div class="space-y-8">
                    @foreach(\App\Models\Division::all() as $division)
                        @php
                            $divTasks = $division->tasks()->count();
                            $divDone = $division->tasks()->where('status', 'completed')->count();
                            $percent = $divTasks > 0 ? ($divDone / $divTasks) * 100 : 0;
                        @endphp
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-[11px] font-black text-[#064e3b] uppercase">{{ $division->name }}</span>
                                <span class="text-[10px] font-black text-slate-400">{{ round($percent) }}% Efficiency</span>
                            </div>
                            <div class="w-full bg-slate-50 h-4 rounded-full overflow-hidden flex">
                                <div class="bg-gradient-to-r from-lime-400 to-lime-500 h-full rounded-full transition-all duration-1000" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100">
                <h3 class="text-sm font-black text-[#064e3b] uppercase tracking-widest mb-10">Recent Activity Log</h3>
                <div class="space-y-8 relative before:absolute before:inset-0 before:left-3 before:w-[1px] before:bg-slate-100">
                    @foreach(\App\Models\Delegation::with('user')->latest()->take(3)->get() as $log)
                        <div class="relative pl-10">
                            <span class="absolute left-0 top-1 w-6 h-6 {{ $log->status == 'completed' ? 'bg-lime-500' : 'bg-blue-500' }} rounded-full border-4 border-white"></span>
                            <p class="text-[10px] font-black text-slate-400 uppercase">{{ $log->updated_at->diffForHumans() }}</p>
                            <h4 class="text-sm font-bold text-[#064e3b] uppercase">{{ $log->user->name }} — {{ $log->title }} ({{ $log->status }})</h4>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-8">

            <div class="bg-[#064e3b] p-10 rounded-[3rem] text-white shadow-2xl relative overflow-hidden">
                <h3 class="text-xs font-black uppercase tracking-widest mb-8 text-lime-400">Waiting For Review</h3>
                <div class="space-y-6">
                    @foreach(\App\Models\Task::where('status', 'submitted')->take(2)->get() as $task)
                        <div class="border-l-2 border-lime-400 pl-4 py-1">
                            <p class="text-[9px] font-black text-white/40 uppercase mb-1">From: {{ $task->division->name }}</p>
                            <h4 class="text-sm font-bold italic leading-tight">{{ $task->title }}</h4>
                            <a href="{{ route('direktur.task.show', $task->id) }}" class="inline-block mt-2 text-[8px] font-black uppercase text-lime-400 underline">Review Now</a>
                        </div>
                    @endforeach

                    @if(\App\Models\Task::where('status', 'submitted')->count() == 0)
                        <p class="text-[10px] italic text-white/30 uppercase">No tasks pending review.</p>
                    @endif
                </div>
                <div class="absolute -right-10 -bottom-10 opacity-10">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                </div>
            </div>

            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6 italic">Next Agendas</h3>

                @foreach(\App\Models\Agenda::where('start_time', '>=', now())->orderBy('start_time', 'asc')->take(2)->get() as $agenda)
                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-[2rem] mb-4 hover:bg-lime-50 transition-colors">
                        @php $dt = \Carbon\Carbon::parse($agenda->start_time); @endphp
                        <div class="bg-[#064e3b] text-white w-12 h-12 rounded-2xl flex flex-col items-center justify-center shrink-0">
                            <span class="text-[8px] font-bold uppercase">{{ $dt->format('M') }}</span>
                            <span class="text-lg font-black">{{ $dt->format('d') }}</span>
                        </div>
                        <div>
                            <h4 class="text-[11px] font-black text-[#064e3b] uppercase tracking-tight">{{ Str::limit($agenda->title, 20) }}</h4>
                            <p class="text-[9px] text-slate-400 font-bold">
                                {{ $dt->format('H:i') }} WIB — <span class="text-lime-600 italic">{{ $agenda->method }}</span>
                            </p>
                        </div>
                    </div>
                @endforeach

                @if(\App\Models\Agenda::where('start_time', '>=', now())->count() == 0)
                    <p class="text-[10px] text-slate-300 uppercase text-center py-4">Belum ada agenda mendatang.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="w-full space-y-8 mt-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-8">
        @include('partials.mini-calendar')
    </div>
        <div class="mt-12">
    @include('partials.program-roadmap')
</div>
    <div class="px-8 pb-12">
        @include('partials.birthdaycalendar')
    </div>
</div>

@endsection
