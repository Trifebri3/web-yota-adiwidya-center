@extends('kabid.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FAFBFC] p-4 md:p-10"
     x-data="{
        showModal: false,
        showDetail: false,
        selectedEvent: { id: '', title: '', type: '', location: '', description: '', start: '', end: '', color: '' }
     }">

    <div class="max-w-[1600px] mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="col-span-1 md:col-span-2">
                <h1 class="text-5xl font-black text-[#064e3b] tracking-tighter uppercase italic leading-none">
                    Division <span class="text-lime-500">Pulse.</span>
                </h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mt-3">Strategic Timeline & Operational Agenda</p>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-[9px] font-black text-slate-300 uppercase italic">Upcoming</p>
                    <p class="text-2xl font-black text-[#064e3b] italic">{{ $upcoming->count() }} Events</p>
                </div>
                <div class="w-12 h-12 bg-lime-50 rounded-2xl flex items-center justify-center text-lime-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>

            <button @click="showModal = true" class="bg-[#064e3b] text-white rounded-[2rem] p-6 hover:bg-lime-400 hover:text-[#064e3b] transition-all group shadow-xl shadow-lime-100">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-black uppercase italic tracking-widest">New Agenda</span>
                    <svg class="w-6 h-6 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                </div>
            </button>
        </div>

        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 lg:col-span-8">
                <div class="bg-white p-8 rounded-[3.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 min-h-[750px]">
                    <div id="calendar" class="font-sans"></div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-4 space-y-8">
                <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm">
                    <h3 class="text-[11px] font-black uppercase tracking-[0.3em] text-[#064e3b] mb-8 italic flex items-center gap-3">
                        <span class="w-2 h-6 bg-lime-400 rounded-full"></span>
                        Next Operations
                    </h3>

                    <div class="relative space-y-0">
                        @forelse($upcoming as $item)
                        <div class="relative pl-8 pb-8 group">
                            @if(!$loop->last)
                            <div class="absolute left-[11px] top-6 w-[2px] h-full bg-slate-50 group-hover:bg-lime-100 transition-colors"></div>
                            @endif
                            <div class="absolute left-0 top-1.5 w-6 h-6 bg-white border-4 rounded-full transition-all group-hover:scale-125 shadow-sm" style="border-color: {{ $item->color }}"></div>

                            <div class="flex flex-col">
                                <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">{{ $item->start_time->format('D, d M — H:i') }}</span>
                                <h4 class="text-sm font-black text-[#064e3b] uppercase italic leading-tight group-hover:text-lime-500 transition-colors cursor-pointer">{{ $item->title }}</h4>
                                <div class="flex items-center gap-3 mt-2">
                                    <span class="text-[8px] font-bold px-2 py-0.5 bg-slate-50 text-slate-400 rounded uppercase tracking-tighter">{{ $item->type }}</span>
                                    @if($item->location)
                                    <span class="text-[8px] font-bold text-slate-400 flex items-center gap-1">
                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        {{ Str::limit($item->location, 20) }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-10">
                            <p class="text-[10px] font-bold text-slate-300 uppercase italic">No schedules for now.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-[#064e3b] p-8 rounded-[3rem] text-white overflow-hidden relative">
                    <div class="relative z-10">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-lime-400 mb-6 italic">Member Presence</h4>
                        <p class="text-xs font-medium opacity-70 mb-8 leading-relaxed">Seluruh agenda ini akan otomatis tersinkronisasi ke dashboard staf Anda.</p>
                        <div class="flex -space-x-3">
                            @foreach(auth()->user()->division->members->take(5) as $member)
                            <div class="w-10 h-10 rounded-full border-4 border-[#064e3b] bg-white flex items-center justify-center text-[10px] font-black text-[#064e3b] uppercase">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                            @endforeach
                            <div class="w-10 h-10 rounded-full border-4 border-[#064e3b] bg-lime-400 flex items-center justify-center text-[8px] font-black text-[#064e3b]">
                                +{{ auth()->user()->division->members->count() }}
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-lime-400 rounded-full blur-3xl opacity-10"></div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="showDetail"
         class="fixed inset-0 z-[101] flex items-center justify-end p-4 bg-[#064e3b]/40 backdrop-blur-sm"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-full"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-full">

        <div @click.away="showDetail = false" class="bg-white h-full w-full max-w-md rounded-[3rem] shadow-2xl overflow-hidden flex flex-col">
            <div :style="`background-color: ${selectedEvent.color}`" class="h-32 p-8 flex justify-between items-start text-white">
                <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-lg text-[8px] font-black uppercase tracking-widest" x-text="selectedEvent.type"></span>
                <button @click="showDetail = false" class="hover:rotate-90 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="flex-1 p-10 -mt-10 bg-white rounded-t-[3rem] space-y-8 overflow-y-auto">
                <div>
                    <h2 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-tight" x-text="selectedEvent.title"></h2>
                    <div class="flex items-center gap-4 mt-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-[10px] font-bold uppercase tracking-widest" x-text="selectedEvent.start"></span>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg></div>
                        <div>
                            <p class="text-[8px] font-black uppercase text-slate-300 tracking-widest mb-1">Venue / Platform</p>
                            <p class="text-xs font-bold text-[#064e3b]" x-text="selectedEvent.location || 'No Location Set'"></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h7"></path></svg></div>
                        <div>
                            <p class="text-[8px] font-black uppercase text-slate-300 tracking-widest mb-1">Brief Description</p>
                            <p class="text-xs font-medium text-slate-600 leading-relaxed" x-text="selectedEvent.description || 'No description provided.'"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-8 border-t border-slate-50 flex gap-4">
                <form :action="`/kabid/agenda/${selectedEvent.id}`" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full bg-slate-100 text-slate-400 py-4 rounded-2xl text-[9px] font-black uppercase tracking-widest hover:bg-red-50 hover:text-red-500 transition-all">Delete</button>
                </form>
                <button class="flex-1 bg-[#064e3b] text-white py-4 rounded-2xl text-[9px] font-black uppercase tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all">Edit</button>
            </div>
        </div>
    </div>

    <div x-show="showModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#064e3b]/90 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="showModal = false" class="bg-white w-full max-w-xl rounded-[3.5rem] p-10 shadow-2xl animate-in zoom-in duration-300">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-black text-[#064e3b] uppercase italic tracking-tighter">New <span class="text-lime-500">Operation.</span></h2>
                <button @click="showModal = false" class="text-slate-300 hover:text-red-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('kabid.agenda.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="text" name="title" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-sm font-bold text-[#064e3b]" placeholder="Agenda Title" required>
                <div class="grid grid-cols-2 gap-4">
                    <select name="type" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-xs font-bold text-[#064e3b]">
                        <option value="meeting">Meeting (Urgent)</option>
                        <option value="event">Division Activity</option>
                        <option value="project_deadline">Project Deadline</option>
                    </select>
                    <input type="text" name="location" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-xs font-bold text-[#064e3b]" placeholder="Location">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <input type="datetime-local" name="start_time" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-[10px] font-bold" required>
                    <input type="datetime-local" name="end_time" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-[10px] font-bold" required>
                </div>
                <textarea name="description" rows="3" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-xs font-medium" placeholder="Notes..."></textarea>
                <button type="submit" class="w-full bg-[#064e3b] text-white py-5 rounded-[2rem] text-[11px] font-black uppercase tracking-[0.4em] hover:bg-lime-400 hover:text-[#064e3b] transition-all">Sync Timeline</button>
            </form>
        </div>
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            events: @json($events),
            eventDisplay: 'block',
            height: 700,
            themeSystem: 'standard',
            eventClick: function(info) {
                // Ambil data dari event FullCalendar
                const event = info.event;

                // Akses Alpine Data menggunakan __x.$data (untuk versi 3)
                // ATAU cara paling aman: dispatch event
                const alpineElement = document.querySelector('[x-data]');
                const data = Alpine.$data(alpineElement);

                data.selectedEvent = {
                    id: event.id,
                    title: event.title,
                    type: event.extendedProps.type,
                    location: event.extendedProps.location,
                    description: event.extendedProps.description,
                    color: event.backgroundColor,
                    start: event.start.toLocaleString('id-ID', {
                        weekday: 'long', day: 'numeric', month: 'long', hour: '2-digit', minute: '2-digit'
                    })
                };
                data.showDetail = true;
            }
        });
        calendar.render();
    });
</script>

<style>
    .fc { --fc-border-color: #f1f5f9; }
    .fc .fc-toolbar-title { font-weight: 900; text-transform: uppercase; font-style: italic; font-size: 1.5rem; color: #064e3b; }
    .fc .fc-button-primary { background: #f8fafc; border: none; color: #64748b; font-size: 10px; font-weight: 800; text-transform: uppercase; border-radius: 12px; }
    .fc .fc-button-active { background: #064e3b !important; color: #fff !important; }
    .fc-event { border: none !important; padding: 4px 8px !important; border-radius: 8px !important; font-size: 9px !important; font-weight: 800 !important; text-transform: uppercase; cursor: pointer; }
    [x-cloak] { display: none !important; }
</style>
@endsection
