@extends('admin.layouts.app')

@section('title', 'Ubah Akses Pengurus')

@section('content')
<div style="max-width: 900px;">

    {{-- Header Section --}}
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 28px; font-weight: 800; color: #222; tracking: -1px; text-transform: uppercase; margin-bottom: 5px;">
            Ubah <span style="color: var(--lemon);">Akses</span>
        </h1>
        <p style="color: #999; font-size: 14px; font-weight: 500;">Perbarui kredensial dan hak akses untuk pengurus: <strong>{{ $user->name }}</strong>.</p>
    </div>

    {{-- Edit Card --}}
    <div class="card-custom" style="background: #fff; padding: 40px; border-radius: 24px; border: 1px solid #f0f0f0; box-shadow: 0 10px 40px rgba(0,0,0,0.02);">

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div style="display: flex; flex-direction: column; gap: 30px;">

                {{-- Row 1: Identitas Dasar --}}
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Nama Lengkap</label>
                        <input type="text" name="name" required value="{{ old('name', $user->name) }}"
                               style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 600; color: #222; outline: none;">
                        @error('name') <span style="color: #ff4757; font-size: 10px; font-weight: 700;">{{ $message }}</span> @enderror
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Alamat Email</label>
                        <input type="email" name="email" required value="{{ old('email', $user->email) }}"
                               style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 600; color: #222; outline: none;">
                        @error('email') <span style="color: #ff4757; font-size: 10px; font-weight: 700;">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Row 2: Jabatan & Keanggotaan --}}
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Role Akses</label>
                        <select name="role" required style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 700; color: #222; cursor: pointer; outline: none; appearance: none;">
                            @foreach($roles as $role)
                                <option value="{{ $role->value }}" {{ $user->role->value == $role->value ? 'selected' : '' }}>
                                    {{ ucfirst($role->value) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Status Keanggotaan</label>
                        <select name="membership_status" required style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 700; color: #222; cursor: pointer; outline: none; appearance: none;">
                            @foreach(['calon', 'aktif', 'nonaktif', 'alumni'] as $status)
                                <option value="{{ $status }}" {{ $user->membership_status == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Row 3: Pengaturan Password (Opsional) --}}
                <div style="background: #fffcf0; padding: 25px; border-radius: 18px; border: 1px solid #f9f2d5;">
                    <label style="font-size: 11px; font-weight: 900; color: #b2b910; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 10px;">Ganti Password (Kosongkan jika tidak ingin diubah)</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <input type="password" name="password" placeholder="Password baru"
                                   style="width: 100%; background: #fff; border: 1px solid #e0e0e0; padding: 12px 15px; border-radius: 10px; font-size: 13px;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                                   style="width: 100%; background: #fff; border: 1px solid #e0e0e0; padding: 12px 15px; border-radius: 10px; font-size: 13px;">
                        </div>
                    </div>
                    @error('password') <p style="color: #ff4757; font-size: 10px; font-weight: 700; margin-top: 8px;">{{ $message }}</p> @enderror
                </div>

                {{-- Submit Action --}}
                <div style="margin-top: 10px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f9f9f9; padding-top: 30px;">
                    <a href="{{ route('admin.users.index') }}" style="font-size: 11px; font-weight: 800; color: #999; text-transform: uppercase; text-decoration: none; letter-spacing: 1px;">
                        ← Batalkan Perubahan
                    </a>

                    <button type="submit" style="background: #222; color: var(--lemon); padding: 18px 40px; border-radius: 15px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        Update Data Pengurus
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
