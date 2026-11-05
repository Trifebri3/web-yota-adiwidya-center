@extends('admin.layouts.app')

@section('title', 'Bentuk Divisi Baru')

@section('content')
<div style="max-width: 850px;">
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 26px; font-weight: 800; color: #222; text-transform: uppercase; tracking: -1px;">
            Bentuk <span style="color: var(--lemon);">Divisi</span> Baru
        </h1>
        <p style="font-size: 14px; color: #999; font-weight: 500;">Inisialisasi departemen baru dan delegasikan pimpinan bidang.</p>
    </div>

    <div class="card-custom" style="background: #fff; padding: 40px; border-radius: 24px;">
        <form action="{{ route('admin.divisions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display: flex; flex-direction: column; gap: 25px;">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    {{-- Nama Divisi --}}
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Nama Divisi</label>
                        <input type="text" name="name" required placeholder="Contoh: Divisi Lingkungan & Sains"
                               style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 600;">
                    </div>

                    {{-- Delegasi Kabid --}}
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Tunjuk Kepala Bidang (KABID)</label>
                        <select name="kabid_id" required style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 700; cursor: pointer;">
                            <option value="" disabled selected>Pilih dari Pengurus Aktif</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role->value ?? $user->role }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Deskripsi & Visi Divisi</label>
                    <textarea name="description" rows="4" placeholder="Jelaskan fokus kerja divisi ini..."
                              style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 500; outline: none;"></textarea>
                </div>

                {{-- Logo --}}
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Logo / Icon Divisi</label>
                    <input type="file" name="logo" style="font-size: 12px; color: #999;">
                </div>

                <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f9f9f9; padding-top: 30px;">
                    <a href="{{ route('admin.divisions.index') }}" style="font-size: 11px; font-weight: 800; color: #999; text-transform: uppercase; text-decoration: none;">← Kembali</a>
                    <button type="submit" style="background: #222; color: var(--lemon); padding: 15px 40px; border-radius: 15px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; cursor: pointer;">Bentuk Divisi</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
