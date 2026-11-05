<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>

<style>
    .executive-flex-container { display: flex; gap: 30px; margin-top: 20px; }
    .todo-list-side { flex: 1; background: #fff; border-radius: 30px; border: 1px solid #f1f5f9; padding: 25px; max-height: 600px; overflow-y: auto; }
    .calendar-side { flex: 2; background: #fff; border-radius: 30px; border: 1px solid #f1f5f9; padding: 25px; }

    /* To-Do Item Styling */
    .todo-item { display: flex; align-items: center; gap: 15px; padding: 15px; border-bottom: 1px solid #f8fafc; transition: 0.3s; }
    .todo-item:hover { background: #f8fafc; border-radius: 15px; }
    .todo-checkbox { width: 20px; height: 20px; accent-color: #BEF264; border-radius: 6px; cursor: pointer; }
    .todo-title { font-size: 13px; font-weight: 800; color: #0F172A; margin: 0; }
    .todo-meta { font-size: 9px; color: #94a3b8; font-weight: 700; text-transform: uppercase; }

    /* Calendar Styling */
    #calendar { font-family: 'Plus Jakarta Sans', sans-serif; height: 550px; }
    .fc-header-toolbar { margin-bottom: 20px !important; }
    .fc-button-primary { background-color: #0F172A !important; border: none !important; border-radius: 10px !important; font-size: 10px !important; text-transform: uppercase !important; font-weight: 800 !important; }
    .fc-event { border: none !important; border-radius: 6px !important; padding: 2px 5px !important; font-size: 10px !important; font-weight: 700 !important; }
</style>

<div class="executive-flex-container">

    <div class="todo-list-side">
        <h3 style="font-size: 14px; font-weight: 900; color: #0F172A; text-transform: uppercase; margin-bottom: 20px; display: flex; justify-content: space-between;">
            Action Items
            <span style="background: #ef4444; color: #fff; padding: 2px 8px; border-radius: 6px; font-size: 10px;">{{ $tasks->where('status', '!=', 'completed')->count() }}</span>
        </h3>

        @forelse($tasks->where('status', '!=', 'completed') as $t)
        <div class="todo-item">
            <form action="{{ route('direktur.task.approve', $t->id) }}" method="POST">
                @csrf @method('PATCH')
                <input type="checkbox" onchange="this.form.submit()" class="todo-checkbox" {{ $t->status == 'completed' ? 'checked' : '' }}>
            </form>
            <div style="flex: 1;">
                <p class="todo-title">{{ Str::limit($t->title, 35) }}</p>
                <span class="todo-meta">🎯 {{ $t->division->name }} | 📅 {{ $t->deadline->format('d M') }}</span>
            </div>
            <a href="{{ route('direktur.task.show', $t->id) }}" style="color: #cbd5e1;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 18l6-6-6-6"></path></svg></a>
        </div>
        @empty
        <div style="text-align: center; padding-top: 50px;">
            <p style="font-size: 11px; color: #94a3b8; font-weight: 700; text-transform: uppercase;">Semua Tugas Clear!</p>
        </div>
        @endforelse
    </div>

    <div class="calendar-side">
        <div id="calendar"></div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            events: [
                @foreach($tasks as $task)
                {
                    title: '{{ $task->title }}',
                    start: '{{ $task->deadline->format('Y-m-d') }}',
                    url: '{{ route('direktur.task.show', $task->id) }}',
                    backgroundColor: '{{ $task->status == 'completed' ? '#BEF264' : ($task->status == 'revision' ? '#ef4444' : '#0F172A') }}',
                    textColor: '{{ $task->status == 'completed' ? '#064E3B' : '#ffffff' }}'
                },
                @endforeach
            ],
            eventClick: function(info) {
                if (info.event.url) {
                    window.location.href = info.event.url;
                    return false;
                }
            }
        });
        calendar.render();
    });
</script>
