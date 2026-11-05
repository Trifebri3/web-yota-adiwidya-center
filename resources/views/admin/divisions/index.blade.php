@extends('admin.layouts.app')

@section('title', 'Struktur Divisi - YOTA')

@section('content')
{{-- 1. TOP BAR --}}
<div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 35px;">
    <div>
        <h1 style="font-size: 26px; font-weight: 800; color: #222; letter-spacing: -1px; text-transform: uppercase;">
            Struktur <span style="color: var(--lemon);">Divisi</span>
        </h1>
        <p style="font-size: 13px; color: #999; font-weight: 500; margin-top: 4px;">Pusat kendali departemen dan delegasi pengurus YOTA.</p>
    </div>

    <a href="{{ route('admin.divisions.create') }}"
       style="background: #222; color: var(--lemon); padding: 14px 28px; border-radius: 14px; text-decoration: none; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); transition: var(--transition);"
       onmouseover="this.style.transform='translateY(-3px)'; this.style.background='var(--lemon)'; this.style.color='#222';"
       onmouseout="this.style.transform='translateY(0)'; this.style.background='#222'; this.style.color='var(--lemon)';">
        + Bentuk Divisi
    </a>
</div>

{{-- 2. GRID KARTU DIVISI --}}
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 25px;">
    @foreach($divisions as $division)
    <div class="card-custom" style="padding: 0; overflow: hidden; display: flex; flex-direction: column; height: 100%;">

        {{-- Header Kartu --}}
        <div style="padding: 25px; border-bottom: 1px solid #f8f8f8; flex-grow: 1;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                <div style="width: 50px; height: 50px; background: #fbfbfb; border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 1px solid #eee;">
                    @if($division->logo)
                        <img src="{{ asset('storage/'.$division->logo) }}" style="width: 100%; height: 100%; object-fit: contain; border-radius: 10px;">
                    @else
                        <span style="font-weight: 900; color: var(--lemon); font-size: 20px;">{{ substr($division->name, 0, 1) }}</span>
                    @endif
                </div>
                <div style="display: flex; gap: 8px;">
                    <a href="{{ route('admin.divisions.edit', $division->id) }}" style="text-decoration: none; font-size: 10px; font-weight: 800; color: #999; text-transform: uppercase; padding: 5px 10px; background: #f5f5f5; border-radius: 6px;">Ubah</a>
                </div>
            </div>

            <h3 style="font-size: 18px; font-weight: 800; color: #222; text-transform: uppercase; margin-bottom: 8px;">{{ $division->name }}</h3>
            <p style="font-size: 12px; color: #999; line-height: 1.6; margin-bottom: 20px;">{{ $division->description ?? 'Divisi aktif di bawah naungan Yota Adiwidya Center.' }}</p>

            {{-- Info Kepala Bidang (KABID) --}}
            <div style="background: #fffcf0; border: 1px solid #f9f2d5; padding: 15px; border-radius: 15px; display: flex; align-items: center; gap: 12px;">
                <div style="width: 35px; height: 35px; background: var(--lemon); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 900;">
                    👑
                </div>
                <div>
                    <span style="display: block; font-size: 9px; font-weight: 900; color: #b2b910; text-transform: uppercase; letter-spacing: 1px;">Kepala Bidang (KABID)</span>
                    <span style="font-size: 13px; font-weight: 700; color: #222;">{{ $division->kabid->name ?? 'Belum Diutus' }}</span>
                </div>
            </div>
        </div>

        {{-- Footer Kartu: Manajemen Anggota --}}
        <div style="padding: 20px 25px; background: #fafafa; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; flex-direction: column;">
                <span style="font-size: 10px; font-weight: 800; color: #bbb; text-transform: uppercase;">Total Anggota</span>
                <span style="font-size: 14px; font-weight: 800; color: #222;">{{ $division->members->count() }} Orang</span>
            </div>

            <button onclick="toggleMemberModal('{{ $division->id }}')"
                    style="background: transparent; border: 1.5px solid #eee; padding: 8px 15px; border-radius: 10px; font-size: 10px; font-weight: 800; color: #666; cursor: pointer; text-transform: uppercase; transition: 0.3s;">
                + Gabungkan Anggota
            </button>
        </div>
    </div>
    @endforeach
</div>

{{-- MODAL SIMPLE UNTUK ADD MEMBER --}}
<div id="memberModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
    <div class="card-custom" style="width: 100%; max-width: 500px; padding: 35px;">
        <h2 style="font-size: 20px; font-weight: 800; color: #222; text-transform: uppercase; margin-bottom: 5px;">Gabungkan <span style="color: var(--lemon);">Anggota</span></h2>
        <p style="font-size: 13px; color: #999; margin-bottom: 25px;">Pilih pengurus dengan role anggota untuk dimasukkan ke divisi ini.</p>

        <form id="addMemberForm" method="POST">
            @csrf
            <div style="max-height: 300px; overflow-y: auto; margin-bottom: 25px; border: 1px solid #f0f0f0; border-radius: 12px; padding: 10px;">
                @foreach($users_anggota as $user)
                    <label style="display: flex; align-items: center; gap: 12px; padding: 10px; cursor: pointer; border-bottom: 1px solid #fafafa;">
                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" style="accent-color: var(--lemon); width: 18px; height: 18px;">
                        <div>
                            <span style="display: block; font-size: 13px; font-weight: 700; color: #222;">{{ $user->name }}</span>
                            <span style="font-size: 10px; color: #bbb;">{{ $user->email }}</span>
                        </div>
                    </label>
                @endforeach
            </div>

            <div style="display: flex; gap: 15px;">
                <button type="button" onclick="toggleMemberModal()" style="flex: 1; padding: 15px; border-radius: 12px; border: 1px solid #eee; background: #fff; font-size: 11px; font-weight: 800; text-transform: uppercase; cursor: pointer;">Batal</button>
                <button type="submit" style="flex: 2; padding: 15px; border-radius: 12px; border: none; background: #222; color: var(--lemon); font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; cursor: pointer;">Proses Gabungkan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleMemberModal(divisionId = null) {
        const modal = document.getElementById('memberModal');
        const form = document.getElementById('addMemberForm');

        if (divisionId) {
            // Update action URL form secara dinamis
            form.action = `/admin/divisions/${divisionId}/add-members`;
            modal.style.display = 'flex';
        } else {
            modal.style.display = 'none';
        }
    }
</script>
@endsection
