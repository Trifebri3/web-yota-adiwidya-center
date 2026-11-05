@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] p-4 md:p-10"
     x-data="{
        showDetail: false,
        detailData: { title: '', desc: '', start: '', end: '', link: '', status: '' }
     }">

    <div class="max-w-5xl mx-auto">
        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-5xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-none">
                    My <span class="text-lime-500">Agendas.</span>
                </h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mt-4">Pusat Kehadiran & Jadwal Kegiatan</p>
            </div>

            <div class="bg-white px-6 py-3 rounded-2xl border border-slate-100 shadow-sm">
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-1">Status Anda</span>
                <span class="text-xs font-bold text-[#064e3b]">{{ Auth::user()->name }} ({{ strtoupper(Auth::user()->role->value) }})</span>
            </div>
        </div>

        <div class="space-y-6">
            @forelse($agendas as $agenda)
                @php
                    $myPresence = $agenda->presences->where('user_id', auth()->id())->first();

                    // Logika Perhitungan Waktu
                    $now = now();
                    $startTime = \Carbon\Carbon::parse($agenda->start_time);
                    $endTime = \Carbon\Carbon::parse($agenda->end_time);

                    $openTime = $startTime->copy()->subMinutes(15); // 15 Menit sebelum mulai
                    $closeTime = $startTime->copy()->addMinutes(20); // 20 Menit setelah mulai

                    $isTooEarly = $now->lt($openTime);
                    $canAttend = $now->between($openTime, $closeTime);
                    $isLate = $now->gt($closeTime);
                    $isExpired = $now->gt($endTime);

                    $hasAttended = $myPresence && $myPresence->status === 'hadir';
                @endphp

                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6 hover:shadow-xl transition-all group overflow-hidden relative cursor-pointer"
                     @click="
                        detailData = {
                            title: '{{ $agenda->title }}',
                            desc: '{{ addslashes($agenda->description) ?? 'Tidak ada deskripsi agenda.' }}',
                            start: '{{ $startTime->format('d M Y, H:i') }}',
                            end: '{{ $endTime->format('d M Y, H:i') }}',
                            link: '{{ $agenda->meeting_link }}',
                            status: '{{ $hasAttended ? 'SUDAH HADIR' : ($isExpired ? 'BERAKHIR' : ($isTooEarly ? 'MENDATANG' : 'SEDANG BERLANGSUNG')) }}'
                        };
                        showDetail = true
                     ">

                    @if($hasAttended)
                        <div class="absolute top-0 right-0 w-32 h-32 bg-lime-500/5 -mr-16 -mt-16 rounded-full"></div>
                    @endif

                    <div class="flex items-center gap-6 relative z-10 w-full md:w-auto">
                        <div class="w-20 h-20 {{ $hasAttended ? 'bg-lime-500 text-white' : ($isExpired ? 'bg-slate-200 text-slate-500' : 'bg-slate-50 text-slate-400') }} rounded-[1.5rem] flex flex-col items-center justify-center border border-slate-100 transition-colors shrink-0">
                            <span class="text-[10px] font-black uppercase tracking-tighter leading-none mb-1">{{ $startTime->format('M') }}</span>
                            <span class="text-3xl font-black tracking-tighter leading-none">{{ $startTime->format('d') }}</span>
                        </div>

                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 bg-slate-100 text-[8px] font-black text-slate-400 rounded uppercase tracking-widest">
                                    {{ $startTime->format('H:i') }} - {{ $endTime->format('H:i') }} WIB
                                </span>
                                @if($hasAttended)
                                    <span class="px-2 py-0.5 bg-lime-100 text-[8px] font-black text-lime-600 rounded uppercase tracking-widest italic tracking-widest">Recorded</span>
                                @elseif($isExpired)
                                    <span class="px-2 py-0.5 bg-red-50 text-[8px] font-black text-red-400 rounded uppercase tracking-widest italic">Archived</span>
                                @endif
                            </div>
                            <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-tight">{{ $agenda->title }}</h3>
                            <p class="text-xs text-slate-400 font-medium mt-1">Klik untuk detail info...</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 w-full md:w-auto relative z-10" @click.stop>
                        @if($hasAttended)
                            <div class="flex items-center gap-3 bg-lime-50 text-lime-600 px-8 py-4 rounded-2xl border border-lime-100 shadow-sm w-full md:w-auto justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-[10px] font-black uppercase tracking-[0.2em]">Hadir</span>
                            </div>

                        @elseif($isTooEarly)
                            <div class="bg-blue-50 text-blue-500 px-6 py-3 rounded-2xl border border-blue-100 flex flex-col items-center w-full md:w-auto">
                                <span class="text-[7px] font-black uppercase tracking-widest">Absen Dibuka</span>
                                <span class="text-[11px] font-extrabold">{{ $openTime->format('H:i') }} WIB</span>
                            </div>

                        @elseif($canAttend)
                            <a href="{{ route('presence.check', $agenda->id) }}"
                               onclick="return confirm('Apakah Anda yakin ingin mencatat kehadiran sekarang?')"
                               class="w-full md:w-auto bg-[#064e3b] text-white px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-lg text-center animate-pulse">
                                Absen Sekarang
                            </a>

                        @elseif($isLate || $isExpired)
                            <div class="bg-red-50 text-red-400 px-8 py-4 rounded-2xl border border-red-100 opacity-60 w-full md:w-auto text-center">
                                <span class="text-[10px] font-black uppercase tracking-[0.2em] italic">Batas Absen Habis</span>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-[3rem] py-24 text-center border-4 border-dashed border-slate-100">
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.5em]">Belum Ada Agenda Terjadwal</p>
                </div>
            @endforelse

            <div class="mt-10">
                {{ $agendas->links() }}
            </div>
        </div>
    </div>

    <div x-show="showDetail"
         class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-[#064e3b]/90 backdrop-blur-sm"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">

        <div @click.away="showDetail = false" class="bg-white w-full max-w-xl rounded-[3rem] p-10 relative overflow-hidden shadow-2xl">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <span class="text-[9px] font-black text-lime-500 uppercase tracking-[0.3em]" x-text="detailData.status"></span>
                    <h2 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none mt-1" x-text="detailData.title"></h2>
                </div>
                <button @click="showDetail = false" class="text-slate-300 hover:text-red-500 transition-colors p-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Jam Mulai</p>
                        <p class="text-xs font-bold text-[#064e3b]" x-text="detailData.start"></p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Jam Selesai</p>
                        <p class="text-xs font-bold text-[#064e3b]" x-text="detailData.end"></p>
                    </div>
                </div>

                <div class="p-6 border-2 border-dashed border-slate-100 rounded-3xl">
                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-2">Deskripsi Agenda</p>
                    <p class="text-sm text-slate-600 leading-relaxed font-medium italic" x-text="detailData.desc"></p>
                </div>

                <template x-if="detailData.link && detailData.link !== '' && detailData.link !== '#'">
                    <a :href="detailData.link" target="_blank"
                       class="flex items-center justify-between w-full bg-blue-50 text-blue-600 p-5 rounded-2xl group hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.828a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            <span class="text-[10px] font-black uppercase tracking-widest">Buka Link Lampiran / Zoom</span>
                        </div>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </template>
            </div>

            <button @click="showDetail = false"
                    class="w-full mt-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#064e3b] transition-all">
                Kembali ke Daftar
            </button>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }

    /* Animasi halus untuk tombol Absen Sekarang */
    @keyframes pulse-custom {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.02); opacity: 0.9; }
    }
    .animate-pulse {
        animation: pulse-custom 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>
@endsection
