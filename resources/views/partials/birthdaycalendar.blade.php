@php
    $pilihBulan = date('m');
    $pilihTahun = date('Y');
    $namaBulan = date('F');

    $usersUltahBulanIni = \App\Models\User::whereMonth('dob', $pilihBulan)
                            ->get()
                            ->groupBy(function($d) {
                                return date('j', strtotime($d->dob));
                            });

    $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $pilihBulan, $pilihTahun);
    $hariPertama = date('w', strtotime("$pilihTahun-$pilihBulan-01"));
@endphp

<style>
    .yota-calendar-wrapper {
        display: block !important;
        background: #ffffff !important;
        border-radius: 2rem !important; /* Radius dikecilkan biar proporsional */
        padding: 18px 22px !important; /* Padding lebih ramping */
        border: 1px solid #f1f5f9 !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03) !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        max-width: 100%;
    }

    .yota-calendar-grid {
        display: grid !important;
        grid-template-columns: repeat(7, 1fr) !important;
        gap: 6px !important; /* Gap lebih rapat */
        margin-top: 12px !important;
    }

    .yota-day-name {
        text-align: center !important;
        font-size: 9px !important;
        font-weight: 900 !important;
        color: #cbd5e1 !important;
        text-transform: uppercase !important;
        padding-bottom: 5px !important;
    }

    .yota-date-cell {
        /* Dibuat lebih pipih, tidak kotak sempurna */
        height: 34px !important;
        border-radius: 0.75rem !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        position: relative !important;
        background: #fbfbfb !important;
        transition: 0.2s !important;
    }

    .yota-date-number {
        font-size: 12px !important;
        font-weight: 800 !important;
        color: #334155 !important;
    }

    .yota-today {
        border: 1.5px solid #064e3b !important;
        background: #fff !important;
    }

    .yota-has-birthday {
        background: #BEF264 !important;
        cursor: pointer !important;
    }

    .yota-has-birthday .yota-date-number {
        color: #064e3b !important;
    }

    /* Indikator titik lebih kecil */
    .yota-birth-indicator {
        width: 3px !important;
        height: 3px !important;
        background: #064e3b !important;
        border-radius: 50% !important;
        position: absolute !important;
        bottom: 4px !important;
    }

    .yota-tooltip {
        visibility: hidden;
        position: absolute;
        bottom: 125%;
        left: 50%;
        transform: translateX(-50%);
        background: #064e3b;
        color: #fff;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 9px;
        white-space: nowrap;
        z-index: 100;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .yota-has-birthday:hover .yota-tooltip {
        visibility: visible !important;
    }
</style>

<div class="yota-calendar-wrapper">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h3 style="font-size: 16px; font-weight: 900; color: #064e3b; text-transform: uppercase; margin: 0; letter-spacing: -0.5px;">
                Momen <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Internal</span>
            </h3>
        </div>
        <div style="background: #f1f5f9; color: #64748b; padding: 4px 10px; border-radius: 8px; font-size: 9px; font-weight: 800; text-transform: uppercase;">
            {{ $namaBulan }}
        </div>
    </div>

    <div class="yota-calendar-grid">
        @foreach(['M', 'S', 'S', 'R', 'K', 'J', 'S'] as $day)
            <div class="yota-day-name">{{ $day }}</div>
        @endforeach

        @for ($i = 0; $i < $hariPertama; $i++)
            <div></div>
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
                            <div>🎂 {{ $u->nickname ?? $u->name }}</div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endfor
    </div>

    <div style="margin-top: 12px; display: flex; gap: 12px; justify-content: center;">
        <div style="display: flex; align-items: center; gap: 5px;">
            <div style="width: 6px; height: 6px; background: #BEF264; border-radius: 2px;"></div>
            <span style="font-size: 8px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Ultah</span>
        </div>
        <div style="display: flex; align-items: center; gap: 5px;">
            <div style="width: 6px; height: 6px; border: 1px solid #064e3b; border-radius: 2px;"></div>
            <span style="font-size: 8px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Hari Ini</span>
        </div>
    </div>
</div>
