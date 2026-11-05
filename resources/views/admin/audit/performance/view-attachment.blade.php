@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-4xl mx-auto">

        <div class="flex items-center justify-between mb-12">
            <div class="flex items-center gap-5">
                <a href="{{ url()->previous() }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#064e3b] shadow-sm hover:bg-lime-400 transition-all border border-slate-100">
                    <i class="fas fa-chevron-left text-xs"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                        Attachment <span class="text-slate-300">Review.</span>
                    </h1>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">Verification for: {{ $presence->user->name }}</p>
                </div>
            </div>
            <span class="px-5 py-2 bg-amber-100 text-amber-600 rounded-xl text-[10px] font-black uppercase tracking-widest border border-amber-200">
                Status: {{ $presence->status }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1 space-y-6">
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-6 italic border-b border-slate-50 pb-2">Agenda Context</p>

                    <h4 class="text-sm font-black text-[#064e3b] uppercase leading-tight mb-2">{{ $presence->agenda->title }}</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-6">{{ $presence->agenda->start_time->format('d M Y, H:i') }}</p>

                    <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-2 italic">Submitted Reason</p>
                    <div class="p-4 bg-slate-50 rounded-2xl">
                        <p class="text-xs font-bold text-slate-600 italic leading-relaxed">"{{ $presence->reason ?? 'Tidak ada keterangan tertulis.' }}"</p>
                    </div>
                </div>

                <div class="bg-[#064e3b] rounded-[30px] p-8 text-white relative overflow-hidden shadow-xl">
                    <p class="text-[9px] font-black uppercase tracking-[0.3em] text-lime-400 mb-2">Audit Instruction</p>
                    <p class="text-[11px] font-medium leading-relaxed opacity-80 italic">Pastikan lampiran dokumen valid dan sesuai dengan tanggal agenda untuk menghindari manipulasi data kehadiran.</p>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white p-4 rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden min-h-[500px] flex flex-col italic">
                    <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50 rounded-t-[2.5rem] mb-4">
                        <span class="text-[10px] font-black text-[#064e3b] uppercase tracking-widest leading-none">Document Evidence</span>
                        <a href="{{ $presence->attachment_link }}" target="_blank" class="text-[10px] font-black text-blue-500 uppercase hover:underline">
                            <i class="fas fa-external-link-alt mr-1"></i> Open Original
                        </a>
                    </div>

                    <div class="flex-1 flex items-center justify-center p-4">
                        @php
                            $extension = pathinfo($presence->attachment_link, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        @endphp

                        @if($isImage)
                            <img src="{{ $presence->attachment_link }}" class="max-w-full h-auto rounded-2xl shadow-lg border border-slate-100" alt="Attachment Evidence">
                        @elseif(strtolower($extension) === 'pdf')
                            <iframe src="{{ $presence->attachment_link }}" class="w-full h-[600px] rounded-2xl border border-slate-100"></iframe>
                        @else
                            <div class="text-center p-12">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-file-download text-3xl text-slate-200"></i>
                                </div>
                                <p class="text-[11px] font-black text-slate-400 uppercase mb-4 tracking-widest">Format file tidak dapat dipratinjau langsung</p>
                                <a href="{{ $presence->attachment_link }}" class="bg-[#064e3b] text-white px-8 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg">Download Document</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
