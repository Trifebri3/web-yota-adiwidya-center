@extends('direktur.layouts.app')

@section('title', 'Manajemen Pengumuman Pusat')

@section('content')
<style>
    .ann-container { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFB; min-height: 100vh; padding: 40px; }
    .ann-card { background: #fff; border-radius: 30px; border: 1px solid #f1f5f9; padding: 25px; transition: all 0.3s ease; position: relative; overflow: hidden; }
    .ann-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.05); }

    /* Priority Indicators */
    .priority-urgent { border-left: 6px solid #ef4444; }
    .priority-high { border-left: 6px solid #f59e0b; }
    .priority-medium { border-left: 6px solid #3b82f6; }
    .priority-low { border-left: 6px solid #94a3b8; }

    .badge-pill { padding: 4px 12px; border-radius: 100px; font-size: 9px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; }
    .bg-dark-yota { background: #0F172A; color: #BEF264; }
</style>

<div class="ann-container">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 50px;">
        <div>
            <h1 style="font-size: 38px; font-weight: 900; color: #0F172A; text-transform: uppercase; letter-spacing: -2px; line-height: 0.9;">
                Pusat <span style="font-family: serif; font-style: italic; color: #84cc16; text-transform: none;">Informasi</span>
            </h1>
            <p style="font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 4px; margin-top: 12px;">Diseminasi Instruksi & Pengumuman Direksi</p>
        </div>

        <a href="{{ route('direktur.announcement.create') }}" style="background: #0F172A; color: #BEF264; padding: 18px 30px; border-radius: 20px; text-decoration: none; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 15px 30px rgba(15,23,42,0.15);">
            + Terbitkan Instruksi
        </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px;">
        <div style="background: #fff; padding: 20px; border-radius: 20px; border: 1px solid #f1f5f9;">
            <p style="font-size: 9px; font-weight: 900; color: #94a3b8; text-transform: uppercase;">Total Publikasi</p>
            <p style="font-size: 20px; font-weight: 900; color: #0F172A;">{{ $announcements->total() }}</p>
        </div>
        <div style="background: #fef2f2; padding: 20px; border-radius: 20px; border: 1px solid #fee2e2;">
            <p style="font-size: 9px; font-weight: 900; color: #ef4444; text-transform: uppercase;">Urgent/High</p>
            <p style="font-size: 20px; font-weight: 900; color: #ef4444;">{{ $announcements->whereIn('priority', ['urgent', 'high'])->count() }}</p>
        </div>
    </div>

    <div style="display: flex; flex-direction: column; gap: 20px;">
        @forelse($announcements as $ann)
        <div class="ann-card priority-{{ $ann->priority }}">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="flex: 1;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <span class="badge-pill bg-dark-yota">
                            {{ $ann->division ? $ann->division->name : '📢 Pengumuman Umum' }}
                        </span>
                        <span style="font-size: 10px; font-weight: 800; color: {{ $ann->is_active ? '#059669' : '#94a3b8' }}">
                            {{ $ann->is_active ? '● AKTIF' : '○ NON-AKTIF' }}
                        </span>
                    </div>

                    <h3 style="font-size: 18px; font-weight: 900; color: #0F172A; text-transform: uppercase; margin-bottom: 8px;">
                        {{ $ann->title }}
                    </h3>

                    <p style="font-size: 13px; color: #64748b; line-height: 1.6; max-width: 80%; margin-bottom: 15px;">
                        {{ Str::limit(strip_tags($ann->content), 150) }}
                    </p>

                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <span style="font-size: 10px; font-weight: 700; color: #94a3b8;">{{ $ann->created_at->format('d M Y') }}</span>
                        </div>
                        @if($ann->expires_at)
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            <span style="font-size: 10px; font-weight: 700; color: #ef4444;">Exp: {{ $ann->expires_at->format('d M Y') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div style="display: flex; gap: 10px;">
                    <form action="{{ route('direktur.announcement.toggle', $ann->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 10px; border-radius: 12px; cursor: pointer;" title="Toggle Aktif/Non-Aktif">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                    </form>

                    <a href="{{ route('direktur.announcement.edit', $ann->id) }}" style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 10px; border-radius: 12px; display: flex; align-items: center;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </a>

                    <form action="{{ route('direktur.announcement.destroy', $ann->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background: #fef2f2; border: 1px solid #fee2e2; padding: 10px; border-radius: 12px; cursor: pointer;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 100px; background: #fff; border-radius: 30px; border: 1px dashed #e2e8f0;">
            <p style="color: #94a3b8; font-weight: 700; text-transform: uppercase; font-size: 12px;">Belum ada pengumuman yang diterbitkan.</p>
        </div>
        @endforelse
    </div>

    <div style="margin-top: 40px;">
        {{ $announcements->links() }}
    </div>
</div>
@endsection
