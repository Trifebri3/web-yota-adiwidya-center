@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .program-banner { height: 350px; border-radius: 45px; overflow: hidden; position: relative; border: 8px solid #fff; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
    .program-banner img { width: 100%; height: 100%; object-cover: cover; }
    .status-overlay { position: absolute; top: 30px; left: 30px; padding: 10px 25px; border-radius: 20px; font-weight: 900; font-size: 10px; text-transform: uppercase; color: #fff; letter-spacing: 1px; }
    .info-card { background: #fff; border-radius: 35px; border: 1px solid #f1f5f9; padding: 35px; height: 100%; }
</style>

<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="flex items-center justify-between mb-12">
            <div class="flex items-center gap-6">
                <a href="{{ route('audit.admin.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#064e3b] shadow-sm hover:bg-lime-400 transition-all border border-slate-100">
                    <i class="fas fa-chevron-left text-xs"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                        Program <span class="text-slate-300 font-normal">Intelligence.</span>
                    </h1>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">Audit Publikasi & Realisasi Lapangan</p>
                </div>
            </div>

            <div class="text-right">
                <span class="text-[9px] font-black text-slate-300 uppercase block mb-1 italic">Execution Status</span>
                <span class="{{ $program->status_label['color'] }} text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest">
                    {{ $program->status_label['id_text'] }}
                </span>
            </div>
        </div>

        <div class="program-banner mb-12">
            <img src="{{ asset('storage/' . $program->banner_image) }}" alt="Banner">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-10 left-10 text-white">
                <h2 class="text-4xl font-black uppercase italic tracking-tighter">{{ $program->title['id'] ?? $program->title }}</h2>
                <p class="text-sm font-bold opacity-80 mt-2 italic"><i class="fas fa-map-marker-alt mr-2"></i> {{ $program->location_name }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-1 space-y-8">
                <div class="info-card shadow-sm">
                    <h4 class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-8 border-b border-slate-50 pb-4">Vitals & Metrics</h4>

                    <div class="space-y-8">
                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Quota Fulfillment</span>
                                <span class="text-xs font-black text-[#064e3b]">{{ $program->quota_used }} / {{ $program->quota_total }}</span>
                            </div>
                            <div class="w-full h-2 bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                                <div class="h-full bg-blue-500 rounded-full" style="width: {{ ($program->quota_used / max($program->quota_total, 1)) * 100 }}%"></div>
                            </div>
                        </div>

                        @if($program->has_donation)
                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Donation Progress</span>
                                <span class="text-xs font-black text-[#064e3b]">{{ $program->donation_percentage }}%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                                <div class="h-full bg-lime-400 rounded-full shadow-[0_0_10px_rgba(190,242,100,0.3)]" style="width: {{ $program->donation_percentage }}%"></div>
                            </div>
                        </div>
                        @endif

                        <div class="p-6 bg-[#064e3b] rounded-[2rem] text-white">
                            <p class="text-[8px] font-black text-lime-400 uppercase tracking-widest mb-2 italic">Remaining Time</p>
                            <h5 class="text-xl font-black italic">{{ $program->time_remaining }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-10">
                <div class="bg-white p-12 rounded-[3rem] border border-slate-100 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div>
                            <h4 class="text-xs font-black text-[#064e3b] uppercase tracking-widest mb-4 italic">Goal & Objectives</h4>
                            <p class="text-sm font-bold text-slate-500 leading-relaxed italic">"{{ $program->goal['id'] ?? $program->goal }}"</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-[#064e3b] uppercase tracking-widest mb-4 italic">Target Audience</h4>
                            <p class="text-sm font-bold text-slate-500 leading-relaxed italic">{{ $program->target_audience['id'] ?? $program->target_audience }}</p>
                        </div>
                    </div>

                    <div class="mt-12 pt-10 border-t border-slate-50">
                        <h4 class="text-xs font-black text-[#064e3b] uppercase tracking-widest mb-6 italic">Methodology</h4>
                        <div class="p-8 bg-slate-50 rounded-[2.5rem]">
                            <p class="text-xs font-medium text-slate-600 leading-relaxed">
                                {{ $program->methodology['id'] ?? $program->methodology }}
                            </p>
                        </div>
                    </div>

                    @if($program->status == 'history')
                    <div class="mt-12 pt-10 border-t border-slate-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-1.5 h-6 bg-lime-500 rounded-full"></div>
                            <h4 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">Post-Program Impact</h4>
                        </div>
                        <p class="text-sm font-bold text-slate-500 italic mb-8">"{{ $program->impact_summary['id'] ?? 'Program telah selesai dilaksanakan dengan hasil yang memuaskan.' }}"</p>

                        <div class="grid grid-cols-2 gap-4">
                            @foreach($program->impact_stats as $label => $value)
                            <div class="p-5 bg-white border border-slate-100 rounded-3xl text-center">
                                <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest mb-1">{{ $label }}</p>
                                <p class="text-lg font-black text-[#064e3b]">{{ $value }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="flex justify-between items-center px-10 py-6 bg-white rounded-[2.5rem] border border-slate-100 italic">
                    <div class="flex gap-10">
                        <div>
                            <span class="text-[8px] font-black text-slate-300 uppercase block">Program Dates</span>
                            <span class="text-[10px] font-black text-slate-500">{{ $program->start_date->format('d M') }} — {{ $program->end_date->format('d M Y') }}</span>
                        </div>
                    </div>
                    <a href="{{ $program->location_link }}" target="_blank" class="text-[9px] font-black text-[#064e3b] uppercase tracking-widest border-b-2 border-lime-400 pb-1">
                        View Field Coordinates <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
