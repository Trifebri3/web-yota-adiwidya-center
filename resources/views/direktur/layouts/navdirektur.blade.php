<aside class="admin-sidebar">
    <div class="sidebar-header">
        <div class="brand-wrapper">
            <div class="brand-logo-container">
                <span class="brand-logo">Y</span>
                <div class="executive-badge">DIR</div>
            </div>
            <div class="brand-info">
                <span class="brand-text">YOTA<span>.</span></span>
                <p class="brand-sub">EXECUTIVE WORKSPACE</p>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="menu-group">STRATEGI & PENGAWASAN</div>


<div class="mode-toggle-wrapper" style="display: flex; align-items: center; gap: 10px; padding: 5px 15px;">
    @php $isDirektur = session('header_mode', 'direktur') === 'direktur'; @endphp

    <span style="font-size: 9px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
        View Mode:
    </span>

    <a href="{{ route('direktur.header.switch', $isDirektur ? 'umum' : 'direktur') }}"
       style="text-decoration: none; display: flex; align-items: center; gap: 6px; background: {{ $isDirektur ? '#0F172A' : '#BEF264' }}; color: {{ $isDirektur ? '#BEF264' : '#0F172A' }}; padding: 6px 12px; border-radius: 100px; font-size: 9px; font-weight: 900; border: 1px solid rgba(0,0,0,0.05); transition: 0.3s;">

        @if($isDirektur)
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
            SWITCH TO COMMON
        @else
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            BACK TO AUTHORITY
        @endif
    </a>
</div>
        <a href="{{ route('direktur.dashboard') }}" class="nav-link active">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"></path><path d="m19 9-5 5-4-4-3 3"></path></svg>
            </span>
            Monitoring Dashboard
        </a>

        <a href="{{ route('direktur.timeline.index') }}" class="nav-link">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"></path><path d="M16 2v4"></path><path d="M3 10h18"></path><rect x="3" y="4" width="18" height="18" rx="2"></rect></svg>
            </span>
            Timeline Umum Besar
        </a>

        <a href="{{ route('direktur.task.index') }}" class="nav-link">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 11 3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
            </span>
            Manajemen Tugas
        </a>

        <div class="menu-group">MANAJEMEN OPERASIONAL</div>

        <a href="{{ route('direktur.agenda.index') }}" class="nav-link">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </span>
            Agenda Direksi
        </a>

        <a href="{{ route('direktur.delegation.index') }}" class="nav-link">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 16 3-8 3 8c-.87.06-1.92.1-3 .1s-2.13-.04-3-.1Z"></path><path d="m2 16 3-8 3 8c-.87.06-1.92.1-3 .1s-2.13-.04-3-.1Z"></path><path d="M7 21h10"></path><path d="M12 3v18"></path><path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2"></path></svg>
            </span>
            Delegasi Wewenang
        </a>

        <a href="{{ route('direktur.announcement.index') }}" class="nav-link">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a3 3 0 0 0-3-3H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a3 3 0 0 0 3-3V8Z"></path><path d="M10 8v8"></path><path d="M18 8h2a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-2"></path></svg>
            </span>
            Pengumuman Pusat
        </a>

        <div class="menu-group">PERSONAL & EKSEKUSI</div>

        <a href="{{ route('direktur.laporan.index') }}" class="nav-link">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
            </span>
            LAPORAN
        </a>


        <a href="{{ route('direktur.evaluation.index') }}" class="nav-link">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
            </span>
            Catatan & Evaluasi
        </a>

        <div class="menu-group">PERIZINAN & WORKSPACE</div>

        <a href="{{ route('direktur.proposal.index') }}" class="nav-link">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="9" y1="15" x2="15" y2="15"></line></svg>
            </span>
            Permohonan & Pengajuan
        </a>

        <a href="{{ route('direktur.workspace.index') }}" class="nav-link">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3"></path><rect x="2" y="7" width="20" height="14" rx="2"></rect><path d="M9 17h6"></path><path d="M12 12v5"></path></svg>
            </span>
            Management Workspace
        </a>

                <a href="{{ route('dir.monitoring') }}" class="nav-link">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3"></path><rect x="2" y="7" width="20" height="14" rx="2"></rect><path d="M9 17h6"></path><path d="M12 12v5"></path></svg>
            </span>
            Monitoring
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn-executive">
                <span class="btn-content">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span class="text">TERMINATE SESSION</span>
                </span>
            </button>
        </form>
    </div>
