<div class="yota-public-nf-showcase">
    <div class="nf-public-header-area">
        <h2 class="nf-main-heading">Lifelong <span class="text-lemon-highlight">Learning.</span></h2>
        <p class="nf-lead-text">Terus berkembang melalui berbagai pelatihan teknis, kursus bahasa, dan sertifikasi profesional.</p>
    </div>

    <div class="nf-public-grid">
        @forelse($user->nonFormalEducations as $non)
        <div class="nf-public-card">
            <div class="nf-card-inner">
                <div class="nf-visual-side">
                    <div class="nf-icon-box-public">
                        <i class="fas fa-award"></i>
                    </div>
                </div>

                <div class="nf-content-side">
                    <div class="nf-year-badge">{{ $non->completion_year }}</div>
                    <h4 class="nf-public-course">{{ $non->course_name }}</h4>
                    <p class="nf-public-provider">
                        <i class="fas fa-check-circle me-1 text-lemon-yota"></i> {{ $non->provider }}
                    </p>
                </div>
            </div>

            <div class="nf-corner-glow"></div>
        </div>
        @empty
        <div class="nf-public-empty">
            <p>Riwayat pelatihan sedang dalam tahap verifikasi dokumen.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    /* PUBLIC NON-FORMAL EDUCATION - CLEAN, FUN & EXPENSIVE */
    .yota-public-nf-showcase {
        --y-dark: #052c24;
        --y-lemon: #BEF264;
        --y-gray: #f8fafc;
        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Header Styling */
    .nf-public-header-area {
        margin-bottom: 50px;
    }

    .nf-main-heading {
        font-size: clamp(2.5rem, 6vw, 4rem);
        font-weight: 800;
        color: var(--y-dark);
        line-height: 1.1;
        letter-spacing: -2px;
        margin-bottom: 20px;
    }

    .text-lemon-highlight {
        color: var(--y-lemon);
        background: var(--y-dark);
        padding: 0 20px;
        border-radius: 20px;
        display: inline-block;
        transform: rotate(-1deg);
    }

    .nf-lead-text {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 600px;
        font-weight: 500;
    }

    /* Grid System */
    .nf-public-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
    }

    /* Card Styling */
    .nf-public-card {
        background: #ffffff;
        border-radius: 35px;
        padding: 30px;
        border: 1px solid rgba(5, 44, 36, 0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .nf-public-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(5, 44, 36, 0.06);
        border-color: var(--y-lemon);
    }

    .nf-card-inner {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        z-index: 2;
    }

    .nf-icon-box-public {
        width: 54px;
        height: 54px;
        background: var(--y-dark);
        color: var(--y-lemon);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
        transition: 0.3s;
    }

    .nf-public-card:hover .nf-icon-box-public {
        transform: rotate(-10deg);
        background: var(--y-lemon);
        color: var(--y-dark);
    }

    .nf-year-badge {
        font-size: 10px;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .nf-public-course {
        font-weight: 800;
        color: var(--y-dark);
        font-size: 1.1rem;
        margin-bottom: 2px;
        line-height: 1.3;
    }

    .nf-public-provider {
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
        margin: 0;
    }

    .text-lemon-yota {
        color: var(--y-lemon);
    }

    /* Decorative Glow */
    .nf-corner-glow {
        position: absolute;
        width: 100px;
        height: 100px;
        background: var(--y-lemon);
        filter: blur(40px);
        opacity: 0;
        top: -50px;
        right: -50px;
        transition: 0.5s;
    }

    .nf-public-card:hover .nf-corner-glow {
        opacity: 0.2;
    }

    .nf-public-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 40px;
        color: #94a3b8;
    }

    @media (max-width: 768px) {
        .nf-main-heading { font-size: 2.5rem; }
        .nf-public-grid { grid-template-columns: 1fr; }
    }
</style>
