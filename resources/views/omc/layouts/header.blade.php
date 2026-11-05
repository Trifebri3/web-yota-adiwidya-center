<aside class="admin-sidebar">
    <div class="sidebar-header">
        <div class="brand-wrapper">
            <div class="brand-logo-container">
                <span class="brand-logo">Y</span>
                <div class="verified-dot"></div>
            </div>
            <div class="brand-info">
                <span class="brand-text">YOTA<span>.</span></span>
                <p class="brand-sub">PIKP HUB 2026</p>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="menu-group">PUSAT KENDALI</div>

        <a href="{{ route('omc.dashboard') }}" class="nav-link {{ request()->routeIs('omc.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            </span>
            Dashboard Utama
        </a>

        <a href="{{ route('omc.quick_publish.index') }}" class="nav-link {{ request()->routeIs('omc.quick_publish.*') ? 'active' : '' }}" style="background: rgba(190, 242, 100, 0.15); color: #064e3b; font-weight: 900;">
            <span class="nav-icon" style="color: #16a34a;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
            </span>
            Smart Quick Publish
        </a>

        <div class="menu-group">HUB KOMUNIKASI (OMC)</div>

        <a href="{{ route('omc.programs.index') }}" class="nav-link {{ request()->routeIs('omc.programs.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
            </span>
            Program 6 Pilar
        </a>

        <a href="{{ route('omc.impact-areas.index') }}" class="nav-link {{ request()->routeIs('omc.impact-areas.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </span>
            Overview 6 Pilar (Impact)
        </a>

        <a href="{{ route('omc.hero-slides.index') }}" class="nav-link {{ request()->routeIs('omc.hero-slides.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
            </span>
            Hero Banner Slider
        </a>

        <a href="{{ route('omc.index') }}" class="nav-link {{ request()->routeIs('omc.publications.*') || request()->routeIs('omc.index') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a3 3 0 0 0-3-3H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a3 3 0 0 0 3-3V8Z"></path><path d="M10 8v8"></path><path d="M18 8h2a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-2"></path></svg>
            </span>
            Rilis Berita & Publikasi
        </a>

        <a href="{{ route('omc.docs.index') }}" class="nav-link {{ request()->routeIs('omc.docs.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            </span>
            Buku & Dokumen Resmi
        </a>

        <a href="{{ route('omc.scientific.index') }}" class="nav-link {{ request()->routeIs('omc.scientific.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
            </span>
            Riset & Ilmiah
        </a>

        <a href="{{ route('omc.impact.index') }}" class="nav-link {{ request()->routeIs('omc.impact.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
            </span>
            Publikasi Dampak
        </a>

        <a href="{{ route('omc.products.index') }}" class="nav-link {{ request()->routeIs('omc.products.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
            </span>
            Produk Sosial
        </a>

        <a href="{{ route('omc.partners.index') }}" class="nav-link {{ request()->routeIs('omc.partners.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </span>
            Partner & Sponsor
        </a>

        <a href="{{ route('omc.campaign.index') }}" class="nav-link {{ request()->routeIs('omc.campaign.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 8v8"></path><path d="M8 12h8"></path></svg>
            </span>
            Funding Kampanye
        </a>

        <a href="{{ route('omc.galleries.index') }}" class="nav-link {{ request()->routeIs('omc.galleries.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
            </span>
            Galeri & Media
        </a>

        <a href="{{ route('omc.reviews.index') }}" class="nav-link {{ request()->routeIs('omc.reviews.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
            </span>
            Review & Testimoni
        </a>

        <div class="menu-group">SISTEM TERVERIFIKASI</div>

        <a href="{{ route('admin.users.index') }}" class="nav-link">
            <span class="nav-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><polyline points="16 11 18 13 22 9"></polyline></svg>
            </span>
            Manajemen Verifikator
        </a>

        <a href="{{ route('profile.complete') }}"
   class="nav-link {{ request()->routeIs('profile.complete') ? 'active' : '' }}">
    <span class="nav-icon">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
        </svg>
    </span>
    Pengaturan Profil
</a>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn-full">
                <span class="btn-content">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span class="text">Keluar dari PIKP</span>
                </span>
            </button>
        </form>
    </div>
</aside>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --pikp-dark: #064E3B; /* Hijau Tua NGO */
        --pikp-lemon: #BEF264; /* Lemon Glow */
        --pikp-text: #636E72;
        --pikp-white: #ffffff;
    }

    .admin-sidebar {
        width: 290px;
        height: 100vh;
        background-color: var(--pikp-white);
        font-family: 'Plus Jakarta Sans', sans-serif;
        display: flex;
        flex-direction: column;
        border-right: 1px solid #f1f5f9;
        position: sticky;
        top: 0;
        z-index: 1100;
    }

    /* Brand Header */
    .sidebar-header {
        padding: 35px 25px;
    }

    .brand-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .brand-logo-container {
        position: relative;
    }

    .brand-logo {
        background-color: var(--pikp-dark);
        color: var(--pikp-lemon);
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-weight: 800;
        font-size: 1.4rem;
        box-shadow: 0 8px 15px rgba(6, 78, 59, 0.15);
    }

    .verified-dot {
        position: absolute;
        top: -4px;
        right: -4px;
        width: 12px;
        height: 12px;
        background: var(--pikp-lemon);
        border: 2px solid #fff;
        border-radius: 50%;
    }

    .brand-text {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--pikp-dark);
        letter-spacing: -1px;
        display: block;
        line-height: 1;
    }

    .brand-text span { color: var(--pikp-lemon); }

    .brand-sub {
        font-size: 0.65rem;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-top: 4px;
        font-weight: 700;
    }

    /* Navigation */
    .sidebar-nav {
        flex: 1;
        padding: 10px 18px;
        overflow-y: auto;
    }

    .menu-group {
        font-size: 0.65rem;
        font-weight: 800;
        color: #cbd5e1;
        letter-spacing: 1.2px;
        margin: 30px 0 12px 12px;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        text-decoration: none;
        color: var(--pikp-text);
        font-size: 0.85rem;
        font-weight: 600;
        border-radius: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 6px;
    }

    .nav-icon {
        display: flex;
        align-items: center;
        color: #94a3b8;
        transition: color 0.3s;
    }

    .nav-link:hover {
        background-color: #f8fafc;
        color: var(--pikp-dark);
    }

    .nav-link:hover .nav-icon {
        color: var(--pikp-dark);
    }

    .nav-link.active {
        background-color: var(--pikp-dark);
        color: var(--pikp-lemon);
        box-shadow: 0 10px 20px rgba(6, 78, 59, 0.15);
    }

    .nav-link.active .nav-icon {
        color: var(--pikp-lemon);
    }

    /* Footer & Logout */
    .sidebar-footer {
        padding: 25px 20px;
        border-top: 1px solid #f8fafc;
    }

    .logout-btn-full {
        width: 100%;
        padding: 16px;
        border: 2px solid #f1f5f9;
        background-color: #f8fafc;
        border-radius: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-content {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        color: #ef4444; /* Merah lembut untuk logout */
    }

    .logout-btn-full .text {
        font-size: 0.85rem;
        font-weight: 800;
        letter-spacing: 0.3px;
    }

    .logout-btn-full:hover {
        background-color: #fef2f2;
        border-color: #fecaca;
        transform: translateY(-2px);
    }

    .sidebar-nav::-webkit-scrollbar { width: 4px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: #f1f5f9; border-radius: 10px; }
</style>
