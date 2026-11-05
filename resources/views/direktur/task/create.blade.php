@extends('direktur.layouts.app')

@section('title', 'Delegasi Tugas Strategis - YOTA')

@section('content')
<style>
    .task-create-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .executive-card { background: #fff; border-radius: 45px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.05); position: relative; overflow: hidden; }
    .executive-card::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, #0F172A, #BEF264); }

    .form-group { margin-bottom: 25px; }
    .label-executive { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
    .input-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 20px; padding: 18px 25px; font-size: 15px; font-weight: 700; color: #0F172A; outline: none; transition: 0.3s; }
    .input-executive:focus { border-color: #0F172A; background: #fff; }

    .textarea-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 25px; padding: 25px; font-size: 15px; font-weight: 600; color: #334155; min-height: 150px; outline: none; line-height: 1.6; resize: none; }

    .info-box { background: #f0fdf4; border: 1px solid #dcfce7; padding: 20px; border-radius: 20px; margin-bottom: 30px; display: flex; align-items: center; gap: 15px; }
</style>

<div class="task-create-container">
    <div style="max-width: 1000px; margin: 0 auto;">

        <div style="margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <a href="{{ route('direktur.task.index') }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">← Kembali ke Dashboard</a>
                <h1 style="font-size: 40px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; margin-top: 10px; line-height: 1;">
                    Buat <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Delegasi</span>
                </h1>
            </div>
        </div>

        <div class="executive-card">
            <div class="info-box">
                <div style="background: #BEF264; padding: 10px; border-radius: 12px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#064E3B" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
                <p style="font-size: 12px; font-weight: 700; color: #064E3B; margin: 0;">Sistem akan mengirimkan notifikasi tugas baru kepada seluruh anggota divisi yang dipilih.</p>
            </div>

            <form action="{{ route('direktur.task.store') }}" method="POST">
                @csrf

                <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 50px;">
                    <div style="border-right: 1px solid #f1f5f9; padding-right: 50px;">
                        <div class="form-group">
                            <label class="label-executive">Nama / Judul Tugas</label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Pembuatan Laporan Bulanan Januari" required class="input-executive">
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Deskripsi / Briefing Singkat</label>
                            <textarea name="description" placeholder="Berikan gambaran umum mengenai hasil yang diharapkan..." class="textarea-executive">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Link Instruksi Detail (G-Drive / Cloud)</label>
                            <input type="url" name="instruction_link" value="{{ old('instruction_link') }}" placeholder="https://drive.google.com/..." class="input-executive">
                            <p style="font-size: 9px; color: #94a3b8; font-weight: 700; margin-top: 10px; text-transform: uppercase;">*Sertakan link dokumen panduan agar staf tidak bingung.</p>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label class="label-executive">Divisi Penanggung Jawab</label>
                            <select name="division_id" required class="input-executive" style="appearance: none;">
                                <option value="" disabled selected>Pilih Divisi Target</option>
                                @foreach($divisions as $div)
                                    <option value="{{ $div->id }}" {{ old('division_id') == $div->id ? 'selected' : '' }}>
                                        🎯 Divisi {{ $div->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Batas Akhir (Deadline)</label>
                            <input type="date" name="deadline" value="{{ old('deadline') }}" required class="input-executive">
                        </div>

                        <div style="margin-top: 80px; padding-top: 30px; border-top: 1px solid #f1f5f9;">
                            <button type="submit" style="width: 100%; background: #0F172A; color: #BEF264; padding: 22px; border-radius: 20px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; box-shadow: 0 20px 40px rgba(15,23,42,0.2);">
                                Kirim Delegasi Tugas
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
