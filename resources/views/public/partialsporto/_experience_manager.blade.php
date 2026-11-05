<div class="yota-public-exp-showcase">
    <div class="exp-public-header-area">
        <h2 class="exp-main-heading">Professional <br> <span class="text-lemon-highlight">Journey.</span></h2>
        <p class="exp-lead-text">Membangun inovasi dan memimpin perubahan melalui dedikasi profesional di berbagai sektor.</p>
    </div>

    <div class="exp-public-list">
        @forelse($user->experiences as $exp)
        <div class="exp-public-item">
            <div class="exp-public-card">
                <div class="exp-card-header-public">
                    <div class="exp-header-left">
                        <div class="exp-icon-box-public">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="exp-title-meta">
                            <div class="exp-pos-wrapper">
                                <h4 class="exp-public-position">{{ $exp->position }}</h4>
                                @if($exp->is_active)
                                    <span class="exp-active-pill">PRESENT</span>
                                @endif
                            </div>
                            <p class="exp-public-company">
                                <i class="fas fa-building me-1 opacity-50"></i> {{ $exp->company_name }}
                            </p>
                        </div>
                    </div>
                    <div class="exp-header-right">
                        <div class="exp-duration-badge">
                            {{ $exp->duration_label }}
                        </div>
                    </div>
                </div>

                @if($exp->job_desc)
                <div class="exp-public-desc">
                    <div class="desc-line"></div>
                    <div class="desc-content">
                        {!! nl2br(e($exp->job_desc)) !!}
                    </div>
                </div>
                @endif
            </div>

            <div class="exp-floating-decorator"></div>
        </div>
        @empty
        <div class="exp-public-empty">
            <p>Rekam jejak profesional sedang dalam proses dokumentasi sistem.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    /* PUBLIC EXPERIENCE - MODERN, LUXURY & BOLD */
    .yota-public-exp-showcase {
        --y-dark: #052c24;
        --y-lemon: #BEF264;
        --y-soft-gray: #f8fafc;
        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Header Styling */
    .exp-public-header-area {
        margin-bottom: 60px;
    }

    .exp-main-heading {
        font-size: clamp(2.5rem, 6vw, 4.5rem);
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
    }

    .exp-lead-text {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 600px;
        font-weight: 500;
        line-height: 1.6;
    }

    /* List & Card Styling */
    .exp-public-list {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .exp-public-item {
        position: relative;
    }

    .exp-public-card {
        background: #ffffff;
        border-radius: 35px;
        padding: 40px;
        border: 1px solid rgba(5, 44, 36, 0.05);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        z-index: 2;
        position: relative;
    }

    .exp-public-card:hover {
        transform: translateX(15px);
        box-shadow: 0 30px 60px rgba(5, 44, 36, 0.04);
        border-color: var(--y-lemon);
    }

    .exp-card-header-public {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .exp-header-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .exp-icon-box-public {
        width: 56px;
        height: 56px;
        background: var(--y-soft-gray);
        color: var(--y-dark);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: 0.3s;
    }

    .exp-public-card:hover .exp-icon-box-public {
        background: var(--y-dark);
        color: var(--y-lemon);
        transform: rotate(-10deg);
    }

    .exp-pos-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .exp-public-position {
        font-weight: 800;
        color: var(--y-dark);
        font-size: 1.4rem;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .exp-active-pill {
        background: var(--y-lemon);
        color: var(--y-dark);
        font-size: 9px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 100px;
        letter-spacing: 1px;
    }

    .exp-public-company {
        font-size: 14px;
        color: #94a3b8;
        font-weight: 600;
        margin: 4px 0 0 0;
    }

    .exp-duration-badge {
        background: var(--y-soft-gray);
        color: var(--y-dark);
        font-size: 12px;
        font-weight: 700;
        padding: 8px 18px;
        border-radius: 12px;
    }

    /* Job Description */
    .exp-public-desc {
        display: flex;
        gap: 20px;
    }

    .desc-line {
        width: 4px;
        background: var(--y-soft-gray);
        border-radius: 10px;
        transition: 0.3s;
    }

    .exp-public-card:hover .desc-line {
        background: var(--y-lemon);
    }

    .desc-content {
        font-size: 15px;
        line-height: 1.8;
        color: #475569;
        font-weight: 500;
    }

    .exp-public-empty {
        text-align: center;
        padding: 60px;
        color: #94a3b8;
    }

    @media (max-width: 768px) {
        .exp-main-heading { font-size: 2.8rem; }
        .exp-public-card { padding: 30px; }
        .exp-card-header-public { flex-direction: column; align-items: flex-start; }
        .exp-header-right { align-self: flex-start; }
    }
</style>
