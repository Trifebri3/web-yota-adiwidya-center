<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="logo-box">Y</div>
        <div class="brand-info">
            <h1 class="brand-name">YOTA<span>.</span></h1>
            <p class="brand-tagline">Management System</p>
        </div>
    </div>

    <nav class="sidebar-menu">
        <small class="menu-label">Main Menu</small>
        <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            </span> Dashboard
        </a>

        <a href="{{ route('omc.quick_publish.index') }}" class="menu-item {{ request()->routeIs('omc.quick_publish.*') ? 'active' : '' }}" style="background: rgba(190, 242, 100, 0.15); color: #064e3b; font-weight: 800;">
            <span class="icon" style="color: #16a34a;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"></path></svg>
            </span> Smart Quick Publish
        </a>

        <small class="menu-label mt-4">Smart Content CMS</small>
        <a href="{{ route('omc.index') }}" class="menu-item {{ request()->routeIs('omc.publications.*') || request()->routeIs('omc.index') ? 'active' : '' }}">
            <span class="icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            </span> Berita & Publikasi
        </a>
        <a href="{{ route('omc.programs.index') }}" class="menu-item {{ request()->routeIs('omc.programs.*') ? 'active' : '' }}">
            <span class="icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
            </span> Program 6 Pilar
        </a>
        <a href="{{ route('omc.docs.index') }}" class="menu-item {{ request()->routeIs('omc.docs.*') ? 'active' : '' }}">
            <span class="icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            </span> Buku & Kebijakan
        </a>
        <a href="{{ route('omc.scientific.index') }}" class="menu-item {{ request()->routeIs('omc.scientific.*') ? 'active' : '' }}">
            <span class="icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
            </span> Riset Ilmiah
        </a>
        <a href="{{ route('omc.impact.index') }}" class="menu-item {{ request()->routeIs('omc.impact.*') ? 'active' : '' }}">
            <span class="icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
            </span> Laporan Dampak
        </a>
        <a href="{{ route('omc.hero-slides.index') }}" class="menu-item {{ request()->routeIs('omc.hero-slides.*') ? 'active' : '' }}">
            <span class="icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
            </span> Hero Slider Beranda
        </a>

        <small class="menu-label mt-4">Organisasi & SDM</small>
        <a href="{{ route('admin.divisions.index') }}" class="menu-item {{ request()->routeIs('admin.divisions.*') ? 'active' : '' }}">
            <span class="icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </span> Kelola Divisi
        </a>
        <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <span class="icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </span> Kelola Pengurus
        </a>

        <small class="menu-label mt-4">Settings</small>
        <a href="{{ route('profile.complete') }}"
           class="nav-link {{ request()->routeIs('profile.complete') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </span>
            Pengaturan Profil
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <span>Keluar dari Sistem</span>
            </button>
        </form>
    </div>
</aside>

<style>
    :root {
        --lemon: #D9E021;
        --dark: #222222;
        --gray: #636E72;
        --light: #F9F9F9;
        --radius: 12px;
    }

    .sidebar {
        width: 260px;
        height: 100vh;
        background: #fff;
        border-right: 1px solid #F0F0F0;
        display: flex;
        flex-direction: column;
        position: sticky;
        top: 0;
    }

    /* Brand Style */
    .sidebar-brand {
        padding: 32px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .logo-box {
        width: 36px;
        height: 36px;
        background: var(--lemon);
        color: var(--dark);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-weight: 800;
        font-size: 1.2rem;
    }

    .brand-name {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--dark);
        letter-spacing: -0.5px;
        line-height: 1;
    }

    .brand-name span { color: var(--lemon); }

    .brand-tagline {
        font-size: 0.65rem;
        color: #A0A0A0;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* Menu Style */
    .sidebar-menu {
        flex: 1;
        padding: 0 16px;
    }

    .menu-label {
        display: block;
        font-size: 0.65rem;
        font-weight: 800;
        color: #CCC;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 12px 12px 8px;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        text-decoration: none;
        color: var(--gray);
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: var(--radius);
        transition: 0.2s ease;
        margin-bottom: 4px;
    }

    .menu-item .icon { font-size: 1.1rem; opacity: 0.7; }

    .menu-item:hover {
        background: var(--light);
        color: var(--dark);
    }

    .menu-item.active {
        background: var(--lemon);
        color: var(--dark);
        box-shadow: 0 4px 12px rgba(217, 224, 33, 0.25);
    }

    /* Footer Style */
    .sidebar-footer {
        padding: 20px 16px;
        border-top: 1px solid #F9F9F9;
    }

    .logout-btn {
        width: 100%;
        padding: 12px;
        border: 1.5px solid #EEE;
        background: transparent;
        border-radius: var(--radius);
        color: var(--gray);
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        transition: 0.3s;
    }

    .logout-btn:hover {
        background: #FF4757;
        border-color: #FF4757;
        color: #FFF;
        box-shadow: 0 4px 12px rgba(255, 71, 87, 0.2);
    }
</style>
