@extends('direktur.layouts.app')

@section('title', 'Penyesuaian Agenda Strategis - YOTA')

@section('content')
<style>
    .edit-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .executive-card { background: #ffffff; border-radius: 50px; border: 1px solid #f1f5f9; box-shadow: 0 20px 50px rgba(15, 23, 42, 0.05); padding: 60px; position: relative; overflow: hidden; }
    .executive-card::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 8px; background: linear-gradient(90deg, #0F172A, #BEF264); }

    .label-caps { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px; display: block; }
    .input-edit { width: 100%; background-color: #f8fafc; border: 2px solid #f1f5f9; border-radius: 20px; padding: 18px 25px; font-size: 15px; font-weight: 700; color: #0F172A; transition: 0.3s; outline: none; }
    .input-edit:focus { border-color: #0F172A; background-color: #fff; }

    .badge-id { background: #0F172A; color: #BEF264; padding: 6px 15px; border-radius: 10px; font-size: 10px; font-weight: 900; margin-bottom: 20px; display: inline-block; }
</style>

<div class="edit-container">
    <div style="max-width: 900px; margin: 0 auto;">

        <div style="margin-bottom: 50px; text-align: left;">
            <a href="{{ route('direktur.agenda.index') }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 15px;">← Batal & Kembali</a>
            <h1 style="font-size: 40px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; line-height: 1;">
                Penyesuaian <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Agenda</span>
            </h1>
            <p style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 3px; margin-top: 15px;">Modifikasi Parameter Penjadwalan Strategis</p>
        </div>

        <div class="executive-card">
            <div class="badge-id">RESOURCE ID: #{{ $agenda->id }}</div>

            <form action="{{ route('direktur.agenda.update', $agenda->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 35px;">
                    <label class="label-caps">Judul Agenda Utama</label>
                    <input type="text" name="title" value="{{ old('title', $agenda->title) }}" required class="input-edit">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 40px;">
                    <div>
                        <label class="label-caps">Tipe Agenda</label>
                        <select name="type" class="input-edit">
                            <option value="rapat_rutin" {{ $agenda->type == 'rapat_rutin' ? 'selected' : '' }}>Rapat Rutin</option>
                            <option value="agenda_umum" {{ $agenda->type == 'agenda_umum' ? 'selected' : '' }}>Agenda Umum</option>
                            <option value="urgent" {{ $agenda->type == 'urgent' ? 'selected' : '' }}>Urgent / Darurat</option>
                        </select>
                    </div>
                    <div>
                        <label class="label-caps">Metode Pertemuan</label>
                        <select name="method" class="input-edit">
                            <option value="online" {{ $agenda->method == 'online' ? 'selected' : '' }}>Online (Virtual)</option>
                            <option value="offline" {{ $agenda->method == 'offline' ? 'selected' : '' }}>Offline (Tatap Muka)</option>
                            <option value="hybrid" {{ $agenda->method == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>
                </div>

                <div style="background: #0F172A; padding: 40px; border-radius: 35px; margin-bottom: 40px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                        <div>
                            <label class="label-caps" style="color: rgba(255,255,255,0.4);">Penyesuaian Waktu Mulai</label>
                            <input type="datetime-local" name="start_time"
                                   value="{{ $agenda->start_time->format('Y-m-d\TH:i') }}" required
                                   class="input-edit" style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); color: #fff;">
                        </div>
                        <div>
                            <label class="label-caps" style="color: rgba(255,255,255,0.4);">Estimasi Waktu Selesai</label>
                            <input type="datetime-local" name="end_time"
                                   value="{{ $agenda->end_time->format('Y-m-d\TH:i') }}" required
                                   class="input-edit" style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); color: #fff;">
                        </div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 50px;">
                    <div>
                        <label class="label-caps">Lokasi Fisik</label>
                        <input type="text" name="location" value="{{ old('location', $agenda->location) }}" class="input-edit" placeholder="Nama Ruangan...">
                    </div>
                    <div>
                        <label class="label-caps">Meeting Link (URL)</label>
                        <input type="url" name="meeting_link" value="{{ old('meeting_link', $agenda->meeting_link) }}" class="input-edit" placeholder="https://...">
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 40px; border-top: 1px solid #f1f5f9;">
                    <p style="font-size: 10px; color: #94a3b8; font-weight: 700; text-transform: uppercase; width: 40%;">
                        *Pembaruan data akan langsung tersinkronisasi ke seluruh dashboard pengurus.
                    </p>

                    <div style="display: flex; gap: 15px;">
                        <button type="submit" style="background: #BEF264; color: #0F172A; padding: 22px 50px; border-radius: 25px; border: none; font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; box-shadow: 0 15px 30px rgba(190, 242, 100, 0.2);">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
