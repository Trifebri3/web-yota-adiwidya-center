@extends(Auth::user()->role->value . '.layouts.app')

@section('title', 'Terbitkan Instruksi Direksi')

@section('content')
<style>
    .ann-create-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .executive-form-card { background: #fff; border-radius: 45px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.05); position: relative; overflow: hidden; }
    .executive-form-card::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: #0F172A; }

    .form-group { margin-bottom: 30px; }
    .label-executive { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
    .input-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 20px; padding: 18px 25px; font-size: 15px; font-weight: 700; color: #0F172A; outline: none; transition: 0.3s; }
    .input-executive:focus { border-color: #BEF264; background: #fff; }

    .textarea-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 25px; padding: 25px; font-size: 15px; font-weight: 600; color: #334155; min-height: 250px; outline: none; line-height: 1.6; resize: none; }
    .textarea-executive:focus { border-color: #BEF264; background: #fff; }

    .priority-selector { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 20px; }
    .priority-option { cursor: pointer; text-align: center; padding: 12px; border-radius: 15px; border: 2px solid #f1f5f9; transition: 0.3s; }
    .priority-option input { display: none; }
    .priority-option span { font-size: 9px; font-weight: 900; text-transform: uppercase; color: #94a3b8; }

    /* Active State for Priority */
    .priority-option:has(input:checked) { border-color: #0F172A; background: #0F172A; }
    .priority-option:has(input:checked) span { color: #BEF264; }
</style>

<div class="ann-create-container">
    <div style="max-width: 1000px; margin: 0 auto;">

        <div style="margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <a href="{{ route('audit.announcement.index') }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">← Kembali ke Bulletin</a>
                <h1 style="font-size: 40px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; margin-top: 10px; line-height: 1;">
                    Tulis <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Pengumuman</span>
                </h1>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">Otoritas Pembuat</p>
                <p style="font-size: 14px; font-weight: 800; color: #0F172A;">DIREKTUR UTAMA</p>
            </div>
        </div>

        <div class="executive-form-card">
            <form action="{{ route('audit.announcement.store') }}" method="POST">
                @csrf

                <div style="display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 50px;">
                    <div style="border-right: 1px solid #f1f5f9; padding-right: 50px;">
                        <div class="form-group">
                            <label class="label-executive">Subjek Pengumuman</label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Perubahan Jadwal Operasional Ramadhan" required class="input-executive">
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Isi Pengumuman / Instruksi</label>
                            <textarea name="content" placeholder="Tuliskan detail instruksi Anda di sini secara jelas..." required class="textarea-executive">{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label class="label-executive">Skala Prioritas</label>
                            <div class="priority-selector">
                                <label class="priority-option">
                                    <input type="radio" name="priority" value="low" {{ old('priority') == 'low' ? 'checked' : '' }}>
                                    <span>Low</span>
                                </label>
                                <label class="priority-option">
                                    <input type="radio" name="priority" value="medium" {{ old('priority', 'medium') == 'medium' ? 'checked' : '' }}>
                                    <span>Med</span>
                                </label>
                                <label class="priority-option">
                                    <input type="radio" name="priority" value="high" {{ old('priority') == 'high' ? 'checked' : '' }}>
                                    <span>High</span>
                                </label>
                                <label class="priority-option">
                                    <input type="radio" name="priority" value="urgent" {{ old('priority') == 'urgent' ? 'checked' : '' }}>
                                    <span>Urgent</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Target Distribusi</label>
                            <select name="division_id" class="input-executive">
                                <option value="">📢 Pengumuman Umum (Semua)</option>
                                @foreach($divisions as $div)
                                    <option value="{{ $div->id }}" {{ old('division_id') == $div->id ? 'selected' : '' }}>
                                        🎯 Divisi {{ $div->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Tanggal Kadaluarsa (Opsional)</label>
                            <input type="date" name="expires_at" value="{{ old('expires_at') }}" class="input-executive">
                            <p style="font-size: 9px; color: #94a3b8; font-weight: 700; margin-top: 10px; text-transform: uppercase;">*Akan otomatis ditarik setelah tanggal ini</p>
                        </div>

                        <div style="margin-top: 60px; padding-top: 30px; border-top: 1px solid #f1f5f9;">
                            <button type="submit" style="width: 100%; background: #0F172A; color: #BEF264; padding: 22px; border-radius: 20px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; box-shadow: 0 20px 40px rgba(15,23,42,0.2);">
                                Terbitkan Pengumuman
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
