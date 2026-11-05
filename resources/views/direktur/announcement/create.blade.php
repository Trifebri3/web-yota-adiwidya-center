@extends('direktur.layouts.app')

@section('title', 'Terbitkan Instruksi Direksi')

@section('content')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

<style>
    /* Container Utama */
    .ann-create-container {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #FDFDFB;
        min-height: 100vh;
        padding: 20px md:padding: 40px;
    }

    /* Card Utama */
    .executive-form-card {
        background: #fff;
        border-radius: 35px;
        border: 1px solid #f1f5f9;
        padding: 40px;
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.05);
        position: relative;
        overflow: visible; /* Diubah dari hidden agar toolbar editor tidak terpotong */
    }

    .executive-form-card::before {
        content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: #0F172A; border-radius: 35px 35px 0 0;
    }

    .form-group { margin-bottom: 25px; }
    .label-executive { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; display: block; }

    /* Input Style */
    .input-executive {
        width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 15px;
        padding: 15px 20px; font-size: 15px; font-weight: 700; color: #0F172A; outline: none; transition: 0.3s;
    }
    .input-executive:focus { border-color: #BEF264; background: #fff; }

    /* Fix Trix Editor agar tidak kepotong */
    trix-editor {
        width: 100% !important;
        min-height: 450px !important; /* Tinggi minimal agar lega */
        max-height: 600px; /* Tinggi maksimal dengan scroll */
        overflow-y: auto !important;
        background: #f8fafc !important;
        border: 2px solid #f1f5f9 !important;
        border-radius: 20px !important;
        padding: 20px !important;
        font-size: 15px !important;
        color: #334155 !important;
        line-height: 1.6 !important;
        outline: none !important;
    }

    trix-editor:focus { border-color: #BEF264 !important; background: #fff !important; }

    /* Styling Toolbar Trix agar rapi */
    trix-toolbar {
        margin-bottom: 8px !important;
    }
    trix-toolbar .trix-button-row {
        border-bottom: none !important;
        gap: 4px;
    }
    trix-toolbar .trix-button {
        background: #fff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 6px !important;
        margin-bottom: 4px !important;
    }
    trix-toolbar .trix-button--active {
        background: #BEF264 !important;
        border-color: #0F172A !important;
    }

    /* Priority Selector Grid */
    .priority-selector { display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; }
    @media (min-width: 768px) { .priority-selector { grid-template-columns: repeat(4, 1fr); } }

    .priority-option { cursor: pointer; text-align: center; padding: 10px; border-radius: 12px; border: 2px solid #f1f5f9; transition: 0.3s; }
    .priority-option input { display: none; }
    .priority-option span { font-size: 9px; font-weight: 900; text-transform: uppercase; color: #94a3b8; }
    .priority-option:has(input:checked) { border-color: #0F172A; background: #0F172A; }
    .priority-option:has(input:checked) span { color: #BEF264; }

    /* Hide attachment icon */
    .trix-button--icon-attach { display: none !important; }
</style>

<div class="ann-create-container">
    <div style="max-width: 1100px; margin: 0 auto;">

        {{-- Header --}}
        <div style="margin-bottom: 30px; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-end; gap: 20px;">
            <div>
                <a href="{{ route('direktur.announcement.index') }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 10px;">← Kembali ke Bulletin</a>
                <h1 style="font-size: clamp(30px, 5vw, 45px); font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; line-height: 0.9;">
                    Tulis <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Pengumuman</span>
                </h1>
            </div>
            <div style="text-align: right; border-left: 4px solid #BEF264; padding-left: 15px;">
                <p style="font-size: 9px; font-weight: 900; color: #94a3b8; text-transform: uppercase; margin: 0;">Otoritas Pembuat</p>
                <p style="font-size: 13px; font-weight: 800; color: #0F172A; margin: 0;">DIREKTUR UTAMA</p>
            </div>
        </div>

        <div class="executive-form-card">
            <form action="{{ route('direktur.announcement.store') }}" method="POST">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr; lg:grid-template-columns: 1.7fr 1.3fr; gap: 40px;">

                    {{-- Kolom Kiri: Input Utama --}}
                    <div class="form-left-section">
                        <div class="form-group">
                            <label class="label-executive">Subjek Pengumuman</label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Judul instruksi resmi..." required class="input-executive">
                        </div>

                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="label-executive">Isi Pengumuman / Instruksi</label>
                            <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                            <trix-editor input="content" placeholder="Ketik atau tempel instruksi Anda di sini..."></trix-editor>
                            @error('content')
                                <p style="color: #ef4444; font-size: 10px; font-weight: 800; margin-top: 8px;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan: Pengaturan --}}
                    <div class="form-right-section" style="background: #fcfdfd; padding: 30px; border-radius: 25px; border: 1px solid #f1f5f9;">

                        <div class="form-group">
                            <label class="label-executive">Tingkat Urgensi</label>
                            <div class="priority-selector">
                                @foreach(['low', 'medium', 'high', 'urgent'] as $p)
                                <label class="priority-option">
                                    <input type="radio" name="priority" value="{{ $p }}" {{ old('priority', 'medium') == $p ? 'checked' : '' }}>
                                    <span>{{ $p }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label-executive">Target Divisi</label>
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
                            <label class="label-executive">Tanggal Berakhir (Opsional)</label>
                            <input type="date" name="expires_at" value="{{ old('expires_at') }}" class="input-executive">
                            <p style="font-size: 9px; color: #94a3b8; font-weight: 700; margin-top: 8px; text-transform: uppercase;">*Sistem akan menarik pengumuman otomatis</p>
                        </div>

                        <div style="margin-top: 40px;">
                            <button type="submit" style="width: 100%; background: #0F172A; color: #BEF264; padding: 20px; border-radius: 15px; border: none; font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(15,23,42,0.15);">
                                Terbitkan Sekarang
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Pastikan lampiran file dimatikan
    document.addEventListener("trix-file-accept", function(event) {
        event.preventDefault();
    });
</script>
@endsection
