@php
    // Inisialisasi Waktu
    $pilihBulan = date('m');
    $pilihTahun = date('Y');
    $namaBulan = date('F');

    // Ambil data dari database (Kolom 'dob' sesuai cast Model User Anda)
    // Jika data kosong, kalender tetap akan merender strukturnya
    $usersUltahBulanIni = \App\Models\User::whereMonth('dob', $pilihBulan)
                            ->get()
                            ->groupBy(function($d) {
                                return date('j', strtotime($d->dob)); // Menggunakan j (1-31 tanpa leading zero)
                            });

    $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $pilihBulan, $pilihTahun);
    $hariPertama = date('w', strtotime("$pilihTahun-$pilihBulan-01"));
@endphp

<style>
    .yota-calendar-wrapper {
        display: block !important; /* Memastikan container terlihat */
        background: #ffffff !important;
        border-radius: 3rem !important;
        padding: 30px !important;
        border: 1px solid #f1f5f9 !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05) !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    .yota-calendar-grid {
        display: grid !important;
        grid-template-columns: repeat(7, 1fr) !important;
        gap: 10px !important;
        margin-top: 20px !important;
    }

    .yota-day-name {
        text-align: center !important;
        font-size: 10px !important;
        font-weight: 900 !important;
        color: #94a3b8 !important;
        text-transform: uppercase !important;
        padding-bottom: 10px !important;
    }

    .yota-date-cell {
        aspect-ratio: 1 / 1 !important;
        border-radius: 1rem !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        position: relative !important;
        background: #fbfbfb !important;
        transition: 0.3s !important;
        border: 1px solid transparent !important;
    }

    .yota-date-number {
        font-size: 14px !important;
        font-weight: 800 !important;
        color: #1e293b !important;
    }

    /* Status Khusus */
    .yota-today {
        border: 2px solid #064e3b !important;
        background: #fff !important;
    }

    .yota-has-birthday {
        background: #BEF264 !important; /* Warna Lemon PIKP */
        cursor: pointer !important;
    }

    .yota-has-birthday .yota-date-number {
        color: #064e3b !important;
    }

    .yota-birth-indicator {
        width: 5px !important;
        height: 5px !important;
        background: #064e3b !important;
        border-radius: 50% !important;
        margin-top: 4px !important;
    }

    /* Tooltip/Popover */
    .yota-tooltip {
        visibility: hidden;
        position: absolute;
        bottom: 110%;
        left: 50%;
        transform: translateX(-50%);
        background: #064e3b;
        color: #fff;
        padding: 8px 12px;
        border-radius: 10px;
        font-size: 10px;
        white-space: nowrap;
        z-index: 100;
        box-shadow: 0 10px 15px rgba(0,0,0,0.1);
    }

    .yota-has-birthday:hover .yota-tooltip {
        visibility: visible !important;
    }
</style>

<div class="yota-calendar-wrapper">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 5px;">
        <div>
            <h3 style="font-size: 22px; font-weight: 900; color: #064e3b; text-transform: uppercase; margin: 0; letter-spacing: -1px;">
                Momen <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Internal</span>
            </h3>
            <p style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-top: 5px;">
                {{ $namaBulan }} {{ $pilihTahun }}
            </p>
        </div>
        <div style="background: #064e3b; color: #BEF264; padding: 6px 12px; border-radius: 10px; font-size: 10px; font-weight: 900;">
            {{ $usersUltahBulanIni->flatten()->count() }} ULANG TAHUN
        </div>
    </div>

    <div class="yota-calendar-grid">
        @foreach(['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $day)
            <div class="yota-day-name">{{ $day }}</div>
        @endforeach

        @for ($i = 0; $i < $hariPertama; $i++)
            <div style="aspect-ratio: 1/1;"></div>
        @endfor

        @for ($hari = 1; $hari <= $jumlahHari; $hari++)
            @php
                $isToday = ($hari == date('j') && $pilihBulan == date('m'));
                $hasBirth = isset($usersUltahBulanIni[$hari]);
            @endphp

            <div class="yota-date-cell {{ $isToday ? 'yota-today' : '' }} {{ $hasBirth ? 'yota-has-birthday' : '' }}">
                <span class="yota-date-number">{{ $hari }}</span>

                @if($hasBirth)
                    <div class="yota-birth-indicator"></div>
                    <div class="yota-tooltip">
                        @foreach($usersUltahBulanIni[$hari] as $u)
                            <div style="margin-bottom: 2px;">🎂 {{ $u->nickname ?? $u->name }}</div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endfor
    </div>

    <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #f8fafc; display: flex; gap: 20px;">
        <div style="display: flex; align-items: center; gap: 8px;">
            <div style="width: 8px; height: 8px; background: #BEF264; border-radius: 2px;"></div>
            <span style="font-size: 9px; font-weight: 800; color: #64748b; text-transform: uppercase;">Ulang Tahun</span>
        </div>
        <div style="display: flex; align-items: center; gap: 8px;">
            <div style="width: 8px; height: 8px; border: 1.5px solid #064e3b; border-radius: 2px;"></div>
            <span style="font-size: 9px; font-weight: 800; color: #64748b; text-transform: uppercase;">Hari Ini</span>
        </div>
    </div>
</div>
