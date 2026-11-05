@extends('direktur.layouts.app')

@section('content')
<style>
    .mandate-edit-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .executive-card { background: #fff; border-radius: 45px; border: 1px solid #f1f5f9; padding: 50px; box-shadow: 0 25px 50px rgba(0,0,0,0.03); }
    .input-executive { width: 100%; background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 20px; padding: 18px 25px; font-weight: 700; color: #0F172A; outline: none; margin-bottom: 20px; }
    .label-executive { font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; display: block; margin-bottom: 10px; }
</style>

<div class="mandate-edit-container">
    <div style="max-width: 900px; margin: 0 auto;">

        <h1 style="font-size: 28px; font-weight: 900; color: #0F172A; text-transform: uppercase; margin-bottom: 30px;">Sesuaikan <span style="color: #84cc16;">Mandat</span></h1>

        <div class="executive-card">
            <form action="{{ route('direktur.delegation.update', $delegation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="background: #0F172A; color: #fff; padding: 20px; border-radius: 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
                    <p style="margin: 0; font-size: 12px; font-weight: 800;">PENERIMA: {{ strtoupper($delegation->user->name) }}</p>
                    <span style="font-size: 10px; opacity: 0.6;">DIBACA: {{ $delegation->read_at ? $delegation->read_at->format('d/m/Y H:i') : 'Belum' }}</span>
                </div>

                <label class="label-executive">Subjek Mandat</label>
                <input type="text" name="title" value="{{ $delegation->title }}" class="input-executive">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label class="label-executive">Status Mandat</label>
                        <select name="status" class="input-executive">
                            <option value="sent" {{ $delegation->status == 'sent' ? 'selected' : '' }}>Sent (Terkirim)</option>
                            <option value="in_progress" {{ $delegation->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="revision" {{ $delegation->status == 'revision' ? 'selected' : '' }}>Revision (Minta Perbaikan)</option>
                            <option value="completed" {{ $delegation->status == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                        </select>
                    </div>
                    <div>
                        <label class="label-executive">Ubah Deadline</label>
                        <input type="datetime-local" name="deadline" value="{{ $delegation->deadline->format('Y-m-d\TH:i') }}" class="input-executive">
                    </div>
                </div>

                <label class="label-executive">Detail Instruksi</label>
                <textarea name="instruction" class="input-executive" style="min-height: 200px; resize: none;">{{ $delegation->instruction }}</textarea>

                <div style="display: flex; justify-content: space-between; margin-top: 30px;">
                    <a href="{{ route('direktur.delegation.index') }}" style="color: #94a3b8; font-size: 11px; font-weight: 900; text-decoration: none; padding-top: 15px;">BATALKAN</a>
                    <button type="submit" style="background: #0F172A; color: #BEF264; border: none; padding: 18px 50px; border-radius: 15px; font-weight: 900; cursor: pointer; text-transform: uppercase;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
