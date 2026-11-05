<footer class="admin-footer">
    <div class="footer-admin-container">
        <div class="admin-brand-section">
            <h3 class="admin-logo">YOTA<span>.</span></h3>
            <div class="verified-pill">
                <span class="lock-icon">🔒</span>
                PIKP SECURE NODE
            </div>
            <p class="system-status">Internal Communication & Information System v2.6.0</p>
        </div>

        <div class="admin-info-grid">
            <div class="info-item">
                <span class="label">Otoritas Panel:</span>
                <span class="value">Yota Adiwidya Center (PIKP)</span>
            </div>
            <div class="info-item">
                <span class="label">Lokasi Node:</span>
                <span class="value">Baleendah, West Java, ID</span>
            </div>
            <div class="info-item">
                <span class="label">Security Ops:</span>
                <span class="value font-mono">sec.ops@yota.or.id</span>
            </div>
            <div class="info-item">
                <span class="label">Network Status:</span>
                <span class="value status-active">
                    <span class="ping-dot"></span>
                    Encrypted & Online
                </span>
            </div>
        </div>
    </div>

    <div class="admin-copyright">
        <p>© 2026 <strong>Yota Adiwidya Center</strong> | Pusat Informasi dan Komunikasi Publik Terverifikasi.</p>
        <div class="footer-legal-links">
            <a href="#">Data Privacy</a>
            <span class="dot-sep">•</span>
            <a href="#">System Policy</a>
            <span class="dot-sep">•</span>
            <a href="#">Audit Log</a>
        </div>
    </div>
</footer>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .admin-footer {
        background-color: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding: 40px 40px 20px 40px;
        border-top: 1px solid #f1f5f9;
        margin-top: auto;
    }

    .footer-admin-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 40px;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Logo & PIKP Styling */
    .admin-logo {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -1px;
        color: #064E3B; /* Hijau Tua */
    }

    .admin-logo span {
        color: #BEF264; /* Lemon Identity */
    }

    .verified-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #064E3B;
        color: #BEF264;
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 0.65rem;
        font-weight: 800;
        margin-bottom: 10px;
        letter-spacing: 0.5px;
    }

    .system-status {
        font-size: 0.75rem;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Info Grid */
    .admin-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px 60px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-item .label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #cbd5e1;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .info-item .value {
        font-size: 0.9rem;
        color: #334155;
        font-weight: 600;
    }

    .status-active {
        color: #064E3B !important;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .ping-dot {
        width: 8px;
        height: 8px;
        background-color: #BEF264;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(190, 242, 100, 0.8);
    }

    /* Copyright Bar */
    .admin-copyright {
        margin-top: 40px;
        padding-top: 25px;
        border-top: 1px solid #f8fafc;
        text-align: center;
    }

    .admin-copyright p {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-bottom: 10px;
    }

    .admin-copyright strong {
        color: #064E3B;
    }

    .footer-legal-links {
        display: flex;
        justify-content: center;
        gap: 15px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .footer-legal-links a {
        color: #cbd5e1;
        text-decoration: none;
        transition: color 0.2s;
    }

    .footer-legal-links a:hover {
        color: #BEF264;
    }

    .dot-sep {
        color: #f1f5f9;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .footer-admin-container {
            flex-direction: column;
            gap: 30px;
        }
        .admin-info-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        .admin-brand-section {
            text-align: center;
            width: 100%;
        }
        .verified-pill {
            justify-content: center;
        }
    }
</style>
