<div class="yota-public-social-showcase">
    <div class="social-container-safe">
        <div class="social-public-header-area">
            <h2 class="social-main-heading">Digital <br> <span class="text-lemon-highlight">Ecosystem.</span></h2>
            <p class="social-lead-text">Hubungkan kolaborasi dan jelajahi jejak digital saya melalui berbagai platform profesional.</p>
        </div>

        <div class="social-public-grid">
            @forelse($user->socialLinks as $social)
            <a href="{{ $social->url }}" target="_blank" class="social-public-anchor">
                <div class="social-public-card">
                    <div class="social-icon-wrapper-public">
                        <i class="{{ $social->bootstrap_icon }}"></i>
                    </div>
                    <div class="social-text-wrapper">
                        <span class="social-platform-label">{{ $social->platform_name }}</span>
                        <span class="social-action-text">Follow / Connect <i class="fas fa-arrow-right ms-1"></i></span>
                    </div>

                    <div class="social-hover-glow"></div>
                </div>
            </a>
            @empty
            <div class="social-public-empty">
                <p>Saluran komunikasi digital sedang dikonfigurasi.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .yota-public-social-showcase {
        --y-dark: #052c24;
        --y-lemon: #BEF264;
        --y-soft: #f8fafc;
        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
        /* Tambahkan padding global agar tidak mepet ke tepi kartu putih utama */
        padding: 20px 0;
    }

    /* CONTAINER SAFE: Kunci agar konten tidak tertutup sidebar */
    .social-container-safe {
        max-width: 1200px; /* Batasi lebar agar tetap elegan di layar besar */
        margin: 0 auto;    /* Center secara horizontal */
        padding: 0 10px;   /* Margin aman dari tepi app-main */
    }

    /* Header Styling */
    .social-public-header-area {
        margin-bottom: 50px;
        position: relative;
    }

    .social-main-heading {
        font-size: clamp(2.5rem, 6vw, 4rem);
        font-weight: 800;
        color: var(--y-dark);
        line-height: 1.1;
        letter-spacing: -2px;
        margin-bottom: 20px;
        /* Pastikan heading tidak overflow ke kiri */
        display: block;
    }

    .text-lemon-highlight {
        color: var(--y-lemon);
        background: var(--y-dark);
        padding: 4px 15px;
        border-radius: 15px;
        display: inline-block;
    }

    .social-lead-text {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 550px;
        font-weight: 500;
    }

    /* Grid System */
    .social-public-grid {
        display: grid;
        /* Gunakan minmax yang lebih fleksibel agar di layar sedang tidak overflow */
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 25px;
    }

    .social-public-anchor {
        text-decoration: none !important;
        color: inherit;
    }

    /* Card Styling */
    .social-public-card {
        background: #ffffff;
        border-radius: 30px;
        padding: 24px;
        border: 1.5px solid rgba(5, 44, 36, 0.08);
        display: flex;
        align-items: center;
        gap: 18px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .social-public-card:hover {
        transform: translateY(-10px) scale(1.02);
        border-color: var(--y-lemon);
        box-shadow: 0 25px 50px rgba(5, 44, 36, 0.08);
    }

    .social-icon-wrapper-public {
        width: 54px;
        height: 54px;
        background: var(--y-dark);
        color: var(--y-lemon);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        transition: 0.3s;
        z-index: 2;
        flex-shrink: 0; /* Mencegah ikon gepeng */
    }

    .social-public-card:hover .social-icon-wrapper-public {
        background: var(--y-lemon);
        color: var(--y-dark);
        transform: rotate(-10deg);
    }

    .social-text-wrapper {
        display: flex;
        flex-direction: column;
        z-index: 2;
        overflow: hidden; /* Agar teks panjang tidak merusak layout */
    }

    .social-platform-label {
        font-weight: 800;
        color: var(--y-dark);
        font-size: 1.05rem;
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .social-action-text {
        font-size: 10px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: 0.3s;
    }

    /* Decorative Glow */
    .social-hover-glow {
        position: absolute;
        width: 120px;
        height: 120px;
        background: var(--y-lemon);
        filter: blur(60px);
        opacity: 0;
        top: -30px;
        right: -30px;
        transition: 0.6s;
    }

    .social-public-card:hover .social-hover-glow {
        opacity: 0.25;
    }

    /* Responsive adjustments */
    @media (max-width: 991px) {
        .social-main-heading { font-size: 2.8rem; }
        .social-public-grid { grid-template-columns: 1fr; }
        .social-container-safe { padding: 0 15px; }
    }
</style>
