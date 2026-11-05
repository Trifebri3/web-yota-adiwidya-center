@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-10 font-['Plus_Jakarta_Sans']">
    <div class="max-w-4xl mx-auto">

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-100 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-bold animate-bounce">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-2xl text-xs font-bold">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <a href="{{ route('task.index') }}" class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#064e3b] transition-all">
                <i class="fas fa-arrow-left"></i> Kembali ke Misi Tim
            </a>
            <div class="px-6 py-2 bg-white rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3">
                <div class="w-2 h-2 rounded-full {{ $task->getStatusColorAttribute() }}"></div>
                <span class="text-[10px] font-black text-[#064e3b] uppercase tracking-widest">{{ $task->status }}</span>
            </div>
        </div>

        <div class="bg-white rounded-[3.5rem] shadow-2xl border border-slate-100 overflow-hidden">
            <div class="h-3 w-full bg-slate-100">
                @php
                    $widths = ['pending'=>'10%', 'read'=>'30%', 'doing'=>'60%', 'submitted'=>'90%', 'completed'=>'100%'];
                    $currentWidth = $widths[$task->status] ?? '0%';
                @endphp
                <div class="h-full bg-gradient-to-r from-lime-400 to-[#064e3b] transition-all duration-1000" style="width: {{ $currentWidth }}"></div>
            </div>

            <div class="p-8 md:p-16">
                <div class="mb-12">
                    <span class="text-[10px] font-black text-lime-600 uppercase tracking-[0.5em] block mb-4">Misi {{ $task->division->name }}</span>
                    <h1 class="text-4xl md:text-6xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-[0.9] mb-8">
                        {{ $task->title }}
                    </h1>

                    <div class="flex flex-wrap gap-6">
                        <div class="flex items-center gap-3 bg-slate-50 px-5 py-3 rounded-2xl border border-slate-100">
                            <i class="fas fa-user-tie text-[#064e3b]"></i>
                            <div>
                                <p class="text-[8px] font-black text-slate-400 uppercase">Director</p>
                                <p class="text-xs font-bold text-[#064e3b]">{{ $task->author->name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 bg-red-50 px-5 py-3 rounded-2xl border border-red-100">
                            <i class="fas fa-calendar-alt text-red-500"></i>
                            <div>
                                <p class="text-[8px] font-black text-red-400 uppercase">Deadline</p>
                                <p class="text-xs font-bold text-red-600">{{ $task->deadline->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-16">
                    <h3 class="text-[10px] font-black text-[#064e3b] uppercase tracking-widest mb-6 flex items-center gap-3">
                        <span class="w-10 h-[2px] bg-lime-500"></span> Deskripsi & Instruksi
                    </h3>
                    <div class="p-8 bg-slate-50/50 rounded-[2.5rem] border border-slate-100 text-slate-600 leading-relaxed font-medium">
                        {!! nl2br(e($task->description)) !!}
                    </div>

                    @if($task->instruction_link)
                    <a href="{{ $task->instruction_link }}" target="_blank" class="mt-6 inline-flex items-center gap-3 bg-white text-[#064e3b] px-8 py-4 rounded-2xl border-2 border-[#064e3b] hover:bg-[#064e3b] hover:text-white transition-all text-[10px] font-black uppercase tracking-widest">
                        <i class="fas fa-link"></i> Dokumen Instruksi
                    </a>
                    @endif
                </div>

                <hr class="border-dashed border-slate-200 mb-16">

                @if($task->status !== 'completed')
                <div class="bg-white">
                    <h3 class="text-2xl font-black text-[#064e3b] uppercase italic mb-8">Mission Control</h3>

                    <form action="{{ route('task.submit', $task->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Status Pengerjaan</label>
                                <select name="status" class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:border-lime-500 transition-all outline-none">
                                    <option value="doing" {{ $task->status == 'doing' ? 'selected' : '' }}>Sedang Dikerjakan (Doing)</option>
                                    <option value="submitted" {{ $task->status == 'submitted' ? 'selected' : '' }}>Kirim Hasil (Submit)</option>
                                </select>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Link Hasil Kerja (Wajib URL)</label>
                                <input type="url" name="submission_link" value="{{ old('submission_link', $task->submission_link) }}"
                                       placeholder="https://drive.google.com/..."
                                       class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:border-lime-500 transition-all outline-none">
                                <p class="text-[8px] text-slate-400 mt-1 ml-2 font-bold uppercase italic">Wajib diawali https://</p>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-5 bg-[#064e3b] text-white rounded-2xl font-black uppercase text-[11px] tracking-[0.4em] hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-xl">
                            Update Progress Tim
                        </button>
                    </form>
                </div>
                @endif

                @if($task->director_note)
                <div class="mt-12 p-8 bg-lime-50 rounded-[2.5rem] border border-lime-100">
                    <h4 class="text-[10px] font-black text-lime-700 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i class="fas fa-comment-dots"></i> Feedback Direktur
                    </h4>
                    <p class="text-sm text-lime-900 font-bold italic">"{{ $task->director_note }}"</p>
                </div>
                @endif

                @if(in_array($task->status, ['submitted', 'completed']))
                <div class="mt-16 pt-16 border-t border-slate-100">
                    <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <h4 class="text-[10px] font-black text-lime-400 uppercase tracking-widest mb-6">Arsip Pelaporan Tim</h4>
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-[9px] text-slate-400 uppercase font-black mb-2">Tautan Terkumpul</p>
                                    <a href="{{ $task->submission_link }}" target="_blank" class="text-lime-400 font-bold text-sm underline hover:text-white transition-all break-all">
                                        {{ $task->submission_link }}
                                    </a>
                                </div>
                                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check-circle text-lime-400 text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
