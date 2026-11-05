@extends('direktur.layouts.app')

@section('title', 'Penyesuaian Instruksi Direksi')

@section('content')
<style>
    .ann-edit-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .executive-form-card { background: #fff; border-radius: 45px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.05); position: relative; overflow: hidden; }
    .executive-form-card::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, #ef4444, #f59e0b, #3b82f6, #BEF264); }

    .form-group { margin-bottom: 30px; }
    .label-executive { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
    .input-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 20px; padding: 18px 25px; font-size: 15px; font-weight: 700; color: #0F172A; outline: none; transition: 0.3s; }
    .input-executive:focus { border-color: #0F172A; background: #fff; box-shadow: 0 10px 20px rgba(15, 23, 42, 0.05); }

    .textarea-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 25px; padding: 25px; font-size: 15px; font-weight: 600; color: #334155; min-height: 200px; outline: none; line-height: 1.6; }
    .textarea-executive:focus { border-color: #0F172A; background: #fff; }

    .switch-container { display: flex; align-items: center; gap: 15px; background: #f8fafc; padding: 20px; border-radius: 20px; border: 2px solid #f1f5f9; }
</style>

<div class="ann-edit-container">
    <div style="max-width: 1000px; margin: 0 auto;">

        <div style="margin-bottom: 40px;">
            <a href="{{ route('direktur.announcement.index') }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">← Batalkan Perubahan</a>
            <h1 style="font-size: 36px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; margin-top: 15px; line-height: 1;">
                Ubah <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Instruksi</span>
            </h1>
            <p style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 3px; margin-top: 10px;">ID Pengumuman: #{{ $announcement->id }}</p>
        </div>

        <div class="executive-form-card">
            <form action="{{ route('direktur.announcement.update', $announcement->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">
                    <div style="border-right: 1px solid #f1f5f9; padding-right: 40px;">
                        <div class="form-group">
                            <label class="label-executive">Subjek / Judul Pengumuman</label>
                            <input type="text" name="title" value="{{ old('title', $announcement->title) }}" required class="input-executive">
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Isi Instruksi Lengkap</label>
                            <textarea name="content" required class="textarea-executive">{{ old('content', $announcement->content) }}</textarea>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label class="label-executive">Skala Prioritas</label>
                            <select name="priority" class="input-executive">
                                <option value="low" {{ $announcement->priority == 'low' ? 'selected' : '' }}>Low / Biasa</option>
                                <option value="medium" {{ $announcement->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $announcement->priority == 'high' ? 'selected' : '' }}>High / Penting</option>
                                <option value="urgent" {{ $announcement->priority == 'urgent' ? 'selected' : '' }}>Urgent / Genting</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Target Audien</label>
                            <select name="division_id" class="input-executive">
                                <option value="">📢 Semua Divisi (Umum)</option>
                                @foreach($divisions as $div)
                                    <option value="{{ $div->id }}" {{ $announcement->division_id == $div->id ? 'selected' : '' }}>
                                        🎯 Divisi {{ $div->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Batas Waktu Tayang</label>
                            <input type="date" name="expires_at"
                                   value="{{ $announcement->expires_at ? $announcement->expires_at->format('Y-m-d') : '' }}"
                                   class="input-executive">
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Status Visibilitas</label>
                            <div class="switch-container">
                                <input type="checkbox" name="is_active" id="is_active" {{ $announcement->is_active ? 'checked' : '' }}
                                       style="width: 20px; height: 20px; accent-color: #0F172A;">
                                <label for="is_active" style="font-size: 12px; font-weight: 800; color: #0F172A;">Tampilkan di Dashboard</label>
                            </div>
                        </div>

                        <div style="margin-top: 50px;">
                            <button type="submit" style="width: 100%; background: #0F172A; color: #BEF264; padding: 22px; border-radius: 20px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; box-shadow: 0 15px 30px rgba(15,23,42,0.2);">
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
