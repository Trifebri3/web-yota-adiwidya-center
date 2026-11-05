@extends(Auth::user()->role->value . '.layouts.app')

@section('title', 'Project Board - ' . $workspace->name)

@section('content')
<style>
    .gen-ws-show { font-family: 'Plus Jakarta Sans', sans-serif; padding: 40px; background: #FDFDFB; min-height: 100vh; }

    /* Kanban Board Layout */
    .kanban-wrapper { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; align-items: start; margin-top: 40px; }
    .kanban-col { background: #f4f7f6; border-radius: 30px; padding: 20px; min-height: 70vh; border: 1px solid #eef2f1; }

    .col-header { display: flex; justify-content: space-between; align-items: center; padding: 10px 15px 20px 15px; }
    .col-title { font-size: 12px; font-weight: 900; color: #002c16; text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; gap: 10px; }
    .count-pill { background: #fff; padding: 2px 10px; border-radius: 8px; font-size: 10px; border: 1px solid #e2e8f0; }

    /* Task Card */
    .task-card { background: #fff; border-radius: 20px; padding: 20px; margin-bottom: 15px; border: 1px solid #e2e8f0; transition: 0.3s; cursor: pointer; position: relative; }
    .task-card:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(0,0,0,0.05); border-color: #BEF264; }

    .add-task-btn { width: 100%; padding: 12px; border-radius: 15px; border: 2px dashed #cbd5e1; background: transparent; color: #64748b; font-size: 11px; font-weight: 800; text-transform: uppercase; cursor: pointer; transition: 0.2s; margin-bottom: 20px; }
    .add-task-btn:hover { background: #fff; border-color: #002c16; color: #002c16; }

    .avatar-mini { width: 25px; height: 25px; border-radius: 8px; background: #002c16; color: #BEF264; display: flex; align-items: center; justify-content: center; font-size: 9px; font-weight: 800; }
</style>

<div class="gen-ws-show">

    <div style="background: #002c16; border-radius: 35px; padding: 40px; color: #fff; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                <a href="{{ route('general.workspace.index') }}" style="color: #BEF264; text-decoration: none; font-size: 20px;">←</a>
                <span style="background: rgba(255,255,255,0.1); padding: 5px 15px; border-radius: 100px; font-size: 10px; font-weight: 800; letter-spacing: 1px;">COLLABORATIVE SPACE</span>
            </div>
            <h1 style="font-size: 32px; font-weight: 900; letter-spacing: -1.5px; margin: 0;">{{ $workspace->name }}</h1>
            <p style="opacity: 0.6; font-size: 14px; margin-top: 10px; max-width: 600px;">{{ $workspace->description }}</p>
        </div>

        <div style="text-align: right;">
            <div style="display: flex; justify-content: flex-end; margin-bottom: 15px;">
                @foreach($workspace->users->take(5) as $u)
                    <div class="avatar-mini" style="border: 2px solid #002c16; margin-left: -8px;" title="{{ $u->name }}">
                        {{ substr($u->name, 0, 1) }}
                    </div>
                @endforeach
                @if($workspace->users->count() > 5)
                    <div class="avatar-mini" style="background: #BEF264; color: #002c16; margin-left: -8px;">+{{ $workspace->users->count() - 5 }}</div>
                @endif
            </div>
            @if($workspace->general_instruction_link)
                <a href="{{ $workspace->general_instruction_link }}" target="_blank" style="background: #BEF264; color: #002c16; padding: 10px 20px; border-radius: 12px; font-size: 10px; font-weight: 900; text-decoration: none; text-transform: uppercase;">↗ Resource Link</a>
            @endif
        </div>
    </div>

    <div class="kanban-wrapper">

        <div class="kanban-col">
            <div class="col-header">
                <div class="col-title"><div style="width: 8px; height: 8px; border-radius: 50%; background: #94a3b8;"></div> Rencana Tugas</div>
                <span class="count-pill">{{ $workspace->tasks->where('status', 'to-do')->count() }}</span>
            </div>

            <a href="{{ route('general.workspace.task.create', ['workspace_id' => $workspace->id]) }}" style="text-decoration: none;">
                <button class="add-task-btn">+ Buat Tugas Baru</button>
            </a>

            @foreach($workspace->tasks->where('status', 'to-do') as $task)
                <a href="{{ route('general.workspace.task.show', $task->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="task-card">
                        <span style="font-size: 8px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">{{ $task->category }}</span>
                        <h4 style="font-size: 14px; font-weight: 800; color: #002c16; margin: 8px 0;">{{ $task->title }}</h4>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                            <div class="avatar-mini" title="Assignee: {{ $task->assignee->name }}">{{ substr($task->assignee->name, 0, 1) }}</div>
                            <span style="font-size: 9px; font-weight: 700; color: #ef4444;">{{ $task->due_date->format('d M') }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="kanban-col">
            <div class="col-header">
                <div class="col-title"><div style="width: 8px; height: 8px; border-radius: 50%; background: #fbbf24;"></div> Sedang Dikerjakan</div>
                <span class="count-pill">{{ $workspace->tasks->whereIn('status', ['doing', 'submitted', 'revision'])->count() }}</span>
            </div>

            @foreach($workspace->tasks->whereIn('status', ['doing', 'submitted', 'revision']) as $task)
                <a href="{{ route('general.workspace.task.show', $task->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="task-card" style="border-left: 4px solid #fbbf24;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <span style="font-size: 8px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">{{ $task->category }}</span>
                            @if($task->status == 'submitted') <span style="font-size: 7px; background: #002c16; color: #BEF264; padding: 2px 6px; border-radius: 4px;">READY TO ACC</span> @endif
                        </div>
                        <h4 style="font-size: 14px; font-weight: 800; color: #002c16; margin: 8px 0;">{{ $task->title }}</h4>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                            <div class="avatar-mini">{{ substr($task->assignee->name, 0, 1) }}</div>
                            <div style="display: flex; gap: 5px; align-items: center;">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="3"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                <span style="font-size: 10px; font-weight: 800; color: #94a3b8;">{{ $task->comments->count() }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="kanban-col" style="background: #f0fdf4;">
            <div class="col-header">
                <div class="col-title" style="color: #166534;"><div style="width: 8px; height: 8px; border-radius: 50%; background: #22c55e;"></div> Selesai & Terverifikasi</div>
                <span class="count-pill">{{ $workspace->tasks->where('status', 'acc')->count() }}</span>
            </div>

            @foreach($workspace->tasks->where('status', 'acc') as $task)
                <a href="{{ route('general.workspace.task.show', $task->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="task-card" style="opacity: 0.7;">
                        <h4 style="font-size: 14px; font-weight: 800; color: #166534; margin: 0; text-decoration: line-through;">{{ $task->title }}</h4>
                        <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
                            <div style="background: #22c55e; color: #fff; padding: 2px 8px; border-radius: 5px; font-size: 8px; font-weight: 900;">ACC</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</div>
@endsection
