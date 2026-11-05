@extends('kabid.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FAFBFC] p-4 md:p-10" x-data="{
    activeTab: 'active',
    showCreateModal: false
}">
    <div class="max-w-[1400px] mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
            <div>
                <h1 class="text-5xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-none">
                    Internal <span class="text-lime-500">Notice.</span>
                </h1>
                <div class="flex items-center gap-4 mt-3">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em]">Division Communication Hub</p>
                    <span class="h-[1px] w-12 bg-slate-200"></span>
                    <span class="text-[10px] font-bold text-lime-600 uppercase italic">Secured for {{ auth()->user()->division->name }}</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button @click="showCreateModal = true" class="bg-[#064e3b] text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-xl shadow-lime-100 flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                    New Broadcast
                </button>
            </div>
        </div>

        <div class="flex gap-8 border-b border-slate-100 mb-8">
            <button @click="activeTab = 'active'"
                :class="activeTab === 'active' ? 'text-[#064e3b] border-[#064e3b]' : 'text-slate-300 border-transparent'"
                class="pb-4 border-b-2 font-black uppercase text-[11px] tracking-widest transition-all">
                Active Announcements
            </button>
            <button @click="activeTab = 'archive'"
                :class="activeTab === 'archive' ? 'text-[#064e3b] border-[#064e3b]' : 'text-slate-300 border-transparent'"
                class="pb-4 border-b-2 font-black uppercase text-[11px] tracking-widest transition-all">
                Archived Feed
            </button>
        </div>

        <div x-show="activeTab === 'active'" x-transition class="space-y-6">
            @forelse($announcements->where('is_active', true) as $info)
                <div class="group bg-white p-8 rounded-[3rem] border border-slate-100 hover:border-lime-200 transition-all shadow-sm flex gap-8 items-start relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-2 {{ $info->priority == 'critical' ? 'bg-red-500' : ($info->priority == 'urgent' ? 'bg-amber-400' : 'bg-lime-400') }}"></div>

                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-300">{{ $info->created_at->format('d M Y') }}</span>
                                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                    <span class="text-[9px] font-black uppercase tracking-widest {{ $info->priority == 'critical' ? 'text-red-500' : 'text-lime-600' }}">
                                        {{ $info->priority }}
                                    </span>
                                </div>
                                <h3 class="text-2xl font-black text-[#064e3b] uppercase italic tracking-tighter">{{ $info->title }}</h3>
                            </div>

                            <div class="flex items-center gap-2">
                                <form action="{{ route('kabid.pengumuman.toggle', $info->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button title="Archive" class="p-3 bg-slate-50 text-slate-400 rounded-xl hover:bg-amber-50 hover:text-amber-600 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                                    </button>
                                </form>
                                <form action="{{ route('kabid.pengumuman.destroy', $info->id) }}" method="POST" onsubmit="return confirm('Hapus permanen?')">
                                    @csrf @method('DELETE')
                                    <button class="p-3 bg-slate-50 text-slate-400 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="text-slate-600 font-medium leading-relaxed max-w-4xl">{{ $info->content }}</p>
                    </div>
                </div>
            @empty
                <div class="py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                    <p class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-300">No active broadcasts for your team</p>
                </div>
            @endforelse
        </div>

        <div x-show="activeTab === 'archive'" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($announcements->where('is_active', false) as $archive)
                <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 opacity-60 hover:opacity-100 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-[8px] font-black uppercase tracking-widest text-slate-300 italic">Archived: {{ $archive->updated_at->format('d/m/y') }}</span>
                        <form action="{{ route('kabid.pengumuman.toggle', $archive->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="text-[8px] font-black uppercase tracking-widest text-lime-600 hover:underline">Restore to Feed</button>
                        </form>
                    </div>
                    <h4 class="text-lg font-black text-[#064e3b] uppercase italic leading-none mb-2">{{ $archive->title }}</h4>
                    <p class="text-xs text-slate-500 line-clamp-2">{{ $archive->content }}</p>
                </div>
            @empty
                <div class="col-span-2 py-20 text-center">
                    <p class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-300">Archive is empty</p>
                </div>
            @endforelse
        </div>
    </div>

    <div x-show="showCreateModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#064e3b]/90 backdrop-blur-md" x-cloak x-transition>
        <div @click.away="showCreateModal = false" class="bg-white w-full max-w-2xl rounded-[3.5rem] p-12 shadow-2xl overflow-hidden relative">
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-lime-400 rounded-full opacity-10"></div>

            <div class="relative z-10">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                        Deploy <br><span class="text-lime-500">Internal Message.</span>
                    </h2>
                    <button @click="showCreateModal = false" class="text-slate-300 hover:text-red-500 transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form action="{{ route('kabid.pengumuman.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase tracking-widest text-slate-300">Broadcast Title</label>
                            <input type="text" name="title" class="w-full bg-slate-50 border-none rounded-2xl p-5 font-bold text-[#064e3b] placeholder:text-slate-200" placeholder="e.g. Weekly Sync Rescheduled" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase tracking-widest text-slate-300">Priority Level</label>
                            <select name="priority" class="w-full bg-slate-50 border-none rounded-2xl p-5 font-bold text-[#064e3b] appearance-none">
                                <option value="normal">🟢 Normal Operations</option>
                                <option value="urgent">🟡 Urgent Notice</option>
                                <option value="critical">🔴 Critical / Action Required</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest text-slate-300">Detailed Instruction</label>
                        <textarea name="content" rows="6" class="w-full bg-slate-50 border-none rounded-[2rem] p-6 font-medium text-slate-700 placeholder:text-slate-200" placeholder="Type your division instructions here..." required></textarea>
                    </div>

                    <div class="flex gap-4">
                        <button type="button" @click="showCreateModal = false" class="flex-1 py-5 rounded-2xl font-black uppercase text-[10px] tracking-widest text-slate-400 hover:bg-slate-50 transition-all border border-slate-100">
                            Cancel
                        </button>
                        <button type="submit" class="flex-[2] bg-[#064e3b] text-white py-5 rounded-2xl font-black uppercase text-[10px] tracking-[0.3em] hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-xl shadow-lime-100">
                            Blast to Division
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
    /* Custom Scrollbar for Textarea */
    textarea::-webkit-scrollbar { width: 8px; }
    textarea::-webkit-scrollbar-track { background: transparent; }
    textarea::-webkit-scrollbar-thumb { background: #f1f5f9; border-radius: 10px; }
</style>
@endsection
