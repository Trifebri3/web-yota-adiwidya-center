@extends('kabid.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FAFBFC] p-4 md:p-10"
     x-data="{
        showAddPanel: false,
        showEditModal: false,
        editData: { id: '', title: '', link_url: '', category: '', description: '' }
     }">

    <div class="max-w-[1400px] mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
            <div>
                <h1 class="text-5xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-none">
                    Division <span class="text-lime-500">Vault.</span>
                </h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mt-3">Strategic Assets & Digital Resources</p>
            </div>

            <button @click="showAddPanel = !showAddPanel"
                    class="bg-[#064e3b] text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all flex items-center gap-3 shadow-xl shadow-lime-100">
                <svg x-show="!showAddPanel" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                <svg x-show="showAddPanel" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                <span x-text="showAddPanel ? 'Cancel Entry' : 'Publish New Link'"></span>
            </button>
        </div>

        <div x-show="showAddPanel" x-collapse x-cloak class="mb-10">
            <div class="bg-white p-10 rounded-[3rem] border-4 border-[#064e3b] shadow-[12px_12px_0px_0px_rgba(6,78,59,0.05)]">
                <form action="{{ route('kabid.dokumen.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @csrf
                    <div class="md:col-span-2 space-y-4">
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Document Title</label>
                            <input type="text" name="title" placeholder="e.g., Q1 Marketing Plan Template" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-[#064e3b]" required>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Resource URL (Google Drive/Canva/Dropbox)</label>
                            <input type="url" name="link_url" placeholder="https://docs.google.com/..." class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-medium text-blue-600" required>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Type</label>
                            <select name="category" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-[#064e3b] text-xs">
                                <option value="Template">📄 Template</option>
                                <option value="SOP">📜 SOP / Manual</option>
                                <option value="Asset">🎨 Design Asset</option>
                                <option value="Other">🔗 External Link</option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Short Description</label>
                            <textarea name="description" rows="2" placeholder="What is this for?" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-medium"></textarea>
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <button type="submit" class="w-full bg-[#064e3b] text-white py-5 rounded-2xl font-black uppercase tracking-[0.3em] text-[10px] hover:bg-lime-400 hover:text-[#064e3b] transition-all">
                            Publish to Division Dashboard
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($documents as $doc)
            <div class="group bg-white p-8 rounded-[3.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-lime-100/50 transition-all relative overflow-hidden flex flex-col h-full">
                <div class="flex justify-between items-start mb-6">
                    <span class="px-4 py-1.5 bg-slate-50 text-slate-400 rounded-xl text-[8px] font-black uppercase tracking-widest group-hover:bg-lime-50 group-hover:text-lime-600 transition-colors">
                        {{ $doc->category }}
                    </span>

                    <div class="flex gap-2">
                        <button @click="
                            editData = {
                                id: '{{ $doc->id }}',
                                title: '{{ $doc->title }}',
                                link_url: '{{ $doc->link_url }}',
                                category: '{{ $doc->category }}',
                                description: '{{ $doc->description }}'
                            };
                            showEditModal = true"
                            class="p-2 bg-slate-50 text-slate-300 rounded-lg hover:bg-blue-50 hover:text-blue-500 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>

                        <form action="{{ route('kabid.dokumen.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Hapus aset ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 bg-slate-50 text-slate-300 rounded-lg hover:bg-red-50 hover:text-red-500 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="flex-1">
                    <h3 class="text-2xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-tight mb-3 line-clamp-2">{{ $doc->title }}</h3>
                    <p class="text-xs text-slate-400 font-medium leading-relaxed mb-8">{{ $doc->description ?? 'No specific description provided for this resource.' }}</p>
                </div>

                <a href="{{ $doc->link_url }}" target="_blank"
                   class="w-full bg-[#064e3b] text-white py-5 rounded-2xl flex items-center justify-center gap-3 group-hover:bg-lime-400 group-hover:text-[#064e3b] transition-all shadow-lg">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em]">Access Resource</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
            </div>
            @empty
            <div class="col-span-full py-32 bg-white rounded-[4rem] border-2 border-dashed border-slate-100 flex flex-col items-center justify-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.4em]">Vault is Empty</p>
            </div>
            @endforelse
        </div>
    </div>

    <div x-show="showEditModal" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-[#064e3b]/90 backdrop-blur-md" x-cloak x-transition>
        <div @click.away="showEditModal = false" class="bg-white w-full max-w-xl rounded-[3.5rem] p-12 shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-black text-[#064e3b] uppercase italic tracking-tighter">Update <span class="text-lime-500">Resource.</span></h2>
                    <button @click="showEditModal = false" class="text-slate-300 hover:text-red-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form :action="`/kabid/dokumen/${editData.id}`" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-1">
                        <label class="text-[9px] font-black uppercase text-slate-300 tracking-widest ml-2">Title</label>
                        <input type="text" name="title" x-model="editData.title" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-[#064e3b]" required>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[9px] font-black uppercase text-slate-300 tracking-widest ml-2">Resource URL</label>
                        <input type="url" name="link_url" x-model="editData.link_url" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-medium text-blue-600" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase text-slate-300 tracking-widest ml-2">Category</label>
                            <select name="category" x-model="editData.category" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-bold text-[#064e3b]">
                                <option value="Template">Template</option>
                                <option value="SOP">SOP</option>
                                <option value="Asset">Asset</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[9px] font-black uppercase text-slate-300 tracking-widest ml-2">Description</label>
                        <textarea name="description" x-model="editData.description" rows="3" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-medium text-slate-600"></textarea>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="button" @click="showEditModal = false" class="flex-1 py-5 rounded-2xl font-black uppercase text-[10px] text-slate-400 hover:bg-slate-50 transition-all">Cancel</button>
                        <button type="submit" class="flex-[2] bg-[#064e3b] text-white py-5 rounded-2xl font-black uppercase text-[10px] tracking-[0.3em] hover:bg-lime-400 hover:text-[#064e3b] transition-all">Apply Changes</button>
                    </div>
                </form>
            </div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-lime-400 rounded-full blur-3xl opacity-10"></div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
