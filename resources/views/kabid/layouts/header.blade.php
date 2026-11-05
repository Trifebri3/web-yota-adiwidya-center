<aside class="admin-sidebar">
    <div class="sidebar-header">
        <div class="brand-wrapper">
            <div class="brand-logo-container">
                @if(Auth::user()->division && Auth::user()->division->logo)
                    <div class="brand-logo-img-wrapper">
                        <img src="{{ asset('storage/' . Auth::user()->division->logo) }}"
                             alt="{{ Auth::user()->division->name }}"
                             class="brand-logo-img">
                    </div>
                @else
                    <span class="brand-logo">
                        {{ substr(Auth::user()->division->name ?? 'Y', 0, 1) }}
                    </span>
                @endif
                <div class="executive-badge">KDV</div>
            </div>
            <div class="brand-info">
                <span class="brand-text">Yota<span>.</span></span>
                <p class="brand-sub">{{ strtoupper(Auth::user()->division->name ?? 'General') }} HUB</p>
            </div>
        </div>

        <div class="user-profile-box">
            <div class="profile-avatar-wrapper">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile" class="user-avatar-img">
                @else
                    <div class="user-avatar-placeholder">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                @endif
                <div class="online-indicator"></div>
            </div>
            <div class="user-details">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <div class="user-role-badge">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                    {{ Auth::user()->role ?? 'Kepala Divisi' }}
                </div>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">

        <div class="menu-group">Manajemen & Monitoring</div>

        <a href="{{ route('kabid.dashboard') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('kadiv.dashboard') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            </span>
            <span class="nav-text">Dashboard Divisi</span>
        </a>

        <a href="{{ route('kabid.proposal.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
            </span>
            <span class="nav-text">Pengajuan Proposal</span>
        </a>

        <a href="{{ route('task.index') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('anggota.task.*') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
            </span>
            <span class="nav-text">Tugas Divisi</span>
        </a>

        <a href="{{ route('kabid-tugas.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </span>
            <span class="nav-text">Tugas Tim</span>
        </a>

        <a href="{{ route('timeline.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
            </span>
            <span class="nav-text">Timeline Umum</span>
        </a>

        <a href="{{ route('delegation.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
            </span>
            <span class="nav-text">Delegasi Khusus</span>
        </a>

        <div class="menu-group">Operasional & Arsip</div>

        <a href="{{ route('general.service.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 1 1-7.6-10.6 8.38 8.38 0 0 1 3.8.9L21 3.5Z"></path></svg>
            </span>
            <span class="nav-text">Request & Service</span>
        </a>

        <a href="{{ route('general.workspace.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h9z"></path></svg>
            </span>
            <span class="nav-text">Workspace Project</span>
        </a>

        <a href="{{ route('general.archive.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7"></path><rect x="3" y="8" width="18" height="4" rx="2"></rect></svg>
            </span>
            <span class="nav-text">Catatan Arsip</span>
        </a>

        <a href="{{ route('general.todo.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
            </span>
            <span class="nav-text">My To Do List</span>
        </a>

        <div class="menu-group">Jadwal & Komunikasi</div>

        <a href="{{ route('user.agendas') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('user.agendas') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </span>
            <span class="nav-text">Agenda Umum</span>
        </a>

        <a href="{{ route('divisiagenda.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0 text-center w-[20px]">
                <i class="fas fa-calendar-alt text-[16px]"></i>
            </span>
            <span class="nav-text">Agenda Divisi</span>
        </a>

        <a href="{{ route('kabid.agenda.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </span>
            <span class="nav-text">Jadwal Internal</span>
        </a>

        <a href="{{ route('announcement.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </span>
            <span class="nav-text">Pengumuman Pusat</span>
        </a>

        <a href="{{ route('kabid.pengumuman.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
            </span>
            <span class="nav-text">Pengumuman Divisi</span>
        </a>

        <div class="menu-group">Tim & Laporan</div>

        <a href="{{ route('kabid.teams.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </span>
            <span class="nav-text">Manajemen Tim</span>
        </a>

        <a href="{{ route('kabid.laporan.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>
            </span>
            <span class="nav-text">Laporan Direktur</span>
        </a>

        <a href="{{ route('evaluation.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 8v4l3 3"></path></svg>
            </span>
            <span class="nav-text">Evaluasi Staf</span>
        </a>

        <div class="menu-group">Resource & Profil</div>

        <a href="{{ route('kabid.dokumen.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
            </span>
            <span class="nav-text">Dokumen Internal</span>
        </a>

        <a href="{{ route('general.dokumen.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            </span>
            <span class="nav-text">Dokumen Umum</span>
        </a>

        <a href="{{ route('gen-posts.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11a9 9 0 0 1 9 9"></path><path d="M4 4a16 16 0 0 1 16 16"></path><circle cx="5" cy="19" r="1"></circle></svg>
            </span>
            <span class="nav-text">Publikasi</span>
        </a>

        <div class="yota-nav-dropdown px-[18px] py-2">
            <button class="yota-drop-btn w-full flex items-center justify-between" id="yotaBtn">
                <span>Web Portofolio</span>
                <i class="fas fa-chevron-down text-[10px]"></i>
            </button>
            <div class="yota-drop-content" id="yotaContent">
                <a href="{{ route('general.identity.index') }}" class="yota-drop-item flex items-center gap-2">
                    <i class="fas fa-id-card-alt text-lime-500"></i> Identitas Utama
                </a>
                <div class="yota-divider"></div>
                <a href="#" class="yota-drop-item flex items-center gap-2">
                    <i class="fas fa-bolt text-lime-500"></i> My Skills
                </a>
            </div>
        </div>

        <a href="{{ route('profile.complete') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('profile.complete') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"></circle><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path></svg>
            </span>
            <span class="nav-text">Pengaturan Profil</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="logout-btn-executive w-full">
                <span class="btn-content flex items-center justify-center gap-3">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span class="text uppercase">Close Workspace</span>
                </span>
            </button>
        </form>
    </div>
