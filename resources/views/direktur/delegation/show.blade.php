@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-10 font-['Plus_Jakarta_Sans']">
    <div class="max-w-4xl mx-auto">

        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <a href="{{ route('delegation.index') }}" class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#064e3b] transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Daftar
            </a>
            <div class="flex gap-2">
                <div class="px-6 py-2 bg-white rounded-2xl border border-slate-100 shadow-sm">
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-1 text-center">Status</span>
                    <span class="text-xs font-bold text-[#064e3b] uppercase">{{ str_replace('_', ' ', $delegation->status) }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative">
            <div class="h-3 bg-gradient-to-r from-lime-400 via-[#064e3b] to-emerald-700"></div>

            <div class="p-8 md:p-14">
                <div class="mb-12">
                    <span class="text-[10px] font-black text-lime-600 uppercase tracking-[0.5em] block mb-3">Instruksi Mandat</span>
                    <h1 class="text-4xl md:text-5xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-[0.9] mb-8">
                        {{ $delegation->title }}
                    </h1>

                    <div class="flex flex-wrap gap-4">
                        <div class="bg-slate-50 px-6 py-4 rounded-2xl border border-slate-100">
                            <p class="text-[8px] font-black text-slate-400 uppercase mb-1">Director</p>
                            <p class="text-sm font-bold text-[#064e3b]">{{ $delegation->director->name }}</p>
                        </div>
                        <div class="bg-red-50 px-6 py-4 rounded-2xl border border-red-100">
                            <p class="text-[8px] font-black text-red-400 uppercase mb-1">Deadline</p>
                            <p class="text-sm font-bold text-red-600">{{ $delegation->deadline->format('d M Y, H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                <div class="mb-16">
                    <h3 class="text-[10px] font-black text-[#064e3b] uppercase tracking-widest mb-6 flex items-center gap-3">
                        <span class="w-10 h-[2px] bg-lime-500"></span> Detail Tugas
                    </h3>
                    <div class="bg-slate-50/50 p-8 rounded-[2rem] border border-slate-100 prose prose-slate max-w-none text-slate-600 leading-relaxed font-medium">
                        {!! nl2br(e($delegation->instruction)) !!}
                    </div>

                    @if($delegation->instruction_attachment)
                    <a href="{{ $delegation->instruction_attachment }}" target="_blank" class="mt-6 inline-flex items-center gap-3 bg-white text-[#064e3b] px-8 py-4 rounded-2xl border-2 border-[#064e3b] hover:bg-[#064e3b] hover:text-white transition-all text-[10px] font-black uppercase tracking-widest">
                        <i class="fas fa-paperclip"></i> Lihat Lampiran Pendukung
                    </a>
                    @endif
                </div>

                <hr class="border-dashed border-slate-200 mb-16">

                @if($delegation->status !== 'completed')
                <div class="bg-white">
                    <h3 class="text-2xl font-black text-[#064e3b] uppercase italic mb-8">Pelaporan Progress</h3>

                    <form action="{{ route('delegation.progress', $delegation->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Update Status Kerja</label>
                                <select name="status" class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:border-lime-500 focus:bg-white transition-all outline-none">
                                    <option value="in_progress" {{ $delegation->status == 'in_progress' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                    <option value="submitted" {{ $delegation->status == 'submitted' ? 'selected' : '' }}>Serahkan Laporan (Submit)</option>
                                </select>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Link Hasil (G-Drive/URL)</label>
                                <input type="url" name="submission_link" value="{{ old('submission_link', $delegation->submission_link) }}"
                                       placeholder="https://..." class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:border-lime-500 focus:bg-white transition-all outline-none">
                                @error('submission_link') <p class="text-[9px] text-red-500 font-bold mt-1 ml-2 uppercase">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Catatan Detail Pelaksanaan</label>
                            <textarea name="result_notes" rows="5" class="w-full bg-slate-50 border-2 border-slate-50 rounded-[2rem] p-6 text-sm font-medium text-slate-600 focus:border-lime-500 focus:bg-white transition-all outline-none" placeholder="Tuliskan kendala atau ringkasan hasil kerja...">{{ old('result_notes', $delegation->result_notes) }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-5 bg-[#064e3b] text-white rounded-2xl font-black uppercase text-[11px] tracking-[0.4em] hover:bg-lime-400 hover:text-[#064e3b] hover:shadow-2xl transition-all shadow-xl shadow-slate-100">
                            Kirim & Perbarui Mandat
                        </button>
                    </form>
                </div>
                @endif

                @if(in_array($delegation->status, ['submitted', 'completed']))
                <div class="mt-16 pt-16 border-t border-slate-100">
                    <div class="bg-slate-50 rounded-[2.5rem] p-10 border border-slate-100">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-8 flex items-center gap-3">
                            <i class="fas fa-archive text-lime-600"></i> Laporan Terarsip
                        </h4>

                        <div class="grid gap-8">
                            <div>
                                <p class="text-[9px] font-black text-[#064e3b] uppercase tracking-widest mb-3">Dokumen Hasil</p>
                                @if($delegation->submission_link)
                                    <a href="{{ $delegation->submission_link }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2 bg-white rounded-xl border border-slate-200 text-blue-600 font-bold text-xs hover:bg-blue-50 transition-all">
                                        <i class="fas fa-external-link-alt"></i> Buka Link Dokumen
                                    </a>
                                @else
                                    <span class="text-slate-400 italic text-xs">Tidak ada lampiran link.</span>
                                @endif
                            </div>

                            <div>
                                <p class="text-[9px] font-black text-[#064e3b] uppercase tracking-widest mb-3">Catatan Pengerjaan</p>
                                <div class="bg-white p-6 rounded-2xl border border-slate-100 text-sm text-slate-500 italic leading-relaxed">
                                    "{!! nl2br(e($delegation->result_notes ?? 'Penerima mandat tidak menyertakan catatan tambahan.')) !!}"
                                </div>
                            </div>

                            @if($delegation->status === 'completed')
                            <div class="pt-6 border-t border-slate-200 flex items-center gap-4">
                                <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check-double"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Mandat Diverifikasi</p>
                                    <p class="text-[9px] text-slate-400 font-bold mt-1">Selesai pada {{ $delegation->completed_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
