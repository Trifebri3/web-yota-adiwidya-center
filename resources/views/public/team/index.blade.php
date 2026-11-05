@extends('public.layouts.app')

@section('content')
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-20">
            <h2 class="text-4xl font-black text-[#064e3b] uppercase italic font-serif">Struktur <span class="not-italic font-sans text-lime-500">Organisasi</span></h2>
            <p class="text-slate-500 mt-4 max-w-2xl mx-auto">Mengenal lebih dekat para penggerak di balik setiap program dan inisiatif kami.</p>
        </div>

        @include('partials.birthday_alert')

        {{-- SECTION LEADERS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-32">
            @foreach($leaders as $leader)
            {{-- Link ke Portofolio menggunakan Slug Nama --}}
            <a href="{{ url('/' . Str::slug($leader->name)) }}" class="text-center group block">
                <div class="relative inline-block mb-6">
                    <img src="{{ $leader->avatar ? asset('storage/'.$leader->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($leader->name).'&background=064e3b&color=fff' }}"
                         class="w-48 h-48 rounded-[3rem] object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500 shadow-xl border-4 border-white">

                    <div class="absolute -bottom-2 -right-2 bg-lime-400 text-[#064e3b] px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg">
                        {{ $leader->role->value }}
                    </div>
                </div>
                <h3 class="text-xl font-black text-[#064e3b] uppercase leading-tight group-hover:text-lime-600 transition-colors">{{ $leader->name }}</h3>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">{{ $leader->nickname ?? 'Core Team' }}</p>

                {{-- Indikator klik yang halus --}}
                <span class="text-[9px] font-black text-lime-500 opacity-0 group-hover:opacity-100 transition-opacity uppercase tracking-tighter mt-2 block">View Portfolio →</span>
            </a>
            @endforeach
        </div>

        <hr class="border-slate-100 mb-32">

        {{-- SECTION DIVISIONS --}}
        @foreach($divisions as $div)
        <div class="mb-32">
            <div class="flex items-center gap-6 mb-12">
                <h2 class="text-2xl font-black text-[#064e3b] uppercase tracking-tighter">{{ $div->name }}</h2>
                <div class="h-[2px] flex-1 bg-slate-100"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                {{-- KABID --}}
                @if($div->kabid)
                <a href="{{ url('/' . Str::slug($div->kabid->name)) }}" class="group block">
                    <div class="relative overflow-hidden rounded-[2rem] mb-4">
                        <img src="{{ $div->kabid->avatar ? asset('storage/'.$div->kabid->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($div->kabid->name).'&background=064e3b&color=fff' }}"
                             class="w-full aspect-square object-cover border-2 border-lime-400 p-1 group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h4 class="font-black text-[#064e3b] text-sm uppercase group-hover:text-lime-600">{{ $div->kabid->name }}</h4>
                    <p class="text-[9px] font-black text-lime-600 uppercase tracking-widest">Kepala Bidang</p>
                </a>
                @endif

                {{-- MEMBERS --}}
                @foreach($div->members as $member)
                <a href="{{ url('/' . Str::slug($member->name)) }}" class="group block">
                    <div class="relative overflow-hidden rounded-[2rem] mb-4">
                        <img src="{{ $member->avatar ? asset('storage/'.$member->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($member->name).'&background=f1f5f9&color=64748b' }}"
                             class="w-full aspect-square object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-500">
                    </div>
                    <h4 class="font-bold text-slate-800 text-sm italic group-hover:text-[#064e3b]">{{ $member->name }}</h4>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Anggota</p>
                </a>
                @endforeach
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
