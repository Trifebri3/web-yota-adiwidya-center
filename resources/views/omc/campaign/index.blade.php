@extends('omc.layouts.app')

@section('content')
<div class="bg-white min-h-screen pt-32 px-4 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-12">
            <div>
                <h1 class="text-4xl font-black uppercase tracking-tighter text-[#052c24]">Crowd<span class="text-lime-500">funding</span></h1>
                <p class="text-slate-400 font-medium italic">Kelola penggalangan dana dan transparansi publik.</p>
            </div>
            <a href="{{ route('omc.campaign.create') }}" class="bg-[#052c24] text-[#BEF264] px-10 py-5 rounded-[2rem] font-black text-xs uppercase tracking-widest hover:bg-lime-500 hover:text-[#052c24] transition-all shadow-xl">
                Buat Kampanye Baru
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($campaigns as $cp)
            <div class="bg-white rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col">
                <div class="relative h-48 bg-slate-100">
                    @if($cp->image)
                        <img src="{{ asset('storage/'.$cp->image) }}" class="w-full h-full object-cover">
                    @endif
                    <div class="absolute top-4 right-4">
                        <span class="px-4 py-2 rounded-full text-[9px] font-black uppercase tracking-widest {{ $cp->status == 'active' ? 'bg-lime-400 text-[#052c24]' : 'bg-slate-200 text-slate-500' }}">
                            {{ $cp->status }}
                        </span>
                    </div>
                </div>

                <div class="p-8 flex-1 flex flex-col">
                    <h3 class="text-xl font-black text-[#052c24] mb-4 leading-tight">{{ $cp->title['id'] }}</h3>

                    <div class="mt-auto space-y-3">
                        <div class="flex justify-between items-end">
                            <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Progress</span>
                            <span class="text-lg font-black text-[#052c24]">{{ $cp->progress_percentage }}%</span>
                        </div>
                        <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-lime-500 transition-all duration-1000" style="width: {{ $cp->progress_percentage }}%"></div>
                        </div>
                        <div class="flex justify-between text-[10px] font-bold">
                            <span class="text-lime-600">Rp{{ number_format($cp->current_amount, 0, ',', '.') }}</span>
                            <span class="text-slate-300">Target: Rp{{ number_format($cp->target_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="flex gap-2 mt-8 pt-6 border-t border-slate-50">
                        <a href="{{ route('omc.campaign.edit', $cp->id) }}" class="flex-1 text-center py-3 bg-slate-50 text-[#052c24] rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#052c24] hover:text-white transition-all">Edit</a>
                        <form action="{{ route('omc.campaign.destroy', $cp->id) }}" method="POST" onsubmit="return confirm('Hapus kampanye ini?')">
                            @csrf @method('DELETE')
                            <button class="px-5 py-3 bg-slate-50 text-red-400 rounded-xl hover:bg-red-500 hover:text-white transition-all italic">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
