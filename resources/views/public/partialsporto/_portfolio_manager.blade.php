<div class="yota-public-port-showcase">
    <div class="port-public-header-area">
<h2 class="port-main-heading">Innovation <br> <span class="text-lemon-highlight">Showcase.</span></h2>
<p class="port-lead-text">Koleksi karya dan pencapaian kreatif yang mencerminkan ide, inovasi, serta kontribusi dari berbagai bidang.</p>
</div>
    </div>

    <div class="port-public-grid">
        @forelse($user->portfolios as $p)
        <div class="port-item-card">
            <div class="port-card-visual">
                <div class="port-visual-overlay">
                    <span class="port-year-tag">{{ $p->year }}</span>
                    @if($p->external_link)
                    <a href="{{ $p->external_link }}" target="_blank" class="port-link-circle" title="View Source / Demo">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    @endif
                </div>
                <div class="port-icon-main">
                    <i class="{{ $p->type == 'iot' ? 'fas fa-robot' : ($p->type == 'web' ? 'fas fa-code' : 'fas fa-lightbulb') }}"></i>
                </div>
            </div>

            <div class="port-card-details">
                <div class="port-type-badge" style="--t-bg: {{ $p->type_styles['bg'] }}; --t-color: {{ $p->type_styles['color'] }}">
                    {{ strtoupper($p->type_styles['label']) }}
                </div>
                <h4 class="port-project-title">{{ $p->project_name }}</h4>
                <div class="port-role-pill">
                    <i class="fas fa-user-tag me-1"></i> {{ $p->my_role }}
                </div>

                @if($p->short_description)
                <p class="port-project-desc">
                    {{ $p->short_description }}
                </p>
                @endif
            </div>

            <div class="port-hover-line"></div>
        </div>
        @empty
        <div class="port-public-empty">
            <i class="fas fa-folder-open mb-3 opacity-20"></i>
            <p>Portofolio inovasi sedang dalam tahap dokumentasi sistem.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    /* PUBLIC PORTFOLIO SHOWCASE - LUXURY, PLAYFUL & BOLD */
    .yota-public-port-showcase {
        --y-dark: #052c24;
        --y-lemon: #BEF264;
        --y-soft: #f8fafc;
        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Header Styling */
    .port-public-header-area {
        margin-bottom: 60px;
    }

    .port-main-heading {
        font-size: clamp(2.5rem, 6vw, 4rem);
        font-weight: 800;
        color: var(--y-dark);
        line-height: 1.1;
        letter-spacing: -3px;
        margin-bottom: 20px;
    }

    .text-lemon-highlight {
        color: var(--y-lemon);
        background: var(--y-dark);
        padding: 0 15px;
        border-radius: 15px;
        display: inline-block;
        transform: rotate(1deg);
    }

    .port-lead-text {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 600px;
        font-weight: 500;
        line-height: 1.6;
    }

    /* Grid System */
    .port-public-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    /* Card Styling */
    .port-item-card {
        background: #ffffff;
        border-radius: 40px;
        overflow: hidden;
        border: 1px solid rgba(5, 44, 36, 0.05);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .port-item-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(5, 44, 36, 0.08);
        border-color: var(--y-lemon);
    }

    /* Visual Header Area */
    .port-card-visual {
        height: 180px;
        background: var(--y-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .port-icon-main {
        font-size: 60px;
        color: var(--y-lemon);
        opacity: 0.8;
        transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .port-item-card:hover .port-icon-main {
        transform: scale(1.3) rotate(-8deg);
        opacity: 1;
    }

    .port-visual-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        z-index: 2;
    }

    .port-year-tag {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: #fff;
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 800;
        border: 1px solid rgba(255,255,255,0.15);
    }

    .port-link-circle {
        width: 44px; height: 44px;
        background: var(--y-lemon);
        color: var(--y-dark);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform: translateY(-20px) scale(0.5);
        opacity: 0;
    }

    .port-item-card:hover .port-link-circle {
        transform: translateY(0) scale(1);
        opacity: 1;
    }

    /* Details Styling */
    .port-card-details {
        padding: 35px;
        flex-grow: 1;
    }

    .port-type-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 12px;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 1px;
        background: var(--t-bg);
        color: var(--t-color);
        margin-bottom: 20px;
    }

    .port-project-title {
        font-weight: 800;
        color: var(--y-dark);
        font-size: 1.4rem;
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .port-role-pill {
        font-size: 12px;
        font-weight: 700;
        color: #94a3b8;
        display: flex;
        align-items: center;
        margin-bottom: 18px;
    }

    .port-project-desc {
        font-size: 14px;
        line-height: 1.7;
        color: #64748b;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .port-hover-line {
        position: absolute;
        bottom: 0; left: 0; width: 0%; height: 6px;
        background: var(--y-lemon);
        transition: 0.5s;
    }

    .port-item-card:hover .port-hover-line {
        width: 100%;
    }

    .port-public-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 80px;
        background: var(--y-soft);
        border-radius: 40px;
        color: #94a3b8;
    }

    @media (max-width: 768px) {
        .port-main-heading { font-size: 2.8rem; }
        .port-public-grid { grid-template-columns: 1fr; }
        .port-item-card { border-radius: 30px; }
    }
</style>
