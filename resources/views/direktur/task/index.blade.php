@extends('direktur.layouts.app')

@section('title', 'Task Control Center - YOTA')

@section('content')
{{-- 1. MONITORING PANEL (Jumlah & Progres) --}}
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
        <div style="background: #0F172A; padding: 25px; border-radius: 25px; color: #fff;">
            <p style="font-size: 10px; font-weight: 800; color: #BEF264; text-transform: uppercase;">Organization Progress</p>
            <h2 style="font-size: 32px; font-weight: 900; margin: 10px 0;">{{ $stats['avg_progress'] }}%</h2>
            <div style="background: rgba(255,255,255,0.1); height: 6px; border-radius: 10px;">
                <div style="width: {{ $stats['avg_progress'] }}%; background: #BEF264; height: 100%; border-radius: 10px;"></div>
            </div>
        </div>

        <div style="background: #fff; padding: 25px; border-radius: 25px; border: 1px solid #f1f5f9;">
            <p style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Total Task</p>
            <h2 style="font-size: 32px; font-weight: 900; color: #0F172A;">{{ $stats['total'] }}</h2>
        </div>

        <div style="background: #fff; padding: 25px; border-radius: 25px; border: 1px solid #f1f5f9;">
            <p style="font-size: 10px; font-weight: 800; color: #ef4444; text-transform: uppercase;">Need Revision</p>
            <h2 style="font-size: 32px; font-weight: 900; color: #ef4444;">{{ $stats['revision'] }}</h2>
        </div>

        <div style="background: #fff; padding: 25px; border-radius: 25px; border: 1px solid #f1f5f9;">
            <p style="font-size: 10px; font-weight: 800; color: #059669; text-transform: uppercase;">Completed</p>
            <h2 style="font-size: 32px; font-weight: 900; color: #059669;">{{ $stats['completed'] }}</h2>
        </div>
    </div>
    
@include('partials.direktur.task-calendar', ['tasks' => $allTasks])
<style>
    .task-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .task-card { background: #fff; border-radius: 30px; border: 1px solid #f1f5f9; transition: all 0.3s ease; overflow: hidden; display: flex; flex-direction: column; }
    .task-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08); }

    .status-badge { padding: 6px 14px; border-radius: 100px; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; }

    /* Progress Bar Mini */
    .progress-track { background: #f1f5f9; height: 6px; border-radius: 10px; width: 100%; margin: 15px 0; overflow: hidden; }
    .progress-bar { height: 100%; transition: width 0.5s ease; }

    .btn-action { padding: 10px; border-radius: 12px; border: 1px solid #e2e8f0; background: #fff; cursor: pointer; transition: 0.2s; display: flex; align-items: center; justify-content: center; }
    .btn-action:hover { background: #f8fafc; border-color: #0F172A; }
</style>

<div class="task-container">

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 50px;">
        <div>
            <h1 style="font-size: 38px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; line-height: 0.9;">
                Delegasi <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Tugas</span>
            </h1>
            <p style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 4px; margin-top: 12px;">Monitoring Workflow & Performa Divisi</p>
        </div>

        <a href="{{ route('direktur.task.create') }}" style="background: #0F172A; color: #BEF264; padding: 18px 30px; border-radius: 20px; text-decoration: none; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 15px 30px rgba(15,23,42,0.15);">
            + Delegasikan Tugas
        </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px;">
        @forelse($tasks as $task)
        <div class="task-card">
            <div style="padding: 25px 25px 10px 25px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <span class="status-badge {{ $task->status_color }}">
                        {{ $task->status }}
                    </span>
                    <span style="font-size: 10px; font-weight: 800; color: #94a3b8;">#{{ $task->id }}</span>
                </div>

                <h3 style="font-size: 18px; font-weight: 900; color: #0F172A; margin-bottom: 5px; line-height: 1.3;">{{ $task->title }}</h3>
                <p style="font-size: 11px; font-weight: 800; color: #84cc16; text-transform: uppercase; letter-spacing: 1px;">
                    🎯 {{ $task->division->name }}
                </p>
            </div>

            <div style="padding: 0 25px 25px 25px;">
                @php
                    $progress = match($task->status) {
                        'pending' => 10, 'read' => 30, 'doing' => 50, 'submitted' => 80, 'revision' => 60, 'completed' => 100, default => 0
                    };
                    $barColor = match($task->status) {
                        'completed' => '#BEF264', 'revision' => '#ef4444', 'submitted' => '#8b5cf6', default => '#0F172A'
                    };
                @endphp
                <div class="progress-track">
                    <div class="progress-bar" style="width: {{ $progress }}%; background: {{ $barColor }};"></div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <span style="font-size: 11px; font-weight: 700; color: {{ $task->deadline->isPast() ? '#ef4444' : '#64748b' }}">
                            {{ $task->deadline->format('d M Y') }}
                        </span>
                    </div>
                    @if($task->opened_at)
                        <span style="font-size: 9px; font-weight: 800; color: #059669; text-transform: uppercase;">✔ Dilihat</span>
                    @else
                        <span style="font-size: 9px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">未 Dilihat</span>
                    @endif
                </div>
            </div>

            <div style="margin-top: auto; padding: 20px 25px; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; gap: 8px;">
                    <a href="{{ route('direktur.task.show', $task->id) }}" class="btn-action" title="Pantau Detail">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </a>
                    <a href="{{ route('direktur.task.edit', $task->id) }}" class="btn-action" title="Edit Tugas">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </a>
                </div>

                @if($task->status == 'submitted')
                <form action="{{ route('direktur.task.approve', $task->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" style="background: #BEF264; color: #064E3B; border: none; padding: 8px 15px; border-radius: 10px; font-size: 10px; font-weight: 900; cursor: pointer; text-transform: uppercase;">
                        ACC Tugas ↗
                    </button>
                </form>
                @endif
            </div>
        </div>
        @empty
        <div style="grid-column: span 3; text-align: center; padding: 100px; background: #fff; border-radius: 30px; border: 1px dashed #e2e8f0;">
            <p style="color: #94a3b8; font-weight: 700; text-transform: uppercase; font-size: 12px;">Belum ada tugas yang didelegasikan.</p>
        </div>
        @endforelse
    </div>

    <div style="margin-top: 40px;">
        {{ $tasks->links() }}
    </div>
</div>
@endsection
