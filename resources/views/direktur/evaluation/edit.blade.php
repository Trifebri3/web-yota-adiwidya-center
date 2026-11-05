@extends('direktur.layouts.app')

@section('title', 'Sesuaikan Evaluasi - YOTA')

@section('content')
<style>
    .eval-edit-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .executive-card { background: #fff; border-radius: 45px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.05); position: relative; overflow: hidden; }
    .executive-card::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: #0F172A; }

    .label-executive { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
    .input-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 20px; padding: 18px 25px; font-size: 14px; font-weight: 700; color: #0F172A; outline: none; transition: 0.3s; }
    .input-executive:focus { border-color: #BEF264; background: #fff; }

    .textarea-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 25px; padding: 25px; font-size: 15px; font-weight: 600; color: #334155; min-height: 200px; outline: none; line-height: 1.6; resize: none; }
    .target-info { background: #0F172A; color: #BEF264; padding: 15px 25px; border-radius: 20px; margin-bottom: 30px; font-size: 12px; font-weight: 800; display: inline-block; }
</style>

<div class="eval-edit-container">
    <div style="max-width: 900px; margin: 0 auto;">

        <div style="margin-bottom: 40px;">
            <a href="{{ route('direktur.evaluation.index') }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">← Batalkan</a>
            <h1 style="font-size: 36px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; margin-top: 15px; line-height: 1;">
                Modifikasi <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Catatan</span>
            </h1>
        </div>

        <div class="executive-card">
            <div class="target-info">
                TARGET:
                @if($evaluation->type == 'division')
                    🏢 DIVISI {{ strtoupper($evaluation->division->name) }}
                @else
                    👤 STAF: {{ strtoupper($evaluation->user->name) }}
                @endif
            </div>

            <form action="{{ route('direktur.evaluation.update', $evaluation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px; margin-top: 10px;">
                    <div class="form-group">
                        <label class="label-executive">Subjek / Topik Evaluasi</label>
                        <input type="text" name="title" value="{{ old('title', $evaluation->title) }}" required class="input-executive">
                    </div>
                    <div class="form-group">
                        <label class="label-executive">Ubah Kategori</label>
                        <select name="label" required class="input-executive">
                            <option value="general" {{ $evaluation->label == 'general' ? 'selected' : '' }}>Umum / Rutin</option>
                            <option value="praise" {{ $evaluation->label == 'praise' ? 'selected' : '' }}>Apresiasi (Praise)</option>
                            <option value="improvement" {{ $evaluation->label == 'improvement' ? 'selected' : '' }}>Saran (Improvement)</option>
                            <option value="warning" {{ $evaluation->label == 'warning' ? 'selected' : '' }}>Teguran (Warning)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="label-executive">Isi Catatan Evaluasi & Kritik/Saran</label>
                    <textarea name="content" required class="textarea-executive">{{ old('content', $evaluation->content) }}</textarea>
                </div>

                <div style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                    <p style="font-size: 10px; color: #94a3b8; font-weight: 700; text-transform: uppercase;">*Perubahan akan langsung terlihat oleh target terkait.</p>
                    <button type="submit" style="background: #0F172A; color: #BEF264; padding: 20px 60px; border-radius: 20px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; cursor: pointer;">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
