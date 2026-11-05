@extends('omc.layouts.app')

@section('content')
<div class="bg-white min-h-screen pt-32 pb-20 px-4 font-['Plus_Jakarta_Sans']">
    <div class="max-w-6xl mx-auto">

        <header class="flex justify-between items-end mb-12">
            <div>
                <nav class="mb-4">
                    <a href="{{ route('omc.campaign.index') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-[#052c24]">← Kembali ke List</a>
                </nav>
                <h1 class="text-5xl font-black text-[#052c24] tracking-tighter uppercase">{{ $campaign->title['id'] }}</h1>
            </div>
            <div class="text-right">
                <p class="text-xs font-black uppercase text-slate-300 mb-1">Total Dana Terkumpul</p>
                <h2 class="text-4xl font-black text-lime-500">Rp{{ number_format($campaign->current_amount, 0, ',', '.') }}</h2>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-slate-900 rounded-[3rem] p-10 text-white shadow-2xl">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-8">Campaign Analytics</h4>
                    <div class="space-y-8">
                        <div>
                            <span class="text-4xl font-black block">{{ $campaign->progress_percentage }}%</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase">Pencapaian dari Target</span>
                        </div>
                        <div class="w-full h-2 bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full bg-lime-400" style="width: {{ $campaign->progress_percentage }}%"></div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="text-xl font-bold block">{{ $campaign->donations()->paid()->count() }}</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase">Donatur</span>
                            </div>
                            <div>
                                <span class="text-xl font-bold block">{{ $campaign->days_left }}</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase">Hari Tersisa</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-[3rem] border border-slate-100 p-10 shadow-sm">
                    <h4 class="text-sm font-black text-[#052c24] uppercase tracking-widest mb-8">Riwayat Donasi Masuk</h4>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-separate border-spacing-y-4">
                            <thead>
                                <tr class="text-[10px] font-black uppercase text-slate-400 tracking-widest">
                                    <th class="px-6 pb-4">Donatur</th>
                                    <th class="px-6 pb-4">Nominal</th>
                                    <th class="px-6 pb-4">Status</th>
                                    <th class="px-6 pb-4">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($campaign->donations()->latest()->get() as $donation)
                                <tr class="bg-slate-50/50 rounded-2xl group hover:bg-slate-50 transition-all">
                                    <td class="px-6 py-5">
                                        <div class="font-bold text-[#052c24]">{{ $donation->donor_name }}</div>
                                        <div class="text-[10px] text-slate-400">{{ $donation->donor_email }}</div>
                                    </td>
                                    <td class="px-6 py-5 font-black text-[#052c24]">
                                        Rp{{ number_format($donation->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase {{ $donation->status == 'success' ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-orange-600' }}">
                                            {{ $donation->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase">
                                        {{ $donation->created_at->format('d M Y, H:i') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-10 text-slate-400 italic">Belum ada donasi yang masuk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
