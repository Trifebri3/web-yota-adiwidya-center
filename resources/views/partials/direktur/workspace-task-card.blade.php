<a href="{{ route('general.workspace.task.show', $task->id) }}" style="text-decoration: none; color: inherit;">
    <div style="background: #fff; border-radius: 20px; padding: 20px; margin-bottom: 15px; border: 1px solid #e2e8f0; transition: 0.3s; cursor: pointer; position: relative;"
         onmouseover="this.style.borderColor='#BEF264'; this.style.transform='translateY(-3px)'"
         onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)'">

        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
            <span style="font-size: 8px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">
                {{ $task->category }}
            </span>
            @if($task->status == 'submitted')
                <span style="font-size: 7px; background: #052c24; color: #BEF264; padding: 2px 6px; border-radius: 4px; font-weight: 800;">READY</span>
            @endif
        </div>

        <h4 style="font-size: 14px; font-weight: 800; color: #052c24; line-height: 1.4; margin: 0 0 15px 0;">
            {{ $task->title }}
        </h4>

        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 15px; border-top: 1px solid #f1f5f9;">
            <div style="display: flex; align-items: center; gap: 8px;">
                @if($task->assignee->avatar)
                    <img src="{{ asset('storage/' . $task->assignee->avatar) }}" style="width: 22px; height: 22px; border-radius: 6px; object-fit: cover;">
                @else
                    <div style="width: 22px; height: 22px; border-radius: 6px; background: #052c24; color: #BEF264; display: flex; align-items: center; justify-content: center; font-size: 9px; font-weight: 800;">
                        {{ substr($task->assignee->name, 0, 1) }}
                    </div>
                @endif
                <span style="font-size: 10px; font-weight: 700; color: #64748b;">{{ explode(' ', $task->assignee->name)[0] }}</span>
            </div>

            <div style="display: flex; align-items: center; gap: 4px; color: {{ $task->due_date->isPast() ? '#ef4444' : '#94a3b8' }};">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <span style="font-size: 9px; font-weight: 800;">{{ $task->due_date->format('d M') }}</span>
            </div>
        </div>
    </div>
</a>
