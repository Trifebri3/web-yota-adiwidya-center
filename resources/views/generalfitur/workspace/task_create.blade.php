@extends(Auth::user()->role->value . '.layouts.app')

@section('title', 'Buat Tugas Baru - ' . $workspace->name)

@section('content')
<style>
    .task-create-container { font-family: 'Plus Jakarta Sans', sans-serif; padding: 40px; background: #FDFDFB; min-height: 100vh; }
    .executive-card { background: #fff; border-radius: 40px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.05); }

    .form-group { margin-bottom: 25px; }
    .label-yota { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
    .input-yota { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 18px; padding: 15px 22px; font-size: 14px; font-weight: 700; color: #002c16; outline: none; transition: 0.3s; }
    .input-yota:focus { border-color: #BEF264; background: #fff; }

    .textarea-yota { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 20px; padding: 22px; font-size: 14px; font-weight: 600; color: #334155; min-height: 120px; outline: none; resize: none; }
</style>

<div class="task-create-container">
    <div style="max-width: 900px; margin: 0 auto;">

        <div style="margin-bottom: 35px;">
            <a href="{{ route('general.workspace.show', $workspace->id) }}" style="text-decoration: none; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">← Kembali ke Board</a>
            <h1 style="font-size: 32px; font-weight: 900; color: #002c16; letter-spacing: -1.5px; margin-top: 15px;">Buat <span style="color: #84cc16;">Tugas Baru</span></h1>
            <p style="font-size: 12px; color: #64748b; font-weight: 700; margin-top: 5px;">Workspace: {{ $workspace->name }}</p>
        </div>

        <div class="executive-card">
            <form action="{{ route('general.workspace.task.store') }}" method="POST">
                @csrf
                <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    <div>
                        <div class="form-group">
                            <label class="label-yota">Judul Tugas</label>
                            <input type="text" name="title" placeholder="Misal: Desain Landing Page" required class="input-yota">
                        </div>

                        <div class="form-group">
                            <label class="label-yota">Kategori / Label</label>
                            <select name="category" required class="input-yota">
                                <option value="Design">Design</option>
                                <option value="Development">Development</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Research">Research</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="label-yota">Link Instruksi Tambahan (G-Drive)</label>
                            <input type="url" name="instruction_link" placeholder="https://..." class="input-yota">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label class="label-yota">Pilih Pelaksana (Assignee)</label>
                            <select name="assignee_id" required class="input-yota">
                                <option value="" disabled selected>Pilih Anggota Tim</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->role->value }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="label-yota">Tenggat Waktu (Deadline)</label>
                            <input type="datetime-local" name="due_date" required class="input-yota">
                        </div>

                        <div class="form-group">
                            <label class="label-yota">Deskripsi Singkat</label>
                            <textarea name="description" placeholder="Jelaskan detail tugas ini..." class="textarea-yota"></textarea>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end;">
                    <button type="submit" style="background: #002c16; color: #BEF264; padding: 18px 40px; border-radius: 15px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; cursor: pointer;">
                        Publish Tugas ke Board
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
