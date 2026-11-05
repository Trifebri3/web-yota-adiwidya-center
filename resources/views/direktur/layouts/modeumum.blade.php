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

        <div class="mode-toggle-wrapper flex items-center gap-3 px-4 py-2 mb-6 bg-white/5 rounded-2xl border border-white/10">
            @php $isDirektur = session('header_mode', 'direktur') === 'direktur'; @endphp
            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest shrink-0">Mode:</span>

            <a href="{{ route('direktur.header.switch', $isDirektur ? 'umum' : 'direktur') }}"
               class="flex items-center gap-2 px-3 py-1.5 rounded-full text-[9px] font-black transition-all duration-300 border border-black/5 no-underline grow justify-center"
               style="background: {{ $isDirektur ? '#0F172A' : '#BEF264' }}; color: {{ $isDirektur ? '#BEF264' : '#0F172A' }};">

                @if($isDirektur)
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                    <span>SWITCH TO COMMON</span>
                @else
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    <span>BACK TO AUTHORITY</span>
                @endif
            </a>
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
                    {{ Auth::user()->role ?? 'Direktur Utama' }}
                </div>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="menu-group">Workspace Utama</div>


        <a href="{{ route('general.todo.index') }}" class="nav-link flex items-center gap-4">
            <span class="nav-icon shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
            </span>
            <span class="nav-text">My To Do List</span>
        </a>

        <a href="{{ route('gen-posts.index') }}" class="nav-link flex items-center gap-4">
            <span class="nav-icon shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a3 3 0 0 0-3-3H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a3 3 0 0 0 3-3V8Z"></path></svg>
            </span>
            <span class="nav-text">Publikasi</span>
        </a>

        <a href="{{ route('general.workspace.index') }}" class="nav-link flex items-center gap-4">
            <span class="nav-icon shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 13V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h9"></path><path d="m17 17 3 3 3-3"></path></svg>
            </span>
            <span class="nav-text">Workspace</span>
        </a>

        <a href="{{ route('general.archive.index') }}" class="nav-link flex items-center gap-4">
            <span class="nav-icon shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
            </span>
            <span class="nav-text">Catatan Arsip</span>
        </a>

        <div class="menu-group">Personal & Settings</div>

        <div class="yota-nav-dropdown px-[15px] mb-2">
            <button class="yota-drop-btn w-full flex items-center justify-between" id="yotaBtn">
                <span class="flex items-center gap-4">
                    <i class="fas fa-briefcase text-[14px] opacity-50"></i>
                    <span>Web Portofolio</span>
                </span>
                <i class="fas fa-chevron-down text-[10px] transition-transform duration-300 arrow-icon"></i>
            </button>
            <div class="yota-drop-content" id="yotaContent">
                <a href="{{ route('general.identity.index') }}" class="yota-drop-item">
                    <i class="fas fa-id-card-alt me-2 text-lime-500"></i> Identitas Utama
                </a>
                <div class="yota-divider"></div>
                <a href="#" class="yota-drop-item">
                    <i class="fas fa-bolt me-2 text-lime-500"></i> My Skills
                </a>
            </div>
        </div>

        <a href="{{ route('profile.complete') }}" class="nav-link flex items-center gap-4 {{ request()->routeIs('profile.complete') ? 'active' : '' }}">
            <span class="nav-icon shrink-0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"></circle><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path></svg>
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
                    <span class="text uppercase">Keluar Sistem</span>
                </span>
            </button>
        </form>
    </div>
