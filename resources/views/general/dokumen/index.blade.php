@extends(Auth::user()->role->value . '.layouts.app')


@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-6 md:p-12">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-16">
            <div class="text-center md:text-left">
                <h1 class="text-6xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-[0.8]">
                    Digital <br><span class="text-lime-500">Resources.</span>
                </h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mt-6 italic">
                    {{ auth()->user()->division->name }} Official Vault
                </p>
            </div>

            <form action="{{ route('general.dokumen.search') }}" method="GET" class="w-full md:w-96">
                <div class="relative group">
                    <input type="text" name="query" placeholder="Search templates or SOP..."
                           class="w-full bg-white border-2 border-slate-100 rounded-2xl py-4 px-6 font-bold text-[#064e3b] focus:border-lime-400 focus:ring-0 transition-all shadow-sm">
                    <button type="submit" class="absolute right-4 top-4 text-slate-300 group-hover:text-lime-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($documents as $doc)
            <div class="bg-white p-8 rounded-[3rem] border border-slate-50 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full relative group">

                <div class="mb-6 flex justify-between items-center">
                    <span class="px-4 py-1.5 bg-lime-50 text-lime-600 rounded-xl text-[8px] font-black uppercase tracking-widest">
                        {{ $doc->category }}
                    </span>
                    <span class="text-[8px] font-bold text-slate-300 uppercase italic">Added by {{ $doc->user->name }}</span>
                </div>

                <div class="flex-1">
                    <h3 class="text-2xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-tight mb-4 group-hover:text-lime-600 transition-colors">
                        {{ $doc->title }}
                    </h3>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed mb-8">
                        {{ $doc->description ?? 'No detailed description provided for this digital asset.' }}
                    </p>
                </div>

                <a href="{{ $doc->link_url }}" target="_blank"
                   class="flex items-center justify-between w-full bg-[#064e3b] text-white p-5 rounded-2xl hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-lg active:scale-95">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em]">Open Digital Asset</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>
            @empty
            <div class="col-span-full py-40 text-center bg-slate-50 rounded-[4rem] border-2 border-dashed border-slate-200">
                <p class="text-[10px] font-black uppercase tracking-[0.5em] text-slate-400 italic">Vault is currently empty</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
