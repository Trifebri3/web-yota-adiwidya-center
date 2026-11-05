@extends('public.layouts.app')

@section('content')
<main class="bg-[#FDFDFB] min-h-screen pt-44 pb-32 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-6">

        {{-- 1. HEADER SECTION --}}
        <header class="mb-20">
            <h2 class="text-xs font-black uppercase tracking-[0.5em] text-lime-600 mb-6">Our Initiatives</h2>
            <div class="flex flex-col md:flex-row justify-between items-end gap-8">
                <h1 class="text-5xl md:text-7xl font-black text-[#052c24] leading-[0.85] tracking-tighter uppercase">
                    Impact <br><span class="italic font-serif text-slate-400 lowercase">Programs.</span>
                </h1>
                <p class="max-w-md text-slate-500 text-lg font-medium leading-relaxed italic">
                    {{ app()->getLocale() == 'id'
                        ? 'Jelajahi program kolaboratif kami untuk membangun masa depan berkelanjutan.'
                        : 'Explore our collaborative programs to build a sustainable future.' }}
                </p>
            </div>
        </header>

        {{-- 2. FILTER & STATUS TABS --}}
        <div class="flex flex-wrap gap-3 mb-12">
            @php $currentStatus = request('status', 'all'); @endphp
            <a href="{{ route('public.programs.index') }}"
               class="px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ $currentStatus == 'all' ? 'bg-[#052c24] text-[#BEF264]' : 'bg-white text-slate-400 border border-slate-100 hover:border-lime-500' }}">
               All Programs
            </a>
            @foreach(['ongoing', 'upcoming', 'history'] as $st)
                <a href="{{ route('public.programs.index', ['status' => $st]) }}"
                   class="px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ $currentStatus == $st ? 'bg-[#052c24] text-[#BEF264]' : 'bg-white text-slate-400 border border-slate-100 hover:border-lime-500' }}">
                   {{ ucfirst($st) }}
                </a>
            @endforeach
        </div>

        {{-- 3. PROGRAM GRID (Pipih & Compact) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($programs as $program)
            <article class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-50 shadow-sm hover:shadow-2xl transition-all duration-700 flex flex-col h-full">

                {{-- Banner Area --}}
                <a href="{{ route('public.programs.show', $program->slug) }}" class="relative h-64 overflow-hidden bg-slate-100">
                    <img src="{{ asset('storage/'.$program->banner_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">

                    {{-- Status Overlay --}}
                    <div class="absolute top-6 left-6 flex flex-col gap-2">
                        <span class="{{ $program->status_label['color'] }} px-4 py-1.5 rounded-xl text-[8px] font-black text-white uppercase tracking-widest shadow-lg">
                            {{ app()->getLocale() == 'id' ? $program->status_label['id_text'] : $program->status_label['text'] }}
                        </span>
                    </div>

                    {{-- Time Remaining Badge --}}
                    @if($program->status !== 'history')
                    <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-xl border border-white/20">
                        <span class="block text-[7px] font-black text-slate-400 uppercase tracking-tighter">Time Left</span>
                        <span class="text-[10px] font-black text-[#052c24]">{{ $program->time_remaining }}</span>
                    </div>
                    @endif
                </a>

                {{-- Content Area --}}
                <div class="p-8 flex flex-col flex-grow">
                    <div class="mb-6">
                        <h3 class="text-xl font-black text-[#052c24] leading-tight uppercase tracking-tighter group-hover:text-lime-600 transition-colors line-clamp-2 min-h-[3rem]">
                            {{ $program->title[app()->getLocale()] ?? $program->title['id'] }}
                        </h3>
                        <div class="flex items-center gap-2 mt-4 text-slate-400">
                            <svg class="w-3 h-3 text-lime-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest">{{ $program->location_name }}</span>
                        </div>
                    </div>

                    {{-- Impact/Donation Info --}}
                    <div class="mt-auto pt-6 border-t border-slate-50">
                        @if($program->has_donation)
                            <div class="space-y-3">
                                <div class="flex justify-between items-end text-[10px] font-black uppercase">
                                    <span class="text-slate-300">Target Reached</span>
                                    <span class="text-lime-600">{{ $program->donation_percentage }}%</span>
                                </div>
                                <div class="h-1.5 w-full bg-slate-50 rounded-full overflow-hidden border border-slate-100 p-0.5">
                                    <div class="h-full bg-lime-500 rounded-full shadow-[0_0_8px_rgba(132,204,22,0.4)]" style="width: {{ $program->donation_percentage }}%"></div>
                                </div>
                            </div>
                        @else
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="block text-[8px] font-black text-slate-300 uppercase tracking-widest">Slots Taken</span>
                                    <span class="text-sm font-black text-[#052c24]">{{ $program->quota_used }} / {{ $program->quota_total }}</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100">
                                    <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Hover CTA --}}
                <div class="px-8 pb-8">
                    <a href="{{ route('public.programs.show', $program->slug) }}"
                       class="w-full bg-slate-50 group-hover:bg-[#052c24] text-slate-400 group-hover:text-lime-400 py-4 rounded-2xl flex items-center justify-center gap-3 text-[10px] font-black uppercase tracking-widest transition-all">
                       {{ app()->getLocale() == 'id' ? 'Lihat Detail' : 'View Details' }}
                       <svg class="w-3 h-3 translate-x-0 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        {{-- 4. PAGINATION --}}
        <div class="mt-20">
            {{ $programs->links() }}
        </div>
    </div>
</main>
@endsection
