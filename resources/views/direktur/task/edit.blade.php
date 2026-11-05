@extends('direktur.layouts.app')

@section('content')
<style>
    .task-edit-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .edit-card { background: #fff; border-radius: 40px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 20px 40px rgba(0,0,0,0.03); }
    .input-exec { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 15px; padding: 15px 20px; font-weight: 700; color: #0F172A; outline: none; margin-bottom: 20px; }
    .input-exec:focus { border-color: #BEF264; }
</style>

<div class="task-edit-container">
    <div style="max-width: 800px; margin: 0 auto;">

        <h1 style="font-size: 28px; font-weight: 900; color: #0F172A; text-transform: uppercase; margin-bottom: 30px;">Audit & <span style="color: #84cc16;">Penyesuaian Tugas</span></h1>

        <div class="edit-card">
            <form action="{{ route('direktur.task.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; display: block; margin-bottom: 10px;">Judul Tugas</label>
                <input type="text" name="title" value="{{ $task->title }}" class="input-exec">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; display: block; margin-bottom: 10px;">Status Progres</label>
                        <select name="status" class="input-exec">
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="revision" {{ $task->status == 'revision' ? 'selected' : '' }}>Revision (Revisi)</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed (ACC)</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; display: block; margin-bottom: 10px;">Deadline</label>
                        <input type="date" name="deadline" value="{{ $task->deadline->format('Y-m-d') }}" class="input-exec">
                    </div>
                </div>

                <label style="font-size: 10px; font-weight: 900; color: #B45309; text-transform: uppercase; display: block; margin-bottom: 10px;">Catatan Direktur / Feedback Revisi</label>
                <textarea name="director_note" class="input-exec" style="min-height: 150px; resize: none;" placeholder="Tuliskan alasan revisi atau apresiasi Anda di sini...">{{ $task->director_note }}</textarea>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 30px;">
                    <a href="{{ route('direktur.task.index') }}" style="color: #94a3b8; font-size: 11px; font-weight: 900; text-decoration: none;">BATAL</a>
                    <button type="submit" style="background: #0F172A; color: #BEF264; border: none; padding: 18px 40px; border-radius: 15px; font-weight: 900; cursor: pointer; text-transform: uppercase; font-size: 11px;">SIMPAN PERUBAHAN</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
