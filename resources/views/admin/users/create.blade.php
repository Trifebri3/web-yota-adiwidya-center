@extends('admin.layouts.app')

@section('title', 'Tambah Pengurus Baru')

@section('content')
<div style="max-width: 900px;">

    {{-- Header Section --}}
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 28px; font-weight: 800; color: #222; tracking: -1px; text-transform: uppercase; margin-bottom: 5px;">
            Tambah <span style="color: var(--lemon);">Pengurus</span>
        </h1>
        <p style="color: #999; font-size: 14px; font-weight: 500;">Daftarkan anggota baru ke dalam ekosistem Yayasan Yota Adiwidya Center.</p>
    </div>

    {{-- Form Card --}}
    <div class="card-custom" style="background: #fff; padding: 40px; border-radius: 24px; border: 1px solid #f0f0f0; box-shadow: 0 10px 40px rgba(0,0,0,0.02);">

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div style="display: flex; flex-direction: column; gap: 30px;">

                {{-- Row 1: Identitas Dasar --}}
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Nama Lengkap</label>
                        <input type="text" name="name" required value="{{ old('name') }}" placeholder="Nama sesuai identitas"
                               style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 600; color: #222; outline: none; transition: 0.3s;"
                               onfocus="this.style.borderColor='var(--lemon)'; this.style.background='#fff';"
                               onblur="this.style.borderColor='#eee'; this.style.background='#fbfbfb';">
                        @error('name') <span style="color: #ff4757; font-size: 10px; font-weight: 700;">{{ $message }}</span> @enderror
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Alamat Email</label>
                        <input type="email" name="email" required value="{{ old('email') }}" placeholder="email@yota.or.id"
                               style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 600; color: #222; outline: none; transition: 0.3s;"
                               onfocus="this.style.borderColor='var(--lemon)'; this.style.background='#fff';"
                               onblur="this.style.borderColor='#eee'; this.style.background='#fbfbfb';">
                        @error('email') <span style="color: #ff4757; font-size: 10px; font-weight: 700;">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Row 2: Penempatan Organisasi --}}
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Role Akses</label>
                        <select name="role" required style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 700; color: #222; cursor: pointer; outline: none; appearance: none;">
                            <option value="" disabled selected>Pilih Jabatan</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->value }}">{{ ucfirst($role->value) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Status Awal</label>
                        <select name="membership_status" required style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 700; color: #222; cursor: pointer; outline: none; appearance: none;">
                            <option value="calon">Calon Pengurus</option>
                            <option value="aktif" selected>Aktif</option>
                        </select>
                    </div>
                </div>

                {{-- Row 3: Keamanan --}}
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Password Default</label>
                        <input type="password" name="password" required
                               style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; outline: none;">
                        @error('password') <span style="color: #ff4757; font-size: 10px; font-weight: 700;">{{ $message }}</span> @enderror
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                               style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; outline: none;">
                    </div>
                </div>

                {{-- Submit Action --}}
                <div style="margin-top: 10px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f9f9f9; padding-top: 30px;">
                    <a href="{{ route('admin.users.index') }}" style="font-size: 11px; font-weight: 800; color: #999; text-transform: uppercase; text-decoration: none; letter-spacing: 1px;">
                        ← Batal & Kembali
                    </a>

                    <button type="submit" style="background: #222; color: var(--lemon); padding: 18px 40px; border-radius: 15px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        Daftarkan Pengurus
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
