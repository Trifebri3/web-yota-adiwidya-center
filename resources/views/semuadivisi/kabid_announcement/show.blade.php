@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] p-4 md:p-10 flex items-center justify-center">
    <div class="max-w-4xl w-full">

        <div class="mb-8">
            <a href="{{ route('semuadivisi.kabid-announcement.index') }}"
               class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-indigo-600 transition-all">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Update
            </a>
        </div>

        <div class="bg-white rounded-[3.5rem] shadow-2xl border border-slate-100 overflow-hidden relative">

            @php
                $allColors = [
                    'urgent' => 'bg-red-600',
                    'high'   => 'bg-orange-500',
                    'medium' => 'bg-indigo-500',
                    'low'    => 'bg-slate-500',
                ];
                $pKey = strtolower($announcement->priority ?? 'low');
                $accentColor = $allColors[$pKey] ?? $allColors['low'];
            @endphp

            <div class="h-3 {{ $accentColor }}"></div>

            <div class="p-10 md:p-16">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-10">
                    <div class="flex items-center gap-3">
                        <span class="{{ $accentColor }} text-white px-5 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">
                            {{ $announcement->priority ?? 'NORMAL' }}
                        </span>
                        <span class="bg-indigo-50 text-indigo-600 px-5 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">
                            INTERNAL {{ $announcement->division->name ?? '' }}
                        </span>
                    </div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-tighter">
                        Diterbitkan {{ $announcement->created_at->translatedFormat('d F Y, H:i') }}
                    </p>
                </div>

                <h1 class="text-4xl md:text-6xl font-black text-[#1e1b4b] uppercase italic tracking-tighter leading-[0.9] mb-12">
                    {{ $announcement->title }}
                </h1>

                <div class="prose prose-indigo max-w-none mb-16">
                    <div class="text-slate-600 text-lg font-medium leading-relaxed">
                        {!! $announcement->content !!}
                    </div>
                </div>

                <div class="pt-10 border-t border-dashed border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-8">
                    <div class="flex items-center gap-5">
                        <div class="w-16 h-16 bg-indigo-50 rounded-[2rem] flex items-center justify-center font-black text-indigo-600 text-xl border-2 border-indigo-100">
                            {{ substr($announcement->user->name ?? '??', 0, 2) }}
                        </div>
                        <div>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Ditetapkan Oleh</p>
                            <p class="text-xl font-black text-[#1e1b4b] uppercase leading-none">
                                {{ $announcement->user->name ?? 'Kepala Bidang' }}
                            </p>
                            <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-[0.2em] mt-2">
                                Authority of {{ $announcement->division->name ?? 'Division' }}
                            </p>
                        </div>
                    </div>

                    <div class="opacity-20 hidden md:block">
                        <div class="border-4 border-indigo-600 p-2 rounded-xl rotate-12">
                            <p class="text-indigo-600 font-black text-xs uppercase border-2 border-indigo-600 px-2 py-1">
                                Verified Internal
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 p-8 text-center border-t border-slate-100">
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.3em]">
                    Dokumen ini adalah instruksi resmi internal PT Yota Inovasi Nusantara
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
