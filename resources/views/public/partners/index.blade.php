@extends('public.layouts.app')

@section('content')

<main class="bg-[#FDFDFB] min-h-screen pt-44 pb-32 font-['Plus_Jakarta_Sans']" x-data="{ openModal: false, activePartner: {} }">
    <div class="max-w-7xl mx-auto px-6">

        {{-- 1. HEADER --}}
        <header class="mb-24 text-center max-w-3xl mx-auto">
            <h2 class="text-xs font-black uppercase tracking-[0.5em] text-lime-600 mb-6">Strategic Network</h2>
            <h1 class="text-5xl md:text-7xl font-black text-[#052c24] leading-[0.85] tracking-tighter uppercase mb-8">
                Global <br><span class="italic font-serif text-slate-400 lowercase">Alliance.</span>
            </h1>
        </header>

        {{-- 2. LOGO GRID (Clean & Minimalist) --}}
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach($partners as $partner)
            <div
                @click="openModal = true; activePartner = {
                    name: '{{ $partner->name }}',
                    logo: '{{ asset('storage/' . $partner->logo) }}',
                    type: '{{ $partner->type }}',
                    desc: '{{ addslashes($partner->getDesc()) }}',
                    url: '{{ $partner->website_url }}'
                }"
                class="group bg-white rounded-[2.5rem] p-8 border border-slate-50 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 flex items-center justify-center cursor-pointer aspect-square">

                <div class="grayscale group-hover:grayscale-0 opacity-40 group-hover:opacity-100 transition-all duration-700">
                    <img src="{{ asset('storage/' . $partner->logo) }}"
                         alt="{{ $partner->name }}"
                         class="max-h-16 max-w-full object-contain transform group-hover:scale-110 transition-transform duration-500">
                </div>
            </div>
            @endforeach
        </div>

        {{-- 3. MODAL DETAIL (Pop-up Information) --}}
        <template x-teleport="body">
            <div x-show="openModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-[99] flex items-center justify-center p-6 bg-[#052c24]/90 backdrop-blur-sm" x-cloak>

                <div @click.away="openModal = false"
                     class="bg-white w-full max-w-2xl rounded-[3.5rem] overflow-hidden shadow-2xl relative">

                    {{-- Close Button --}}
                    <button @click="openModal = false" class="absolute top-8 right-8 text-slate-300 hover:text-[#052c24] transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <div class="p-12 md:p-16 flex flex-col items-center text-center">
                        {{-- Modal Logo --}}
                        <div class="h-24 mb-10">
                            <img :src="activePartner.logo" class="max-h-full object-contain">
                        </div>

                        {{-- Modal Info --}}
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-lime-600 mb-4" x-text="activePartner.type"></span>
                        <h2 class="text-3xl font-black text-[#052c24] uppercase tracking-tighter mb-6" x-text="activePartner.name"></h2>
                        <p class="text-slate-500 text-lg leading-relaxed italic mb-10" x-text="activePartner.desc"></p>

                        {{-- Action --}}
                        <template x-if="activePartner.url">
                            <a :href="'https://' + activePartner.url" target="_blank" class="bg-[#052c24] text-[#BEF264] px-10 py-5 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-lime-500 hover:text-[#052c24] transition-all">
                                Visit Website →
                            </a>
                        </template>
                    </div>
                </div>
            </div>
        </template>

        {{-- 4. CTA --}}
        <div class="mt-32 border-t border-slate-100 pt-20 text-center">
            <h4 class="text-[10px] font-black text-slate-300 uppercase tracking-[0.4em] mb-8">Want to collaborate?</h4>
            <a href="mailto:hello@siyota.org" class="text-2xl md:text-4xl font-black text-[#052c24] hover:text-lime-500 transition-colors uppercase tracking-tighter italic">
                Get in Touch with our Team —→
            </a>
        </div>
    </div>
</main>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
