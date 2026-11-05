@extends('direktur.layouts.app')

@section('title', 'Performance Evaluation - YOTA')

@section('content')
<style>
    .eval-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .eval-card { background: #fff; border-radius: 35px; border: 1px solid #f1f5f9; padding: 30px; transition: 0.3s; position: relative; overflow: hidden; display: flex; flex-direction: column; }
    .eval-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.04); }

    /* Label Styles */
    .label-praise { border-left: 6px solid #BEF264; }
    .label-warning { border-left: 6px solid #ef4444; }
    .label-improvement { border-left: 6px solid #3b82f6; }
    .label-general { border-left: 6px solid #94a3b8; }

    .badge-label { padding: 4px 12px; border-radius: 100px; font-size: 9px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; }
    .status-read { background: #f0fdf4; color: #15803d; }
    .status-unread { background: #fef2f2; color: #b91c1c; }
</style>

<div class="eval-container">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 50px;">
        <div>
            <h1 style="font-size: 38px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; line-height: 0.9;">
                Kinerja <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">& Evaluasi</span>
            </h1>
            <p style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 4px; margin-top: 12px;">Monitoring Kualitas & Pengembangan SDM</p>
        </div>

        <a href="{{ route('direktur.evaluation.create') }}" style="background: #0F172A; color: #BEF264; padding: 18px 30px; border-radius: 20px; text-decoration: none; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 15px 30px rgba(15,23,42,0.15);">
            + Beri Evaluasi Baru
        </a>
    </div>

    <div style="display: flex; gap: 10px; margin-bottom: 30px;">
        <a href="{{ route('direktur.evaluation.index') }}" style="text-decoration: none; padding: 8px 20px; border-radius: 12px; font-size: 10px; font-weight: 900; {{ !request('type') ? 'background: #0F172A; color: #BEF264;' : 'background: #fff; color: #94a3b8; border: 1px solid #f1f5f9;' }}">SEMUA</a>
        <a href="{{ route('direktur.evaluation.index', ['type' => 'division']) }}" style="text-decoration: none; padding: 8px 20px; border-radius: 12px; font-size: 10px; font-weight: 900; {{ request('type') == 'division' ? 'background: #0F172A; color: #BEF264;' : 'background: #fff; color: #94a3b8; border: 1px solid #f1f5f9;' }}">DIVISI</a>
        <a href="{{ route('direktur.evaluation.index', ['type' => 'user']) }}" style="text-decoration: none; padding: 8px 20px; border-radius: 12px; font-size: 10px; font-weight: 900; {{ request('type') == 'user' ? 'background: #0F172A; color: #BEF264;' : 'background: #fff; color: #94a3b8; border: 1px solid #f1f5f9;' }}">PERSONAL</a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 25px;">
        @forelse($evaluations as $eval)
        <div class="eval-card label-{{ $eval->label }}">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                <span class="badge-label {{ $eval->is_read ? 'status-read' : 'status-unread' }}">
                    {{ $eval->is_read ? '✓ Dibaca' : '⌛ Belum Dibaca' }}
                </span>
                <span style="font-size: 9px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">{{ $eval->created_at->format('d M Y') }}</span>
            </div>

            <h3 style="font-size: 18px; font-weight: 900; color: #0F172A; text-transform: uppercase; margin-bottom: 5px;">{{ $eval->title }}</h3>

            <p style="font-size: 11px; font-weight: 800; color: #84cc16; text-transform: uppercase; margin-bottom: 15px;">
                @if($eval->type == 'division')
                    🎯 Divisi: {{ $eval->division->name }}
                @else
                    👤 Personal: {{ $eval->user->name }}
                @endif
            </p>

            <div style="font-size: 13px; color: #64748b; line-height: 1.6; margin-bottom: 25px;">
                {{ Str::limit($eval->content, 120) }}
            </div>

            <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center; padding-top: 20px; border-top: 1px solid #f8fafc;">
                <div style="display: flex; gap: 8px;">
                    <a href="{{ route('direktur.evaluation.show', $eval->id) }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #0F172A; background: #BEF264; padding: 8px 15px; border-radius: 10px;">Review</a>
                    <a href="{{ route('direktur.evaluation.edit', $eval->id) }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #64748b; border: 1px solid #e2e8f0; padding: 8px 15px; border-radius: 10px;">Edit</a>
                </div>

                <form action="{{ route('direktur.evaluation.destroy', $eval->id) }}" method="POST" onsubmit="return confirm('Hapus evaluasi ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div style="grid-column: span 3; text-align: center; padding: 100px; background: #fff; border-radius: 30px; border: 1px dashed #e2e8f0;">
            <p style="color: #94a3b8; font-weight: 700; text-transform: uppercase; font-size: 12px;">Belum ada catatan evaluasi.</p>
        </div>
        @endforelse
    </div>

    <div style="margin-top: 40px;">
        {{ $evaluations->links() }}
    </div>
</div>
@endsection
