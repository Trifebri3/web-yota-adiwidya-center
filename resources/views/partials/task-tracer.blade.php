@php
    $user = Auth::user();

    // 1. Ambil Delegasi dari Direktur
    $delegations = \App\Models\Delegation::where('user_id', $user->id)
        ->where('status', '!=', 'completed')
        ->get()->map(function($item) {
            $item->source = 'Director';
            $item->trace_color = 'bg-red-500';
            $item->due = $item->deadline;
            return $item;
        });

    // 2. Ambil Tugas dari Kabid
    $kabidTasks = \App\Models\KabidTask::where('user_id', $user->id)
        ->where('status', '!=', 'completed')
        ->get()->map(function($item) {
            $item->source = 'Kabid';
            $item->trace_color = 'bg-lime-500';
            $item->due = $item->deadline;
            return $item;
        });

    // 3. Ambil Workspace Task
    $wsTasks = \App\Models\WorkspaceTask::where('assignee_id', $user->id)
        ->whereNotIn('status', ['acc', 'completed'])
        ->get()->map(function($item) {
            $item->source = 'Workspace';
            $item->trace_color = 'bg-blue-500';
            $item->due = $item->due_date;
            return $item;
        });

    // 4. Ambil Service Request (Kerjaan antar Divisi)
    $serviceRequests = \App\Models\ServiceRequest::where('handler_id', $user->id)
        ->where('status', 'in_progress')
        ->get()->map(function($item) {
            $item->source = 'Service';
            $item->trace_color = 'bg-orange-500';
            $item->due = $item->created_at->addDays(3); // Estimasi 3 hari jika tdk ada deadline
            return $item;
        });

    // GABUNGKAN & URUTKAN BERDASARKAN DEADLINE TERDEKAT
    $allTasks = collect()
        ->concat($delegations)
        ->concat($kabidTasks)
        ->concat($wsTasks)
        ->concat($serviceRequests)
        ->sortBy('due');
@endphp

<div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-2xl font-['Plus_Jakarta_Sans']" x-data="{ filter: 'all' }">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter">Mission <span class="text-slate-300">Tracer</span></h3>
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1">Urutan Berdasarkan Deadline Terdekat</p>
        </div>

        <div class="flex bg-slate-50 p-1 rounded-xl border border-slate-100">
            <button @click="filter = 'all'" :class="filter === 'all' ? 'bg-white shadow-sm text-[#064e3b]' : 'text-slate-400'" class="px-3 py-1.5 rounded-lg text-[8px] font-black uppercase transition-all">All</button>
            <button @click="filter = 'Director'" :class="filter === 'Director' ? 'bg-red-500 text-white shadow-sm' : 'text-slate-400'" class="px-3 py-1.5 rounded-lg text-[8px] font-black uppercase transition-all">Dir</button>
            <button @click="filter = 'Kabid'" :class="filter === 'Kabid' ? 'bg-lime-500 text-[#064e3b] shadow-sm' : 'text-slate-400'" class="px-3 py-1.5 rounded-lg text-[8px] font-black uppercase transition-all">Kabid</button>
        </div>
    </div>

    <div class="space-y-3 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
        @forelse($allTasks as $task)
            <div x-show="filter === 'all' || filter === '{{ $task->source }}'"
                 x-transition.fade
                 class="group relative bg-slate-50 hover:bg-white border border-transparent hover:border-slate-200 p-5 rounded-[2rem] transition-all flex items-center justify-between">

                <div class="flex items-center gap-5">
                    <div class="w-1.5 h-10 {{ $task->trace_color }} rounded-full shadow-sm"></div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[8px] font-black uppercase tracking-widest text-slate-300 italic">{{ $task->source }}</span>
                            <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                            <span class="text-[8px] font-black {{ $task->due && $task->due->isPast() ? 'text-red-500' : 'text-orange-500' }} uppercase">
                                <i class="far fa-clock mr-1"></i> {{ $task->due ? $task->due->diffForHumans() : 'No Deadline' }}
                            </span>
                        </div>
                        <h4 class="text-sm font-black text-[#064e3b] uppercase leading-tight group-hover:text-lime-600 transition-colors">
                            {{ Str::limit($task->title, 35) }}
                        </h4>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden md:block text-right">
                        <p class="text-[7px] font-black text-slate-300 uppercase tracking-widest mb-1">Status</p>
                        <p class="text-[9px] font-black text-[#064e3b] uppercase italic">{{ $task->status ?? 'Active' }}</p>
                    </div>
                    <a href="#" class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center text-[#064e3b] shadow-sm group-hover:bg-[#064e3b] group-hover:text-white transition-all">
                        <i class="fas fa-chevron-right text-[10px]"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center py-10">
                <p class="text-[10px] font-black text-slate-300 uppercase italic">Semua Misi Selesai. Good Job!</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f8fafc; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
</style>
