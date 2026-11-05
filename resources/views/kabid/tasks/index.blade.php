@extends('kabid.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-12">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-black text-[#064e3b] tracking-tighter uppercase italic">Task <span class="text-lime-500">Distribution.</span></h1>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Monitor and manage your division's workflow</p>
            </div>
            <a href="{{ route('kabid-tugas.create') }}" class="px-8 py-4 bg-[#064e3b] text-white rounded-[2rem] text-[10px] font-black uppercase tracking-widest shadow-xl shadow-lime-100 hover:bg-lime-400 hover:text-[#064e3b] transition-all flex items-center gap-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                Deploy New Task
            </a>
        </div>

        <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-50">
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-300">Target</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-300">Title & Deadline</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-300">Current Status</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-300">Progress</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-300 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($tasks as $task)
                        <tr class="group hover:bg-slate-50 transition-colors">
                            <td class="px-8 py-6">
                                @if($task->team_id)
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-black text-lime-600 uppercase italic">Group Task</span>
                                        <span class="text-xs font-bold text-[#064e3b]">{{ $task->team->name }}</span>
                                    </div>
                                @else
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-black text-blue-500 uppercase italic">Personal</span>
                                        <span class="text-xs font-bold text-[#064e3b]">{{ $task->user->name }}</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-black text-[#064e3b] uppercase tracking-tight mb-1">{{ Str::limit($task->title, 40) }}</p>
                                <p class="text-[9px] font-bold text-slate-400 uppercase italic">Due: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y, H:i') }}</p>
                            </td>
                            <td class="px-8 py-6">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-slate-100 text-slate-400',
                                        'in_progress' => 'bg-blue-50 text-blue-500',
                                        'submitted' => 'bg-amber-50 text-amber-500',
                                        'revised' => 'bg-red-50 text-red-500',
                                        'completed' => 'bg-lime-50 text-lime-600',
                                    ];
                                @endphp
                                <span class="px-4 py-1.5 rounded-full text-[8px] font-black uppercase tracking-widest {{ $statusClasses[$task->status] ?? 'bg-slate-100' }}">
                                    {{ $task->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                @if($task->submission_link)
                                    <a href="{{ $task->submission_link }}" target="_blank" class="flex items-center gap-2 text-[9px] font-black text-blue-600 uppercase hover:underline">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 13a3 3 0 000 6h4a3 3 0 000-6H10zM14 11a3 3 0 000-6h-4a3 3 0 000 6h4z"></path></svg>
                                        View Result
                                    </a>
                                @else
                                    <span class="text-[9px] font-bold text-slate-300 uppercase italic tracking-widest">Not Submitted Yet</span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('kabid-tugas.show', $task->id) }}" class="p-2 text-slate-400 hover:text-[#064e3b] transition-colors" title="Review Submission">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <form action="{{ route('kabid-tugas.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Archive this task?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-slate-300 hover:text-red-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-200 italic">No tasks deployed in this timeline.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($tasks->hasPages())
            <div class="px-8 py-6 bg-slate-50/50">
                {{ $tasks->links() }}
            </div>
            @endif
        </div>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-amber-50 p-6 rounded-[2.5rem] border border-amber-100 flex items-center gap-6">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-amber-500 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-amber-700 italic">Pending Review</h4>
                    <p class="text-2xl font-black text-amber-900 tracking-tighter">{{ $tasks->where('status', 'submitted')->count() }} Tasks</p>
                </div>
            </div>
            <div class="bg-red-50 p-6 rounded-[2.5rem] border border-red-100 flex items-center gap-6">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-red-500 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <div>
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-red-700 italic">In Revision</h4>
                    <p class="text-2xl font-black text-red-900 tracking-tighter">{{ $tasks->where('status', 'revised')->count() }} Tasks</p>
                </div>
            </div>
            <div class="bg-lime-50 p-6 rounded-[2.5rem] border border-lime-100 flex items-center gap-6">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-lime-600 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-lime-700 italic">Success Rate</h4>
                    <p class="text-2xl font-black text-lime-900 tracking-tighter">{{ $tasks->where('status', 'completed')->count() }} Done</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
