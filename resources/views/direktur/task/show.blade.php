@extends('direktur.layouts.app')

@section('content')
<style>
    .task-show-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .task-paper { background: #fff; border-radius: 40px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 25px 50px rgba(0,0,0,0.02); position: relative; }
    .status-ribbon { position: absolute; top: 0; right: 50px; padding: 15px 25px; border-radius: 0 0 20px 20px; font-weight: 900; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; }
    .section-box { background: #f8fafc; border-radius: 25px; padding: 30px; margin-bottom: 30px; }
    .label-mini { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; margin-bottom: 10px; display: block; }
</style>

<div class="task-show-container">
    <div style="max-width: 1000px; margin: 0 auto;">

        <div style="display: flex; justify-content: space-between; margin-bottom: 30px;">
            <a href="{{ route('direktur.task.index') }}" style="text-decoration: none; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">← Kembali</a>
            <a href="{{ route('direktur.task.edit', $task->id) }}" style="font-size: 11px; font-weight: 900; color: #0F172A; text-decoration: none;">UBAH TUGAS</a>
        </div>

        <div class="task-paper">
            <div class="status-ribbon {{ $task->status_color }}">
                Status: {{ $task->status }}
            </div>

            <p style="font-size: 12px; font-weight: 800; color: #84cc16; margin-bottom: 10px;">TARGET: DIVISI {{ strtoupper($task->division->name) }}</p>
            <h1 style="font-size: 32px; font-weight: 900; color: #0F172A; margin-bottom: 40px; text-transform: uppercase;">{{ $task->title }}</h1>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">
                <div>
                    <div class="section-box" style="background: #fff; border: 1px solid #f1f5f9;">
                        <span class="label-mini">Deskripsi Instruksi</span>
                        <p style="font-size: 15px; line-height: 1.8; color: #475569;">{{ $task->description ?? 'Tidak ada deskripsi tambahan.' }}</p>

                        @if($task->instruction_link)
                        <a href="{{ $task->instruction_link }}" target="_blank" style="display: inline-block; margin-top: 20px; background: #0F172A; color: #BEF264; padding: 12px 20px; border-radius: 12px; text-decoration: none; font-size: 11px; font-weight: 900;">BUKA DOKUMEN INSTRUKSI ↗</a>
                        @endif
                    </div>

                    {{-- FEEDBACK DIREKTUR --}}
                    <div class="section-box" style="background: #FFFBEB; border: 1px solid #FEF3C7;">
                        <span class="label-mini" style="color: #B45309;">Catatan Direktur (Feedback/Revisi)</span>
                        <p style="font-size: 14px; color: #92400E; font-weight: 600;">{{ $task->director_note ?? 'Belum ada catatan.' }}</p>
                    </div>
                </div>

                <div>
                    <div class="section-box">
                        <span class="label-mini">Hasil Pengumpulan</span>
                        @if($task->submission_link)
                            <p style="font-size: 12px; font-weight: 700; color: #0F172A; margin-bottom: 15px;">Link telah dikirim:</p>
                            <a href="{{ $task->submission_link }}" target="_blank" style="color: #2563eb; font-weight: 800; text-decoration: underline; word-break: break-all;">{{ $task->submission_link }}</a>
                        @else
                            <p style="font-size: 12px; color: #94a3b8; font-style: italic;">Divisi belum mengumpulkan hasil kerja.</p>
                        @endif
                    </div>

                    <div class="section-box">
                        <span class="label-mini">Timeline Audit</span>
                        <div style="font-size: 12px; font-weight: 700;">
                            <p style="margin-bottom: 10px;">📅 Deadline: <span style="color: #ef4444;">{{ $task->deadline->format('d M Y') }}</span></p>
                            <p>👁️ Dibuka Staf: <span style="color: #059669;">{{ $task->opened_at ? $task->opened_at->format('d M, H:i') : '-' }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
