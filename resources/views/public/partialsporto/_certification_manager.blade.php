<div class="yota-public-cert-showcase">
    <div class="cert-public-header-area">
        <h2 class="cert-main-heading">Expert <br> <span class="text-lemon-highlight">Validations.</span></h2>
        <p class="cert-lead-text">Koleksi lisensi dan sertifikasi profesional yang memvalidasi kompetensi teknis saya sesuai standar industri.</p>
    </div>

    <div class="cert-public-grid">
        @forelse($user->certifications as $cert)
        <div class="cert-public-card">
            <div class="cert-inner">
                <div class="cert-status-wrapper">
                    @if($cert->is_expired)
                        <span class="cert-badge-status expired">Expired</span>
                    @else
                        <span class="cert-badge-status active">Verified</span>
                    @endif
                </div>

                <div class="cert-main-content">
                    <div class="cert-visual-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="cert-text-info">
                        <h5 class="cert-public-name">{{ $cert->cert_name }}</h5>
                        <p class="cert-public-org">{{ $cert->issuing_organization }}</p>
                    </div>
                </div>

                <div class="cert-footer-meta">
                    <div class="cert-date-info">
                        <i class="far fa-calendar-alt me-1"></i>
                        <span>Issued {{ $cert->issue_date->format('M Y') }}</span>
                    </div>

                    @if($cert->credential_url)
                    <a href="{{ $cert->credential_url }}" target="_blank" class="cert-verify-btn">
                        <span>Check Link</span>
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    @endif
                </div>
            </div>
            <div class="cert-hover-glow"></div>
        </div>
        @empty
        <div class="cert-public-empty">
            <i class="fas fa-shield-alt mb-3 opacity-20 fa-3x"></i>
            <p>Sertifikasi kompetensi sedang dalam tahap verifikasi dokumen.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    /* PUBLIC CERTIFICATIONS - LUXURY & PROFESSIONAL */
    .yota-public-cert-showcase {
        --y-dark: #052c24;
        --y-lemon: #BEF264;
        --y-border: rgba(5, 44, 36, 0.08);
        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Header Styling */
    .cert-public-header-area {
        margin-bottom: 60px;
    }

    .cert-main-heading {
        font-size: clamp(2.5rem, 6vw, 4rem);
        font-weight: 800;
        color: var(--y-dark);
        line-height: 1;
        letter-spacing: -3px;
        margin-bottom: 20px;
    }

    .text-lemon-highlight {
        color: var(--y-lemon);
        background: var(--y-dark);
        padding: 0 15px;
        border-radius: 20px;
        display: inline-block;
        transform: rotate(-1deg);
    }

    .cert-lead-text {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 600px;
        font-weight: 500;
        line-height: 1.6;
    }

    /* Grid System */
    .cert-public-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 25px;
    }

    /* Card Styling */
    .cert-public-card {
        background: #ffffff;
        border: 1px solid var(--y-border);
        border-radius: 40px; /* Playful squircle */
        padding: 35px;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .cert-public-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 60px rgba(5, 44, 36, 0.06);
        border-color: var(--y-lemon);
    }

    .cert-status-wrapper {
        position: absolute;
        top: 35px;
        right: 35px;
    }

    .cert-badge-status {
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        padding: 6px 14px;
        border-radius: 100px;
        letter-spacing: 1px;
    }

    .cert-badge-status.active {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .cert-badge-status.expired {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .cert-main-content {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        margin-right: 60px;
    }

    .cert-visual-icon {
        width: 56px;
        height: 56px;
        background: var(--y-dark);
        color: var(--y-lemon);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
        transition: 0.3s;
    }

    .cert-public-card:hover .cert-visual-icon {
        transform: rotate(-10deg) scale(1.1);
    }

    .cert-public-name {
        font-weight: 800;
        color: var(--y-dark);
        margin: 0;
        line-height: 1.3;
        font-size: 1.2rem;
        letter-spacing: -0.5px;
    }

    .cert-public-org {
        font-size: 14px;
        color: #64748b;
        font-weight: 600;
        margin-top: 4px;
    }

    .cert-footer-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        border-top: 2px dashed #f1f5f9;
    }

    .cert-date-info {
        font-size: 12px;
        font-weight: 700;
        color: #94a3b8;
    }

    .cert-verify-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 800;
        color: var(--y-dark);
        text-decoration: none;
        transition: 0.2s;
        border-bottom: 2px solid var(--y-lemon);
    }

    .cert-verify-btn:hover {
        color: #000;
        padding-right: 5px;
    }

    .cert-hover-glow {
        position: absolute;
        width: 100px;
        height: 100px;
        background: var(--y-lemon);
        filter: blur(50px);
        opacity: 0;
        bottom: -50px;
        left: -50px;
        transition: 0.5s;
    }

    .cert-public-card:hover .cert-hover-glow {
        opacity: 0.2;
    }

    .cert-public-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 80px;
        background: #f8fafc;
        border-radius: 40px;
        color: #94a3b8;
    }

    @media (max-width: 768px) {
        .cert-main-heading { font-size: 2.8rem; }
        .cert-public-grid { grid-template-columns: 1fr; }
        .cert-public-card { padding: 30px; }
    }
</style>
