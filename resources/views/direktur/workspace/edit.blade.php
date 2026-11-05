
@extends('direktur.layouts.app')

@section('title', 'Konfigurasi Workspace - YOTA')

@section('content')
<style>
    .ws-edit-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .executive-card { background: #fff; border-radius: 45px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.05); position: relative; overflow: hidden; }
    .executive-card::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: #0F172A; }

    .form-group { margin-bottom: 25px; }
    .label-executive { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
    .input-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 20px; padding: 18px 25px; font-size: 15px; font-weight: 700; color: #0F172A; outline: none; transition: 0.3s; }
    .input-executive:focus { border-color: #BEF264; background: #fff; }

    .textarea-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 25px; padding: 25px; font-size: 15px; font-weight: 600; color: #334155; min-height: 150px; outline: none; line-height: 1.6; resize: none; }

    /* Member Selector Styling */
    .member-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; max-height: 350px; overflow-y: auto; padding: 10px; border: 2px solid #f1f5f9; border-radius: 25px; background: #f8fafc; }
    .member-checkbox { display: none; }
    .member-label { display: flex; align-items: center; gap: 12px; padding: 12px; background: #fff; border-radius: 15px; cursor: pointer; transition: 0.2s; border: 2px solid transparent; }
    .member-checkbox:checked + .member-label { border-color: #BEF264; background: #0F172A; color: #fff; }

    .status-indicator { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 12px; font-size: 11px; font-weight: 800; text-transform: uppercase; margin-bottom: 30px; }
    .active-badge { background: #f0fdf4; color: #15803d; }
</style>

<div class="ws-edit-container">
    <div style="max-width: 1100px; margin: 0 auto;">

        <div style="margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <a href="{{ route('direktur.workspace.index') }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">← Kembali</a>
                <h1 style="font-size: 36px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; margin-top: 10px; line-height: 1;">
                    Edit <span style="font-family: serif; font-style: italic; color: #84cc16;">Workspace</span>
                </h1>
            </div>
        </div>

        <div class="executive-card">
            <form action="{{ route('direktur.workspace.update', $workspace->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 60px;">
                    <div>
                        <div class="form-group">
                            <label class="label-executive">Nama Workspace</label>
                            <input type="text" name="name" value="{{ old('name', $workspace->name) }}" required class="input-executive">
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div class="form-group">
                                <label class="label-executive">Status Proyek</label>
                                <select name="status" class="input-executive">
                                    <option value="active" {{ $workspace->status == 'active' ? 'selected' : '' }}>Active (Running)</option>
                                    <option value="archived" {{ $workspace->status == 'archived' ? 'selected' : '' }}>Archived (Selesai/Arsip)</option>
                                    <option value="completed" {{ $workspace->status == 'completed' ? 'selected' : '' }}>Completed (Finish)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="label-executive">Link Folder Utama</label>
                                <input type="url" name="general_instruction_link" value="{{ old('general_instruction_link', $workspace->general_instruction_link) }}" class="input-executive" placeholder="https://...">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Deskripsi / Ruang Lingkup</label>
                            <textarea name="description" class="textarea-executive">{{ old('description', $workspace->description) }}</textarea>
                        </div>
                    </div>

                    <div>
                        <label class="label-executive">Manajemen Anggota Tim (Sync)</label>
                        <div class="member-grid">
                            @foreach($users as $user)
                            <div>
                                <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" id="user_{{ $user->id }}" class="member-checkbox"
                                    {{ in_array($user->id, $currentMemberIds) ? 'checked' : '' }}>
                                <label for="user_{{ $user->id }}" class="member-label">
                                    <div style="width: 30px; height: 30px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 800;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div style="overflow: hidden;">
                                        <p style="font-size: 12px; font-weight: 800; margin: 0; white-space: nowrap; text-overflow: ellipsis;">{{ $user->name }}</p>
                                        <p style="font-size: 9px; opacity: 0.6; margin: 0; text-transform: uppercase;">{{ $user->role }}</p>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <p style="font-size: 9px; color: #94a3b8; font-weight: 700; margin-top: 15px; text-transform: uppercase; line-height: 1.5;">
                            *Menghapus centang akan menarik akses user dari workspace ini secara otomatis.
                        </p>

                        <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; gap: 15px;">
                            <a href="{{ route('direktur.workspace.index') }}" style="flex: 1; text-align: center; text-decoration: none; color: #94a3b8; font-size: 11px; font-weight: 900; text-transform: uppercase; padding: 22px; border-radius: 20px; border: 2px solid #f1f5f9;">Batal</a>
                            <button type="submit" style="flex: 2; background: #0F172A; color: #BEF264; padding: 22px; border-radius: 20px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; cursor: pointer;">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
