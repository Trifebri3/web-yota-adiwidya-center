@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] p-4 md:p-10">
    <div class="max-w-6xl mx-auto">

        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-5xl font-black text-[#1e1b4b] tracking-tighter uppercase italic leading-none">
                    Division <span class="text-indigo-500">Updates.</span>
                </h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mt-4">
                    Informasi Internal Khusus Divisi:
                    <span class="text-indigo-600">{{ Auth::user()->division->name ?? 'Umum' }}</span>
                </p>
            </div>

            <div class="bg-white px-6 py-4 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                    <i class="fas fa-bullhorn text-xl"></i>
                </div>
                <div>
                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Total Pengumuman</p>
                    <p class="text-xl font-black text-[#1e1b4b]">{{ $announcements->total() }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($announcements as $item)
                @php
                    $allColors = [
                        'urgent' => ['bg' => 'bg-red-600', 'text' => 'text-white'],
                        'high'   => ['bg' => 'bg-orange-500', 'text' => 'text-white'],
                        'medium' => ['bg' => 'bg-indigo-500', 'text' => 'text-white'],
                        'low'    => ['bg' => 'bg-slate-500', 'text' => 'text-white'],
                    ];

                    $priorityKey = strtolower($item->priority ?? 'low');
                    $colors = $allColors[$priorityKey] ?? $allColors['low'];
                @endphp

                <div class="bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 group relative flex flex-col">

                    <div class="h-2 {{ $colors['bg'] }}"></div>

                    <div class="p-8 flex-1">
                        <div class="flex justify-between items-start mb-6">
                            <span class="{{ $colors['bg'] }} {{ $colors['text'] }} px-4 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">
                                {{ $item->priority ?? 'NORMAL' }}
                            </span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                                {{ $item->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <h2 class="text-2xl font-black text-[#1e1b4b] uppercase italic leading-tight mb-4 group-hover:text-indigo-600 transition-colors">
                            {{ $item->title }}
                        </h2>

                        <div class="text-slate-600 text-sm leading-relaxed mb-6 line-clamp-3 font-medium">
                            {!! Str::limit(strip_tags($item->content), 150) !!}
                        </div>

                        <div class="flex items-center gap-4 pt-6 border-t border-dashed border-slate-100">
                            <div class="w-10 h-10 bg-indigo-50 rounded-full flex items-center justify-center font-black text-indigo-600 text-xs">
                                {{ substr($item->user->name ?? '??', 0, 2) }}
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase text-[#1e1b4b] leading-none">
                                    {{ $item->user->name ?? 'Kepala Bidang' }}
                                </p>
                                <p class="text-[9px] font-bold text-indigo-400 uppercase tracking-widest mt-1">
                                    Kepala Divisi {{ $item->division->name ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <button onclick="openKabidModal('{{ addslashes($item->title) }}', '{!! addslashes($item->content) !!}', '{{ $item->priority }}', '{{ $item->user->name }}')"
                            class="w-full py-4 bg-slate-50 border-t border-slate-100 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:bg-indigo-600 hover:text-white transition-all">
                        Lihat Instruksi Internal
                    </button>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-[3rem] border-4 border-dashed border-slate-100">
                    <i class="fas fa-folder-open text-4xl text-slate-200 mb-4"></i>
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.5em]">Belum ada instruksi dari Kabid</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $announcements->links() }}
        </div>
    </div>
</div>

<div id="kabidModal" class="fixed inset-0 z-[1000] hidden flex items-center justify-center p-4 bg-[#1e1b4b]/95 backdrop-blur-md">
    <div class="bg-white w-full max-w-2xl rounded-[3rem] p-10 max-h-[85vh] overflow-y-auto relative shadow-2xl">
        <div id="modalPriority" class="inline-block px-4 py-1 rounded-full text-[9px] font-black uppercase mb-4"></div>

        <h2 id="modalTitle" class="text-4xl font-black text-[#1e1b4b] uppercase italic leading-none mb-4"></h2>

        <div class="flex items-center gap-3 mb-8 pb-8 border-b border-slate-100">
            <div id="modalInitial" class="w-8 h-8 bg-indigo-50 rounded-full flex items-center justify-center font-black text-indigo-600 text-[10px]"></div>
            <div>
                <p id="modalAuthor" class="text-[10px] font-black uppercase text-[#1e1b4b] leading-none"></p>
                <p class="text-[8px] font-bold text-indigo-400 uppercase tracking-widest mt-1">Internal Division Authority</p>
            </div>
        </div>

        <div id="modalContent" class="prose prose-indigo max-w-none text-slate-600 font-medium leading-relaxed"></div>

        <button onclick="closeKabidModal()" class="mt-10 w-full py-4 rounded-2xl bg-slate-100 text-[10px] font-black uppercase tracking-widest text-indigo-600 hover:bg-red-500 hover:text-white transition-all">
            Tutup Informasi
        </button>
    </div>
</div>

<script>
function openKabidModal(title, content, priority, author) {
    const modal = document.getElementById('kabidModal');
    const priorityBadge = document.getElementById('modalPriority');

    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalContent').innerHTML = content;
    document.getElementById('modalAuthor').innerText = author;
    document.getElementById('modalInitial').innerText = author.substring(0, 2).toUpperCase();

    const colors = {
        'urgent': 'bg-red-600 text-white',
        'high': 'bg-orange-500 text-white',
        'medium': 'bg-indigo-500 text-white',
        'low': 'bg-slate-500 text-white'
    };

    const pKey = priority ? priority.toLowerCase() : 'low';
    priorityBadge.className = `inline-block px-4 py-1 rounded-full text-[9px] font-black uppercase mb-4 ${colors[pKey] || colors['low']}`;
    priorityBadge.innerText = pKey;

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeKabidModal() {
    document.getElementById('kabidModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>
@endsection