</aside>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --dir-dark: #304e00;
        --dir-accent: #bef264;
        --dir-silver: #F1F5F9;
        --nav-hover: rgba(255, 255, 255, 0.05);
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
    .sidebar-header { padding: 30px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
    .brand-wrapper { display: flex; align-items: center; gap: 15px; margin-bottom: 25px; }
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
        position: absolute; bottom: -5px; right: -5px; background: #fff;
        color: var(--dir-dark); font-size: 0.5rem; font-weight: 900;
        padding: 2px 5px; border-radius: 4px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .brand-text { font-size: 1.4rem; font-weight: 800; letter-spacing: -1px; color: #fff; }
    .brand-text span { color: var(--dir-accent); }
    .brand-sub { font-size: 0.6rem; color: var(--dir-accent); opacity: 0.8; font-weight: 800; margin-top: 2px; letter-spacing: 0.5px; }

    /* Profile Card */
    .user-profile-box { background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.06); border-radius: 16px; padding: 12px; display: flex; align-items: center; gap: 12px; }
    .user-avatar-img { width: 100%; height: 100%; border-radius: 10px; object-fit: cover; border: 2px solid var(--dir-accent); }
    .user-avatar-placeholder { width: 40px; height: 40px; background: var(--dir-accent); color: var(--dir-dark); display: flex; align-items: center; justify-content: center; border-radius: 10px; font-weight: 800; }
    .online-indicator { position: absolute; bottom: -2px; right: -2px; width: 10px; height: 10px; background: #10B981; border: 2px solid var(--dir-dark); border-radius: 50%; }
    .user-name { display: block; font-size: 0.8rem; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .user-role-badge { display: flex; align-items: center; gap: 4px; font-size: 0.6rem; font-weight: 800; color: var(--dir-accent); text-transform: uppercase; margin-top: 2px; }

    /* Navigation */
    .sidebar-nav { flex: 1; padding: 15px; overflow-y: auto; }
    .menu-group { font-size: 0.65rem; font-weight: 800; color: rgba(255,255,255,0.2); letter-spacing: 1.5px; margin: 25px 0 10px 15px; text-transform: uppercase; }
    .nav-link { text-decoration: none; color: rgba(255,255,255,0.5); font-size: 0.8rem; font-weight: 600; border-radius: 12px; transition: 0.3s; margin-bottom: 2px; padding: 12px 15px; }
    .nav-link:hover { background: var(--nav-hover); color: #fff; }
    .nav-link.active { background: linear-gradient(135deg, rgba(190, 242, 100, 0.1), rgba(190, 242, 100, 0.02)); color: var(--dir-accent); border: 1px solid rgba(190, 242, 100, 0.1); }
    .nav-icon { opacity: 0.4; transition: 0.3s; }
    .nav-link:hover .nav-icon, .nav-link.active .nav-icon { opacity: 1; color: var(--dir-accent); }

    /* Dropdown UI */
    .yota-drop-btn { background: transparent; color: rgba(255,255,255,0.5); padding: 12px 15px; font-size: 0.8rem; font-weight: 600; border: none; cursor: pointer; transition: 0.3s; border-radius: 12px; }
    .yota-drop-btn:hover { background: var(--nav-hover); color: #fff; }
    .yota-drop-content { display: none; background-color: #fff; border-radius: 16px; padding: 8px; margin-top: 5px; box-shadow: 0 15px 30px rgba(0,0,0,0.3); }
    .yota-drop-content.show { display: block; }
    .yota-drop-item { color: #475569; padding: 10px 15px; text-decoration: none; display: block; font-size: 13px; font-weight: 700; border-radius: 10px; transition: 0.2s; }
    .yota-drop-item:hover { background-color: #f7fee7; color: #064e3b; padding-left: 20px; }
    .yota-divider { height: 1px; background: #f1f5f9; margin: 6px 10px; }

    /* Footer */
    .sidebar-footer { padding: 20px; border-top: 1px solid rgba(255,255,255,0.05); }
    .logout-btn-executive { padding: 14px; border-radius: 12px; border: 1px solid rgba(239, 68, 68, 0.2); background: rgba(239, 68, 68, 0.05); cursor: pointer; transition: 0.3s; }
    .logout-btn-executive:hover { background: #ef4444; border-color: #ef4444; }
    .logout-btn-executive .text { font-size: 0.75rem; font-weight: 900; color: #ef4444; }
    .logout-btn-executive:hover .text, .logout-btn-executive:hover svg { color: #fff; }

    .sidebar-nav::-webkit-scrollbar { width: 4px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.05); border-radius: 10px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropBtn = document.getElementById('yotaBtn');
    const dropContent = document.getElementById('yotaContent');
    const arrow = document.querySelector('.arrow-icon');

    if(dropBtn) {
        dropBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropContent.classList.toggle('show');
            this.classList.toggle('active');
            if(arrow) arrow.style.transform = dropContent.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0deg)';
        });
    }

    document.addEventListener('click', function(e) {
        if (dropBtn && !dropBtn.contains(e.target) && !dropContent.contains(e.target)) {
            dropContent.classList.remove('show');
            dropBtn.classList.remove('active');
            if(arrow) arrow.style.transform = 'rotate(0deg)';
        }
    });
});
</script>
