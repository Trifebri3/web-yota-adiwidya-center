@php
    /**
     * LOGIKA AGREGASI LIVE - MULTIBAHASA & HEMAT RUANG
     */
    $allVerifiedReports = \App\Models\ImpactReport::where('is_verified', true)->get();
    $currentLang = app()->getLocale();
    $aggregatedStats = [];

    foreach ($allVerifiedReports as $report) {
        if (!empty($report->stats_data)) {
            foreach ($report->stats_data as $stat) {
                $key = \Illuminate\Support\Str::slug($stat['label_id']);

                // Pembersihan angka
                $rawNum = preg_replace('/[^0-9.]/', '', $stat['value']);
                $numValue = (float) $rawNum;

                // Ekstraksi simbol asli
                $unitSymbol = preg_replace('/[0-9.,]/', '', $stat['value']);

                if (!isset($aggregatedStats[$key])) {
                    $aggregatedStats[$key] = [
                        'value' => 0,
                        // PRIORITAS: label_en/label_id berdasarkan locale aktif
                        'label' => $stat['label_'.$currentLang] ?? $stat['label_id'],
                        'symbol' => $unitSymbol ?: '+'
                    ];
                }
                $aggregatedStats[$key]['value'] += $numValue;
            }
        }
    }

    $displayStats = collect($aggregatedStats)->sortByDesc('value')->take(4);

    $impactTrends = \App\Models\ImpactReport::where('is_verified', true)
        ->selectRaw('MONTHNAME(published_at) as month, COUNT(*) as count, published_at')
        ->groupBy('month', 'published_at')
        ->orderBy('published_at', 'ASC')
        ->get()
        ->take(-6);
@endphp

<section class="bg-white py-16 relative overflow-hidden font-['Plus_Jakarta_Sans'] border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

            {{-- Bagian Kiri: Headline & Grid Angka --}}
            <div class="lg:col-span-5 space-y-8">
                <div>
                    <h2 class="text-[10px] font-black uppercase tracking-[0.5em] text-lime-600 mb-3">
                        {{ __('impact.hero_tag') }}
                    </h2>
                    <h3 class="text-3xl md:text-4xl font-black text-[#052c24] leading-none tracking-tighter uppercase">
                        {{ __('impact.title') }} <span class="italic font-serif text-slate-400 lowercase">{{ __('impact.title_accent') }}</span>
                    </h3>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    @foreach($displayStats as $item)
                    <div class="p-6 bg-[#F8FAFC] border border-slate-100 rounded-[2rem] group hover:bg-[#052c24] transition-all duration-500">
                        <div class="text-3xl font-black text-[#052c24] group-hover:text-lime-400 transition-colors tracking-tighter">
                            @php
                                $v = $item['value'];
                                $formatted = $v >= 1000 ? number_format($v/1000, 1) . 'k' : number_format($v, 0, ',', '.');
                            @endphp
                            {{ $formatted }}<span class="text-lime-500 group-hover:text-white text-[0.7em] ml-0.5">{{ $item['symbol'] }}</span>
                        </div>
                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 group-hover:text-white/60 transition-colors mt-1">
                            {{ $item['label'] }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Bagian Kanan: Grafik Tren Minimalis --}}
            <div class="lg:col-span-7 bg-[#052c24] rounded-[2.5rem] p-8 relative overflow-hidden shadow-2xl shadow-[#052c24]/20">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-lime-500/10 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h4 class="text-white font-black uppercase tracking-widest text-[10px] flex items-center gap-2">
                                <span class="w-2 h-2 bg-lime-400 rounded-full animate-pulse"></span>
                                {{ __('impact.growth_title') }}
                            </h4>
                            <p class="text-white/40 text-[9px] font-bold uppercase mt-1 tracking-tighter">
                                {{ __('impact.verified_footer', ['count' => $allVerifiedReports->count()]) }}
                            </p>
                        </div>
                        <a href="{{ route('public.impact.index') }}" class="px-5 py-2 bg-white/5 border border-white/10 rounded-full text-[8px] font-black text-white uppercase tracking-widest hover:bg-lime-400 hover:text-[#052c24] transition-all">
                            {{ __('impact.see_all') }} →
                        </a>
                    </div>

                    <div class="h-[180px] w-full">
                        <canvas id="compactTrendChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('compactTrendChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 180);
        gradient.addColorStop(0, 'rgba(190, 242, 100, 0.3)');
        gradient.addColorStop(1, 'rgba(190, 242, 100, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($impactTrends->pluck('month')) !!},
                datasets: [{
                    data: {!! json_encode($impactTrends->pluck('count')) !!},
                    borderColor: '#BEF264',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    backgroundColor: gradient,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#BEF264',
                    pointHoverBorderColor: '#052c24',
                    pointHoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false },
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: 'rgba(255,255,255,0.3)',
                            font: { size: 9, weight: '800' },
                            // Opsional: Jika ingin translate nama bulan di JS, gunakan PHP trans() di sini
                        }
                    }
                }
            }
        });
    });
</script>
