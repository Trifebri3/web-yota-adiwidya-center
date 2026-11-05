@extends('kabid.layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] p-4 md:p-10"
     x-data="{
        activeTab: 'current',
        showSubmitForm: false,
        showEditModal: false,
        editData: { id: '', title: '', report_type: '', report_date: '', report_link: '', description: '' }
     }">
@include('kabid.laporan.partials.check_monthly')
    <div class="max-w-6xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12">
            <div>
                <h1 class="text-5xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-none">
                    Executive <span class="text-lime-500">Reporting.</span>
                </h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mt-4">Official Submission & Management</p>
            </div>

            <button @click="showSubmitForm = !showSubmitForm"
                class="bg-[#064e3b] text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-xl shadow-lime-100 flex items-center gap-3">
                <svg x-show="!showSubmitForm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                <span x-text="showSubmitForm ? 'Cancel Entry' : 'Submit New Report'"></span>
            </button>
        </div>

        <div class="flex gap-4 mb-8">
            <button @click="activeTab = 'current'"
                :class="activeTab === 'current' ? 'bg-[#064e3b] text-white' : 'bg-white text-slate-400'"
                class="px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest transition-all shadow-sm">
                In Review / Pending
            </button>
            <button @click="activeTab = 'archive'"
                :class="activeTab === 'archive' ? 'bg-lime-500 text-[#064e3b]' : 'bg-white text-slate-400'"
                class="px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest transition-all shadow-sm flex items-center gap-2">
                📦 Archived Reports
            </button>
        </div>

        <div x-show="showSubmitForm" x-collapse x-cloak class="mb-12">
            <div class="bg-white p-10 rounded-[3rem] border-4 border-[#064e3b] shadow-[12px_12px_0px_0px_rgba(6,78,59,0.05)]">
                <form action="{{ route('kabid.laporan.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Report Title</label>
                            <input type="text" name="title" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-[#064e3b]" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Category</label>
                            <select name="report_type" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-[#064e3b]">
                                <option value="Bulanan">Laporan Bulanan</option>
                                <option value="Program">Laporan Program Kerja</option>
                                <option value="Tahunan">Laporan Tahunan</option>
                                <option value="Khusus">Laporan Khusus</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Period Date</label>
                            <input type="date" name="report_date" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-[#064e3b]" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Cloud Link</label>
                            <input type="url" name="report_link" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-medium text-blue-600" required>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-[#064e3b] text-white py-5 rounded-2xl font-black uppercase tracking-[0.3em] text-[10px] hover:bg-lime-400 hover:text-[#064e3b] transition-all">Publish Laporan</button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] overflow-hidden border border-slate-100 shadow-sm">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-6 text-left text-[9px] font-black uppercase tracking-widest text-slate-400">Submission</th>
                        <th class="px-8 py-6 text-left text-[9px] font-black uppercase tracking-widest text-slate-400">Report Info</th>
                        <th class="px-8 py-6 text-center text-[9px] font-black uppercase tracking-widest text-slate-400">Status</th>
                        <th class="px-8 py-6 text-right text-[9px] font-black uppercase tracking-widest text-slate-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($reports as $r)
                    <tr x-show="(activeTab === 'current' && '{{ $r->status }}' !== 'approved') || (activeTab === 'archive' && '{{ $r->status }}' === 'approved')"
                        x-transition.opacity
                        class="hover:bg-slate-50/30 transition-colors group">
                        <td class="px-8 py-6 text-xs font-bold text-[#064e3b]">
                            {{ $r->created_at->format('d/m/Y') }}<br>
                            <span class="text-[9px] text-slate-300 uppercase italic">{{ $r->created_at->diffForHumans() }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <h5 class="text-sm font-black text-[#064e3b] uppercase italic mb-1">{{ $r->title }}</h5>
                            <span class="px-2 py-0.5 bg-slate-100 text-[8px] font-black text-slate-400 rounded uppercase tracking-tighter">{{ $r->report_type }}</span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase italic
                                {{ $r->status == 'approved' ? 'bg-lime-50 text-lime-600 border border-lime-200' : ($r->status == 'rejected' ? 'bg-red-50 text-red-600' : 'bg-amber-50 text-amber-600') }}">
                                {{ $r->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex justify-end gap-2">
                                <a href="{{ $r->report_link }}" target="_blank" class="p-2 bg-slate-50 text-slate-400 rounded-lg hover:bg-[#064e3b] hover:text-white transition-all shadow-sm" title="View Document">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>

                                {{-- EDIT & DELETE: Hanya Muncul di Tab Current --}}
                                @if($r->status != 'approved')
                                <button @click="
                                    editData = {
                                        id: '{{ $r->id }}',
                                        title: '{{ $r->title }}',
                                        report_type: '{{ $r->report_type }}',
                                        report_date: '{{ $r->report_date->format('Y-m-d') }}',
                                        report_link: '{{ $r->report_link }}',
                                        description: '{{ $r->description }}'
                                    };
                                    showEditModal = true"
                                    class="p-2 bg-slate-50 text-slate-400 rounded-lg hover:bg-blue-50 hover:text-blue-500 transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>

                                <form action="{{ route('kabid.laporan.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Tarik kembali laporan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 bg-slate-50 text-slate-400 rounded-lg hover:bg-red-50 hover:text-red-500 transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                                @else
                                    <span class="p-2 text-[8px] font-black text-lime-500 uppercase tracking-tighter">🔒 Locked</span>
                                @endif
                            </div>
                        </td>
                    </tr>

                    {{-- Baris Feedback --}}
                    <tr x-show="activeTab === 'current' && '{{ $r->status }}' === 'rejected' && '{{ $r->feedback }}'" class="bg-red-50/20">
                        <td colspan="4" class="px-8 py-3 text-[10px] text-red-600 italic font-bold border-l-4 border-red-400">Note: {{ $r->feedback }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="py-20 text-center text-slate-300 font-black uppercase text-[10px] tracking-widest">No Submissions Found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="showEditModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#064e3b]/90 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showEditModal = false" class="bg-white w-full max-w-xl rounded-[3rem] p-10 relative overflow-hidden shadow-2xl">
             <h2 class="text-2xl font-black text-[#064e3b] uppercase italic tracking-tighter mb-8">Update <span class="text-lime-500">Report.</span></h2>
             <form :action="`/kabid/laporan/${editData.id}`" method="POST" class="space-y-5">
                 @csrf @method('PUT')
                 <input type="text" name="title" x-model="editData.title" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-[#064e3b]">
                 <div class="grid grid-cols-2 gap-4">
                     <select name="report_type" x-model="editData.report_type" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-[#064e3b]">
                         <option value="Bulanan">Bulanan</option><option value="Program">Program</option><option value="Tahunan">Tahunan</option><option value="Khusus">Khusus</option>
                     </select>
                     <input type="date" name="report_date" x-model="editData.report_date" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-[#064e3b]">
                 </div>
                 <input type="url" name="report_link" x-model="editData.report_link" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-medium text-blue-600">
                 <div class="flex gap-3 pt-4">
                     <button type="button" @click="showEditModal = false" class="flex-1 py-4 font-black text-slate-400">Cancel</button>
                     <button type="submit" class="flex-[2] bg-[#064e3b] text-white py-4 rounded-xl font-black uppercase text-[10px]">Update & Resubmit</button>
                 </div>
             </form>
        </div>
    </div>
</div>

<style> [x-cloak] { display: none !important; } </style>
@endsection
