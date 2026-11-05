@extends('kabid.layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] p-4 md:p-10">
    <div class="max-w-7xl mx-auto mb-10 flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
            <h1 class="text-4xl font-black text-[#064e3b] tracking-tighter uppercase italic">
                Team <span class="text-lime-500">Orchestration.</span>
            </h1>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em] mt-2">
                Manage your division's specialized task forces
            </p>
        </div>

        <form action="{{ route('kabid.teams.store') }}" method="POST" class="flex gap-2 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">
            @csrf
            <input type="text" name="name" placeholder="New Team Name..."
                   class="border-none bg-transparent text-xs font-bold focus:ring-0 w-48" required>
            <button type="submit" class="bg-[#064e3b] text-white px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all">
                Create Team
            </button>
        </form>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-12 gap-8">

        <div class="col-span-12 lg:col-span-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($teams as $team)
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden group hover:border-lime-300 transition-all">
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter">{{ $team->name }}</h3>
                                <p class="text-[9px] font-bold text-slate-300 uppercase tracking-widest">{{ $team->members->count() }} Specialized Members</p>
                            </div>
                            <span class="p-3 bg-slate-50 rounded-2xl group-hover:bg-lime-50 transition-colors">
                                <svg class="w-5 h-5 text-slate-300 group-hover:text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </span>
                        </div>

                        <div class="space-y-3 mb-8">
                            @forelse($team->members as $member)
                            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl group/item">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 bg-[#064e3b] rounded-full flex items-center justify-center text-[8px] text-white font-bold italic">
                                        {{ substr($member->name, 0, 1) }}
                                    </div>
                                    <span class="text-[11px] font-bold text-slate-600">{{ $member->name }}</span>
                                </div>
                                <form action="{{ route('kabid.teams.unassign', $member->id) }}" method="POST">
                                    @csrf
                                    <button class="opacity-0 group-hover/item:opacity-100 text-slate-300 hover:text-red-500 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </form>
                            </div>
                            @empty
                            <p class="text-center py-4 text-[10px] font-bold text-slate-300 uppercase tracking-widest italic">No members assigned</p>
                            @endforelse
                        </div>

                        <form action="{{ route('kabid.teams.assign', $team->id) }}" method="POST" class="relative">
                            @csrf
                            <select name="user_id" onchange="this.form.submit()"
                                    class="w-full bg-slate-100 border-none rounded-xl py-3 px-4 text-[10px] font-black uppercase tracking-widest text-[#064e3b] focus:ring-2 focus:ring-lime-400 cursor-pointer">
                                <option value="" selected disabled>+ Add Member to {{ $team->name }}</option>
                                @foreach($unassignedMembers as $uMember)
                                    <option value="{{ $uMember->id }}">{{ $uMember->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-span-12 lg:col-span-4 space-y-6">
            <div class="bg-[#064e3b] p-8 rounded-[3rem] text-white shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-lime-400 mb-6 italic">Division Pool</h4>
                    <div class="flex justify-between items-end">
                        <div>
                            <span class="text-5xl font-black italic tracking-tighter">{{ $unassignedMembers->count() }}</span>
                            <p class="text-[9px] font-bold opacity-50 uppercase mt-2">Available Members</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xl font-black italic tracking-tighter">{{ $teams->count() }}</span>
                            <p class="text-[9px] font-bold opacity-50 uppercase mt-2">Active Teams</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-lime-400 rounded-full blur-3xl opacity-20"></div>
            </div>

            <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm">
                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-6 italic">Waiting List</h4>
                <div class="space-y-4">
                    @forelse($unassignedMembers as $uMember)
                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-transparent hover:border-lime-200 transition-all">
                        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-[10px] font-black text-[#064e3b] border border-slate-100 shadow-sm">
                            {{ substr($uMember->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-[#064e3b] uppercase">{{ $uMember->name }}</p>
                            <p class="text-[8px] font-bold text-slate-400 uppercase">Not Assigned</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-6">
                        <p class="text-[9px] font-black text-slate-200 uppercase tracking-widest italic">Everyone is in a team</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
