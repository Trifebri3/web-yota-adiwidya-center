@extends('direktur.layouts.app')

@section('title', 'Terbitkan Evaluasi Strategis - YOTA')

@section('content')
<style>
    .eval-create-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .executive-card { background: #fff; border-radius: 45px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.05); position: relative; overflow: hidden; }
    .executive-card::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, #BEF264, #3b82f6, #ef4444); }

    .form-group { margin-bottom: 25px; }
    .label-executive { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
    .input-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 20px; padding: 18px 25px; font-size: 14px; font-weight: 700; color: #0F172A; outline: none; transition: 0.3s; }
    .input-executive:focus { border-color: #0F172A; background: #fff; }

    .textarea-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 25px; padding: 25px; font-size: 15px; font-weight: 600; color: #334155; min-height: 180px; outline: none; line-height: 1.6; resize: none; }

    .type-selector { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 30px; }
    .type-option { cursor: pointer; text-align: center; padding: 15px; border-radius: 20px; border: 2px solid #f1f5f9; transition: 0.3s; position: relative; }
    .type-option input { position: absolute; opacity: 0; }
    .type-option span { font-size: 11px; font-weight: 900; text-transform: uppercase; color: #94a3b8; }

    .type-option:has(input:checked) { border-color: #0F172A; background: #0F172A; }
    .type-option:has(input:checked) span { color: #BEF264; }

    .hidden { display: none; }
</style>

<div class="eval-create-container">
    <div style="max-width: 900px; margin: 0 auto;">

        <div style="margin-bottom: 40px;">
            <a href="{{ route('direktur.evaluation.index') }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">← Kembali ke List</a>
            <h1 style="font-size: 40px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; margin-top: 15px; line-height: 1;">
                Tulis <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Evaluasi</span>
            </h1>
            <p style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 3px; margin-top: 10px;">Audit Performa Divisi & Staf Perorangan</p>
        </div>

        <div class="executive-card">
            <form action="{{ route('direktur.evaluation.store') }}" method="POST">
                @csrf

                <label class="label-executive">Target Evaluasi</label>
                <div class="type-selector">
                    <label class="type-option">
                        <input type="radio" name="type" value="division" onclick="toggleTarget('division')" {{ old('type') == 'division' ? 'checked' : '' }}>
                        <span>🏢 Per Divisi</span>
                    </label>
                    <label class="type-option">
                        <input type="radio" name="type" value="user" onclick="toggleTarget('user')" {{ old('type', 'user') == 'user' ? 'checked' : '' }}>
                        <span>👤 Perorangan (Staf)</span>
                    </label>
                </div>

                <div id="division_select" class="form-group {{ old('type') == 'division' ? '' : 'hidden' }}">
                    <label class="label-executive">Pilih Divisi Sasaran</label>
                    <select name="division_id" class="input-executive">
                        <option value="">-- Pilih Divisi --</option>
                        @foreach($divisions as $div)
                            <option value="{{ $div->id }}">{{ $div->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="user_select" class="form-group {{ old('type') == 'user' || !old('type') ? '' : 'hidden' }}">
                    <label class="label-executive">Pilih Nama Staf</label>
                    <select name="user_id" class="input-executive">
                        <option value="">-- Pilih Nama Staf --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                        @endforeach
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 2fr 1.2fr; gap: 25px; margin-top: 30px;">
                    <div class="form-group">
                        <label class="label-executive">Subjek / Topik Evaluasi</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Kedisiplinan Kehadiran Rapat" required class="input-executive">
                    </div>
                    <div class="form-group">
                        <label class="label-executive">Kategori Catatan</label>
                        <select name="label" required class="input-executive">
                            <option value="general">Umum / Rutin</option>
                            <option value="praise">Apresiasi (Praise)</option>
                            <option value="improvement">Saran (Improvement)</option>
                            <option value="warning">Teguran (Warning)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="label-executive">Isi Catatan Evaluasi & Kritik/Saran</label>
                    <textarea name="content" placeholder="Berikan evaluasi yang mendalam dan solutif..." required class="textarea-executive">{{ old('content') }}</textarea>
                </div>

                <div style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end;">
                    <button type="submit" style="background: #0F172A; color: #BEF264; padding: 20px 60px; border-radius: 20px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; box-shadow: 0 15px 30px rgba(15,23,42,0.15);">
                        Terbitkan Catatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleTarget(type) {
        const divSelect = document.getElementById('division_select');
        const userSelect = document.getElementById('user_select');

        if (type === 'division') {
            divSelect.classList.remove('hidden');
            userSelect.classList.add('hidden');
        } else {
            divSelect.classList.add('hidden');
            userSelect.classList.remove('hidden');
        }
    }
</script>
@endsection
