@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-10 font-['Plus_Jakarta_Sans']">
    <div class="max-w-4xl mx-auto">

        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <a href="{{ route('delegation.index') }}" class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#064e3b] transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Daftar
            </a>

            <div class="flex items-center gap-3 bg-white px-6 py-2 rounded-2xl border border-slate-100 shadow-sm">
                <div class="w-2 h-2 rounded-full {{ $delegation->status == 'completed' ? 'bg-emerald-500' : 'bg-lime-500 animate-pulse' }}"></div>
                <span class="text-[10px] font-black text-[#064e3b] uppercase tracking-widest">Status: {{ str_replace('_', ' ', $delegation->status) }}</span>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="h-3 bg-gradient-to-r from-lime-400 via-[#064e3b] to-emerald-800"></div>

            <div class="p-8 md:p-14">
                <div class="mb-12">
                    <span class="text-[10px] font-black text-lime-600 uppercase tracking-[0.5em] block mb-3">Instruksi Direktur</span>
                    <h1 class="text-4xl md:text-6xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-[0.9] mb-8">
                        {{ $delegation->title }}
                    </h1>

                    <div class="flex flex-wrap gap-4">
                        <div class="bg-slate-50 px-6 py-4 rounded-2xl border border-slate-100 flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($delegation->director->name) }}&background=064e3b&color=BEF264" class="w-8 h-8 rounded-lg">
                            <div>
                                <p class="text-[8px] font-black text-slate-400 uppercase">Pemberi Mandat</p>
                                <p class="text-xs font-bold text-[#064e3b]">{{ $delegation->director->name }}</p>
                            </div>
                        </div>
                        <div class="bg-red-50 px-6 py-4 rounded-2xl border border-red-100">
                            <p class="text-[8px] font-black text-red-400 uppercase">Tenggat Waktu</p>
                            <p class="text-xs font-bold text-red-600">{{ $delegation->deadline->format('d M Y, H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                <div class="mb-16">
                    <h3 class="text-[10px] font-black text-[#064e3b] uppercase tracking-widest mb-6 flex items-center gap-3">
                        <span class="w-10 h-[2px] bg-lime-500"></span> Detail Tugas
                    </h3>
                    <div class="bg-slate-50 p-8 rounded-[2rem] border border-slate-100 text-slate-600 leading-relaxed font-medium">
                        {!! nl2br(e($delegation->instruction)) !!}
                    </div>

                    @if($delegation->instruction_attachment)
                    <a href="{{ $delegation->instruction_attachment }}" target="_blank" class="mt-6 inline-flex items-center gap-3 bg-[#064e3b] text-white px-8 py-4 rounded-2xl hover:bg-black transition-all text-[10px] font-black uppercase tracking-widest shadow-xl">
                        <i class="fas fa-link"></i> Buka Lampiran Direktur
                    </a>
                    @endif
                </div>

                <hr class="border-dashed border-slate-200 mb-16">

                @if($delegation->status !== 'completed')
                <div class="bg-white">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-black text-[#064e3b] uppercase italic">Update Laporan</h3>
                        @if(session('success'))
                            <span class="px-4 py-1 bg-emerald-100 text-emerald-600 text-[10px] font-bold rounded-lg animate-bounce">✓ TERSIMPAN</span>
                        @endif
                    </div>

                    <form action="{{ route('delegation.progress', $delegation->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Tahapan Kerja</label>
                                <select name="status" class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:border-lime-500 transition-all outline-none">
                                    <option value="in_progress" {{ $delegation->status == 'in_progress' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                    <option value="submitted" {{ $delegation->status == 'submitted' ? 'selected' : '' }}>Selesai & Kirim Laporan</option>
                                </select>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Link Hasil (Google Drive / Doc)</label>
                                <input type="url" name="submission_link" value="{{ old('submission_link', $delegation->submission_link) }}"
                                       placeholder="https://..." class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:border-lime-500 transition-all outline-none">
                                @error('submission_link') <p class="text-[9px] text-red-500 font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Catatan Laporan ke Direktur</label>
                            <textarea name="result_notes" rows="5" class="w-full bg-slate-50 border-2 border-slate-50 rounded-[2rem] p-6 text-sm font-medium text-slate-600 focus:border-lime-500 transition-all outline-none" placeholder="Jelaskan apa saja yang sudah diselesaikan...">{{ old('result_notes', $delegation->result_notes) }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-5 bg-[#064e3b] text-white rounded-2xl font-black uppercase text-[11px] tracking-[0.4em] hover:bg-lime-500 hover:text-[#064e3b] transition-all shadow-xl shadow-slate-100">
                            Simpan & Kirim Update
                        </button>
                    </form>
                </div>
                @endif

                @if(in_array($delegation->status, ['submitted', 'completed']))
                <div class="mt-16 pt-16 border-t border-slate-100">
                    <div class="bg-[#064e3b] rounded-[2.5rem] p-10 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <h4 class="text-[10px] font-black text-lime-400 uppercase tracking-[0.3em] mb-8">Data Laporan Terkirim</h4>

                            <div class="grid gap-8">
                                <div>
                                    <p class="text-[9px] font-black text-slate-300 uppercase mb-3">Tautan Dokumen</p>
                                    @if($delegation->submission_link)
                                        <a href="{{ $delegation->submission_link }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-lime-500 rounded-xl text-[#064e3b] font-black text-[10px] uppercase tracking-widest hover:bg-white transition-all">
                                            <i class="fas fa-file-alt"></i> Lihat Hasil Kerja
                                        </a>
                                    @else
                                        <span class="text-slate-400 italic text-xs">Tidak ada tautan dilampirkan.</span>
                                    @endif
                                </div>

                                <div>
                                    <p class="text-[9px] font-black text-slate-300 uppercase mb-3">Catatan Progress</p>
                                    <div class="bg-black/20 p-6 rounded-2xl border border-white/10 text-sm text-slate-100 italic leading-relaxed">
                                        "{!! nl2br(e($delegation->result_notes ?? 'Penerima mandat tidak memberikan catatan.')) !!}"
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-lime-500 rounded-full blur-3xl opacity-10"></div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
