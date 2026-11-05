@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="p-8 bg-[#FDFDFB] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-10">
        <div>
            <span class="text-[10px] font-black text-lime-500 uppercase tracking-[0.5em] block mb-2">Internal Schedule</span>
            <h1 class="text-5xl font-black text-[#064e3b] uppercase tracking-tighter leading-none">
                Divisi <span class="text-lime-500 italic font-serif">Agenda</span>
            </h1>
            <p class="text-slate-400 text-xs mt-2">Sinkronisasi jadwal internal Divisi {{ $divisionName }}.</p>
        </div>

        @if(in_array(Auth::user()->role->value, ['kabid', 'direktur', 'admin']))
        <button onclick="toggleModal('modal-agenda')" class="bg-[#064e3b] text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-lime-500 hover:text-[#064e3b] transition-all shadow-lg flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Agenda
        </button>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-[3rem] p-8 border border-slate-100 shadow-sm">
            <div id="calendar"></div>
        </div>

        <div class="space-y-6">
            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Mendatang</h3>
            @forelse($upcoming as $item)
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute left-0 top-0 w-2 h-full" style="background-color: {{ $item->color }}"></div>
                <div class="flex justify-between items-start mb-4">
                    <span class="text-[8px] font-black uppercase px-3 py-1 bg-slate-100 rounded-full text-slate-500">{{ $item->type }}</span>
                    <span class="text-[9px] font-bold text-slate-400">{{ $item->start_time->format('d M, H:i') }}</span>
                </div>
                <h4 class="text-sm font-black text-[#064e3b] uppercase mb-2">{{ $item->title }}</h4>
                <p class="text-[10px] text-slate-500 italic mb-4 line-clamp-2">{{ $item->description }}</p>
                <div class="flex items-center gap-2 text-[9px] font-bold text-slate-400 uppercase">
                    <i class="fas fa-map-marker-alt"></i> {{ $item->location ?? 'Lokasi Belum Diset' }}
                </div>
            </div>
            @empty
            <div class="p-10 text-center bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200">
                <p class="text-slate-400 text-xs italic">Belum ada agenda terdekat.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
<div id="modal-detail-agenda" class="fixed inset-0 z-[99] hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl p-10 relative overflow-hidden">
        <div id="detail-color-bar" class="absolute top-0 left-0 w-full h-3"></div>

        <div class="mb-8">
            <span id="detail-type" class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-400 block mb-2">Meeting</span>
            <h2 id="detail-title" class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none mb-4">Judul Agenda</h2>
            <div class="flex items-center gap-4 text-slate-400 font-bold text-[10px] uppercase">
                <div class="flex items-center gap-1"><i class="far fa-clock"></i> <span id="detail-time">10:00 - 12:00</span></div>
                <div class="flex items-center gap-1 text-[#064e3b]"><i class="fas fa-map-marker-alt"></i> <span id="detail-location">Ruang Rapat</span></div>
            </div>
        </div>

        <div class="bg-slate-50 p-6 rounded-2xl mb-8 border border-slate-100">
            <p id="detail-description" class="text-sm text-slate-600 font-medium leading-relaxed italic">Deskripsi agenda akan muncul di sini.</p>
        </div>

        <button onclick="toggleModal('modal-detail-agenda')" class="w-full py-4 bg-[#064e3b] text-white rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-black transition-all">Tutup Detail</button>
    </div>
</div>

@if(in_array(Auth::user()->role->value, ['kabid', 'direktur', 'admin']))
<div id="modal-agenda" class="fixed inset-0 z-[99] hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-xl rounded-[3rem] shadow-2xl p-10">
        <h2 class="text-2xl font-black text-[#064e3b] uppercase mb-8 italic">Jadwalkan <span class="text-lime-500 not-italic">Agenda Baru</span></h2>
        <form action="{{ route('divisiagenda.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-2">Nama Agenda</label>
                <input type="text" name="title" required class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:ring-2 focus:ring-lime-400">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-2">Tipe</label>
                    <select name="type" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-[#064e3b]">
                        <option value="meeting">Meeting</option>
                        <option value="event">Kegiatan</option>
                        <option value="project_deadline">Deadline</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-2">Lokasi</label>
                    <input type="text" name="location" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-[#064e3b]">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-2">Mulai</label>
                    <input type="datetime-local" name="start_time" required class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-2">Selesai</label>
                    <input type="datetime-local" name="end_time" required class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-2">Deskripsi Singkat</label>
                <textarea name="description" rows="3" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm"></textarea>
            </div>
            <div class="flex gap-4 pt-4">
                <button type="button" onclick="toggleModal('modal-agenda')" class="flex-1 font-black text-[10px] uppercase text-slate-400">Batal</button>
                <button type="submit" class="flex-[2] bg-[#064e3b] text-white py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-lg">Simpan Agenda</button>
            </div>
        </form>
    </div>
</div>
@endif
{{-- Scripts untuk FullCalendar --}}
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

<script>
function toggleModal(id) {
    const modal = document.getElementById(id);
    modal.classList.toggle('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'id', // Set bahasa Indonesia
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        events: @json($events),
        eventClick: function(info) {
            // Ambil data dari event yang diklik
            const props = info.event.extendedProps;
            const start = info.event.start.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            const end = info.event.end ? info.event.end.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) : '';

            // Masukkan data ke Modal Detail
            document.getElementById('detail-title').innerText = info.event.title;
            document.getElementById('detail-type').innerText = props.type;
            document.getElementById('detail-location').innerText = props.location || 'Lokasi Belum Diset';
            document.getElementById('detail-description').innerText = props.description || 'Tidak ada deskripsi.';
            document.getElementById('detail-time').innerText = start + (end ? ' - ' + end : '');
            document.getElementById('detail-color-bar').style.backgroundColor = info.event.backgroundColor;

            // Munculkan Modal
            toggleModal('modal-detail-agenda');
        }
    });
    calendar.render();
});
</script>
@endsection
