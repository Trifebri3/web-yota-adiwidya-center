@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-5xl mx-auto">
        <div class="mb-12">
            <h1 class="text-4xl font-black text-[#064e3b] uppercase italic tracking-tighter mb-2">Audit <span class="text-slate-300">Trails.</span></h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tracing every single action in the system</p>
        </div>

        <div class="space-y-4">
            @foreach($logs as $log)
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center
                        @if($log->description == 'deleted') bg-red-50 text-red-500 @elseif($log->description == 'created') bg-emerald-50 text-emerald-500 @else bg-blue-50 text-blue-500 @endif">
                        <i class="fas @if($log->description == 'deleted') fa-trash @elseif($log->description == 'created') fa-plus @else fa-edit @endif"></i>
                    </div>

                    <div>
                        <p class="text-[11px] font-black text-[#064e3b] uppercase leading-none mb-1">
                            {{ $log->causer->name ?? 'System' }}
                            <span class="text-slate-300 font-bold italic mx-1">has</span>
                            {{ $log->description }}
                            <span class="text-slate-400 italic">data on</span>
                            {{ class_basename($log->subject_type) }}
                        </p>
                        <p class="text-[9px] font-bold text-slate-300 uppercase italic">
                            {{ $log->created_at->format('d M Y | H:i:s') }} • IP: {{ $log->properties['ip'] ?? 'N/A' }}
                        </p>
                    </div>
                </div>

                <div class="text-right">
                    <span class="text-[8px] font-black text-slate-300 uppercase tracking-widest block mb-1 italic">Event ID</span>
                    <span class="text-[10px] font-black text-[#064e3b]">#{{ $log->id }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
