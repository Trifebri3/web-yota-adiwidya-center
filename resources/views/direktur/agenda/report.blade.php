@extends('direktur.layouts.app')

@section('content')
<style>
    /* 1. Reset untuk Layar Normal */
    .report-paper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #fff;
        max-width: 1000px;
        margin: 40px auto;
        padding: 60px;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    /* 2. Layout Spesifik PDF/PRINT */
    @media print {
        @page {
            size: A4;
            margin: 0;
        }
        body {
            background: #fff !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .no-print, .admin-sidebar, .admin-footer, .admin-header {
            display: none !important;
        }
        .report-paper {
            margin: 0 !important;
            padding: 40px !important;
            box-shadow: none !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        .table-report th { background: #f8fafc !important; -webkit-print-color-adjust: exact; }
    }

    /* 3. Estetika Dokumen */
    .report-header { border-bottom: 3px solid #0F172A; padding-bottom: 20px; margin-bottom: 40px; display: flex; justify-content: space-between; align-items: flex-end; }
    .brand-title { font-size: 28px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -1px; }
    .brand-title span { color: #84cc16; }

    .grid-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 40px; }
    .stat-box { border: 1px solid #e2e8f0; padding: 20px; border-radius: 15px; text-align: center; }
    .stat-label { font-size: 9px; font-weight: 900; color: #94a3b8; text-transform: uppercase; margin-bottom: 5px; }
    .stat-value { font-size: 24px; font-weight: 900; color: #0F172A; }

    .table-report { width: 100%; border-collapse: collapse; }
    .table-report th { padding: 15px; font-size: 10px; font-weight: 900; color: #64748b; text-transform: uppercase; background: #f8fafc; border: 1px solid #e2e8f0; }
    .table-report td { padding: 15px; font-size: 12px; font-weight: 700; color: #1e293b; border: 1px solid #e2e8f0; }


    .table-detail { width: 100%; border-collapse: collapse; margin-top: 20px; }
    .table-detail th { padding: 12px; font-size: 9px; font-weight: 900; background: #f1f5f9; border: 1px solid #e2e8f0; text-transform: uppercase; }
    .table-detail td { padding: 10px 15px; font-size: 11px; border: 1px solid #e2e8f0; color: #1e293b; }
    .page-break { page-break-before: always; } /* Memaksa pindah halaman di PDF jika data banyak */
</style>

<div class="report-paper">
    <div class="no-print" style="margin-bottom: 30px; display: flex; justify-content: space-between;">
        <a href="{{ route('direktur.agenda.index') }}" style="color: #94a3b8; font-size: 10px; font-weight: 900; text-decoration: none;">← KEMBALI</a>
        <button onclick="window.print()" style="background: #BEF264; color: #064E3B; border: none; padding: 12px 25px; border-radius: 10px; font-weight: 900; cursor: pointer; font-size: 11px;">
            🖨️ CETAK KE PDF
        </button>
    </div>

    <div class="report-header">
        <div>
            <h1 class="brand-title">YOTA<span>.</span></h1>
            <p style="font-size: 10px; font-weight: 800; color: #64748b; margin: 0;">Yota adiwidya center</p>
        </div>
        <div style="text-align: right;">
            <p style="font-size: 12px; font-weight: 900; color: #0F172A; margin: 0; text-transform: uppercase;">Laporan Kehadiran Agenda</p>
            <p style="font-size: 10px; color: #94a3b8; margin: 0;">Ref: #AGD-{{ $agenda->id }}-{{ date('Y') }}</p>
        </div>
    </div>

    <div style="margin-bottom: 40px;">
        <table style="width: 100%; font-size: 13px;">
            <tr>
                <td style="width: 150px; color: #94a3b8; font-weight: 800; text-transform: uppercase; font-size: 10px;">Nama Agenda</td>
                <td style="font-weight: 900; color: #0F172A;">: {{ $agenda->title }}</td>
            </tr>
            <tr>
                <td style="color: #94a3b8; font-weight: 800; text-transform: uppercase; font-size: 10px;">Waktu & Tgl</td>
                <td style="font-weight: 700; color: #0F172A;">: {{ $agenda->start_time->format('d F Y, H:i') }} WIB</td>
            </tr>
            <tr>
                <td style="color: #94a3b8; font-weight: 800; text-transform: uppercase; font-size: 10px;">Metode</td>
                <td style="font-weight: 700; color: #0F172A;">: {{ strtoupper($agenda->method) }}</td>
            </tr>
        </table>
    </div>

    <div class="grid-stats">
        <div class="stat-box">
            <div class="stat-label">Total Peserta</div>
            <div class="stat-value">{{ $stats['total'] }}</div>
        </div>
        <div class="stat-box" style="background: #f0fdf4; border-color: #bbf7d0;">
            <div class="stat-label">Hadir</div>
            <div class="stat-value" style="color: #15803d;">{{ $stats['hadir'] }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Izin/Sakit</div>
            <div class="stat-value">{{ $stats['izin'] + $stats['sakit'] }}</div>
        </div>
        <div class="stat-box" style="background: #fef2f2; border-color: #fecaca;">
            <div class="stat-label">Tanpa Ket.</div>
            <div class="stat-value" style="color: #b91c1c;">{{ $stats['alpha'] }}</div>
        </div>
    </div>

    <h3 style="font-size: 12px; font-weight: 900; color: #0F172A; text-transform: uppercase; margin-bottom: 15px;">Rekapitulasi Kehadiran Per Divisi</h3>
    <table class="table-report">
        <thead>
            <tr>
                <th>Nama Divisi</th>
                <th style="text-align: center;">Target</th>
                <th style="text-align: center;">Realisasi</th>
                <th style="text-align: center;">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($divisionReport as $divName => $data)
            <tr>
                <td>{{ $divName ?? 'Lintas Bidang' }}</td>
                <td style="text-align: center;">{{ $data['total'] }}</td>
                <td style="text-align: center;">{{ $data['hadir'] }}</td>
                <td style="text-align: center; color: {{ $data['persentase'] < 50 ? '#dc2626' : '#059669' }}">
                    {{ $data['persentase'] }}%
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<h3 style="font-size: 12px; font-weight: 900; color: #0F172A; text-transform: uppercase; margin-bottom: 15px; border-left: 4px solid #BEF264; padding-left: 10px;">Rekapitulasi Kehadiran Per Divisi</h3>
    <table class="table-report" style="margin-bottom: 50px;">
        <thead>
            <tr>
                <th>Nama Divisi</th>
                <th style="text-align: center;">Target</th>
                <th style="text-align: center;">Realisasi</th>
                <th style="text-align: center;">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($divisionReport as $divName => $data)
            <tr>
                <td>{{ $divName ?? 'Lintas Bidang' }}</td>
                <td style="text-align: center;">{{ $data['total'] }}</td>
                <td style="text-align: center;">{{ $data['hadir'] }}</td>
                <td style="text-align: center; font-weight: 900;">{{ $data['persentase'] }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div> {{-- Agar tabel nama rapi di halaman baru --}}
    <h3 style="font-size: 12px; font-weight: 900; color: #0F172A; text-transform: uppercase; margin-bottom: 15px; border-left: 4px solid #0F172A; padding-left: 10px;">Daftar Detail Kehadiran Anggota</h3>
    <table class="table-detail">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="text-align: left; width: 35%;">Nama Lengkap</th>
                <th style="text-align: left; width: 30%;">Divisi / Bidang</th>
                <th style="width: 15%;">Status</th>
                <th style="text-align: left; width: 15%;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agenda->presences->sortBy('user.division.name') as $index => $presence)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="font-weight: 800;">{{ strtoupper($presence->user->name) }}</td>
                <td>{{ $presence->user->division->name ?? 'N/A' }}</td>
                <td style="text-align: center;">
                    @php
                        $statusColor = match($presence->status) {
                            'hadir' => '#059669',
                            'izin', 'sakit' => '#d97706',
                            'alpha', 'pending' => '#dc2626',
                            default => '#64748b'
                        };
                    @endphp
                    <span style="color: {{ $statusColor }}; font-weight: 900; font-size: 9px; text-transform: uppercase;">
                        {{ $presence->status == 'pending' ? 'ALPHA' : $presence->status }}
                    </span>
                </td>
                <td style="font-size: 10px; font-style: italic; color: #64748b;">
                    {{ $presence->reason ?? '-' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 60px; display: flex; justify-content: flex-end;">
        <div style="text-align: center; width: 250px;">
            <p style="font-size: 10px; color: #94a3b8; font-weight: 800; margin-bottom: 60px;">DIREKTUR YOT ADIWIDYA CENTER</p>
            <p style="font-size: 13px; font-weight: 900; color: #0F172A; border-bottom: 2px solid #0F172A; display: inline-block;">TRI FEBRIANSAH</p>
            <p style="font-size: 10px; color: #94a3b8; font-weight: 800; margin-top: 5px;"></p>
        </div>
    </div>
</div>

</div>
@endsection
