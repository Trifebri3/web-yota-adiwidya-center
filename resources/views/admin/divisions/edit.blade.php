@extends('admin.layouts.app')

@section('title', 'Ubah Divisi')

@section('content')
<div style="max-width: 850px;">
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 26px; font-weight: 800; color: #222; text-transform: uppercase; tracking: -1px;">
            Ubah <span style="color: var(--lemon);">Divisi</span>
        </h1>
        <p style="font-size: 14px; color: #999; font-weight: 500;">Perbarui data departemen atau lakukan rotasi Kepala Bidang.</p>
    </div>

    <div class="card-custom" style="background: #fff; padding: 40px; border-radius: 24px;">
        <form action="{{ route('admin.divisions.update', $division->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div style="display: flex; flex-direction: column; gap: 30px;">

                {{-- Nama & Kabid --}}
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Nama Divisi</label>
                        <input type="text" name="name" value="{{ old('name', $division->name) }}" required
                               style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 700;">
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Kepala Bidang (Rotasi)</label>
                        <select name="kabid_id" required style="width: 100%; background: #fffcf0; border: 1px solid #f9f2d5; padding: 15px 20px; border-radius: 12px; font-size: 14px; font-weight: 700; color: #222;">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $division->kabid_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">Deskripsi Tugas</label>
                    <textarea name="description" rows="4" style="width: 100%; background: #fbfbfb; border: 1px solid #eee; padding: 15px 20px; border-radius: 12px; font-size: 14px;">{{ old('description', $division->description) }}</textarea>
                </div>

                {{-- Preview & Upload Logo --}}
                <div style="display: flex; align-items: center; gap: 20px;">
                    @if($division->logo)
                        <div style="width: 80px; height: 80px; background: #fbfbfb; border-radius: 15px; border: 1px solid #eee; padding: 10px;">
                            <img src="{{ asset('storage/'.$division->logo) }}" style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                    @endif
                    <div style="flex-grow: 1;">
                        <label style="font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 8px;">Ganti Logo Divisi</label>
                        <input type="file" name="logo">
                    </div>
                </div>

                {{-- Action --}}
                <div style="margin-top: 10px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f9f9f9; padding-top: 30px;">
                    <button type="button" onclick="confirmDelete()" style="background: transparent; border: none; color: #ff4757; font-size: 10px; font-weight: 800; text-transform: uppercase; cursor: pointer;">Bubarkan Divisi</button>

                    <div style="display: flex; gap: 15px;">
                        <a href="{{ route('admin.divisions.index') }}" style="padding: 15px 25px; border-radius: 12px; text-decoration: none; font-size: 11px; font-weight: 800; color: #999; text-transform: uppercase; border: 1px solid #eee;">Batal</a>
                        <button type="submit" style="background: #222; color: var(--lemon); padding: 15px 35px; border-radius: 15px; border: none; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; cursor: pointer;">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </form>

        {{-- Form Hapus (Hidden) --}}
        <form id="deleteForm" action="{{ route('admin.divisions.destroy', $division->id) }}" method="POST" style="display: none;">
            @csrf @method('DELETE')
        </form>
    </div>
</div>

<script>
    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin membubarkan divisi ini? Semua anggota akan dikembalikan ke status tanpa divisi.')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
@endsection
