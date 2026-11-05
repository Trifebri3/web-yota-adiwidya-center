@extends('public.layouts.app')
@section('title', 'Visi & Misi | Yota adiwidya center')

@section('content')

<section class="bg-[#FDFDFB] py-32 relative overflow-hidden font-['Plus_Jakarta_Sans']">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-lime-100/30 rounded-full blur-[120px] -z-10"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center mb-24">
            <h2 class="text-xs font-black tracking-[0.4em] text-[#064e3b] uppercase mb-4">{{ __('vision.title') }}</h2>
            <p class="text-lg text-slate-500 font-light max-w-2xl mx-auto italic">{{ __('vision.subtitle') }}</p>
        </div>

        <div class="relative mb-32 group">
            <div class="absolute -inset-4 bg-slate-50 rounded-[4rem] scale-95 group-hover:scale-100 transition-transform duration-700 -z-10"></div>
            <div class="bg-white border border-slate-100 rounded-[3.5rem] p-12 lg:p-20 shadow-xl overflow-hidden relative">
                <div class="absolute top-0 right-0 p-12 opacity-5 group-hover:opacity-10 transition-opacity">
                    <svg class="w-40 h-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>

                <div class="max-w-4xl relative z-10">
                    <span class="text-lime-600 font-black tracking-widest text-[10px] uppercase mb-6 block">{{ __('vision.vision_label') }}</span>
                    <h3 class="text-3xl md:text-5xl font-black text-[#064e3b] leading-[1.1] tracking-tight">
                        {{ __('vision.vision_text') }}
                    </h3>
                </div>
            </div>
        </div>



        <div class="grid lg:grid-cols-2 gap-8 mb-32">
            @foreach(__('vision.missions') as $index => $mission)
            <div class="group p-10 bg-white border border-slate-100 rounded-[2.5rem] hover:border-lime-200 hover:shadow-2xl hover:shadow-lime-100/50 transition-all duration-500">
                <div class="flex items-start gap-8">
                    <div class="w-14 h-14 shrink-0 rounded-2xl bg-[#064e3b] text-lime-400 flex items-center justify-center text-xl font-black shadow-lg">
                        0{{ $index + 1 }}
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-[#064e3b] mb-4 group-hover:text-lime-600 transition-colors">{{ $mission['title'] }}</h4>
                        <p class="text-slate-500 font-light leading-relaxed">{{ $mission['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="bg-[#064e3b] rounded-[4rem] p-12 lg:p-20 text-white relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-64 h-64 opacity-10 pointer-events-none">
                <img src="{{ asset('image/yota3.png') }}" class="w-full h-full object-contain">
            </div>

            <div class="relative z-10">
                <div class="text-center mb-16">
                    <h3 class="text-sm font-black tracking-[0.5em] text-lime-400 uppercase mb-4">{{ __('vision.values_label') }}</h3>
                    <div class="h-[1px] w-24 bg-white/20 mx-auto"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                    @foreach(__('vision.values') as $name => $desc)
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-white/5 rounded-full mx-auto mb-6 flex items-center justify-center border border-white/10 group-hover:bg-lime-500 group-hover:text-[#064e3b] transition-all duration-500 group-hover:rotate-[360deg]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h5 class="text-xl font-bold mb-3">{{ $name }}</h5>
                        <p class="text-slate-400 text-sm font-light leading-relaxed">{{ $desc }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>

<section class="relative bg-[#052c24] pt-32 pb-40 overflow-hidden font-['Plus_Jakarta_Sans']">
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <circle cx="10" cy="10" r="30" fill="url(#grad1)" />
            <defs>
                <radialGradient id="grad1" cx="50%" cy="50%" r="50%">
                    <stop offset="0%" style="stop-color:#BEF264;stop-opacity:0.3" />
                    <stop offset="100%" style="stop-color:#052c24;stop-opacity:0" />
                </radialGradient>
            </defs>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">

        <div class="grid lg:grid-cols-12 gap-16 mb-32 items-center">
            <div class="lg:col-span-5">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-lime-400 text-[10px] font-black tracking-[0.3em] uppercase mb-8">
                    <span class="w-2 h-2 bg-lime-500 rounded-full animate-pulse"></span>
                    {{ __('purpose.tagline') }}
                </div>
                <h2 class="text-4xl md:text-6xl font-black text-white leading-tight tracking-tighter mb-8">
                    {{ __('purpose.evolution_title') }}
                </h2>
            </div>
            <div class="lg:col-span-7">
                <div class="p-10 lg:p-14 bg-white/5 backdrop-blur-md border-l-4 border-lime-500 rounded-r-[3rem] relative">
                    <p class="text-xl md:text-2xl text-slate-300 leading-relaxed font-light italic">
                        {!! __('purpose.evolution_desc') !!}
                    </p>
                    <div class="mt-8 flex items-center gap-4">
                        <img src="{{ asset('image/yetc.png') }}" class="h-10 opacity-50 grayscale hover:grayscale-0 transition-all cursor-help" title="Original YETC Legacy">
                        <div class="h-px w-12 bg-white/20"></div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Evolved into Yota Adiwidya Center</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach(__('purpose.items') as $number => $item)
            <div class="group relative p-10 lg:p-16 bg-white/5 border border-white/10 rounded-[4rem] hover:bg-white/[0.08] transition-all duration-700">
                <div class="absolute top-10 right-10 text-8xl font-black text-white/5 group-hover:text-lime-500/10 transition-colors">
                    {{ $number }}
                </div>

                <div class="relative z-10">
                    <div class="w-16 h-16 bg-lime-500 rounded-2xl flex items-center justify-center text-[#052c24] mb-10 group-hover:rotate-[15deg] transition-transform duration-500 shadow-xl shadow-lime-500/20">
                        @if($number == '01')
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        @elseif($number == '02')
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                        @elseif($number == '03')
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" /></svg>
                        @endif
                    </div>

                    <h4 class="text-3xl font-black text-white mb-6 leading-tight">
                        {{ $item['title'] }}
                    </h4>
                    <p class="text-slate-400 font-light leading-relaxed text-lg">
                        {{ $item['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-32 text-center">
            <div class="inline-block relative">
                <div class="absolute -inset-4 bg-lime-500 blur-2xl opacity-10"></div>
                <p class="relative text-2xl md:text-3xl font-medium text-white italic max-w-4xl mx-auto leading-relaxed">
                    "{{ __('purpose.footer_text') }}"
                </p>
            </div>

            <div class="mt-20 flex flex-col items-center">
                <p class="text-[10px] font-black text-lime-500 uppercase tracking-[0.5em] mb-4">Yota Adiwidya Center</p>
                <h5 class="text-white font-bold text-sm tracking-widest uppercase">Muda Peduli Berinovasi Untuk Bumi</h5>
            </div>
        </div>
    </div>
</section>
<section class="bg-white py-32 relative overflow-hidden font-['Plus_Jakarta_Sans']">
    <div class="absolute top-0 right-0 w-1/2 h-full bg-slate-50/50 -skew-x-12 translate-x-32 z-0"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">

        <div class="flex flex-col lg:flex-row justify-between items-end mb-24 gap-8">
            <div class="max-w-2xl">
                <span class="inline-block px-4 py-1.5 rounded-full bg-[#064e3b] text-[#d9f99d] text-[10px] font-black tracking-[0.3em] uppercase mb-6">
                    {{ __('approach.tagline') }}
                </span>
                <h2 class="text-5xl md:text-7xl font-black text-[#064e3b] leading-[0.95] tracking-tighter">
                    {{ __('approach.title') }} <br>
                    <span class="text-lime-500 italic font-serif">{{ __('approach.title_accent') }}</span>
                </h2>
            </div>
            <p class="max-w-xs text-slate-500 text-sm font-light leading-relaxed border-l-2 border-lime-500 pl-6 mb-2">
                {{ __('approach.subtitle') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-0">
            @foreach(__('approach.steps') as $num => $step)
            <div class="relative group p-10 lg:p-12 bg-white border border-slate-100 lg:border-none hover:bg-slate-50 transition-all duration-500 first:rounded-t-[3rem] lg:first:rounded-l-[3rem] lg:first:rounded-tr-none last:rounded-b-[3rem] lg:last:rounded-r-[3rem] lg:last:rounded-bl-none overflow-hidden">
                <div class="text-[5rem] font-black text-slate-100 group-hover:text-lime-500/20 transition-colors leading-none mb-8">
                    {{ $num }}
                </div>

                <div class="relative z-10">
                    <h4 class="text-xl font-bold text-[#064e3b] mb-4 h-14 flex items-center">{{ $step['label'] }}</h4>
                    <p class="text-slate-500 text-sm font-light leading-relaxed">
                        {{ $step['desc'] }}
                    </p>
                </div>

                @if(!$loop->last)
                <div class="hidden lg:block absolute top-1/2 -right-4 -translate-y-1/2 z-20">
                    <svg class="w-8 h-8 text-lime-500 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <div class="mt-24 bg-[#064e3b] rounded-[4rem] p-12 lg:p-20 text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cpath d=\"M0 0h20L0 20z\" fill=\"%23ffffff\" fill-rule=\"evenodd\"/%3E%3C/svg%3E');"></div>

            <div class="grid lg:grid-cols-12 gap-16 items-center relative z-10">
                <div class="lg:col-span-5">
                    <h3 class="text-4xl font-black leading-tight mb-6">
                        {{ __('approach.philosophy_title') }}
                    </h3>
                    <p class="text-slate-300 font-light text-lg">
                        Prinsip kerja kami yang tidak terpisahkan, memastikan setiap inovasi memiliki akar yang kuat dan buah yang bermanfaat.
                    </p>

                    <div class="mt-12 flex items-center gap-6">
                        <div class="w-20 h-20 p-2 bg-white/10 rounded-2xl backdrop-blur-md border border-white/20">
                            <img src="{{ asset('image/verifikasi.png') }}" class="w-full h-full object-contain" alt="Haran Process">
                        </div>
                        <p class="text-[10px] font-black tracking-widest uppercase text-lime-400">Verified Strategic <br> Approach</p>
                    </div>
                </div>

                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-3 gap-8">
                    @foreach(__('approach.principles') as $key => $val)
                    <div class="p-8 bg-white/5 rounded-3xl border border-white/10 hover:bg-lime-500 hover:text-[#064e3b] transition-all duration-500 group/item">
                        <h5 class="text-2xl font-black mb-4 group-hover/item:scale-110 transition-transform origin-left">{{ $key }}</h5>
                        <p class="text-xs font-medium text-slate-400 group-hover/item:text-[#064e3b] tracking-wide">{{ $val }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
