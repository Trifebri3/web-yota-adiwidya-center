@extends(Auth::user()->role->value . '.layouts.app')

@section('title', 'Detail Instruksi Direksi')

@section('content')
<style>
    .ann-show-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .ann-paper { background: #fff; border-radius: 50px; border: 1px solid #f1f5f9; padding: 60px; box-shadow: 0 30px 60px -12px rgba(15, 23, 42, 0.05); position: relative; max-width: 900px; margin: 0 auto; }

    /* Stamp Indicator */
    .official-stamp { position: absolute; top: 40px; right: 60px; transform: rotate(15deg); border: 4px solid #BEF264; color: #BEF264; padding: 10px 20px; border-radius: 15px; font-weight: 900; font-size: 14px; text-transform: uppercase; opacity: 0.2; pointer-events: none; }

    .content-area { font-size: 16px; line-height: 1.8; color: #334155; margin: 40px 0; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; padding: 40px 0; }

    .meta-box { background: #f8fafc; border-radius: 25px; padding: 25px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .meta-item { display: flex; flex-direction: column; gap: 5px; }
    .meta-label { font-size: 9px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; }
    .meta-value { font-size: 13px; font-weight: 800; color: #0F172A; }
</style>

<div class="ann-show-container">
    <div style="max-width: 900px; margin: 0 auto; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('audit.announcement.index') }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">← Kembali ke List</a>

        <div style="display: flex; gap: 10px;">
            <a href="{{ route('audit.announcement.edit', $announcement->id) }}" style="background: #0F172A; color: #BEF264; padding: 12px 25px; border-radius: 12px; font-size: 10px; font-weight: 900; text-decoration: none; text-transform: uppercase;">Ubah Data</a>
        </div>
    </div>

    <div class="ann-paper">
        <div class="official-stamp">OFFICIAL INSTRUCTION</div>

        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 25px;">
            <span style="background: #0F172A; color: #BEF264; padding: 6px 14px; border-radius: 100px; font-size: 9px; font-weight: 900; text-transform: uppercase;">
                {{ $announcement->division ? $announcement->division->name : '📢 Seluruh Divisi' }}
            </span>
            @php
                $prioColor = match($announcement->priority) {
                    'urgent' => '#ef4444',
                    'high' => '#f59e0b',
                    'medium' => '#3b82f6',
                    default => '#94a3b8'
                };
            @endphp
            <span style="color: {{ $prioColor }}; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px;">
                ● Prioritas: {{ $announcement->priority }}
            </span>
        </div>

        <h1 style="font-size: 32px; font-weight: 900; color: #0F172A; line-height: 1.2; text-transform: uppercase;">
            {{ $announcement->title }}
        </h1>

        <div class="content-area">
            {!! nl2br(e($announcement->content)) !!}
        </div>

        <div class="meta-box">
            <div class="meta-item">
                <span class="meta-label">Diterbitkan Oleh</span>
                <span class="meta-value">{{ $announcement->author->name ?? 'Direktur Utama' }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Tanggal Terbit</span>
                <span class="meta-value">{{ $announcement->created_at->format('d F Y') }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Berakhir Pada</span>
                <span class="meta-value" style="color: {{ $announcement->expires_at ? '#ef4444' : '#0F172A' }}">
                    {{ $announcement->expires_at ? $announcement->expires_at->format('d F Y') : 'Tanpa Batas' }}
                </span>
            </div>
        </div>

        <div style="margin-top: 60px; display: flex; justify-content: flex-end;">
            <div style="text-align: center; border-top: 1px solid #f1f5f9; padding-top: 20px; width: 200px;">
                <p style="font-size: 11px; font-weight: 900; color: #0F172A; margin: 0; text-transform: uppercase;">Tri Febriansah</p>
                <p style="font-size: 9px; color: #94a3b8; font-weight: 700; margin-top: 5px;">DIREKTUR UTAMA YOTA</p>
            </div>
        </div>
    </div>
</div>
@endsection
