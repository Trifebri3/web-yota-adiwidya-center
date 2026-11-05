@extends('direktur.layouts.app')

@section('title', 'Detail Evaluasi Kinerja - YOTA')

@section('content')
<style>
    .eval-show-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .eval-paper { background: #fff; border-radius: 50px; border: 1px solid #f1f5f9; padding: 60px; box-shadow: 0 30px 60px rgba(15, 23, 42, 0.05); position: relative; max-width: 850px; margin: 0 auto; }

    /* Status Badge Floating */
    .read-badge { position: absolute; top: 40px; right: 60px; padding: 8px 20px; border-radius: 12px; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; }
    .is-read { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .not-read { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

    .category-tag { display: inline-block; padding: 6px 15px; border-radius: 100px; font-size: 9px; font-weight: 900; text-transform: uppercase; margin-bottom: 20px; }

    /* Warna per Label */
    .tag-praise { background: #BEF264; color: #064E3B; }
    .tag-warning { background: #ef4444; color: #fff; }
    .tag-improvement { background: #3b82f6; color: #fff; }
    .tag-general { background: #94a3b8; color: #fff; }

    .content-body { font-size: 16px; line-height: 1.8; color: #334155; padding: 40px 0; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; margin: 30px 0; }
</style>

<div class="eval-show-container">
    <div style="max-width: 850px; margin: 0 auto; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('direktur.evaluation.index') }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">← Kembali ke List</a>

        <div style="display: flex; gap: 10px;">
            <a href="{{ route('direktur.evaluation.edit', $evaluation->id) }}" style="background: #0F172A; color: #BEF264; padding: 12px 25px; border-radius: 12px; font-size: 10px; font-weight: 900; text-decoration: none; text-transform: uppercase;">Ubah Catatan</a>
        </div>
    </div>

    <div class="eval-paper">
        <div class="read-badge {{ $evaluation->is_read ? 'is-read' : 'not-read' }}">
            {{ $evaluation->is_read ? '✓ Sudah Dibaca' : '⌛ Belum Dibaca' }}
        </div>

        <span class="category-tag tag-{{ $evaluation->label }}">
            Kategori: {{ $evaluation->label }}
        </span>

        <h1 style="font-size: 32px; font-weight: 900; color: #0F172A; line-height: 1.2; text-transform: uppercase; margin-bottom: 10px;">
            {{ $evaluation->title }}
        </h1>

        <p style="font-size: 13px; font-weight: 800; color: #84cc16; text-transform: uppercase;">
            Target:
            @if($evaluation->type == 'division')
                Divisi {{ $evaluation->division->name }}
            @else
                {{ $evaluation->user->name }} ({{ $evaluation->user->role }})
            @endif
        </p>

        <div class="content-body">
            {!! nl2br(e($evaluation->content)) !!}
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <p style="font-size: 9px; font-weight: 900; color: #94a3b8; text-transform: uppercase; margin-bottom: 5px;">Diterbitkan Oleh</p>
                <p style="font-size: 13px; font-weight: 800; color: #0F172A;">{{ $evaluation->author->name }}</p>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 9px; font-weight: 900; color: #94a3b8; text-transform: uppercase; margin-bottom: 5px;">Waktu Publikasi</p>
                <p style="font-size: 13px; font-weight: 800; color: #0F172A;">{{ $evaluation->created_at->format('d F Y, H:i') }} WIB</p>
            </div>
        </div>

        <div style="margin-top: 60px; display: flex; justify-content: flex-end;">
            <div style="text-align: center; width: 200px; border-top: 2px solid #0F172A; padding-top: 15px;">
                <p style="font-size: 11px; font-weight: 900; color: #0F172A; margin: 0;">TRI FEBRIANSAH</p>
                <p style="font-size: 9px; color: #94a3b8; font-weight: 700; margin-top: 2px;">DIREKTUR UTAMA YOTA</p>
            </div>
        </div>
    </div>
</div>
@endsection
