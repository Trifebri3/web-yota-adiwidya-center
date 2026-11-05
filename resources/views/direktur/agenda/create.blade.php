@extends('direktur.layouts.app')
@section('title', 'Rancang Agenda Strategis - YOTA')

@section('content')
<style>
    .create-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .glass-card { background: #ffffff; border-radius: 50px; border: 1px solid #f1f5f9; box-shadow: 0 20px 50px rgba(15, 23, 42, 0.05); padding: 60px; }
    .input-label { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
    .input-field { width: 100%; background-color: #f8fafc; border: 2px solid #f1f5f9; border-radius: 20px; padding: 18px 25px; font-size: 15px; font-weight: 700; color: #0F172A; transition: all 0.3s ease; outline: none; }
    .input-field:focus { border-color: #BEF264; background-color: #fff; box-shadow: 0 10px 20px rgba(190, 242, 100, 0.1); }
    .section-title { font-size: 14px; font-weight: 900; color: #064E3B; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 30px; display: flex; align-items: center; gap: 10px; }
    .section-line { flex: 1; height: 1px; background: #f1f5f9; }
</style>

<div class="create-container">
    <div style="max-width: 900px; margin: 0 auto;">

        <div style="margin-bottom: 50px; text-align: center;">
            <h1 style="font-size: 40px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; line-height: 1;">
                Rancang <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Agenda Baru</span>
            </h1>
            <p style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 3px; margin-top: 15px;">Inisialisasi Penjadwalan Kerja & Delegasi Presensi</p>
        </div>

        <div class="glass-card">
            <form action="{{ route('direktur.agenda.store') }}" method="POST">
                @csrf

                <div class="section-title">
                    <span>01. Identitas Agenda</span>
                    <div class="section-line"></div>
                </div>

                <div style="margin-bottom: 35px;">
                    <label class="input-label">Judul Agenda Strategis</label>
                    <input type="text" name="title" required placeholder="Masukkan Nama Kegiatan..." class="input-field">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 40px;">
                    <div>
                        <label class="input-label">Tipe Kegiatan</label>
                        <select name="type" class="input-field" style="appearance: none;">
                            <option value="rapat_rutin">Rapat Rutin</option>
                            <option value="agenda_umum">Agenda Umum</option>
                            <option value="urgent">Urgent / Darurat</option>
                        </select>
                    </div>
                    <div>
                        <label class="input-label">Metode Pertemuan</label>
                        <select name="method" class="input-field" style="appearance: none;">
                            <option value="online">Online (Virtual)</option>
                            <option value="offline">Offline (Tatap Muka)</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                    </div>
                </div>

                <div class="section-title">
                    <span>02. Penjadwalan</span>
                    <div class="section-line"></div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 35px;">
                    <div>
                        <label class="input-label">Waktu Mulai</label>
                        <input type="datetime-local" name="start_time" required class="input-field">
                    </div>
                    <div>
                        <label class="input-label">Estimasi Selesai</label>
                        <input type="datetime-local" name="end_time" required class="input-field">
                    </div>
                </div>

                <div style="background: #f8fafc; padding: 25px; border-radius: 30px; margin-bottom: 40px; border: 1px dashed #cbd5e1;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                        <div>
                            <label class="input-label">Pengulangan (Recurring)</label>
                            <select name="repeat" class="input-field" style="background: #fff;">
                                <option value="none">Tidak Berulang</option>
                                <option value="daily">Setiap Hari</option>
                                <option value="weekly">Setiap Minggu</option>
                                <option value="monthly">Setiap Bulan</option>
                            </select>
                        </div>
                        <div>
                            <label class="input-label">Berakhir Pada (Opsional)</label>
                            <input type="date" name="repeat_until" class="input-field" style="background: #fff;">
                        </div>
                    </div>
                </div>

                <div class="section-title">
                    <span>03. Lokasi & Tautan</span>
                    <div class="section-line"></div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 50px;">
                    <div>
                        <label class="input-label">Lokasi (Jika Offline)</label>
                        <input type="text" name="location" placeholder="Nama Ruangan / Tempat..." class="input-field">
                    </div>
                    <div>
                        <label class="input-label">Meeting Link (Jika Online)</label>
                        <input type="url" name="meeting_link" placeholder="https://zoom.us/j/..." class="input-field">
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 40px; border-top: 1px solid #f1f5f9;">
                    <a href="{{ route('direktur.agenda.index') }}" style="font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; text-decoration: none; letter-spacing: 1px;">← Batalkan</a>

                    <button type="submit" style="background: #0F172A; color: #BEF264; padding: 22px 50px; border-radius: 25px; border: none; font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2);">
                        Publikasikan Agenda
                    </button>
                </div>
            </form>
        </div>

        <p style="text-align: center; font-size: 10px; color: #94a3b8; font-weight: 700; margin-top: 30px; text-transform: uppercase; letter-spacing: 1px;">
            Sistem akan otomatis membuat daftar kehadiran untuk seluruh pengurus aktif.
        </p>
    </div>
</div>
@endsection
