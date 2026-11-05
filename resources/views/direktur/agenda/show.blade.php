@extends('direktur.layouts.app')

@section('title', 'Monitoring Presensi - Executive')

@section('content')
<style>
    .show-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .header-box { background: #0F172A; border-radius: 40px; padding: 50px; color: #fff; margin-bottom: 40px; position: relative; overflow: hidden; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15); }
    .header-box::after { content: ""; position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: #BEF264; border-radius: 50%; opacity: 0.1; }

    .table-card { background: #fff; border-radius: 40px; border: 1px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.02); overflow: hidden; }
    .presence-table { width: 100%; border-collapse: collapse; text-align: left; }
    .presence-table th { padding: 25px; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid #f8fafc; }
    .presence-table td { padding: 20px 25px; border-bottom: 1px solid #f8fafc; vertical-align: middle; }

    .status-select { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 8px 12px; font-size: 11px; font-weight: 800; color: #0F172A; cursor: pointer; text-transform: uppercase; outline: none; transition: 0.3s; }
    .status-select:hover { border-color: #BEF264; background: #fff; }

    .avatar-circle { width: 45px; height: 45px; border-radius: 15px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #0F172A; overflow: hidden; }
</style>

<div class="show-container">

    <div class="header-box">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <a href="{{ route('direktur.agenda.index') }}" style="color: #BEF264; text-decoration: none; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; display: block; margin-bottom: 20px;">← Back to Command Center</a>
                <h1 style="font-size: 32px; font-weight: 900; text-transform: uppercase; letter-spacing: -1px; margin: 0; line-height: 1;">{{ $agenda->title }}</h1>
                <div style="display: flex; gap: 20px; margin-top: 20px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="width: 8px; height: 8px; background: #BEF264; border-radius: 50%;"></div>
                        <span style="font-size: 12px; font-weight: 600; opacity: 0.7;">{{ $agenda->start_time->format('d M Y') }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="width: 8px; height: 8px; background: #BEF264; border-radius: 50%;"></div>
                        <span style="font-size: 12px; font-weight: 600; opacity: 0.7;">{{ $agenda->method }} Meeting</span>
                    </div>
                </div>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 10px; font-weight: 900; color: #BEF264; text-transform: uppercase; opacity: 0.5;">Resource ID</p>
                <p style="font-size: 20px; font-weight: 900; margin: 0;">#{{ $agenda->id }}</p>
            </div>
        </div>
    </div>

    <div class="table-card">
        <div style="padding: 30px 40px; border-bottom: 1px solid #f8fafc; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 18px; font-weight: 900; color: #0F172A; text-transform: uppercase;">Monitoring <span style="font-family: serif; font-style: italic; color: #84cc16;">Kehadiran Staf</span></h3>
            <div style="background: #f8fafc; padding: 8px 20px; border-radius: 12px; font-size: 11px; font-weight: 800; color: #64748b;">
                TOTAL: {{ $presences->count() }} PENGURUS
            </div>
        </div>

        <table class="presence-table">
            <thead>
                <tr>
                    <th>Nama & Role</th>
                    <th>Bidang / Divisi</th>
                    <th>Status Saat Ini</th>
                    <th style="text-align: right;">Otoritas Direktur</th>
                </tr>
            </thead>
            <tbody>
                @foreach($presences as $presence)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div class="avatar-circle">
                                @if($presence->user->avatar)
                                    <img src="{{ asset('storage/'.$presence->user->avatar) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    {{ substr($presence->user->name, 0, 2) }}
                                @endif
                            </div>
                            <div>
                                <p style="font-size: 14px; font-weight: 900; color: #1e293b; margin: 0;">{{ $presence->user->name }}</p>
                                <p style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-top: 2px;">{{ $presence->user->role }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">
                            {{ $presence->user->division->name ?? 'Lintas Bidang' }}
                        </span>
                    </td>
                    <td>
                        @php
                            $label = $presence->status_label; // Menggunakan Helper Attr dari Model yang kita buat tadi
                        @endphp
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span class="{{ $label['class'] }}" style="padding: 6px 12px; border-radius: 10px; font-size: 9px; font-weight: 900; text-transform: uppercase;">
                                {{ $label['icon'] }} {{ $label['text'] }}
                            </span>
                        </div>
                    </td>
                    <td style="text-align: right;">
                        <form action="{{ route('direktur.agenda.updatePresence', $presence->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="status-select">
                                <option value="pending" {{ $presence->status == 'pending' ? 'selected' : '' }}>Set Pending</option>
                                <option value="hadir" {{ $presence->status == 'hadir' ? 'selected' : '' }}>Set Hadir</option>
                                <option value="izin" {{ $presence->status == 'izin' ? 'selected' : '' }}>Set Izin</option>
                                <option value="sakit" {{ $presence->status == 'sakit' ? 'selected' : '' }}>Set Sakit</option>
                                <option value="alpha" {{ $presence->status == 'alpha' ? 'selected' : '' }}>Set Alpha</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 50px;">
        <h3 style="font-size: 14px; font-weight: 900; color: #064E3B; text-transform: uppercase; margin-bottom: 20px;">Laporan Ketidakhadiran (Izin/Sakit)</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            @forelse($presences->whereIn('status', ['izin', 'sakit']) as $absent)
            <div style="background: #fff; padding: 25px; border-radius: 25px; border: 1px solid #f1f5f9;">
                <p style="font-size: 11px; font-weight: 800; color: #0F172A; margin-bottom: 10px;">{{ $absent->user->name }}</p>
                <p style="font-size: 12px; color: #64748b; line-height: 1.5; font-style: italic;">"{{ $absent->reason ?? 'Tidak ada keterangan tertulis.' }}"</p>
                @if($absent->attachment_link)
                    <a href="{{ $absent->attachment_link }}" target="_blank" style="display: inline-block; margin-top: 15px; font-size: 10px; font-weight: 900; color: #84cc16; text-decoration: none; text-transform: uppercase;">View Attachment ↗</a>
                @endif
            </div>
            @empty
            <p style="font-size: 12px; color: #94a3b8;">Belum ada laporan ketidakhadiran masuk.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="p-8 bg-[#FDFDFB] min-h-screen">
    <div class="bg-[#064e3b] rounded-[3rem] p-10 text-white mb-10 relative overflow-hidden shadow-2xl">
        <div class="relative z-10">
            <span class="px-4 py-1 bg-lime-400 text-[#064e3b] text-[9px] font-black uppercase rounded-full tracking-widest mb-4 inline-block">
                {{ str_replace('_', ' ', $agenda->type) }}
            </span>
            <h1 class="text-4xl font-black uppercase tracking-tighter mb-2 italic font-serif">{{ $agenda->title }}</h1>
            <div class="flex flex-wrap gap-6 text-sm font-medium text-white/70">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $agenda->start_time->format('d M Y | H:i') }} WIB
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    {{ $agenda->location ?? 'Online (Link Terlampir)' }}
                </div>
            </div>
        </div>
        <div class="absolute right-[-5%] top-[-20%] w-64 h-64 bg-lime-500 rounded-full opacity-20 blur-3xl"></div>
    </div>

    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
            <h3 class="text-sm font-black text-[#064e3b] uppercase tracking-widest">Daftar Presensi Anggota</h3>
            <div class="flex gap-4">
                <div class="flex items-center gap-2 text-[10px] font-black uppercase text-slate-400">
                    <span class="w-3 h-3 bg-lime-500 rounded-full"></span> Hadir
                </div>
                <div class="flex items-center gap-2 text-[10px] font-black uppercase text-slate-400">
                    <span class="w-3 h-3 bg-red-600 rounded-full"></span> Alpha
                </div>
            </div>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                    <th class="px-8 py-6">Nama Anggota</th>
                    <th class="px-8 py-6">Divisi</th>
                    <th class="px-8 py-6 text-center">Status</th>
                    <th class="px-8 py-6">Keterangan / Bukti</th>
                    <th class="px-8 py-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($presences as $presence)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-black text-[#064e3b] text-xs">
                                {{ substr($presence->user->name, 0, 1) }}
                            </div>
                            <div>
                                <span class="block font-black text-[#064e3b] uppercase text-sm leading-none mb-1">{{ $presence->user->name }}</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ $presence->user->role->value }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest italic">{{ $presence->user->division->name ?? '-' }}</span>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="{{ $presence->status_label['class'] }} px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">
                            {{ $presence->status_label['icon'] }} {{ $presence->status_label['text'] }}
                        </span>
                    </td>
                    <td class="px-8 py-5">
                        @if($presence->attachment_link)
                            <a href="{{ $presence->attachment_link }}" target="_blank" class="text-blue-600 font-black text-[10px] uppercase underline flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                Lihat Bukti
                            </a>
                        @else
                            <span class="text-slate-300 text-[10px] uppercase font-bold">-</span>
                        @endif
                    </td>
                    <td class="px-8 py-5 text-right">
                        <button onclick="editStatus({{ $presence->id }})" class="p-2 hover:bg-slate-200 rounded-xl transition-colors text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
