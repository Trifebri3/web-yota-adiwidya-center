@extends('direktur.layouts.app')


@section('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
<style>
    .fc-event { cursor: pointer; padding: 2px 5px; }
    .fc-toolbar-title { font-size: 1.25rem !important; font-weight: bold; text-transform: capitalize; }
</style>
@endsection

@section('content')
<div class="p-6">
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kalender Aktivitas Perusahaan</h2>
            <p class="text-sm text-gray-600">Monitoring jadwal rapat, event, dan deadline seluruh divisi.</p>
        </div>

        <form action="{{ route('dir.monitoring.agenda') }}" method="GET" class="flex items-center gap-2">
            <select name="division_id" onchange="this.form.submit()" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                <option value="">Semua Divisi</option>
                @foreach(\App\Models\Division::all() as $div)
                    <option value="{{ $div->id }}" {{ request('division_id') == $div->id ? 'selected' : '' }}>
                        {{ $div->name }}
                    </option>
                @endforeach
            </select>
            @if(request('division_id'))
                <a href="{{ route('dir.monitoring.agenda') }}" class="text-xs text-red-600 hover:underline">Reset</a>
            @endif
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="lg:col-span-1 space-y-4">
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <h3 class="font-bold text-gray-700 mb-3 border-b pb-2 text-sm uppercase">Keterangan Tipe</h3>
                <div class="space-y-2">
                    <div class="flex items-center text-sm">
                        <span class="w-3 h-3 rounded-full bg-[#ef4444] mr-2"></span> Rapat (Meeting)
                    </div>
                    <div class="flex items-center text-sm">
                        <span class="w-3 h-3 rounded-full bg-[#10b981] mr-2"></span> Kegiatan (Event)
                    </div>
                    <div class="flex items-center text-sm">
                        <span class="w-3 h-3 rounded-full bg-[#f59e0b] mr-2"></span> Deadline Proyek
                    </div>
                    <div class="flex items-center text-sm">
                        <span class="w-3 h-3 rounded-full bg-[#64748b] mr-2"></span> Lainnya
                    </div>
                </div>
            </div>

            <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                <h4 class="text-indigo-800 font-bold text-xs uppercase mb-2">Tips</h4>
                <p class="text-xs text-indigo-700 leading-relaxed">Klik pada salah satu agenda di kalender untuk melihat detail lokasi dan deskripsi lengkap.</p>
            </div>
        </div>

        <div class="lg:col-span-3">
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900" id="modalTitle">Detail Agenda</h3>
                <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Divisi Pelaksana</label>
                    <p id="modalDivision" class="text-sm font-bold text-indigo-600"></p>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase">Mulai</label>
                        <p id="modalStart" class="text-sm text-gray-800"></p>
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase">Selesai</label>
                        <p id="modalEnd" class="text-sm text-gray-800"></p>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Lokasi</label>
                    <p id="modalLocation" class="text-sm text-gray-800"></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase">Deskripsi</label>
                    <p id="modalDescription" class="text-sm text-gray-600 italic"></p>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeModal()" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:ml-3 sm:w-auto sm:text-sm">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listMonth'
            },
            locale: 'id',
            events: @json($events),
            eventClick: function(info) {
                // Tampilkan Detail di Modal
                document.getElementById('modalTitle').innerText = info.event.title;
                document.getElementById('modalDivision').innerText = info.event.extendedProps.division;
                document.getElementById('modalLocation').innerText = info.event.extendedProps.location || 'Tidak ditentukan';
                document.getElementById('modalDescription').innerText = info.event.extendedProps.description || '-';
                document.getElementById('modalStart').innerText = info.event.start.toLocaleString('id-ID');
                document.getElementById('modalEnd').innerText = info.event.end ? info.event.end.toLocaleString('id-ID') : '-';

                document.getElementById('detailModal').classList.remove('hidden');
            }
        });
        calendar.render();
    });

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>
@endsection
