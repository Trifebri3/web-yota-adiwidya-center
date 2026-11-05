@extends('direktur.layouts.app')

@section('title', 'Executive Agenda - PIKP HUB')

@section('content')
<style>
    .dir-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .dir-card { background: #ffffff; border-radius: 40px; border: 1px solid #f1f5f9; overflow: hidden; transition: all 0.4s ease; position: relative; }
    .dir-card:hover { transform: translateY(-8px); box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.1); }

    /* Archive Table Style */
    .archive-row { transition: all 0.2s; border-radius: 15px; }
    .archive-row:hover { background: #f8fafc; }
    .bar-bg { background: #f1f5f9; height: 8px; border-radius: 100px; width: 80px; }
    .bar-fill { height: 100%; border-radius: 100px; background: #BEF264; }
</style>

<div class="dir-container">

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 50px;">
        <div>
            <h1 style="font-size: 38px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; line-height: 0.9;">
                Executive <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Agenda</span>
            </h1>
            <p style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 4px; margin-top: 12px;">Active Strategic Scheduling</p>
        </div>

        <a href="{{ route('direktur.agenda.create') }}" style="background: #0F172A; color: #BEF264; padding: 18px 30px; border-radius: 20px; text-decoration: none; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 15px 30px rgba(15, 23, 42, 0.2);">
            + Rancang Agenda
        </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 30px; margin-bottom: 80px;">
        @foreach($agendas->where('start_time', '>=', now()) as $agenda)
        <div class="dir-card">
            <div style="background: #0F172A; padding: 12px 25px; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 9px; font-weight: 900; color: #BEF264; text-transform: uppercase;">{{ str_replace('_', ' ', $agenda->type) }}</span>
                <span style="color: rgba(255,255,255,0.3); font-size: 10px;">AKTIF</span>
            </div>
            <div style="padding: 30px;">
                <h2 style="font-size: 20px; font-weight: 900; color: #0F172A; text-transform: uppercase; margin-bottom: 20px;">{{ $agenda->title }}</h2>
                <div style="background: #F8FAFC; border-radius: 20px; padding: 20px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="font-size: 9px; font-weight: 900; color: #64748b; text-transform: uppercase;">Presensi</span>
                        <span style="font-size: 11px; font-weight: 900;">{{ $agenda->total_hadir }} Orang</span>
                    </div>
                    <div style="background: #e2e8f0; height: 8px; border-radius: 10px;">
                        <div style="width: {{ ($agenda->total_hadir / max($agenda->total_hadir + $agenda->total_izin + $agenda->total_alpha, 1)) * 100 }}%; height: 100%; background: #BEF264; border-radius: 10px;"></div>
                    </div>
                </div>
            </div>
            <div style="padding: 20px 30px; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between;">
                <a href="{{ route('direktur.agenda.show', $agenda->id) }}" style="text-decoration: none; font-size: 10px; font-weight: 900; color: #0F172A; background: #BEF264; padding: 8px 15px; border-radius: 10px;">MONITOR</a>
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('direktur.agenda.edit', $agenda->id) }}"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="margin-top: 100px;">
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 30px;">
            <h2 style="font-size: 24px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -1px;">Archive <span style="color: #94a3b8;">Repository</span></h2>
            <div style="flex: 1; height: 1px; background: #e2e8f0;"></div>
        </div>

        @php
            $archivedAgendas = $agendas->where('start_time', '<', now())->groupBy(function($date) {
                return $date->start_time->format('F Y');
            });
        @endphp

        <div style="display: flex; flex-direction: column; gap: 40px;">
            @foreach($archivedAgendas as $month => $items)
            <div>
                <h3 style="font-size: 11px; font-weight: 900; color: #064E3B; background: #BEF264; display: inline-block; padding: 4px 12px; border-radius: 8px; margin-bottom: 15px; text-transform: uppercase;">
                    📅 {{ $month }}
                </h3>

                <div style="background: #fff; border-radius: 25px; border: 1px solid #f1f5f9; overflow: hidden;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <tbody style="font-size: 13px;">
                            @foreach($items as $item)
                            <tr class="archive-row">
                                <td style="padding: 15px 25px; font-weight: 800; color: #0F172A; width: 40%;">
                                    {{ $item->title }}
                                    <span style="display: block; font-size: 9px; color: #94a3b8; font-weight: 600; text-transform: uppercase; margin-top: 2px;">{{ $item->start_time->format('d M Y') }}</span>
                                </td>
                                <td style="padding: 15px 10px;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div class="bar-bg">
                                            <div class="bar-fill" style="width: {{ ($item->total_hadir / max($item->total_hadir + $item->total_izin + $item->total_alpha, 1)) * 100 }}%;"></div>
                                        </div>
                                        <span style="font-size: 10px; font-weight: 800; color: #64748b;">{{ $item->total_hadir }} Hadir</span>
                                    </div>
                                </td>
                                <td style="padding: 15px 25px; text-align: right;">
                                    <a href="{{ route('direktur.agenda.report', $item->id) }}" style="text-decoration: none; font-size: 9px; font-weight: 900; color: #94a3b8; border: 1px solid #e2e8f0; padding: 5px 12px; border-radius: 8px; text-transform: uppercase;">View Report</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div style="margin-top: 50px; display: flex; justify-content: center;">
        {{ $agendas->links() }}
    </div>
</div>
@endsection
