@extends(Auth::user()->role->value . '.layouts.app')

@section('title', 'Detail Tugas: ' . $task->title)

@section('content')
<style>
    .task-detail-container { font-family: 'Plus Jakarta Sans', sans-serif; padding: 40px; background: #FDFDFB; min-height: 100vh; }
    .task-white-card { background: #fff; border-radius: 40px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.03); }

    .instruction-box { background: #f8fafc; border-radius: 25px; padding: 30px; border-left: 5px solid #0F172A; margin-bottom: 40px; }

    .status-badge { padding: 8px 18px; border-radius: 100px; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; }

    .comment-bubble { display: flex; gap: 15px; margin-bottom: 25px; }
    .comment-content { background: #f8fafc; padding: 20px; border-radius: 0 25px 25px 25px; flex: 1; border: 1px solid #f1f5f9; }

    .form-input-yota { background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 15px; padding: 15px; font-weight: 700; color: #0F172A; width: 100%; outline: none; }
    .form-input-yota:focus { border-color: #BEF264; background: #fff; }
</style>

<div class="task-detail-container">
    <div style="max-width: 1000px; margin: 0 auto;">

        <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('general.workspace.show', $task->workspace_id) }}" style="text-decoration: none; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">← Kembali ke Board</a>
            <p style="font-size: 11px; font-weight: 800; color: #64748b;">Workspace: <span style="color: #0F172A;">{{ $task->workspace->name }}</span></p>
        </div>

        <div class="task-white-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px;">
                <div>
                    <span style="background: #0F172A; color: #BEF264; padding: 6px 15px; border-radius: 100px; font-size: 9px; font-weight: 900; text-transform: uppercase;">{{ $task->category }}</span>
                    <h1 style="font-size: 32px; font-weight: 900; color: #0F172A; margin-top: 15px; letter-spacing: -1.5px;">{{ $task->title }}</h1>
                    <p style="font-size: 13px; font-weight: 700; color: #94a3b8; margin-top: 5px;">Assignee: <span style="color: #0F172A;">{{ $task->assignee->name }}</span></p>
                </div>
                <div style="text-align: right;">
                    <div class="status-badge {{ $task->status_color }}">{{ $task->status }}</div>
                    <p style="font-size: 10px; font-weight: 800; color: #ef4444; margin-top: 10px; text-transform: uppercase;">Deadline: {{ $task->due_date->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div class="instruction-box">
                <label style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 10px;">Deskripsi & Instruksi Kerja</label>
                <div style="font-size: 15px; color: #334155; line-height: 1.8; font-weight: 500;">
                    {!! nl2br(e($task->description)) !!}
                </div>

                @if($task->instruction_link)
                <div style="margin-top: 25px; padding-top: 20px; border-top: 1px dashed #cbd5e1;">
                    <a href="{{ $task->instruction_link }}" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; background: #0F172A; color: #fff; padding: 12px 25px; border-radius: 15px; text-decoration: none; font-size: 11px; font-weight: 800;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                        BUKA PANDUAN KERJA
                    </a>
                </div>
                @endif
            </div>

            <div style="background: #fdfdfb; border: 2px dashed #e2e8f0; border-radius: 30px; padding: 35px; margin-bottom: 50px;">
                <h3 style="font-size: 14px; font-weight: 900; color: #0F172A; text-transform: uppercase; margin-bottom: 25px;">Submission & Status</h3>

                <form action="{{ route('general.workspace.task.update', $task->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <div style="display: grid; grid-template-columns: 1fr 1.5fr auto; gap: 20px; align-items: end;">
                        <div>
                            <label style="font-size: 9px; font-weight: 900; color: #94a3b8; display: block; margin-bottom: 8px;">UPDATE STATUS</label>
                            <select name="status" class="form-input-yota">
                                <option value="doing" {{ $task->status == 'doing' ? 'selected' : '' }}>🚧 Sedang Dikerjakan</option>
                                <option value="submitted" {{ $task->status == 'submitted' ? 'selected' : '' }}>📤 Ajukan Peninjauan</option>
                                @if(Auth::user()->role != 'anggota')
                                    <option value="revision" {{ $task->status == 'revision' ? 'selected' : '' }}>⚠️ Butuh Revisi</option>
                                    <option value="acc" {{ $task->status == 'acc' ? 'selected' : '' }}>✅ Selesai (ACC)</option>
                                @endif
                            </select>
                        </div>
                        <div>
                            <label style="font-size: 9px; font-weight: 900; color: #94a3b8; display: block; margin-bottom: 8px;">LINK HASIL KERJA (LINK DRIVE/DOKUMEN)</label>
                            <input type="url" name="submission_link" value="{{ $task->submission_link }}" placeholder="https://..." class="form-input-yota">
                        </div>
                        <button type="submit" style="background: #BEF264; color: #0F172A; padding: 18px 30px; border-radius: 15px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; cursor: pointer;">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <div style="border-top: 1px solid #f1f5f9; padding-top: 40px;">
                <h3 style="font-size: 16px; font-weight: 900; color: #0F172A; margin-bottom: 30px; display: flex; align-items: center; gap: 10px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    Diskusi Tim & Feedback
                </h3>

                <div style="margin-bottom: 40px;">
                    @forelse($task->comments as $comment)
                    <div class="comment-bubble">
                        <div style="width: 40px; height: 40px; background: #0F172A; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #BEF264; font-size: 12px; font-weight: 800; flex-shrink: 0;">
                            {{ substr($comment->user->name, 0, 1) }}
                        </div>
                        <div class="comment-content">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                <span style="font-size: 12px; font-weight: 900; color: #0F172A;">{{ $comment->user->name }}</span>
                                <span style="font-size: 10px; font-weight: 700; color: #94a3b8;">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p style="font-size: 14px; color: #475569; line-height: 1.6; margin: 0;">{{ $comment->comment }}</p>
                        </div>
                    </div>
                    @empty
                    <div style="text-align: center; padding: 30px; background: #f8fafc; border-radius: 20px;">
                        <p style="font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Belum ada diskusi. Mulai tanya atau beri feedback!</p>
                    </div>
                    @endforelse
                </div>

                <form action="{{ route('general.workspace.task.comment', $task->id) }}" method="POST">
                    @csrf
                    <div style="position: relative;">
                        <textarea name="comment" placeholder="Tulis masukan atau pertanyaan..." style="width: 100%; border: 2px solid #f1f5f9; border-radius: 25px; padding: 25px; padding-right: 150px; min-height: 100px; outline: none; font-family: inherit; font-weight: 600; font-size: 14px; resize: none;"></textarea>
                        <button type="submit" style="position: absolute; right: 15px; bottom: 15px; background: #0F172A; color: #BEF264; border: none; padding: 12px 25px; border-radius: 15px; font-size: 10px; font-weight: 900; text-transform: uppercase; cursor: pointer;">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
