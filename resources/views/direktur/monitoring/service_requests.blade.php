@extends('direktur.layouts.app')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 italic">Ticket Monitoring (Service Requests)</h2>
        <p class="text-gray-500 text-sm">Pantau aliran bantuan dan kerjasama antar divisi (Tiket Masuk/Keluar).</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($requests as $req)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 border-b flex justify-between items-center bg-slate-50">
                <span class="text-xs font-mono font-bold text-slate-500 uppercase">#{{ $req->ticket_number }}</span>
                <span class="px-2 py-0.5 text-[10px] font-bold rounded-full
                    {{ $req->status == 'completed' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                    {{ strtoupper($req->status) }}
                </span>
            </div>
            <div class="p-5">
                <h3 class="font-bold text-gray-800 mb-2">{{ $req->title }}</h3>
                <div class="flex items-center gap-2 mb-4">
                    <div class="text-[10px] px-2 py-1 bg-blue-50 text-blue-600 rounded">DARI: {{ $req->requesterDivision->name }}</div>
                    <div class="text-gray-300">→</div>
                    <div class="text-[10px] px-2 py-1 bg-indigo-50 text-indigo-600 rounded">KE: {{ $req->targetDivision->name }}</div>
                </div>
                <p class="text-xs text-gray-500 italic line-clamp-2">"{{ $req->description }}"</p>
            </div>
            <div class="px-5 py-3 bg-gray-50 border-t flex justify-between items-center text-[10px]">
                <span class="text-gray-400 italic">Dibuat: {{ $req->created_at->diffForHumans() }}</span>
                <span class="font-bold text-gray-700 uppercase">PIC: {{ $req->handler->name ?? 'WAITING' }}</span>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white p-10 text-center rounded-xl border border-dashed border-gray-300">
            <p class="text-gray-400">Tidak ada tiket layanan saat ini.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-6">{{ $requests->links() }}</div>
</div>
@endsection
