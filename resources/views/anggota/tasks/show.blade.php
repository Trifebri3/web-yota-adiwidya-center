@extends('anggota.layouts.app')

@section('content')
<div class="p-8 bg-[#FDFDFB] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-4xl mx-auto">

        <a href="{{ route('anggota.tugas.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#064e3b] mb-10 transition-all">
            <i class="fas fa-chevron-left"></i> Kembali ke Daftar Tugas
        </a>

        <div class="bg-white rounded-[3.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="h-3 w-full bg-gradient-to-r from-lime-400 via-[#064e3b] to-emerald-900"></div>

            <div class="p-8 md:p-16">
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-4 py-1.5 bg-slate-100 text-[#064e3b] rounded-xl text-[9px] font-black uppercase tracking-widest border border-slate-50">
                            {{ $task->team_id ? 'Mission: ' . $task->team->name : 'Personal Mission' }}
                        </span>
                        <div class="text-right">
                            <p class="text-[8px] font-black text-slate-400 uppercase">Deadline</p>
                            <p class="text-[10px] font-black text-red-500 uppercase italic">{{ $task->deadline->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-[#064e3b] uppercase italic leading-[0.9] tracking-tighter mb-8">
                        {{ $task->title }}
                    </h1>
                </div>

                <div class="mb-16">
                    <h3 class="text-[10px] font-black text-[#064e3b] uppercase tracking-widest mb-6 flex items-center gap-3">
                        <span class="w-10 h-[2px] bg-lime-500"></span> Deskripsi & Instruksi
                    </h3>
                    <div class="bg-slate-50/50 p-8 rounded-[2rem] border border-slate-100 text-slate-600 font-medium leading-relaxed italic">
                        {!! nl2br(e($task->description)) !!}
                    </div>
                </div>

                {{-- REVISION NOTES: Muncul hanya jika status Revised --}}
                @if($task->status == 'revised')
                <div class="mb-12 p-8 bg-red-50 border border-red-100 rounded-[2.5rem] animate-pulse">
                    <h4 class="text-[10px] font-black text-red-600 uppercase tracking-widest mb-3 flex items-center gap-2">
                        <i class="fas fa-exclamation-triangle"></i> Catatan Revisi Kabid
                    </h4>
                    <p class="text-sm text-red-800 font-bold italic leading-relaxed">
                        "{{ $task->revision_notes }}"
                    </p>
                </div>
                @endif

                <hr class="border-dashed border-slate-200 mb-16">

                {{-- KONDISI 1: FORM PENGUMPULAN (Tampil jika Pending/Revised/In Progress) --}}
                @if(in_array($task->status, ['pending', 'revised', 'in_progress']))
                <div class="bg-white">
                    <h3 class="text-2xl font-black text-[#064e3b] uppercase italic mb-8 flex items-center gap-3">
                        Mission Control <span class="text-[10px] not-italic text-slate-400 font-bold tracking-widest">SUBMIT REPORT</span>
                    </h3>

                    <form action="{{ route('anggota.tugas.submit', $task->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Link Hasil (Wajib Menggunakan HTTPS)</label>
                            <input type="url" name="submission_link" value="{{ old('submission_link', $task->submission_link) }}"
                                   required placeholder="https://drive.google.com/..."
                                   class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:border-lime-500 focus:bg-white transition-all outline-none">
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Catatan Tambahan (Laporan Singkat)</label>
                            <textarea name="submission_notes" rows="4"
                                      class="w-full bg-slate-50 border-2 border-slate-50 rounded-[2rem] p-6 text-sm font-medium text-slate-600 focus:border-lime-500 focus:bg-white transition-all outline-none"
                                      placeholder="Tuliskan ringkasan hasil kerja atau kendala yang dihadapi...">{{ old('submission_notes', $task->submission_notes) }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-5 bg-[#064e3b] text-white rounded-2xl font-black uppercase text-[11px] tracking-[0.4em] hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-xl shadow-slate-100">
                            Kirim Laporan Ke Kabid
                        </button>
                    </form>
                </div>

                {{-- KONDISI 2: ARSIP LAPORAN (Tampil jika sudah Submitted/Completed) --}}
                @else
                <div class="space-y-8">
                    <div class="bg-slate-900 rounded-[3rem] p-10 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-lime-400 rounded-2xl flex items-center justify-center text-[#064e3b] shadow-lg shadow-lime-400/20">
                                    <i class="fas fa-check-double text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-xl font-black uppercase italic leading-none">Laporan Berhasil Terkirim</h4>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-2">Status Saat Ini: {{ strtoupper($task->status) }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-white/10">
                                <div>
                                    <p class="text-[9px] font-black text-lime-400 uppercase tracking-widest mb-3">Tautan Dokumen</p>
                                    <a href="{{ $task->submission_link }}" target="_blank" class="text-sm font-bold underline hover:text-lime-400 break-all transition-colors">
                                        {{ $task->submission_link }}
                                    </a>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-lime-400 uppercase tracking-widest mb-3">Terakhir Update</p>
                                    <p class="text-sm font-bold">{{ $task->updated_at->format('d M Y, H:i') }} WIB</p>
                                </div>
                            </div>

                            @if($task->submission_notes)
                            <div class="mt-8 pt-8 border-t border-white/10">
                                <p class="text-[9px] font-black text-lime-400 uppercase tracking-widest mb-3">Catatan Anda</p>
                                <p class="text-xs text-slate-300 italic leading-relaxed font-medium">
                                    "{{ $task->submission_notes }}"
                                </p>
                            </div>
                            @endif
                        </div>

                        <div class="absolute -bottom-10 -right-10 opacity-10 pointer-events-none">
                            <i class="fas fa-paper-plane text-[15rem] -rotate-12"></i>
                        </div>
                    </div>

                    {{-- Pesan Sukses jika sudah Completed --}}
                    @if($task->status == 'completed')
                    <div class="bg-emerald-50 p-10 rounded-[3rem] border border-emerald-100 text-center">
                        <div class="w-16 h-16 bg-emerald-500 rounded-full flex items-center justify-center mx-auto mb-4 text-white shadow-xl">
                            <i class="fas fa-trophy text-2xl"></i>
                        </div>
                        <h4 class="text-2xl font-black text-emerald-900 uppercase italic leading-none">Mission Accomplished</h4>
                        <p class="text-sm text-emerald-700 font-medium mt-2">Kabid telah memverifikasi laporan Anda. Tugas dinyatakan SELESAI.</p>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
