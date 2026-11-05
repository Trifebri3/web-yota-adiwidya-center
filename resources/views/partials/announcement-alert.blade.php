@php
    // Direct Model Access
    $announcement = \App\Models\Announcement::where('is_active', true)
        ->where(function($q) {
            $q->whereNull('division_id')
              ->orWhere('division_id', Auth::user()->division_id);
        })
        ->where(function($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        })
        ->latest()
        ->first();
@endphp

@if($announcement)
<div x-data="{
        show: false,
        minimized: false,
        id: 'announcement_{{ $announcement->id }}'
     }"
     x-init="
        if(localStorage.getItem(id) !== 'read') {
            setTimeout(() => { show = true }, 1000); // Muncul setelah 1 detik
        }
     "
     x-show="show"
     x-transition:enter="transition ease-out duration-500"
     x-transition:enter-start="opacity-0 translate-y-10"
     x-transition:enter-end="opacity-100 translate-y-0"
     class="fixed bottom-6 right-6 z-[9999] flex flex-col items-end gap-3 pointer-events-none">

    <div x-show="!minimized"
         class="bg-white w-[280px] rounded-[2rem] shadow-2xl border border-slate-100 overflow-hidden pointer-events-auto relative">

        <div class="h-1.5 w-full {{ $announcement->priority == 'high' ? 'bg-red-500' : 'bg-lime-400' }}"></div>

        <div class="p-5">
            <div class="flex justify-between items-start mb-2">
                <span class="text-[8px] font-black uppercase tracking-[0.2em] text-slate-400">Broadcast</span>
                <div class="flex gap-2">
                    <button @click="minimized = true" class="text-slate-300 hover:text-[#064e3b]"><i class="fas fa-minus text-[10px]"></i></button>
                    <button @click="show = false; localStorage.setItem(id, 'read')" class="text-slate-300 hover:text-red-500"><i class="fas fa-times text-[10px]"></i></button>
                </div>
            </div>

            <h4 class="text-xs font-black text-[#064e3b] uppercase italic leading-tight mb-2 truncate">
                {{ $announcement->title }}
            </h4>

            <p class="text-[10px] text-slate-500 font-medium leading-relaxed mb-4 line-clamp-2">
                {{ Str::limit(strip_tags($announcement->content), 60) }}
            </p>

            <a href="#" @click="localStorage.setItem(id, 'read')"
               class="block w-full text-center py-2 bg-slate-50 rounded-xl text-[9px] font-black text-[#064e3b] uppercase tracking-widest hover:bg-[#064e3b] hover:text-white transition-all">
                Buka Pengumuman
            </a>
        </div>
    </div>

    <button x-show="minimized"
            @click="minimized = false"
            class="pointer-events-auto w-12 h-12 bg-[#064e3b] rounded-2xl shadow-xl flex items-center justify-center text-lime-400 border-2 border-white group relative">
        <i class="fas fa-bullhorn text-sm"></i>
        <span class="absolute -top-1 -right-1 flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-lime-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-lime-500"></span>
        </span>
    </button>
</div>
@endif
