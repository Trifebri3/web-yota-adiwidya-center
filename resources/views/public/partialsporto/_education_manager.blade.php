<div class="yota-public-edu-showcase">
    <div class="edu-public-header-area">
        <h2 class="edu-main-heading">Academic <br> <span class="text-lemon-highlight">Foundation.</span></h2>
        <p class="edu-lead-text">Perjalanan akademik dan pengembangan intelektual sebagai fondasi keahlian teknis.</p>
    </div>

    <div class="edu-public-timeline">
        @forelse($user->educations as $edu)
        <div class="edu-public-item">
            <div class="edu-public-indicator">
                <div class="edu-public-dot"></div>
                <div class="edu-public-line"></div>
            </div>

            <div class="edu-public-card">
                <div class="edu-public-header-content">
                    <div class="edu-public-meta">
                        <span class="edu-public-period">
                            <i class="far fa-calendar-alt me-1"></i> {{ $edu->year_range }}
                        </span>
                        @if($edu->is_current)
                            <span class="edu-public-tag-current">Ongoing</span>
                        @endif
                    </div>
                    <h4 class="edu-public-inst">{{ $edu->institution }}</h4>
                </div>

                <div class="edu-public-body">
                    <div class="edu-public-degree">
                        {{ $edu->degree }} in <span class="text-dark-yota">{{ $edu->field_of_study }}</span>
                    </div>

                    @if($edu->achievements_summary)
                    <div class="edu-public-achievements">
                        <div class="ach-label-tiny">KEY NOTES & ACHIEVEMENTS</div>
                        <p class="ach-text-small">{!! nl2br(e($edu->achievements_summary)) !!}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="edu-public-empty">
            <p>Informasi latar belakang pendidikan sedang diperbarui.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    /* PUBLIC EDUCATION - LUXURY TIMELINE STYLE */
    .yota-public-edu-showcase {
        --y-dark: #052c24;
        --y-lemon: #BEF264;
        --y-gray: #f8fafc;
        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Header Styling */
    .edu-public-header-area {
        margin-bottom: 60px;
    }

    .edu-main-heading {
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
    }

    .edu-lead-text {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 600px;
        font-weight: 500;
        line-height: 1.6;
    }

    /* Timeline Structure */
    .edu-public-timeline {
        position: relative;
        padding-left: 10px;
    }

    .edu-public-item {
        display: flex;
        gap: 40px;
        margin-bottom: 50px;
        position: relative;
    }

    /* Indicator Dots */
    .edu-public-indicator {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-shrink: 0;
    }

    .edu-public-dot {
        width: 20px;
        height: 20px;
        background: #ffffff;
        border: 5px solid var(--y-dark);
        border-radius: 50%;
        z-index: 2;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .edu-public-item:hover .edu-public-dot {
        border-color: var(--y-lemon);
        transform: scale(1.3);
        box-shadow: 0 0 15px rgba(190, 242, 100, 0.5);
    }

    .edu-public-line {
        width: 2px;
        flex-grow: 1;
        background: #e2e8f0;
        margin-top: 10px;
    }

    .edu-public-item:last-child .edu-public-line {
        display: none;
    }

    /* Card Styling */
    .edu-public-card {
        background: #ffffff;
        border: 1px solid rgba(5, 44, 36, 0.05);
        padding: 40px;
        border-radius: 40px;
        flex-grow: 1;
        transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
    }

    .edu-public-item:hover .edu-public-card {
        box-shadow: 0 30px 60px rgba(5, 44, 36, 0.04);
        border-color: rgba(5, 44, 36, 0.1);
        transform: translateX(15px);
    }

    .edu-public-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .edu-public-period {
        font-size: 13px;
        font-weight: 700;
        color: #94a3b8;
        letter-spacing: 0.5px;
    }

    .edu-public-tag-current {
        background: var(--y-lemon);
        color: var(--y-dark);
        font-size: 10px;
        font-weight: 800;
        padding: 5px 12px;
        border-radius: 100px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .edu-public-inst {
        color: var(--y-dark);
        font-weight: 800;
        font-size: 1.6rem;
        margin-bottom: 5px;
        letter-spacing: -1px;
    }

    .edu-public-degree {
        font-size: 16px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 25px;
    }

    .text-dark-yota { color: var(--y-dark); font-weight: 700; }

    /* Achievements Content */
    .edu-public-achievements {
        background: var(--y-gray);
        padding: 25px;
        border-radius: 25px;
        border: 1px solid rgba(0,0,0,0.02);
        position: relative;
    }

    .ach-label-tiny {
        font-size: 9px;
        font-weight: 800;
        color: #94a3b8;
        margin-bottom: 10px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .ach-text-small {
        font-size: 14px;
        line-height: 1.7;
        color: #475569;
        margin-bottom: 0;
        font-weight: 500;
    }

    .edu-public-empty {
        text-align: center;
        padding: 60px;
        color: #94a3b8;
    }

    @media (max-width: 768px) {
        .edu-main-heading { font-size: 2.8rem; }
        .edu-public-item { gap: 20px; }
        .edu-public-card { padding: 30px; border-radius: 30px; }
        .edu-public-inst { font-size: 1.3rem; }
    }
</style>
