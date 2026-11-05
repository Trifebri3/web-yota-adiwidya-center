<footer class="admin-footer">
    <div class="footer-admin-container">
        <div class="admin-brand-section">
            <h3 class="admin-logo">YOTA<span>.</span></h3>
            <p class="system-status">Admin & Management System v2.0</p>
        </div>

        <div class="admin-info-grid">
            <div class="info-item">
                <span class="label">Yayasan:</span>
                <span class="value">Yota Adiwidya Center</span>
            </div>
            <div class="info-item">
                <span class="label">Alamat:</span>
                <span class="value">Baleendah, Kab. Bandung</span>
            </div>
            <div class="info-item">
                <span class="label">Kontak Support:</span>
                <span class="value">+62 851 1771 3303</span>
            </div>
            <div class="info-item">
                <span class="label">Sistem Status:</span>
                <span class="value status-active">● Online</span>
            </div>
        </div>
    </div>

    <div class="admin-copyright">
        <p>© 2026 <strong>Yota Adiwidya Center</strong> | Yayasan Yota Wujudkan Asa. All Rights Reserved.</p>
    </div>
</footer>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    .admin-footer {
        background-color: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding: 25px 40px;
        border-top: 1px solid #f0f0f0;
        margin-top: auto; /* Memastikan footer selalu di bawah */
    }

    .footer-admin-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 30px;
        max-width: 100%;
    }

    /* Logo & Versi */
    .admin-logo {
        font-size: 1.2rem;
        font-weight: 800;
        margin-bottom: 4px;
        letter-spacing: -0.5px;
        color: #222;
    }

    .admin-logo span {
        color: #D9E021; /* Lemon Identity */
    }

    .system-status {
        font-size: 0.75rem;
        color: #999;
        font-weight: 500;
    }

    /* Grid Info untuk Pengurus */
    .admin-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px 40px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-item .label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #A0A0A0;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .info-item .value {
        font-size: 0.85rem;
        color: #444;
        font-weight: 500;
    }

    .status-active {
        color: #B2B910 !important; /* Lemon Gelap agar terbaca */
        font-weight: 700 !important;
    }

    /* Copyright Bar */
    .admin-copyright {
        margin-top: 25px;
        padding-top: 15px;
        border-top: 1px solid #fafafa;
        text-align: center;
    }

    .admin-copyright p {
        font-size: 0.8rem;
        color: #bbb;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .footer-admin-container {
            flex-direction: column;
            gap: 20px;
        }
        .admin-info-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }
    }
</style>
