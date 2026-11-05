@extends('kabid.layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Kepala divisi Command Center') }}
    </h2>
@endsection

@section('content')
<style>
    .kadiv-stat-card {
        background: #ffffff;
        border-radius: 32px;
        padding: 30px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }
    .kadiv-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(6, 78, 59, 0.05);
        border-color: #bef264;
    }
    .quick-link-circle {
        width: 48px; height: 48px;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.3s ease;
    }
    .status-pill-small {
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 8px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
</style>

<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="space-y-4 mb-8">
            @include('kabid.laporan.partials.check_monthly')
            @include('partials.birthday_alert')
            @include('partials.agendaumum-alert')
        </div>

        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <span class="text-[10px] font-black text-lime-600 uppercase tracking-[0.5em] block mb-3">
                    {{ Auth::user()->division->name }} Division Command
                </span>
                <h1 class="text-6xl font-black text-[#064e3b] tracking-tighter uppercase leading-none">
                    Manager <span class="italic font-serif text-slate-300">Hub.</span>
                </h1>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ now()->format('l, d F Y') }}</p>
                <p class="text-sm font-bold text-[#064e3b] mt-1">Status: Operational Active</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="kadiv-stat-card">
                <div class="flex justify-between items-start mb-6">
                    <div class="quick-link-circle bg-orange-50 text-orange-500"><i class="fas fa-file-invoice"></i></div>
                    <span class="text-[9px] font-black text-slate-300 uppercase">Proposals</span>
                </div>
                <h2 class="text-4xl font-black text-[#064e3b]">
                    {{ \App\Models\Proposal::where('division_id', Auth::user()->division_id)->where('status', 'pending')->count() }}
                </h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase mt-2 tracking-widest">Menunggu Review</p>
            </div>

            <div class="kadiv-stat-card">
                <div class="flex justify-between items-start mb-6">
                    <div class="quick-link-circle bg-blue-50 text-blue-500"><i class="fas fa-concierge-bell"></i></div>
                    <span class="text-[9px] font-black text-slate-300 uppercase">Service Inbox</span>
                </div>
                <h2 class="text-4xl font-black text-[#064e3b]">
                    {{ \App\Models\ServiceRequest::where('target_division_id', Auth::user()->division_id)->where('status', 'pending')->count() }}
                </h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase mt-2 tracking-widest">Butuh Approval Anda</p>
            </div>

            <div class="kadiv-stat-card">
                <div class="flex justify-between items-start mb-6">
                    <div class="quick-link-circle bg-indigo-50 text-indigo-500"><i class="fas fa-tasks"></i></div>
                    <span class="text-[9px] font-black text-slate-300 uppercase">Operations</span>
                </div>
                <h2 class="text-4xl font-black text-[#064e3b]">
                    {{ \App\Models\ServiceRequest::where('target_division_id', Auth::user()->division_id)->where('status', 'in_progress')->count() }}
                </h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase mt-2 tracking-widest">Sedang Dikerjakan</p>
            </div>

            <div class="kadiv-stat-card">
                <div class="flex justify-between items-start mb-6">
                    <div class="quick-link-circle bg-emerald-50 text-emerald-500"><i class="fas fa-folder-open"></i></div>
                    <span class="text-[9px] font-black text-slate-300 uppercase">Division Assets</span>
                </div>
                <h2 class="text-4xl font-black text-[#064e3b]">
                    {{ \App\Models\Archive::where('user_id', Auth::id())->count() }}
                </h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase mt-2 tracking-widest">Link Tersimpan</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-10">

            <div class="bg-white rounded-[40px] p-10 border border-slate-100 shadow-sm">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter">Incoming Service</h3>
                    <a href="{{ route('general.service.index') }}" class="text-[10px] font-black text-lime-600 uppercase tracking-widest">View All</a>
                </div>

                <div class="space-y-6">
                    @php
                        $inbox = \App\Models\ServiceRequest::where('target_division_id', Auth::user()->division_id)
                                ->where('status', 'pending')
                                ->take(3)
                                ->get();
                    @endphp

                    @forelse($inbox as $item)
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <div class="flex items-center gap-4">
                                <div class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></div>
                                <div>
                                    <p class="text-[11px] font-black text-[#064e3b] uppercase leading-none mb-1">
                                        {{ Str::limit($item->title, 25) }}
                                    </p>
                                    <p class="text-[8px] font-bold text-slate-400 uppercase">Dari: {{ $item->requesterDivision->name }}</p>
                                </div>
                            </div>
                            <a href="{{ route('general.service.index') }}" class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-[#064e3b] shadow-sm">
                                <i class="fas fa-chevron-right text-[8px]"></i>
                            </a>
                        </div>
                    @empty
                        <p class="text-center py-10 text-[10px] font-bold text-slate-300 uppercase">Inbox Bersih</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-[40px] p-10 border border-slate-100 shadow-sm text-white" style="background: #064e3b">
                <h3 class="text-xl font-black text-lime-400 uppercase italic tracking-tighter mb-10">Proposal Tracking</h3>

                <div class="space-y-6">
                    @php
                        $myProposals = \App\Models\Proposal::where('division_id', Auth::user()->division_id)
                                        ->latest()
                                        ->take(3)
                                        ->get();
                    @endphp

                    @foreach($myProposals as $p)
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div>
                                <p class="text-xs font-black uppercase tracking-tight">{{ Str::limit($p->title, 30) }}</p>
                                <p class="text-[8px] font-bold text-lime-400/50 uppercase mt-1">{{ $p->reference_number }}</p>
                            </div>
                            <span class="status-pill-small {{ $p->status_color }} bg-white/10">{{ $p->status }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="col-span-1 md:col-span-2">
                @include('partials.task-tracer')
            </div>




            <div class="space-y-8">
                @include('partials.mini-calendar')
            </div>

            <div class="space-y-8">
                @include('partials.division-calendar')
            </div>
        </div>

        <div class="mt-12">
    @include('partials.program-roadmap')
</div>

        <div class="mt-8">
            @include('partials.birthdaycalendar')
        </div>



    </div>
</div>
@endsection
