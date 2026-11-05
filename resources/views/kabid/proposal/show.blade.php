@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-10 font-['Plus_Jakarta_Sans']">
    <div class="max-w-4xl mx-auto">

        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <a href="{{ route('kabid.proposal.index') }}" class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#064e3b] transition-all">
                <i class="fas fa-arrow-left"></i> Kembali ke Arsip
            </a>
            <div class="flex items-center gap-3">
                <span class="px-6 py-2 rounded-2xl {{ $proposal->status_color }} text-[10px] font-black uppercase tracking-widest shadow-sm">
                    {{ $proposal->status }}
                </span>
            </div>
        </div>

        <div class="bg-white rounded-[3.5rem] shadow-2xl border border-slate-100 overflow-hidden relative">

            {{-- Watermark Stempel jika Approved --}}
            @if($proposal->status == 'approved')
            <div class="absolute top-20 right-10 -rotate-12 opacity-20 pointer-events-none">
                <div class="border-8 border-emerald-500 text-emerald-500 p-4 rounded-full font-black text-4xl uppercase tracking-widest">
                    APPROVED
                </div>
            </div>
            @endif

            <div class="p-8 md:p-16">
                <div class="mb-16 border-b border-slate-100 pb-12">
                    <span class="text-[10px] font-black text-lime-600 uppercase tracking-[0.4em] block mb-4">Official Submission</span>
                    <h1 class="text-4xl md:text-5xl font-black text-[#064e3b] uppercase italic leading-[0.9] tracking-tighter mb-6">
                        {{ $proposal->title }}
                    </h1>
                    <div class="flex flex-wrap gap-6 text-[10px] font-black uppercase text-slate-400">
                        <span>Ref: {{ $proposal->reference_number }}</span>
                        <span class="text-[#064e3b]">|</span>
                        <span>Kategori: {{ $proposal->category_label }}</span>
                        <span class="text-[#064e3b]">|</span>
                        <span>Diajukan: {{ $proposal->created_at->format('d M Y') }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-16">
                    <div class="lg:col-span-2 space-y-10">
                        <div>
                            <h3 class="text-[10px] font-black text-[#064e3b] uppercase tracking-widest mb-4 flex items-center gap-2">
                                <span class="w-8 h-[2px] bg-lime-500"></span> Deskripsi Pengajuan
                            </h3>
                            <div class="prose prose-slate max-w-none text-slate-600 font-medium leading-relaxed italic">
                                {!! nl2br(e($proposal->description)) !!}
                            </div>
                        </div>

                        @if($proposal->document_url)
                        <a href="{{ $proposal->document_url }}" target="_blank" class="inline-flex items-center gap-3 bg-slate-900 text-white px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-lime-500 hover:text-[#064e3b] transition-all shadow-xl">
                            <i class="fas fa-file-pdf"></i> Lihat Berkas Lampiran
                        </a>
                        @endif
                    </div>

                    {{-- Sidebar Anggaran --}}
                    <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-slate-100 h-fit">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Estimasi Biaya</p>
                        <h4 class="text-2xl font-black text-[#064e3b] italic">
                            {{ $proposal->category === 'budget' ? $proposal->formatted_cost : 'N/A' }}
                        </h4>
                        <hr class="my-6 border-slate-200">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Divisi Pengaju</p>
                        <p class="text-xs font-bold text-[#064e3b] uppercase">{{ $proposal->division->name }}</p>
                    </div>
                </div>

                <div class="pt-12 border-t border-slate-100">
                    <h3 class="text-[10px] font-black text-[#064e3b] uppercase tracking-widest mb-10">Approval Tracking</h3>

                    <div class="space-y-8">
                        <div class="flex gap-6">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-[10px] {{ $proposal->reviewer_id ? 'bg-blue-500 text-white' : 'bg-slate-100 text-slate-400' }}">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <div class="w-[2px] h-full bg-slate-100 mt-2"></div>
                            </div>
                            <div class="pb-8">
                                <h4 class="text-xs font-black text-[#064e3b] uppercase">Tahap 1: Review Pengawas</h4>
                                @if($proposal->reviewer_id)
                                    <p class="text-[11px] font-medium text-slate-500 mt-2 italic">"{{ $proposal->notes_from_reviewer }}"</p>
                                    <p class="text-[9px] font-black text-blue-500 uppercase mt-2">— {{ $proposal->reviewer->name }} ({{ $proposal->reviewed_at->format('d/m/Y') }})</p>
                                @else
                                    <p class="text-[10px] text-slate-400 italic mt-1 font-bold">Menunggu verifikasi administrasi...</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-[10px] {{ $proposal->status == 'approved' ? 'bg-emerald-500 text-white' : ($proposal->status == 'rejected' ? 'bg-red-500 text-white' : 'bg-slate-100 text-slate-400') }}">
                                    <i class="fas fa-file-signature"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-xs font-black text-[#064e3b] uppercase">Tahap 2: Keputusan Direktur</h4>
                                @if($proposal->approver_id)
                                    <p class="text-[11px] font-medium text-slate-500 mt-2 italic">"{{ $proposal->notes_from_director }}"</p>
                                    <p class="text-[9px] font-black text-emerald-600 uppercase mt-2">— {{ $proposal->approver->name }} ({{ $proposal->approved_at->format('d/m/Y') }})</p>
                                @else
                                    <p class="text-[10px] text-slate-400 italic mt-1 font-bold">Menunggu keputusan akhir...</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($proposal->status == 'revised' || $proposal->status == 'pending')
                <div class="mt-16 flex justify-end gap-4">
                    <form action="{{ route('kabid.proposal.destroy', $proposal->id) }}" method="POST" onsubmit="return confirm('Tarik kembali proposal ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-8 py-4 text-[10px] font-black uppercase text-red-400 hover:text-red-600 transition-all tracking-widest">
                            Tarik Pengajuan
                        </button>
                    </form>
                    <a href="{{ route('kabid.proposal.edit', $proposal->id) }}" class="px-10 py-4 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-[#064e3b] transition-all">
                        Edit Proposal
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
