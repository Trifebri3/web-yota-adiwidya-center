@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">
                    Strategic <span class="text-slate-300">Bulletin.</span>
                </h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-3 italic">Pusat Instruksi & Kebijakan Strategis Yayasan</p>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('audit.index') }}" class="bg-white text-[#064e3b] px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest border border-slate-100 shadow-sm hover:bg-[#064e3b] hover:text-white transition-all">
                    <i class="fas fa-th-large mr-2"></i> Dashboard
                </a>
                <a href="{{ route('audit.announcement.create') }}" class="bg-[#064e3b] text-white px-8 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-emerald-900/20 hover:bg-black transition-all flex items-center gap-2">
                    <i class="fas fa-plus"></i> Terbitkan Instruksi
                </a>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm overflow-hidden relative">
            <div class="mb-10 flex justify-between items-center">
                <h3 class="text-sm font-black text-[#064e3b] uppercase tracking-widest italic border-b-2 border-lime-400 pb-2">Active Policy & Directives</h3>
            </div>

            <div class="space-y-6">
                @forelse($announcements as $ann)
                <div class="group relative p-8 bg-slate-50/50 rounded-[2.5rem] border border-transparent hover:border-slate-200 hover:bg-white transition-all">
                    <div class="flex flex-col md:flex-row justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                {{-- Priority Badge --}}
                                @php
                                    $priorityColors = [
                                        'urgent' => 'bg-red-500 text-white',
                                        'high'   => 'bg-orange-500 text-white',
                                        'medium' => 'bg-blue-500 text-white',
                                        'low'    => 'bg-slate-400 text-white',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest {{ $priorityColors[$ann->priority] ?? 'bg-slate-400' }}">
                                    {{ $ann->priority }}
                                </span>
                                <span class="text-[9px] font-black text-slate-300 uppercase italic">Ref: #{{ $ann->id }}{{ $ann->created_at->format('Y') }}</span>
                            </div>

                            <h4 class="text-xl font-black text-[#064e3b] uppercase tracking-tight mb-2 group-hover:text-lime-600 transition-colors">
                                {{ $ann->title }}
                            </h4>

                            <div class="flex items-center gap-4 text-[10px] font-bold text-slate-400 italic">
                                <span><i class="fas fa-user-tie mr-1"></i> {{ $ann->author->name }}</span>
                                <span><i class="fas fa-layer-group mr-1"></i> {{ $ann->division->name ?? 'Seluruh Divisi' }}</span>
                                <span><i class="fas fa-clock mr-1 text-slate-200"></i> {{ $ann->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            {{-- Toggle Status --}}
                            <form action="{{ route('audit.announcement.toggle', $ann->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="w-12 h-12 rounded-2xl {{ $ann->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center shadow-sm hover:scale-110 transition-all" title="Toggle Visibility">
                                    <i class="fas {{ $ann->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                </button>
                            </form>

                            {{-- Edit --}}
                            <a href="{{ route('audit.announcement.edit', $ann->id) }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-blue-600 border border-slate-100 shadow-sm hover:bg-blue-600 hover:text-white transition-all">
                                <i class="fas fa-pen-nib text-xs"></i>
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('audit.announcement.destroy', $ann->id) }}" method="POST" onsubmit="return confirm('Tarik kembali instruksi resmi ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-red-500 border border-slate-100 shadow-sm hover:bg-red-500 hover:text-white transition-all">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="py-20 text-center">
                    <i class="fas fa-bullhorn text-5xl text-slate-100 mb-4"></i>
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Belum ada kebijakan resmi yang diterbitkan.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
