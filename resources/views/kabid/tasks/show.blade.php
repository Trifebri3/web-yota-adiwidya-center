@extends('kabid.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-12">
    <div class="max-w-5xl mx-auto">

        <nav class="flex justify-between items-center mb-12">
            <a href="{{ route('kabid-tugas.index') }}" class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 hover:text-lime-500 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                Back to Monitor
            </a>
            <div class="flex gap-2">
                <span class="px-4 py-1.5 bg-slate-100 rounded-full text-[9px] font-black uppercase tracking-widest text-slate-400">Task ID: #KB-{{ $task->id }}</span>
            </div>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <div class="lg:col-span-7 space-y-8">
                <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="px-3 py-1 bg-lime-100 text-lime-700 text-[8px] font-black uppercase rounded-lg tracking-widest">
                            {{ $task->team_id ? 'Group Project' : 'Individual Assignment' }}
                        </span>
                        <span class="text-[10px] font-bold text-slate-300 uppercase tracking-tighter">
                            Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y, H:i') }}
                        </span>
                    </div>

                    <h1 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-tight mb-6">
                        {{ $task->title }}
                    </h1>

                    <div class="prose prose-slate max-w-none text-slate-600 font-medium leading-relaxed">
                        <p class="text-sm italic mb-4 text-slate-400 font-bold uppercase tracking-widest">Task Briefing:</p>
                        {!! nl2br(e($task->description)) !!}
                    </div>
                </div>

                @if($task->submission_link)
                <div class="bg-blue-50 rounded-[3rem] p-10 border border-blue-100 relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-600 mb-6 italic">Member Submission</h3>
                        <div class="bg-white p-6 rounded-3xl shadow-sm mb-6">
                            <p class="text-xs font-bold text-slate-400 uppercase mb-2">Attached Link:</p>
                            <a href="{{ $task->submission_link }}" target="_blank" class="text-lg font-black text-blue-600 break-all hover:underline flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                Open Result Asset
                            </a>
                        </div>
                        @if($task->submission_notes)
                        <div class="italic text-blue-800 text-sm leading-relaxed">
                            <span class="font-black uppercase text-[9px] block mb-2 opacity-50 underline">Staff Notes:</span>
                            "{{ $task->submission_notes }}"
                        </div>
                        @endif
                    </div>
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-200 rounded-full blur-3xl opacity-30"></div>
                </div>
                @endif
            </div>

            <div class="lg:col-span-5 space-y-6">
                <div class="bg-[#064e3b] rounded-[3rem] p-8 text-white shadow-xl">
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-50 mb-6 italic">Current Workflow State</p>
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-4xl font-black uppercase italic tracking-tighter text-lime-400">{{ $task->status }}</h2>
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="p-4 bg-white/5 rounded-2xl border border-white/10">
                            <p class="text-[8px] font-black uppercase opacity-40 mb-1">Assigned To</p>
                            <p class="text-xs font-bold">{{ $task->team_id ? $task->team->name : $task->user->name }}</p>
                        </div>
                    </div>
                </div>

                @if($task->status == 'submitted' || $task->status == 'revised')
                <div class="bg-white rounded-[3rem] p-8 border border-slate-100 shadow-sm space-y-6">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-[#064e3b] italic">Review Decision</h4>

                    <form action="{{ route('kabid-tugas.complete', $task->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-lime-400 text-[#064e3b] py-5 rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] hover:bg-[#064e3b] hover:text-white transition-all shadow-lg shadow-lime-100">
                            Approve & Complete
                        </button>
                    </form>

                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
                        <div class="relative flex justify-center text-[8px] font-black uppercase text-slate-300"><span class="bg-white px-2">OR</span></div>
                    </div>

                    <form action="{{ route('kabid-tugas.revise', $task->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <textarea name="revision_notes" rows="4" placeholder="Write feedback for revision..."
                                  class="w-full bg-slate-50 border-none rounded-2xl text-xs font-medium focus:ring-2 focus:ring-red-400" required></textarea>
                        <button type="submit" class="w-full bg-red-50 text-red-500 py-5 rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] hover:bg-red-500 hover:text-white transition-all">
                            Send for Revision
                        </button>
                    </form>
                </div>
                @elseif($task->status == 'completed')
                <div class="bg-lime-50 rounded-[3rem] p-10 text-center border border-lime-200">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm text-lime-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-lg font-black text-[#064e3b] uppercase italic mb-2">Mission Accomplished</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">This task is archived and completed.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