</aside>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --dir-dark: #0F172A; /* Slate Gelap untuk kesan Premium/Formal */
        --dir-accent: #BEF264; /* Lemon Glow tetap sebagai identitas */
        --dir-silver: #F1F5F9;
        --dir-text: #64748B;
    }

    .admin-sidebar {
        width: 300px;
        height: 100vh;
        background-color: var(--dir-dark);
        font-family: 'Plus Jakarta Sans', sans-serif;
        display: flex;
        flex-direction: column;
        position: sticky;
        top: 0;
        z-index: 1100;
        color: var(--dir-silver);
    }

    /* Brand Header */
    .sidebar-header { padding: 40px 25px; border-bottom: 1px solid rgba(255,255,255,0.05); }
    .brand-wrapper { display: flex; align-items: center; gap: 15px; }
    .brand-logo-container { position: relative; }
    .brand-logo {
        background-color: var(--dir-accent);
        color: var(--dir-dark);
        width: 45px; height: 45px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px; font-weight: 800; font-size: 1.5rem;
    }
    .executive-badge {
        position: absolute; bottom: -8px; right: -8px;
        background: #fff; color: var(--dir-dark);
        font-size: 0.5rem; font-weight: 900;
        padding: 2px 5px; border-radius: 4px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }
    .brand-text { font-size: 1.5rem; font-weight: 800; letter-spacing: -1px; line-height: 1; }
    .brand-text span { color: var(--dir-accent); }
    .brand-sub { font-size: 0.65rem; color: var(--dir-accent); opacity: 0.7; font-weight: 800; margin-top: 5px; }

    /* Navigation */
    .sidebar-nav { flex: 1; padding: 20px 15px; overflow-y: auto; }
    .menu-group { font-size: 0.6rem; font-weight: 800; color: rgba(255,255,255,0.2); letter-spacing: 2px; margin: 30px 0 15px 15px; }

    .nav-link {
        display: flex; align-items: center; gap: 15px; padding: 14px 18px;
        text-decoration: none; color: rgba(255,255,255,0.5);
        font-size: 0.85rem; font-weight: 600; border-radius: 14px;
        transition: all 0.3s ease; margin-bottom: 5px;
    }
    .nav-icon { color: rgba(255,255,255,0.2); transition: color 0.3s; }

    .nav-link:hover { background: rgba(255,255,255,0.03); color: #fff; }
    .nav-link:hover .nav-icon { color: var(--dir-accent); }

    .nav-link.active {
        background: linear-gradient(135deg, rgba(190, 242, 100, 0.1), rgba(190, 242, 100, 0.05));
        color: var(--dir-accent);
        border: 1px solid rgba(190, 242, 100, 0.2);
    }
    .nav-link.active .nav-icon { color: var(--dir-accent); }

    /* Footer & Logout */
    .sidebar-footer { padding: 30px 20px; border-top: 1px solid rgba(255,255,255,0.05); }
    .logout-btn-executive {
        width: 100%; padding: 16px;
        border: 1px solid rgba(239, 68, 68, 0.2);
        background-color: rgba(239, 68, 68, 0.05);
        border-radius: 14px; cursor: pointer; transition: all 0.3s ease;
    }
    .btn-content { display: flex; align-items: center; justify-content: center; gap: 12px; color: #ef4444; }
    .logout-btn-executive .text { font-size: 0.75rem; font-weight: 900; letter-spacing: 1px; }
    .logout-btn-executive:hover { background-color: #ef4444; border-color: #ef4444; }
    .logout-btn-executive:hover .btn-content { color: #fff; }

    /* Custom Scrollbar */
    .sidebar-nav::-webkit-scrollbar { width: 4px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.05); border-radius: 10px; }
</style>
