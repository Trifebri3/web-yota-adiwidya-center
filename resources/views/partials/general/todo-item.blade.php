<div style="background: #fff; padding: 15px 20px; border-radius: 18px; border: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; transition: 0.3s;">
    <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
        <form action="{{ route('general.todo.toggle', $todo->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0; display: flex;">
                <div style="width: 22px; height: 22px; border-radius: 7px; border: 2px solid {{ $todo->is_completed ? '#BEF264' : '#e2e8f0' }}; background: {{ $todo->is_completed ? '#BEF264' : 'transparent' }}; display: flex; align-items: center; justify-content: center; transition: 0.2s;">
                    @if($todo->is_completed)
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#002c16" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    @endif
                </div>
            </button>
        </form>

        <div style="display: flex; flex-direction: column;">
            <span style="font-size: 14px; font-weight: 700; color: #002c16; {{ $todo->is_completed ? 'text-decoration: line-through; opacity: 0.5;' : '' }}">
                {{ $todo->task }}
            </span>
            <div style="display: flex; align-items: center; gap: 8px; margin-top: 4px;">
                @php
                    $colors = ['top' => '#ef4444', 'medium' => '#f59e0b', 'chill' => '#BEF264'];
                    $bg = ['top' => '#fee2e2', 'medium' => '#fef3c7', 'chill' => '#f7fee7'];
                @endphp
                <span style="font-size: 8px; font-weight: 900; padding: 2px 8px; border-radius: 5px; background: {{ $bg[$todo->priority] }}; color: {{ $colors[$todo->priority] }}; text-transform: uppercase;">
                    {{ $todo->priority }}
                </span>
                <span style="font-size: 9px; color: #cbd5e1; font-weight: 600;">{{ $todo->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>

    <form action="{{ route('general.todo.destroy', $todo->id) }}" method="POST" onsubmit="return confirm('Hapus target ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" style="background: none; border: none; color: #cbd5e1; cursor: pointer; transition: 0.3s;" onmouseover="this.style.color='#ef4444'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
        </button>
    </form>
</div>
