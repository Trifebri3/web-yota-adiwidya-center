@extends('kabid.layouts.app')


@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-12"
     x-data="{ targetType: '{{ $task->team_id ? 'team' : 'personal' }}' }">
    <div class="max-w-3xl mx-auto">

        <div class="mb-12 text-center md:text-left">
            <a href="{{ route('kabid-tugas.index') }}" class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 hover:text-lime-500 transition-colors flex items-center justify-center md:justify-start gap-2 mb-4">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"></path></svg>
                Cancel & Back
            </a>
            <h1 class="text-5xl font-black text-[#064e3b] tracking-tighter uppercase italic">Refine <span class="text-lime-500">Task.</span></h1>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Adjusting mission details for {{ $task->title }}</p>
        </div>

        <div class="bg-white rounded-[3rem] border border-slate-100 shadow-2xl shadow-slate-200/50 p-8 md:p-12">
            <form action="{{ route('kabid-tugas.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-10">
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-4 block italic">Update Subject</label>
                        <input type="text" name="title" value="{{ $task->title }}"
                               class="w-full border-b-2 border-slate-100 focus:border-lime-400 border-t-0 border-x-0 px-0 py-4 text-xl font-bold text-[#064e3b] focus:ring-0 transition-all" required>
                    </div>

                    <div class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 flex items-center justify-between">
                        <div>
                            <p class="text-[9px] font-black uppercase text-slate-400 tracking-widest mb-1">Current Assignment</p>
                            <p class="text-sm font-black text-[#064e3b] uppercase italic">
                                {{ $task->team_id ? 'Team: ' . $task->team->name : 'Member: ' . $task->user->name }}
                            </p>
                        </div>
                        <div class="px-4 py-2 bg-white rounded-xl text-[8px] font-black uppercase text-slate-300 tracking-widest">
                            Target Locked
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-4 block italic">New Deadline</label>
                        <input type="datetime-local" name="deadline"
                               value="{{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d\TH:i') }}"
                               class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-sm font-bold text-[#064e3b] focus:ring-2 focus:ring-lime-400" required>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-4 block italic">Revised Briefing</label>
                        <textarea name="description" rows="6"
                                  class="w-full bg-slate-50 border-none rounded-[2rem] py-6 px-8 text-sm font-medium text-slate-600 focus:ring-2 focus:ring-lime-400">{{ $task->description }}</textarea>
                    </div>

                    @if($task->status !== 'completed')
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-4 block italic">Status Override</label>
                        <select name="status" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-xs font-black uppercase tracking-widest text-[#064e3b] focus:ring-2 focus:ring-lime-400">
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="revised" {{ $task->status == 'revised' ? 'selected' : '' }}>Under Revision</option>
                        </select>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-6">
                        <button type="submit" class="bg-[#064e3b] text-white py-6 rounded-[2rem] text-[10px] font-black uppercase tracking-[0.3em] hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-xl shadow-lime-100">
                            Save Changes
                        </button>
                        <button type="button" onclick="history.back()" class="bg-slate-100 text-slate-400 py-6 rounded-[2rem] text-[10px] font-black uppercase tracking-[0.3em] hover:bg-red-50 hover:text-red-500 transition-all">
                            Discard
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
