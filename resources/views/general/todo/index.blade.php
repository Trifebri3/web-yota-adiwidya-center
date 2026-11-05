@extends(Auth::user()->role->value . '.layouts.app')

@section('title', 'Daily Targets - YOTA')

@section('content')
<div class="todo-container" x-data="{ showHistory: false }">
    <div style="max-width: 900px; margin: 0 auto;">

        <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <h1 style="font-size: 24px; font-weight: 900; color: #002c16; letter-spacing: -1px;">TARGET <span style="color: #84cc16;">HARIAN</span></h1>
                <p style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Manage your daily focus & priority</p>
            </div>

            <button @click="showHistory = !showHistory"
                    style="background: #f1f5f9; color: #64748b; border: none; padding: 8px 15px; border-radius: 10px; font-size: 10px; font-weight: 800; cursor: pointer; transition: 0.3s;">
                <span x-text="showHistory ? 'LIHAT TARGET AKTIF' : 'LIHAT RIWAYAT SELESAI'"></span>
            </button>
        </div>

        <form action="{{ route('general.todo.store') }}" method="POST"
              style="background: #fff; padding: 10px; border-radius: 20px; border: 1px solid #f1f5f9; display: flex; gap: 10px; margin-bottom: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.02);">
            @csrf
            <input type="text" name="task" placeholder="Apa fokus utama kamu hari ini?"
                   style="flex: 1; border: none; padding: 10px 15px; font-size: 14px; font-weight: 600; outline: none; color: #002c16;" required>

            <select name="priority" style="background: #f8fafc; border: none; border-radius: 12px; padding: 0 15px; font-size: 11px; font-weight: 800; color: #64748b; outline: none; cursor: pointer;">
                <option value="chill">CHILL</option>
                <option value="medium">MEDIUM</option>
                <option value="top">TOP PRIORITY</option>
            </select>

            <button type="submit" style="background: #002c16; color: #BEF264; border: none; padding: 10px 20px; border-radius: 12px; font-size: 11px; font-weight: 900; cursor: pointer;">
                TAMBAH
            </button>
        </form>

        <div class="task-list" x-show="!showHistory" x-transition>
            @forelse($todos->where('is_completed', false) as $todo)
                @include('partials.general.todo-item', ['todo' => $todo])
            @empty
                <div style="text-align: center; padding: 50px; background: #fff; border-radius: 30px; border: 2px dashed #f1f5f9;">
                    <p style="font-size: 12px; font-weight: 700; color: #94a3b8;">Belum ada target aktif. Santai sejenak atau buat target baru!</p>
                </div>
            @endforelse
        </div>

        <div class="history-list" x-show="showHistory" x-transition style="display: none;">
            <div style="margin-bottom: 20px; padding-left: 15px; border-left: 3px solid #BEF264;">
                <h3 style="font-size: 12px; font-weight: 900; color: #002c16;">RIWAYAT SELESAI ({{ now()->format('F Y') }})</h3>
            </div>

            @forelse($todos->where('is_completed', true) as $todo)
                <div style="opacity: 0.6; filter: grayscale(1);">
                    @include('partials.general.todo-item', ['todo' => $todo])
                </div>
            @empty
                <p style="text-align: center; font-size: 11px; color: #94a3b8;">Belum ada riwayat tugas selesai bulan ini.</p>
            @endforelse
        </div>

    </div>
</div>
@endsection
