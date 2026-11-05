@extends('anggota.layouts.app')

@section('content')
<style>
    .member-card {
        background: #ffffff;
        border-radius: 30px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .member-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(6, 78, 59, 0.05);
    }
    .status-dot {
        width: 8px; height: 8px; border-radius: 50%; display: inline-block;
    }
    .progress-bar {
        height: 6px; border-radius: 10px; background: #f1f5f9; overflow: hidden;
    }
    .progress-fill {
        height: 100%; background: #064e3b; border-radius: 10px;
    }
</style>

<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="space-y-4 mb-8">
            @include('partials.birthday_alert')
            @include('partials.agendaumum-alert')
        </div>

        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <span class="text-[10px] font-black text-lime-600 uppercase tracking-[0.5em] block mb-3">
                    Personal Workspace
                </span>
                <h1 class="text-6xl font-black text-[#064e3b] tracking-tighter uppercase leading-none">
                    Hello, <span class="italic font-serif text-slate-300">{{ explode(' ', Auth::user()->name)[0] }}.</span>
                </h1>
            </div>

            <div class="bg-white px-6 py-4 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-4">
<div class="text-right">
    <p class="text-[8px] font-black text-slate-400 uppercase">Division Rank</p>
    <p class="text-xs font-black text-[#064e3b] uppercase">
        {{ Auth::user()->division->name ?? 'No Division' }} Member
    </p>
</div>
                <div class="w-10 h-10 bg-[#064e3b] text-lime-400 rounded-2xl flex items-center justify-center font-black">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            @php
                $pendingKabid = \App\Models\KabidTask::where('user_id', Auth::id())->where('status', 'pending')->count();
                $pendingDir = \App\Models\Delegation::where('user_id', Auth::id())->whereNull('completed_at')->count();
                $wsTasks = \App\Models\WorkspaceTask::where('assignee_id', Auth::id())->where('status', 'doing')->count();
                $todoCount = \App\Models\Todo::where('user_id', Auth::id())->where('is_completed', false)->count();
            @endphp

            <div class="member-card p-8">
                <p class="text-[9px] font-black text-slate-400 uppercase mb-4 tracking-widest">Missions from Kabid</p>
                <h2 class="text-4xl font-black text-[#064e3b]">{{ $pendingKabid }}</h2>
                <div class="progress-bar mt-4"><div class="progress-fill" style="width: 45%"></div></div>
            </div>

            <div class="member-card p-8">
                <p class="text-[9px] font-black text-slate-400 uppercase mb-4 tracking-widest">Director Orders</p>
                <h2 class="text-4xl font-black text-orange-500">{{ $pendingDir }}</h2>
                <div class="progress-bar mt-4"><div class="progress-fill bg-orange-400" style="width: 30%"></div></div>
            </div>

            <div class="member-card p-8">
                <p class="text-[9px] font-black text-slate-400 uppercase mb-4 tracking-widest">Active Workspace</p>
                <h2 class="text-4xl font-black text-blue-500">{{ $wsTasks }}</h2>
                <div class="progress-bar mt-4"><div class="progress-fill bg-blue-500" style="width: 60%"></div></div>
            </div>

            <div class="member-card p-8 bg-[#064e3b]">
                <p class="text-[9px] font-black text-lime-400/50 uppercase mb-4 tracking-widest">Your To-Do</p>
                <h2 class="text-4xl font-black text-white">{{ $todoCount }}</h2>
                <p class="text-[8px] text-white/40 font-bold uppercase mt-2 italic">Keep Productive!</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">

            <div class="lg:col-span-2 space-y-8">
                <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter mb-6 flex items-center gap-3">
                    <span class="w-8 h-1 bg-[#064e3b]"></span> Current Assignments
                </h3>

                @php
                    $recentTasks = \App\Models\KabidTask::where('user_id', Auth::id())
                                    ->where('status', '!=', 'completed')
                                    ->latest()->take(5)->get();
                @endphp

                @forelse($recentTasks as $task)
                    <div class="member-card p-6 flex items-center justify-between border-l-8 border-l-lime-400">
                        <div class="flex items-center gap-6">
                            <div class="text-center shrink-0">
                                <p class="text-[10px] font-black text-slate-300 uppercase leading-none">{{ $task->deadline->format('M') }}</p>
                                <p class="text-xl font-black text-[#064e3b] leading-none">{{ $task->deadline->format('d') }}</p>
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-[#064e3b] uppercase tracking-tight">{{ $task->title }}</h4>
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-[8px] font-black text-slate-400 uppercase">From: {{ $task->kabid->name }}</span>
                                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                    <span class="text-[8px] font-black text-lime-600 uppercase">{{ $task->status }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('anggota.tugas.show', $task->id) }}" class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-[#064e3b] hover:bg-[#064e3b] hover:text-white transition-all shrink-0">
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                @empty
                    <div class="py-20 text-center bg-white rounded-[40px] border-2 border-dashed border-slate-100">
                        <p class="text-slate-300 font-black uppercase text-xs">No active tasks found</p>
                    </div>
                @endforelse
            </div>

            <div class="space-y-8">
                <div class="bg-white rounded-[40px] p-8 border border-slate-100 shadow-sm">
                    <h3 class="text-sm font-black text-[#064e3b] uppercase tracking-widest mb-8">Personal Todo</h3>
                    <div class="space-y-4">
                        @php $todos = \App\Models\Todo::where('user_id', Auth::id())->latest()->take(4)->get(); @endphp
                        @foreach($todos as $todo)
                            <div class="flex items-center gap-3 group">
                                <div class="w-5 h-5 rounded-md border-2 shrink-0 {{ $todo->is_completed ? 'bg-lime-400 border-lime-400' : 'border-slate-200' }} flex items-center justify-center">
                                    @if($todo->is_completed) <i class="fas fa-check text-[8px] text-[#064e3b]"></i> @endif
                                </div>
                                <span class="text-xs font-bold {{ $todo->is_completed ? 'text-slate-300 line-through' : 'text-slate-600' }}">
                                    {{ $todo->task }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-gradient-to-br from-[#064e3b] to-emerald-900 rounded-[40px] p-8 text-white relative overflow-hidden">
                    <h3 class="text-sm font-black text-lime-400 uppercase tracking-widest mb-4">Latest Insights</h3>
                    @php $latestPost = \App\Models\Post::where('status', 'published')->latest()->first(); @endphp
                    @if($latestPost)
                        <p class="text-xs font-bold leading-relaxed opacity-80 mb-6 italic">"{{ Str::limit($latestPost->title, 60) }}"</p>
                        <a href="#" class="text-[9px] font-black uppercase tracking-[0.3em] text-lime-400 border-b border-lime-400/30 pb-1">Read Article</a>
                    @endif
                    <div class="absolute -bottom-6 -right-6 opacity-10">
                        <i class="fas fa-lightbulb text-8xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div class="col-span-1 md:col-span-2">
                @include('partials.task-tracer')
            </div>

            <div class="bg-white rounded-[40px] p-4 shadow-sm border border-slate-100">
                @include('partials.mini-calendar')
            </div>

            <div class="bg-white rounded-[40px] p-4 shadow-sm border border-slate-100">
                @include('partials.division-calendar')
            </div>
        </div>
                    <div class="mt-12">
    @include('partials.program-roadmap')
</div>
        <div class="mt-8">
            @include('partials.birthdaycalendar')
        </div>
    </div>
</div>
@endsection
