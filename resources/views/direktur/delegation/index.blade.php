@extends('direktur.layouts.app')

@section('title', 'Direct Mandate Tracker - YOTA')

@section('content')
<style>
    .mandate-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .mandate-table-card { background: #fff; border-radius: 40px; border: 1px solid #f1f5f9; padding: 40px; box-shadow: 0 20px 50px rgba(0,0,0,0.02); }

    .table-exec { width: 100%; border-collapse: collapse; }
    .table-exec th { padding: 20px; text-align: left; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; border-bottom: 2px solid #f8fafc; }
    .table-exec td { padding: 20px; border-bottom: 1px solid #f8fafc; vertical-align: middle; }

    .status-pill { padding: 6px 14px; border-radius: 100px; font-size: 9px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5px; }
    .st-sent { background: #f1f5f9; color: #64748b; }
    .st-read { background: #dbeafe; color: #1e40af; }
    .st-progress { background: #fef3c7; color: #92400e; }
    .st-submitted { background: #ede9fe; color: #5b21b6; }
    .st-completed { background: #BEF264; color: #064E3B; }
    .st-revision { background: #fef2f2; color: #991b1b; }

    .user-avatar-mini { width: 35px; height: 35px; border-radius: 12px; background: #0F172A; color: #BEF264; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 12px; }
</style>

<div class="mandate-container">

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 50px;">
        <div>
            <h1 style="font-size: 38px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; line-height: 0.9;">
                Mandat <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Personal</span>
            </h1>
            <p style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 4px; margin-top: 12px;">Direct Command & Delegation Center</p>
        </div>

        <a href="{{ route('direktur.delegation.create') }}" style="background: #0F172A; color: #BEF264; padding: 18px 35px; border-radius: 20px; text-decoration: none; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 15px 30px rgba(15,23,42,0.15);">
            + Beri Mandat Baru
        </a>
    </div>

    <div class="mandate-table-card">
        <table class="table-exec">
            <thead>
                <tr>
                    <th>Penerima Mandat</th>
                    <th>Judul Instruksi</th>
                    <th>Status</th>
                    <th>Audit Waktu</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($delegations as $mandat)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div class="user-avatar-mini">{{ substr($mandat->user->name, 0, 1) }}</div>
                            <div>
                                <p style="font-size: 13px; font-weight: 900; color: #0F172A; margin: 0;">{{ $mandat->user->name }}</p>
                                <p style="font-size: 10px; color: #94a3b8; font-weight: 700; margin: 0;">{{ $mandat->user->role }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p style="font-size: 14px; font-weight: 800; color: #0F172A; margin: 0;">{{ $mandat->title }}</p>
                        <span style="font-size: 10px; color: #94a3b8; font-weight: 700;">DL: {{ $mandat->deadline->format('d M, H:i') }}</span>
                    </td>
                    <td>
                        <span class="status-pill st-{{ $mandat->status }}">
                            {{ str_replace('_', ' ', $mandat->status) }}
                        </span>
                    </td>
                    <td>
                        <div style="font-size: 10px; font-weight: 700;">
                            <p style="margin: 0; color: {{ $mandat->read_at ? '#059669' : '#94a3b8' }}">
                                {{ $mandat->read_at ? '👁️ Dibaca: '.$mandat->read_at->diffForHumans() : '⌛ Belum Dibaca' }}
                            </p>
                            @if($mandat->completed_at)
                                <p style="margin: 5px 0 0 0; color: #84cc16;">✅ Selesai: {{ $mandat->completed_at->format('d M') }}</p>
                            @endif
                        </div>
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; gap: 10px; justify-content: flex-end;">
                            <a href="{{ route('direktur.delegation.show', $mandat->id) }}" style="background: #f8fafc; padding: 10px; border-radius: 12px; display: block; border: 1px solid #e2e8f0;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </a>

                            @if($mandat->status == 'submitted')
                            <form action="{{ route('direktur.delegation.complete', $mandat->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" style="background: #BEF264; border: none; padding: 10px 15px; border-radius: 12px; cursor: pointer; font-size: 9px; font-weight: 900; color: #064E3B;">ACC</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 100px; color: #94a3b8; font-weight: 700; font-size: 12px; text-transform: uppercase;">Belum ada mandat personal yang dikirim.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 30px;">
        {{ $delegations->links() }}
    </div>
</div>
@endsection
