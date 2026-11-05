<footer class="admin-footer">
    <div class="footer-admin-container">
        <div class="admin-brand-section">
            <h3 class="admin-logo">YOTA<span>.</span></h3>
            <div class="verified-pill">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 16v-4"></path>
                    <path d="M12 8h.01"></path>
                </svg>
                STAFF WORKSPACE NODE
            </div>
            <p class="system-status">Contribution Mode v2.6.0 | Division Level</p>
        </div>

        <div class="admin-info-grid">
            <div class="info-item">
                <span class="label">Divisi Aktif</span>
                <span class="value">{{ Auth::user()->division->name ?? 'Unassigned' }}</span>
            </div>
            <div class="info-item">
                <span class="label">ID Akun</span>
                <span class="value font-mono">MBR-{{ str_pad(Auth::user()->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="info-item">
                <span class="label">Uplink Status</span>
                <span class="value status-active">
                    <span class="ping-dot"></span>
                    Synchronized to Hub
                </span>
            </div>
        </div>
    </div>

    <div class="admin-copyright">
        <p>© 2026 <strong>Yota Adiwidya Center</strong> | Kontributor Aktif {{ Auth::user()->division->name ?? '' }}.</p>
        <div class="footer-legal-links">
            <a href="#">User Guidelines</a>
            <span class="dot-sep">•</span>
            <a href="#">Reporting Guide</a>
            <span class="dot-sep">•</span>
            <a href="#">Help Desk</a>
        </div>
    </div>
</footer>

<style>
    /* Styling tetap sinkron dengan identitas visual YOTA */
    :root {
        --footer-dark: #002c16; /* Menyesuaikan dengan Sidebar Hijau Tua Anggota */
        --footer-lemon: #BEF264;
        --footer-text: #64748B;
        --footer-border: #F1F5F9;
    }

    .admin-footer {
        background-color: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding: 40px 40px 25px 40px;
        border-top: 1px solid var(--footer-border);
        margin-top: auto;
    }

    .footer-admin-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 30px;
    }

    .admin-logo {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -1px;
        color: var(--footer-dark);
    }

    .admin-logo span { color: var(--footer-lemon); }

    .verified-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--footer-dark);
        color: var(--footer-lemon);
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 0.6rem;
        font-weight: 800;
        margin-bottom: 12px;
        letter-spacing: 1px;
    }

    .system-status {
        font-size: 0.7rem;
        color: var(--footer-text);
        font-weight: 600;
        opacity: 0.8;
    }

    .admin-info-grid {
        display: grid;
        grid-template-columns: repeat(3, auto);
        gap: 40px;
    }

    .info-item .label {
        display: block;
        font-size: 0.6rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94A3B8;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .info-item .value {
        font-size: 0.85rem;
        color: var(--footer-dark);
        font-weight: 700;
    }

    .status-active {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #059669 !important;
    }

    .ping-dot {
        width: 7px; height: 7px;
        background-color: #10B981;
        border-radius: 50%;
        position: relative;
    }

    .ping-dot::after {
        content: '';
        position: absolute;
        width: 100%; height: 100%;
        background: inherit;
        border-radius: inherit;
        animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    @keyframes ping {
        75%, 100% { transform: scale(2.5); opacity: 0; }
    }

    .admin-copyright {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid var(--footer-border);
        text-align: center;
    }

    .admin-copyright p { font-size: 0.75rem; color: var(--footer-text); margin-bottom: 8px; }
    .admin-copyright strong { color: var(--footer-dark); }

    .footer-legal-links {
        display: flex;
        justify-content: center;
        gap: 12px;
        font-size: 0.7rem;
        font-weight: 700;
    }

    .footer-legal-links a { color: #94A3B8; text-decoration: none; transition: 0.2s; }
    .footer-legal-links a:hover { color: var(--footer-dark); }
    .dot-sep { color: #E2E8F0; }

    @media (max-width: 768px) {
        .admin-info-grid { grid-template-columns: 1fr; gap: 20px; }
        .footer-admin-container { flex-direction: column; align-items: center; text-align: center; }
    }
</style>
