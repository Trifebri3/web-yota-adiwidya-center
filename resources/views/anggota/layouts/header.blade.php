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
                <div class="executive-badge">STF</div>
            </div>
            <div class="brand-info">
                <span class="brand-text">Yota<span>.</span></span>
                <p class="brand-sub">{{ strtoupper(Auth::user()->division->name ?? 'General') }} TEAM</p>
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
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    {{ Auth::user()->role ?? 'Anggota Divisi' }}
                </div>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="menu-group">Workspace Utama</div>

        <a href="{{ route('anggota.dashboard') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('anggota.dashboard') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            </span>
            <span class="nav-text">Beranda Kerja</span>
        </a>

        <a href="{{ route('task.index') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('anggota.task.*') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
            </span>
            <span class="nav-text">Tugas Divisi</span>
        </a>

        <a href="{{ route('timeline.index') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('kadiv.task.*') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </span>
            <span class="nav-text">Timeline Umum</span>
        </a>

        <div class="menu-group">Aktivitas & Presensi</div>

        <a href="{{ route('general.todo.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
            </span>
            <span class="nav-text">My To Do</span>
        </a>

        <a href="{{ route('announcement.index') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('kadiv.task.*') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </span>
            <span class="nav-text">Pengumuman</span>
        </a>
        
        <a href="{{ route('semuadivisi.kabid-announcement.index') }}" 
   class="nav-link flex items-center gap-3 {{ request()->routeIs('semuadivisi.kabid-announcement.*') ? 'active' : '' }}">
    <span class="nav-icon shrink-0">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
    </span>
    <span class="nav-text font-black uppercase tracking-widest text-[10px]">Pengumuman DIVISI</span>
</a>


        <a href="{{ route('delegation.index') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('kadiv.task.*') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
            </span>
            <span class="nav-text">Delegasi Khusus</span>
        </a>

        <a href="{{ route('evaluation.index') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('kadiv.task.*') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
            </span>
            <span class="nav-text">Evaluasi</span>
        </a>

        <a href="{{ route('user.agendas') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('user.agendas') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </span>
            <span class="nav-text">Agenda Umum</span>
        </a>

        <div class="menu-group">Hasil Kerja</div>

        <a href="{{ route('general.archive.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7"></path><rect x="3" y="8" width="18" height="4" rx="2"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
            </span>
            <span class="nav-text">Catatan Arsip</span>
        </a>

        <a href="{{ route('general.service.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4H6z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            </span>
            <span class="nav-text">Request dan Service</span>
        </a>

        <a href="{{ route('general.workspace.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h9z"></path></svg>
            </span>
            <span class="nav-text">Workspace Project</span>
        </a>

        <a href="{{ route('divisiagenda.index') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('divisiagenda.*') ? 'active' : '' }}">
            <span class="nav-icon shrink-0 text-center w-[20px]">
                <i class="fas fa-calendar-check text-[16px]"></i>
            </span>
            <span class="nav-text">Agenda Divisi</span>
        </a>

        <a href="{{ route('anggota.tugas.index') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('anggota.tugas.*') ? 'active' : '' }}">
            <span class="nav-icon shrink-0 text-center w-[20px]">
                <i class="fas fa-tasks text-[16px]"></i>
            </span>
            <span class="nav-text">Tugas Saya</span>
        </a>

        <div class="menu-group">Informasi</div>

        <a href="{{ route('gen-posts.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11a9 9 0 0 1 9 9"></path><path d="M4 4a16 16 0 0 1 16 16"></path><circle cx="5" cy="19" r="1"></circle></svg>
            </span>
            <span class="nav-text">Publikasi</span>
        </a>

        <a href="{{ route('general.dokumen.index') }}" class="nav-link flex items-center gap-3">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            </span>
            <span class="nav-text">Lihat Dokumen</span>
        </a>

        <a href="{{ route('profile.complete') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('profile.complete') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"></circle><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path></svg>
            </span>
            <span class="nav-text">Pengaturan Profil</span>
        </a>

        <div class="yota-nav-dropdown px-[18px] py-2">
            <button class="yota-drop-btn w-full flex items-center justify-between" id="yotaBtn">
                <span>Web Portofolio</span>
                <i class="fas fa-chevron-down text-[10px]"></i>
            </button>
            <div class="yota-drop-content" id="yotaContent">
                <a href="{{ route('general.identity.index') }}" class="yota-drop-item flex items-center gap-2">
                    <i class="fas fa-id-badge text-lime-500"></i> Identitas Utama
                </a>
            </div>
        </div>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="logout-btn-executive w-full">
                <span class="btn-content flex items-center justify-center gap-3">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span class="text">Keluar Sistem</span>
                </span>
            </button>
        </form>
    </div>
