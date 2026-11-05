<header class="pembina-header">
    @php
        $activeMode = session('header_mode', 'pembina');
    @endphp

    <aside class="pembina-sidebar">
        <div class="pembina-brand">
            <div class="pembina-logo-box">
                <span class="pembina-letter">Y</span>
                <div class="pembina-badge">BOARD</div>
            </div>
            <div class="pembina-title">
                <span class="pembina-main-text">YOTA<span>.</span></span>
                <p class="pembina-sub-text">BOARD OF TRUSTEES</p>
            </div>
        </div>

        <nav class="pembina-nav">


<div class="pembina-group">Core Panel</div>
            <a href="{{ url('/dashboard') }}" class="pembina-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-grip"></i>
                <span>Dashboard Utama</span>
            </a>

            <div class="pembina-group">Pemantauan Tertinggi</div>
            <a href="{{ route('audit.index') }}" class="pembina-link {{ request()->routeIs('audit.index') ? 'active' : '' }}">
                <i class="fas fa-shield-halved"></i>
                <span>High-Level Monitoring</span>
            </a>

            <div class="pembina-group">Audit Kinerja</div>
            <a href="{{ route('audit.performance.index') }}" class="pembina-link {{ request()->routeIs('audit.performance.*') ? 'active' : '' }}">
                <i class="fas fa-file-signature"></i>
                <span>Raport & Kedisiplinan</span>
            </a>

            <div class="pembina-group">Kebijakan & Strategi</div>
            <a href="{{ route('audit.resources.index') }}" class="pembina-link {{ request()->routeIs('audit.resources.index') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i>
                <span>TIMSOKS Monitoring</span>
            </a>
            <a href="{{ route('audit.impact.index') }}" class="pembina-link {{ request()->routeIs('audit.impact.index') ? 'active' : '' }}">
                <i class="fas fa-heart-pulse"></i>
                <span>Vitals Program Kerja</span>
            </a>

            <div class="pembina-group">Workspace Utama</div>
            <a href="{{ route('general.todo.index') }}" class="pembina-link {{ request()->routeIs('general.todo.*') ? 'active' : '' }}">
                <i class="fas fa-list-check"></i>
                <span>My To Do List</span>
            </a>
            <a href="{{ route('gen-posts.index') }}" class="pembina-link {{ request()->routeIs('gen-posts.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i>
                <span>Publikasi</span>
            </a>
            <a href="{{ route('general.workspace.index') }}" class="pembina-link {{ request()->routeIs('general.workspace.*') ? 'active' : '' }}">
                <i class="fas fa-laptop-code"></i>
                <span>Workspace</span>
            </a>
            <a href="{{ route('general.archive.index') }}" class="pembina-link {{ request()->routeIs('general.archive.*') ? 'active' : '' }}">
                <i class="fas fa-box-archive"></i>
                <span>Catatan Arsip</span>
            </a>

            <div class="pembina-group">Otoritas & SDM</div>
            <a href="{{ route('audit.admin.index') }}" class="pembina-link {{ request()->routeIs('audit.admin.*') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i>
                <span>Manajemen SDM</span>
            </a>
            <a href="{{ route('audit.announcement.index') }}" class="pembina-link {{ request()->routeIs('audit.announcement.*') ? 'active' : '' }}">
                <i class="fas fa-bullhorn"></i>
                <span>Pengumuman Pusat</span>
            </a>
            <a href="{{ route('profile.complete') }}" class="pembina-link {{ request()->routeIs('profile.complete') ? 'active' : '' }}">
                <i class="fas fa-user-gear"></i>
                <span>Pengaturan Profil</span>
            </a>
        </nav>

        <div class="pembina-sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="pembina-exit-btn">
                    <i class="fas fa-power-off"></i>
                    <span>TERMINATE SESSION</span>
                </button>
            </form>
        </div>
    </aside>
</header>
<style>
    /* --- CSS MANDIRI - PEMBINA EXECUTIVE UI --- */

    .pembina-sidebar {
        width: 280px;
        height: 100vh;
        background: #04241d; /* Deep Dark Green */
        position: fixed;
        left: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 25px rgba(0,0,0,0.3);
        border-right: 1px solid rgba(245, 158, 11, 0.15);
        z-index: 9999;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #fff;
    }

    /* Brand Styling */
    .pembina-brand {
        padding: 30px 25px;
        display: flex;
        align-items: center;
        gap: 15px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .pembina-logo-box {
        position: relative;
        width: 45px;
        height: 45px;
        background: #F59E0B; /* Gold Amber */
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .pembina-letter {
        color: #fff;
        font-weight: 800;
        font-size: 22px;
    }

    .pembina-badge {
        position: absolute;
        bottom: -8px;
        background: #000;
        color: #F59E0B;
        font-size: 7px;
        font-weight: 900;
        padding: 2px 6px;
        border-radius: 4px;
        letter-spacing: 1px;
        border: 1px solid #F59E0B;
        white-space: nowrap;
    }

    .pembina-main-text {
        display: block;
        font-weight: 800;
        font-size: 18px;
        letter-spacing: 1px;
    }

    .pembina-main-text span { color: #F59E0B; }

    .pembina-sub-text {
        margin: 0;
        font-size: 9px;
        color: rgba(255,255,255,0.4);
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    /* Navigation Scroll Area */
    .pembina-nav {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: rgba(245, 158, 11, 0.2) transparent;
    }

    .pembina-nav::-webkit-scrollbar { width: 4px; }
    .pembina-nav::-webkit-scrollbar-thumb { background: rgba(245, 158, 11, 0.2); border-radius: 10px; }

    /* Menu Grouping */
    .pembina-group {
        font-size: 10px;
        font-weight: 800;
        color: #F59E0B;
        opacity: 0.6;
        letter-spacing: 2px;
        padding: 20px 15px 10px;
        text-transform: uppercase;
    }

    /* Links */
    .pembina-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        color: rgba(255,255,255,0.6);
        text-decoration: none !important;
        font-size: 13px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.2s ease;
        margin-bottom: 2px;
    }

    .pembina-link i {
        width: 20px;
        font-size: 16px;
        text-align: center;
        transition: 0.3s;
    }

    .pembina-link:hover {
        background: rgba(255,255,255,0.05);
        color: #fff;
        padding-left: 20px;
    }

    .pembina-link.active {
        background: linear-gradient(90deg, rgba(245,158,11,0.15) 0%, transparent 100%);
        color: #F59E0B;
        border-left: 3px solid #F59E0B;
        border-radius: 0 10px 10px 0;
    }

    .pembina-link.active i { color: #F59E0B; }

    /* Sidebar Footer */
    .pembina-sidebar-footer {
        padding: 20px;
        border-top: 1px solid rgba(255,255,255,0.05);
        background: rgba(0,0,0,0.2);
    }

    .pembina-exit-btn {
        width: 100%;
        background: #7f1d1d;
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        transition: 0.3s;
        text-transform: uppercase;
    }

    .pembina-exit-btn:hover {
        background: #b91c1c;
        box-shadow: 0 5px 15px rgba(185, 28, 28, 0.4);
    }
</style>
