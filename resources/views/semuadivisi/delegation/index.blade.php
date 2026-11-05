@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] p-4 md:p-10">
    <div class="max-w-6xl mx-auto">
        <div class="mb-12">
            <h1 class="text-5xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-none">
                My <span class="text-lime-500">Mandates.</span>
            </h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mt-4">Tugas & Tanggung Jawab Personal Anda</p>
        </div>

        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="p-8 text-[10px] font-black uppercase text-slate-400 tracking-widest">Judul Mandat</th>
                        <th class="p-8 text-[10px] font-black uppercase text-slate-400 tracking-widest text-center">Deadline</th>
                        <th class="p-8 text-[10px] font-black uppercase text-slate-400 tracking-widest text-center">Status</th>
                        <th class="p-8 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($delegations as $mandate)
                    <tr class="group hover:bg-slate-50/50 transition-colors">
                        <td class="p-8">
                            <h3 class="font-black text-[#064e3b] uppercase italic text-lg leading-tight">{{ $mandate->title }}</h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">Dari: {{ $mandate->director->name }}</p>
                        </td>
                        <td class="p-8 text-center text-sm font-black text-slate-600">
                            {{ \Carbon\Carbon::parse($mandate->deadline)->format('d M Y') }}
                        </td>
                        <td class="p-8 text-center">
                            @php
                                $statusMap = [
                                    'sent' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'label' => 'Baru'],
                                    'read' => ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'label' => 'Dibaca'],
                                    'in_progress' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-600', 'label' => 'Dikerjakan'],
                                    'submitted' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-600', 'label' => 'Menunggu ACC'],
                                    'revision' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'label' => 'Butuh Revisi'],
                                    'completed' => ['bg' => 'bg-lime-100', 'text' => 'text-lime-600', 'label' => 'Selesai'],
                                ];
                                $st = $statusMap[$mandate->status];
                            @endphp
                            <span class="px-4 py-2 rounded-xl {{ $st['bg'] }} {{ $st['text'] }} text-[9px] font-black uppercase tracking-widest">
                                {{ $st['label'] }}
                            </span>
                        </td>
                        <td class="p-8 text-right">
                            <a href="{{ route('delegation.show', $mandate->id) }}" class="inline-flex items-center justify-center w-12 h-12 bg-white border border-slate-200 rounded-2xl text-[#064e3b] hover:bg-lime-500 hover:text-white hover:border-lime-500 transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-20 text-center">
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.5em]">Tidak ada mandat aktif</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            {{ $delegations->links() }}
        </div>
    </div>
    
</div>
@endsection
