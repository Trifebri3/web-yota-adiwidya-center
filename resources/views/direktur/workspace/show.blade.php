@extends('direktur.layouts.app')

@section('title', $workspace->name . ' - Workspace')

@section('content')
<style>
    .ws-show-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .header-glass { background: #0F172A; border-radius: 40px; padding: 50px; color: #fff; position: relative; overflow: hidden; margin-bottom: 40px; }
    .header-glass::after { content: ""; position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: #BEF264; filter: blur(100px); opacity: 0.2; }

    .board-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; align-items: start; }
    .board-column { background: #f1f5f9; border-radius: 25px; padding: 20px; min-height: 500px; }
    .column-title { font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; padding-left: 10px; }

    .task-mini-card { background: #fff; border-radius: 20px; padding: 20px; margin-bottom: 15px; border: 1px solid #e2e8f0; transition: 0.3s; cursor: pointer; }
    .task-mini-card:hover { transform: scale(1.02); box-shadow: 0 10px 25px rgba(0,0,0,0.05); }

    .category-tag { font-size: 8px; font-weight: 900; padding: 4px 10px; border-radius: 100px; text-transform: uppercase; margin-bottom: 10px; display: inline-block; }
</style>

<div class="ws-show-container">

    <div class="header-glass">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div style="max-width: 600px;">
                <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                    <span style="background: rgba(190, 242, 100, 0.2); color: #BEF264; padding: 6px 15px; border-radius: 100px; font-size: 10px; font-weight: 800; text-transform: uppercase;">{{ $workspace->status }}</span>
                    <span style="background: rgba(255, 255, 255, 0.1); color: #fff; padding: 6px 15px; border-radius: 100px; font-size: 10px; font-weight: 800; text-transform: uppercase;">{{ $workspace->tasks->count() }} Tasks</span>
                </div>
                <h1 style="font-size: 42px; font-weight: 900; line-height: 1; letter-spacing: -2px; margin-bottom: 15px;">{{ $workspace->name }}</h1>
                <p style="font-size: 14px; opacity: 0.7; line-height: 1.6;">{{ $workspace->description }}</p>
            </div>

            <div style="text-align: right;">
                <a href="{{ route('direktur.workspace.edit', $workspace->id) }}" style="background: #fff; color: #0F172A; padding: 15px 25px; border-radius: 15px; text-decoration: none; font-size: 11px; font-weight: 900; text-transform: uppercase;">Config Workspace</a>
                @if($workspace->general_instruction_link)
                    <a href="{{ $workspace->general_instruction_link }}" target="_blank" style="display: block; margin-top: 15px; color: #BEF264; font-size: 11px; font-weight: 800; text-decoration: none;">↗ Main Folder Link</a>
                @endif
            </div>
        </div>

        <div style="margin-top: 40px; display: flex; align-items: center; gap: 15px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 30px;">
            <span style="font-size: 10px; font-weight: 800; opacity: 0.5; text-transform: uppercase;">Colaborators:</span>
            <div style="display: flex; gap: 8px;">
                @foreach($workspace->users as $u)
                    <div title="{{ $u->name }}" style="width: 35px; height: 35px; border-radius: 10px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800; border: 1px solid rgba(255,255,255,0.1);">
                        {{ substr($u->name, 0, 1) }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="board-grid">

        <div class="board-column">
            <div class="column-title">
                <div style="width: 8px; height: 8px; border-radius: 50%; background: #94a3b8;"></div>
                To-Do ({{ $workspace->tasks->where('status', 'to-do')->count() }})
            </div>

            @foreach($workspace->tasks->where('status', 'to-do') as $task)
                @include('partials.direktur.workspace-task-card', ['task' => $task])
            @endforeach
        </div>

        <div class="board-column">
            <div class="column-title">
                <div style="width: 8px; height: 8px; border-radius: 50%; background: #fbbf24;"></div>
                Doing ({{ $workspace->tasks->whereIn('status', ['doing', 'submitted', 'revision'])->count() }})
            </div>

            @foreach($workspace->tasks->whereIn('status', ['doing', 'submitted', 'revision']) as $task)
                @include('partials.direktur.workspace-task-card', ['task' => $task])
            @endforeach
        </div>

        <div class="board-column" style="background: #f0fdf4;">
            <div class="column-title" style="color: #166534;">
                <div style="width: 8px; height: 8px; border-radius: 50%; background: #22c55e;"></div>
                Verified ({{ $workspace->tasks->where('status', 'acc')->count() }})
            </div>

            @foreach($workspace->tasks->where('status', 'acc') as $task)
                @include('partials.direktur.workspace-task-card', ['task' => $task])
            @endforeach
        </div>

    </div>
</div>
@endsection
