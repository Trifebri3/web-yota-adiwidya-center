@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#F8FAFC] p-6">
    <div class="max-w-md w-full bg-white rounded-[3rem] p-10 shadow-2xl text-center border-4 {{ $status == 'success' ? 'border-lime-500' : 'border-red-500' }}">

        @if($status == 'success')
            <div class="w-20 h-20 bg-lime-500 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg animate-bounce">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-black text-[#064e3b] uppercase italic leading-none mb-2">Berhasil!</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">{{ $message }}</p>

            <div class="bg-slate-50 rounded-2xl p-4 text-left border border-slate-100">
                <p class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Agenda</p>
                <p class="font-bold text-[#064e3b]">{{ $agenda->title }}</p>
            </div>
        @else
            <div class="w-20 h-20 bg-red-500 text-white rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-black text-red-600 uppercase italic leading-none mb-2">Gagal!</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $message }}</p>
        @endif

        <a href="{{ route('user.agendas') }}" class="mt-8 inline-block text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 hover:text-[#064e3b] transition-colors">
            Kembali ke Agenda
        </a>
    </div>
</div>
@endsection
