@extends(Auth::user()->role->value . '.layouts.app')

@section('title', 'My Workspaces - YOTA')

@section('content')
<style>
    .gen-ws-container { font-family: 'Plus Jakarta Sans', sans-serif; padding: 40px; background: #FDFDFB; min-height: 100vh; }
    .ws-card-gen { background: #fff; border-radius: 30px; border: 1px solid #f1f5f9; padding: 25px; transition: 0.3s; position: relative; border-top: 5px solid #e2e8f0; }
    .ws-card-gen:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
    .ws-card-gen.priority { border-top-color: #BEF264; background: #fffdf5; }

    .action-btn-circle { width: 35px; height: 35px; border-radius: 10px; border: 1px solid #f1f5f9; background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s; color: #64748b; }
    .action-btn-circle:hover { background: #0F172A; color: #BEF264; }

    .filter-tab { padding: 10px 20px; border-radius: 12px; font-size: 11px; font-weight: 800; text-decoration: none; color: #94a3b8; border: 1px solid transparent; }
    .filter-tab.active { background: #0F172A; color: #BEF264; }
</style>

<div class="gen-ws-container">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
        <div>
            <h1 style="font-size: 32px; font-weight: 900; color: #0F172A; letter-spacing: -1.5px;">WORK<span style="color: #84cc16;">SPACES</span></h1>
            <p style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px;">Kolaborasi & Manajemen Proyek</p>
        </div>

        <div style="display: flex; background: #fff; padding: 8px; border-radius: 15px; border: 1px solid #f1f5f9; gap: 5px;">
            <a href="?status=active" class="filter-tab {{ request('status', 'active') == 'active' ? 'active' : '' }}">AKTIF</a>
            <a href="?status=archived" class="filter-tab {{ request('status') == 'archived' ? 'active' : '' }}">ARSIP</a>
            <a href="?status=completed" class="filter-tab {{ request('status') == 'completed' ? 'active' : '' }}">PENYIMPANAN</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px;">
        @forelse($workspaces as $ws)
        {{-- Logika filter manual sederhana untuk demo --}}
        @if(request('status', 'active') == $ws->status)
        <div class="ws-card-gen {{ $ws->is_priority ? 'priority' : '' }}">

            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                <div style="display: flex; gap: 8px;">
                    {{-- Tombol Pin --}}
                    <form action="{{ route('general.workspace.toggle-priority', $ws->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="action-btn-circle" title="Pin ke Prioritas">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="{{ $ws->is_priority ? '#BEF264' : 'none' }}" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </button>
                    </form>
                </div>

                <div style="text-align: right;">
                    <span style="font-size: 9px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">Owner:</span>
                    <p style="font-size: 11px; font-weight: 800; color: #0F172A; margin: 0;">{{ $ws->creator->name }}</p>
                </div>
            </div>

            <h3 style="font-size: 18px; font-weight: 900; color: #0F172A; margin-bottom: 8px; text-transform: uppercase;">{{ $ws->name }}</h3>
            <p style="font-size: 12px; color: #64748b; line-height: 1.6; margin-bottom: 25px; height: 40px; overflow: hidden;">{{ Str::limit($ws->description, 80) }}</p>

            <div style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; padding: 12px 20px; border-radius: 15px; margin-bottom: 20px;">
                <div style="text-align: center;">
                    <span style="display: block; font-size: 14px; font-weight: 900; color: #0F172A;">{{ $ws->tasks_count }}</span>
                    <span style="font-size: 8px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Total Task</span>
                </div>
                <div style="width: 1px; height: 20px; background: #e2e8f0;"></div>
                <div style="text-align: center;">
                    <span style="display: block; font-size: 14px; font-weight: 900; color: #84cc16;">{{ round(($ws->tasks_completed_count ?? 0 / ($ws->tasks_count ?: 1)) * 100) }}%</span>
                    <span style="font-size: 8px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Done</span>
                </div>
            </div>

            <div style="display: flex; gap: 10px;">
                <a href="{{ route('general.workspace.show', $ws->id) }}" style="flex: 2; text-align: center; background: #0F172A; color: #BEF264; text-decoration: none; padding: 12px; border-radius: 12px; font-size: 10px; font-weight: 900; text-transform: uppercase;">Masuk Workspace</a>

                {{-- Tombol Archive/Move (Hanya jika role cukup tinggi atau sesuai kebijakan) --}}
                <div style="display: flex; gap: 5px;">
                    <form action="{{ route('general.workspace.update-status', $ws->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="{{ $ws->status == 'active' ? 'archived' : 'active' }}">
                        <button type="submit" class="action-btn-circle" title="Arsip/Aktifkan">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 8H3V6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2z"></path><path d="M10 12h4"></path><path d="M3 8v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
        @empty
        <div style="grid-column: span 3; text-align: center; padding: 80px;">
            <p style="color: #94a3b8; font-weight: 700; text-transform: uppercase; font-size: 11px;">Tidak ada workspace di kategori ini.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
