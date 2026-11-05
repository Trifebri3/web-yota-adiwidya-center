@extends(Auth::user()->role->value . '.layouts.app')

@section('title', 'Intelligence Audit - YOTA')

@section('content')
<style>
    :root { --yota-dark: #064e3b; --yota-lemon: #bef264; }
    .audit-table-container { background: #fff; border-radius: 35px; border: 1px solid #f1f5f9; overflow: hidden; box-shadow: 0 10px 30px -10px rgba(0,0,0,0.02); }
    .status-pill { padding: 5px 12px; border-radius: 10px; font-size: 9px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5px; }
    .avatar-frame { width: 45px; height: 45px; border-radius: 16px; object-cover: cover; background: #f8fafc; border: 1px solid #f1f5f9; }
</style>

{{-- Header Laporan Khusus Pengawas --}}
<div class="flex justify-between items-end mb-12">
    <div>
        <h1 class="text-4xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
            Audit <span class="text-slate-300 font-serif font-normal">Intelligence.</span>
        </h1>
        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.3em] mt-3 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Personnel Oversight Mode
        </p>
    </div>

    <div class="flex gap-4">
        <div class="text-right px-6 border-r border-slate-100">
            <p class="text-[8px] font-black text-slate-300 uppercase">Total Personnel</p>
            <p class="text-xl font-black text-[#064e3b]">{{ $stats['total_users'] }}</p>
        </div>
        <button onclick="window.print()" class="bg-[#064e3b] text-white px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-black transition-all">
            Export Report
        </button>
    </div>
</div>

{{-- Tabel Utama --}}
<div class="audit-table-container">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50">
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Profile & Identity</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Departmental Hub</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Auth Level</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Engagement</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Tracing</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50/50 transition-all group">
                    {{-- Kolom 1: Profil & Identitas --}}
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            {{-- Avatar Logic (Gak bakal error biarpun Null) --}}
                            <img src="{{ $user->identity->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=064e3b&color=fff' }}"
                                 class="avatar-frame shadow-sm group-hover:scale-105 transition-transform">
                            <div>
                                <span class="block font-black text-[#064e3b] text-sm uppercase leading-tight">{{ $user->name }}</span>
                                <span class="text-[10px] font-bold text-slate-400 tracking-tight">{{ $user->email }}</span>
                            </div>
                        </div>
                    </td>


                    {{-- Kolom 3: Role --}}
                    <td class="px-8 py-5">
                        <span class="bg-slate-100 text-slate-500 px-3 py-1 rounded-lg text-[9px] font-black uppercase border border-slate-200/50">
                            {{ $user->role->value ?? $user->role }}
                        </span>
                    </td>

                    {{-- Kolom 4: Status Keanggotaan --}}
{{-- Ganti bagian kolom divisi lo dengan ini --}}
<td class="px-8 py-5">
    <div class="flex flex-col">
        @php
            // Kita paksa cari datanya langsung ke tabel divisions berdasarkan division_id si user
            $dataDivisi = \App\Models\Division::find($user->division_id);
        @endphp

        @if($dataDivisi)
            {{-- Munculin Nama Divisinya --}}
            <span class="text-[11px] font-black text-[#064e3b] uppercase italic leading-none mb-1">
                {{ $dataDivisi->name }}
            </span>
            <span class="text-[8px] font-black text-lime-600 uppercase tracking-widest">
                Verified Unit
            </span>
        @else
            {{-- Kalau tetep gak muncul, berarti division_id di tabel users emang NULL atau 0 --}}
            <span class="text-[11px] font-black text-red-400 uppercase italic leading-none mb-1">
                Tidak Terikat
            </span>
            <span class="text-[8px] font-bold text-slate-300 uppercase tracking-widest">
                ID: {{ $user->division_id ?? 'NULL' }}
            </span>
        @endif
    </div>
</td>
                    {{-- Kolom 5: AKSI KHUSUS AUDIT (Read-Only) --}}
                    <td class="px-8 py-5 text-right">
                        <a href="{{ route('audit.user.show', $user->id) }}"
                           class="inline-flex items-center gap-2 bg-[#064e3b] text-white px-5 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-lg shadow-emerald-900/10">
                            <i class="fas fa-fingerprint text-[10px]"></i> Trace Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($users->hasPages())
    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
