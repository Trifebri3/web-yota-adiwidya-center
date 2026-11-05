@extends('admin.layouts.app')

@section('title', 'Database Pengurus - YOTA')

@section('content')
{{-- Top Bar: Judul & Aksi Utama --}}
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div>
        <h1 style="font-size: 24px; font-weight: 800; color: #222; tracking: -1px; text-transform: uppercase;">
            Database <span style="color: var(--lemon);">Pengurus</span>
        </h1>
        <p style="font-size: 13px; color: #999; font-weight: 500;">Yayasan Yota Adiwidya Center — Manajemen Akses & Keanggotaan</p>
    </div>

    <a href="{{ route('admin.users.create') }}"
       style="background: var(--lemon); color: #222; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 15px rgba(217, 224, 33, 0.2); transition: all 0.3s ease;"
       onmouseover="this.style.background='#222'; this.style.color='#fff';"
       onmouseout="this.style.background='var(--lemon)'; this.style.color='#222';">
        + Tambah Pengurus
    </a>
</div>

{{-- Tabel Data Lengkap --}}
<div class="card-custom" style="padding: 0; overflow: hidden; border: 1px solid #eee; background: #fff;">
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 1000px;">
            <thead>
                <tr style="background: #fafafa;">
                    <th style="padding: 18px 25px; text-align: left; font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #eee;">Identitas</th>
                    <th style="padding: 18px 25px; text-align: left; font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #eee;">Divisi / Bidang</th>
                    <th style="padding: 18px 25px; text-align: left; font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #eee;">Akses Sistem</th>
                    <th style="padding: 18px 25px; text-align: left; font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #eee;">Status</th>
                    <th style="padding: 18px 25px; text-align: center; font-size: 10px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #eee;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr style="border-bottom: 1px solid #f9f9f9; transition: 0.3s;" onmouseover="this.style.background='#fcfcfc';" onmouseout="this.style.background='transparent';">
                    {{-- Kolom Identitas --}}
                    <td style="padding: 20px 25px;">
                        <span style="font-weight: 800; color: #222; font-size: 14px; display: block;">{{ $user->name }}</span>
                        <span style="font-size: 12px; color: #999; font-weight: 500;">{{ $user->email }}</span>
                    </td>

                    {{-- Kolom Divisi --}}
                    <td style="padding: 20px 25px;">
                        <div style="font-size: 13px; font-weight: 700; color: #444;">
                            {{ $user->division->name ?? 'Lintas Divisi' }}
                        </div>
                        <div style="font-size: 10px; color: #bbb; text-transform: uppercase; font-weight: 800;">
                            {{ $user->team->name ?? 'Staf Umum' }}
                        </div>
                    </td>

                    {{-- Kolom Role --}}
                    <td style="padding: 20px 25px;">
                        <span style="background: #f1f1f1; padding: 6px 12px; border-radius: 8px; font-size: 10px; font-weight: 900; color: #555; text-transform: uppercase; letter-spacing: 0.5px;">
                            {{ $user->role->value ?? $user->role }}
                        </span>
                    </td>

                    {{-- Kolom Status --}}
                    <td style="padding: 20px 25px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            @php
                                $statusColor = match($user->membership_status) {
                                    'aktif' => '#B2B910',
                                    'calon' => '#facc15',
                                    'alumni' => '#3498db',
                                    default => '#cbd5e1'
                                };
                            @endphp
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: {{ $statusColor }};"></span>
                            <span style="font-size: 11px; font-weight: 800; color: #444; text-transform: uppercase;">
                                {{ $user->membership_status }}
                            </span>
                        </div>
                    </td>

                    {{-- Kolom Aksi --}}
                    <td style="padding: 20px 25px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 8px;">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               style="background: #222; color: var(--lemon); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 10px; font-weight: 900; text-transform: uppercase;">
                                Edit
                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus pengurus ini?')" style="margin:0;">
                                @csrf @method('DELETE')
                                <button type="submit" style="background: transparent; color: #ff4757; border: 1px solid #ff4757; padding: 7px 15px; border-radius: 8px; cursor: pointer; font-weight: 900; font-size: 10px; text-transform: uppercase;">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Footer Tabel: Pagination --}}
    @if($users->hasPages())
    <div class="px-8 py-4 bg-slate-50 border-t border-slate-100">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="custom-pagination">
                {{ $users->links() }}
            </div>
            <p style="font-size: 9px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 1.5px;">
                Tampilan: {{ $users->firstItem() }}-{{ $users->lastItem() }} / Total {{ $users->total() }}
            </p>
        </div>
    </div>
    @endif
</div>
@endsection