</aside>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --dir-dark: #002c16;
        --dir-accent: #BEF264;
        --dir-silver: #F1F5F9;
        --nav-hover: rgba(255, 255, 255, 0.03);
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

    /* Header & Branding */
    .sidebar-header { padding: 35px 25px; border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
    .brand-wrapper { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }
    .brand-logo-img-wrapper {
        width: 45px; height: 45px; background-color: #fff;
        border-radius: 12px; display: flex; align-items: center;
        justify-content: center; overflow: hidden; border: 2px solid var(--dir-accent);
    }
    .brand-logo-img { width: 100%; height: 100%; object-fit: contain; padding: 5px; }
    .brand-logo {
        background-color: var(--dir-accent); color: var(--dir-dark);
        width: 45px; height: 45px; display: flex; align-items: center;
        justify-content: center; border-radius: 12px; font-weight: 800; font-size: 1.5rem;
    }

    .executive-badge {
        position: absolute; bottom: -8px; right: -8px; background: #fff;
        color: var(--dir-dark); font-size: 0.55rem; font-weight: 900;
        padding: 2px 6px; border-radius: 5px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .brand-text { font-size: 1.5rem; font-weight: 800; letter-spacing: -1px; line-height: 1; color: #fff; }
    .brand-text span { color: var(--dir-accent); }
    .brand-sub { font-size: 0.65rem; color: var(--dir-accent); opacity: 0.8; font-weight: 800; margin-top: 5px; letter-spacing: 0.5px; }

    /* Profil Pengguna */
    .user-profile-box { background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.06); border-radius: 20px; padding: 16px; display: flex; align-items: center; gap: 12px; }
    .user-avatar-img { width: 100%; height: 100%; border-radius: 12px; object-fit: cover; border: 2px solid var(--dir-accent); }
    .user-name { display: block; font-size: 0.85rem; font-weight: 700; color: #fff; white-space: nowrap; text-overflow: ellipsis; overflow: hidden; }
    .user-role-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 0.6rem; font-weight: 800; color: var(--dir-accent); text-transform: uppercase; margin-top: 4px; }

    /* Navigasi */
    .sidebar-nav { flex: 1; padding: 20px 15px; overflow-y: auto; }
    .menu-group { font-size: 0.65rem; font-weight: 800; color: rgba(255,255,255,0.2); letter-spacing: 1.5px; margin: 30px 0 10px 12px; text-transform: uppercase; }
    .nav-link { text-decoration: none; color: rgba(255,255,255,0.5); font-size: 0.85rem; font-weight: 600; border-radius: 14px; transition: 0.3s ease; margin-bottom: 4px; padding: 14px 18px; }
    .nav-link:hover { background: var(--nav-hover); color: #fff; }
    .nav-link.active { background: linear-gradient(135deg, rgba(190, 242, 100, 0.12), rgba(190, 242, 100, 0.03)); color: var(--dir-accent); border: 1px solid rgba(190, 242, 100, 0.2); }

    /* Dropdown */
    .yota-nav-dropdown { position: relative; font-family: 'Plus Jakarta Sans', sans-serif; }
    .yota-drop-btn { background: transparent; color: #fff; padding: 10px 0; font-size: 13px; font-weight: 800; text-transform: uppercase; border: none; cursor: pointer; border-bottom: 1px solid rgba(255,255,255,0.05); }
    .yota-drop-content { display: none; background-color: #fff; border-radius: 20px; padding: 10px; margin-top: 5px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
    .yota-drop-content.show { display: block; }
    .yota-drop-item { color: #475569; padding: 12px 18px; text-decoration: none; display: block; font-size: 13px; font-weight: 700; border-radius: 12px; transition: 0.2s; }
    .yota-drop-item:hover { background-color: #f7fee7; color: #064e3b; padding-left: 25px; }
    .yota-divider { height: 1px; background: #f1f5f9; margin: 8px 10px; }

    /* Footer */
    .sidebar-footer { padding: 25px 20px; border-top: 1px solid rgba(255,255,255,0.05); }
    .logout-btn-executive { padding: 16px; border: 1px solid rgba(239, 68, 68, 0.2); background: rgba(239, 68, 68, 0.05); border-radius: 14px; cursor: pointer; transition: 0.3s; }
    .logout-btn-executive:hover { background: #ef4444; border-color: #ef4444; }
    .logout-btn-executive .text { font-size: 0.75rem; font-weight: 900; color: #ef4444; transition: 0.3s; }
    .logout-btn-executive:hover .text, .logout-btn-executive:hover svg { color: #fff; }

    .sidebar-nav::-webkit-scrollbar { width: 4px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.05); border-radius: 10px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropBtn = document.getElementById('yotaBtn');
    const dropContent = document.getElementById('yotaContent');
    if(dropBtn) {
        dropBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropContent.classList.toggle('show');
            this.classList.toggle('active');
        });
    }
    document.addEventListener('click', function(e) {
        if (dropBtn && !dropBtn.contains(e.target) && !dropContent.contains(e.target)) {
            dropContent.classList.remove('show');
            dropBtn.classList.remove('active');
        }
    });
});
</script>