</aside>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --dir-dark: #304e00;
        --dir-accent: #d0ff80;
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

    /* Header */
    .sidebar-header { padding: 35px 25px; border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
    .brand-wrapper { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }
    .brand-logo-container { position: relative; }
    .brand-logo {
        background-color: var(--dir-accent);
        color: var(--dir-dark);
        width: 45px; height: 45px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px; font-weight: 800; font-size: 1.5rem;
    }
    .brand-logo-img-wrapper {
        width: 45px; height: 45px;
        background-color: #fff;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        overflow: hidden; border: 2px solid var(--dir-accent);
    }
    .brand-logo-img { width: 100%; height: 100%; object-fit: contain; padding: 5px; }

    .executive-badge {
        position: absolute; bottom: -8px; right: -8px;
        background: #fff; color: var(--dir-dark);
        font-size: 0.55rem; font-weight: 900; padding: 2px 6px; border-radius: 5px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .brand-text { font-size: 1.5rem; font-weight: 800; letter-spacing: -1px; line-height: 1; color: #fff; }
    .brand-text span { color: var(--dir-accent); }
    .brand-sub { font-size: 0.65rem; color: var(--dir-accent); opacity: 0.8; font-weight: 800; margin-top: 5px; letter-spacing: 0.5px; }

    /* Profile Box */
    .user-profile-box { background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.06); border-radius: 20px; padding: 16px; display: flex; align-items: center; gap: 12px; }
    .profile-avatar-wrapper { position: relative; width: 45px; height: 45px; flex-shrink: 0; }
    .user-avatar-img { width: 100%; height: 100%; border-radius: 12px; object-fit: cover; border: 2px solid var(--dir-accent); }
    .user-avatar-placeholder { width: 100%; height: 100%; background: var(--dir-accent); color: var(--dir-dark); display: flex; align-items: center; justify-content: center; border-radius: 12px; font-weight: 800; font-size: 1.2rem; }
    .online-indicator { position: absolute; bottom: -2px; right: -2px; width: 12px; height: 12px; background: #10B981; border: 2.5px solid var(--dir-dark); border-radius: 50%; }
    .user-name { display: block; font-size: 0.85rem; font-weight: 700; color: #fff; white-space: nowrap; text-overflow: ellipsis; overflow: hidden; }
    .user-role-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 0.6rem; font-weight: 800; color: var(--dir-accent); text-transform: uppercase; margin-top: 4px; }

    /* Navigation */
    .sidebar-nav { flex: 1; padding: 20px 15px; overflow-y: auto; }
    .menu-group { font-size: 0.6rem; font-weight: 800; color: rgba(255,255,255,0.25); letter-spacing: 2px; margin: 30px 0 12px 15px; text-transform: uppercase; }
    .nav-link { text-decoration: none; color: rgba(255,255,255,0.5); font-size: 0.85rem; font-weight: 600; border-radius: 14px; transition: all 0.3s ease; margin-bottom: 4px; padding: 14px 18px; }
    .nav-icon { color: rgba(255,255,255,0.2); transition: all 0.3s; }
    .nav-link:hover { background: var(--nav-hover); color: #fff; }
    .nav-link:hover .nav-icon { color: var(--dir-accent); transform: translateX(3px); }
    .nav-link.active { background: linear-gradient(135deg, rgba(190, 242, 100, 0.12), rgba(190, 242, 100, 0.03)); color: var(--dir-accent); border: 1px solid rgba(190, 242, 100, 0.2); }
    .nav-link.active .nav-icon { color: var(--dir-accent); }

    /* Dropdown */
    .yota-nav-dropdown { position: relative; font-family: 'Plus Jakarta Sans', sans-serif; }
    .yota-drop-btn { background: transparent; color: #fff; padding: 10px 0; font-size: 13px; font-weight: 800; text-transform: uppercase; border: none; cursor: pointer; transition: all 0.3s ease; border-bottom: 1px solid rgba(255,255,255,0.05); }
    .yota-drop-btn:hover { color: var(--dir-accent); }
    .yota-drop-content { display: none; background-color: #ffffff; min-width: 220px; box-shadow: 0px 20px 40px rgba(6, 78, 59, 0.15); border: 1px solid #f1f5f9; border-radius: 20px; padding: 10px; z-index: 999; margin-top: 5px; }
    .yota-drop-content.show { display: block; }
    .yota-drop-item { color: #475569; padding: 12px 18px; text-decoration: none; display: block; font-size: 13px; font-weight: 700; border-radius: 12px; transition: 0.2s; }
    .yota-drop-item:hover { background-color: #f7fee7; color: #064e3b; padding-left: 25px; }

    /* Footer */
    .sidebar-footer { padding: 25px 20px; border-top: 1px solid rgba(255,255,255,0.05); }
    .logout-btn-executive { padding: 16px; border: 1px solid rgba(239, 68, 68, 0.2); background-color: rgba(239, 68, 68, 0.05); border-radius: 14px; cursor: pointer; transition: all 0.3s ease; }
    .logout-btn-executive .text { font-size: 0.75rem; font-weight: 900; letter-spacing: 1px; color: #ef4444; }
    .logout-btn-executive:hover { background-color: #ef4444; border-color: #ef4444; }
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
