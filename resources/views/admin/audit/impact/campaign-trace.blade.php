@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .ledger-card { background: #fff; border-radius: 35px; border: 1px solid #f1f5f9; overflow: hidden; }
    .status-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 6px; }
</style>

<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div class="flex items-center gap-6">
                <a href="{{ route('audit.impact.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#064e3b] shadow-sm hover:bg-[#064e3b] hover:text-white transition-all border border-slate-100">
                    <i class="fas fa-chevron-left text-xs"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                        Donation <span class="text-slate-300">Trace.</span>
                    </h1>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mt-3 italic">{{ $campaign->title['id'] }}</p>
                </div>
            </div>

            <div class="bg-[#064e3b] text-white px-8 py-4 rounded-[2rem] shadow-xl shadow-emerald-900/20 text-right">
                <p class="text-[8px] font-black text-lime-400 uppercase tracking-widest mb-1">Current Accumulation</p>
                <p class="text-2xl font-black leading-none italic">Rp{{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <p class="text-[8px] font-black text-slate-300 uppercase mb-2 tracking-widest">Target Amount</p>
                <p class="text-lg font-black text-[#064e3b]">Rp{{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <p class="text-[8px] font-black text-slate-300 uppercase mb-2 tracking-widest">Progres Capaian</p>
                <p class="text-lg font-black text-lime-600">{{ $campaign->progress_percentage }}%</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <p class="text-[8px] font-black text-slate-300 uppercase mb-2 tracking-widest">Donatur Masuk</p>
                <p class="text-lg font-black text-[#064e3b]">{{ $donations->total() }} Person</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <p class="text-[8px] font-black text-slate-300 uppercase mb-2 tracking-widest">Sisa Waktu</p>
                <p class="text-lg font-black text-orange-500">{{ $campaign->days_left }} Days</p>
            </div>
        </div>

        <div class="ledger-card shadow-sm">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-white">
                <h3 class="text-sm font-black text-[#064e3b] uppercase tracking-widest leading-none italic">Transaction History</h3>
                <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest italic">Live Financial Feed</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-5">Donatur & Contact</th>
                            <th class="px-8 py-5">Amount (IDR)</th>
                            <th class="px-8 py-5">Payment Method</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5 text-right">External ID</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-sm">
                        @forelse($donations as $donation)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5">
                                <span class="font-black text-[#064e3b] uppercase tracking-tight block">{{ $donation->donor_name }}</span>
                                <span class="text-[10px] font-bold text-slate-400 italic">{{ $donation->donor_email }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="font-black text-[#064e3b]">Rp{{ number_format($donation->amount, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="bg-slate-100 text-slate-500 px-3 py-1 rounded-lg text-[9px] font-black uppercase border border-slate-200/50">
                                    {{ $donation->payment_type ?? 'Midtrans' }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                @php
                                    $statusClass = $donation->status === 'success' ? 'text-emerald-500 bg-emerald-50' : ($donation->status === 'pending' ? 'text-amber-500 bg-amber-50' : 'text-red-500 bg-red-50');
                                @endphp
                                <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest border {{ $statusClass }}">
                                    {{ $donation->status }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right font-mono text-[10px] text-slate-300">
                                {{ $donation->external_id ?? 'N/A' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center">
                                <i class="fas fa-receipt text-3xl text-slate-100 mb-3"></i>
                                <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest italic">Belum ada donasi yang masuk untuk kampanye ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-8 bg-slate-50/50">
                {{ $donations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
