@php
    use Carbon\Carbon;

    $now = Carbon::now();
    $dayOfMonth = $now->day;

    // Tentukan apakah sekarang sudah masuk periode kritis (Minggu ke-4 / Tanggal 21 ke atas)
    $isCriticalPeriod = $dayOfMonth >= 21;

    if ($isCriticalPeriod) {
        // PERIODE MINGGU KE-4: Wajib upload laporan bulan INI
        $targetMonth = $now->month;
        $targetYear = $now->year;
        $monthName = $now->translatedFormat('F');
        $note = "⚠️ PEKAN TERAKHIR: Segera submit laporan evaluasi bulan ini.";
    } else {
        // PERIODE AWAL - MINGGU KE-3: Cek laporan bulan LALU
        $lastMonth = $now->copy()->subMonth();
        $targetMonth = $lastMonth->month;
        $targetYear = $lastMonth->year;
        $monthName = $lastMonth->translatedFormat('F');
        $note = "📋 REVIEW AWAL BULAN: Pastikan laporan bulan lalu sudah lengkap.";
    }

    // Cek keberadaan laporan di database
    $hasSubmitted = \App\Models\LaporanBidang::where('division_id', Auth::user()->division_id)
        ->where('report_type', 'Bulanan')
        ->whereMonth('report_date', $targetMonth)
        ->whereYear('report_date', $targetYear)
        ->exists();
@endphp

@if(!$hasSubmitted)
<div class="mb-10">
    <div class="relative overflow-hidden bg-white border-2 {{ $isCriticalPeriod ? 'border-red-500 shadow-red-100' : 'border-amber-400 shadow-amber-100' }} rounded-[2.5rem] p-8 shadow-2xl transition-all">

        <div class="absolute top-0 right-0 p-4 opacity-10">
            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex items-center gap-6">
                <div class="w-16 h-16 {{ $isCriticalPeriod ? 'bg-red-500' : 'bg-amber-400' }} text-white rounded-[1.5rem] flex items-center justify-center shadow-lg animate-bounce">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="px-3 py-1 rounded-full {{ $isCriticalPeriod ? 'bg-red-100 text-red-600' : 'bg-amber-100 text-amber-600' }} text-[9px] font-black uppercase tracking-widest">
                            Required Action
                        </span>
                    </div>
                    <h4 class="text-xl font-black text-slate-800 tracking-tighter uppercase">
                        LAPORAN BULAN <span class="{{ $isCriticalPeriod ? 'text-red-600' : 'text-[#064e3b]' }}">{{ strtoupper($monthName) }}</span> BELUM ADA
                    </h4>
                    <p class="text-xs font-bold text-slate-400 italic mt-1">
                        {{ $note }}
                    </p>
                </div>
            </div>

            <div class="flex flex-col items-center gap-2">
                <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest">System Deadline: {{ $isCriticalPeriod ? 'End of Month' : 'Before Week 4' }}</span>
            </div>
        </div>
    </div>
</div>
@endif
