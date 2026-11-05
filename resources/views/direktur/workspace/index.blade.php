@extends('direktur.layouts.app')

@section('title', 'Corporate Workspace - YOTA')

@section('content')
<style>
    .workspace-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .ws-card { background: #fff; border-radius: 35px; border: 1px solid #f1f5f9; padding: 30px; transition: 0.3s; position: relative; display: flex; flex-direction: column; height: 100%; }
    .ws-card:hover { transform: translateY(-5px); box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.08); }

    .status-active { background: #f0fdf4; color: #15803d; }
    .status-archived { background: #f1f5f9; color: #64748b; }
    .status-completed { background: #0F172A; color: #BEF264; }

    .progress-circle-box { position: relative; width: 60px; height: 60px; }
    .member-stack { display: flex; align-items: center; margin-left: 10px; }
    .member-avatar { width: 32px; height: 32px; border-radius: 10px; border: 2px solid #fff; background: #0F172A; color: #BEF264; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 800; margin-left: -10px; }
</style>

<div class="workspace-container">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 50px;">
        <div>
            <h1 style="font-size: 38px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; line-height: 0.9;">
                Project <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Workspaces</span>
            </h1>
            <p style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 4px; margin-top: 12px;">Manajemen Kolaborasi & Proyek Strategis</p>
        </div>

        <a href="{{ route('direktur.workspace.create') }}" style="background: #0F172A; color: #BEF264; padding: 18px 30px; border-radius: 20px; text-decoration: none; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 15px 30px rgba(15,23,42,0.15);">
            + Inisiasi Workspace
        </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 25px;">
        @forelse($workspaces as $ws)
        <div class="ws-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                <span style="padding: 6px 14px; border-radius: 100px; font-size: 9px; font-weight: 900; text-transform: uppercase;" class="status-{{ $ws->status }}">
                    {{ $ws->status }}
                </span>

                @php
                    $percentage = $ws->tasks_count > 0 ? round(($ws->completed_tasks_count / $ws->tasks_count) * 100) : 0;
                @endphp
                <div style="text-align: right;">
                    <p style="font-size: 18px; font-weight: 900; color: #0F172A; margin: 0;">{{ $percentage }}%</p>
                    <p style="font-size: 9px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Progress</p>
                </div>
            </div>

            <h3 style="font-size: 20px; font-weight: 900; color: #0F172A; margin-bottom: 10px; text-transform: uppercase; line-height: 1.2;">
                {{ $ws->name }}
            </h3>
            <p style="font-size: 13px; color: #64748b; line-height: 1.5; margin-bottom: 25px;">
                {{ Str::limit($ws->description, 100) }}
            </p>

            <div style="margin-top: auto;">
                <div style="background: #f1f5f9; height: 6px; border-radius: 10px; overflow: hidden; margin-bottom: 20px;">
                    <div style="width: {{ $percentage }}%; background: #BEF264; height: 100%;"></div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="member-stack">
                        @foreach($ws->users->take(4) as $user)
                            <div class="member-avatar" title="{{ $user->name }}">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endforeach
                        @if($ws->users->count() > 4)
                            <div class="member-avatar" style="background: #f1f5f9; color: #64748b;">+{{ $ws->users->count() - 4 }}</div>
                        @endif
                    </div>

                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('direktur.workspace.show', $ws->id) }}" style="text-decoration: none; background: #0F172A; color: #fff; padding: 10px 20px; border-radius: 12px; font-size: 10px; font-weight: 900; text-transform: uppercase;">Kelola</a>

                        <form action="{{ route('direktur.workspace.destroy', $ws->id) }}" method="POST" onsubmit="return confirm('Hapus workspace ini? Semua tugas di dalamnya akan hilang.')">
                            @csrf @method('DELETE')
                            <button type="submit" style="background: #fef2f2; border: 1px solid #fee2e2; padding: 10px; border-radius: 12px; color: #ef4444; cursor: pointer;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column: span 3; text-align: center; padding: 100px; background: #fff; border-radius: 40px; border: 1px dashed #e2e8f0;">
            <p style="color: #94a3b8; font-weight: 700; text-transform: uppercase;">Belum ada workspace yang dibuat.</p>
        </div>
        @endforelse
    </div>

    <div style="margin-top: 40px;">
        {{ $workspaces->links() }}
    </div>
</div>
@endsection
