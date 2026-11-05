<div class="yota-public-ach-showcase">
    <div class="ach-public-header-area">
        <h2 class="ach-main-heading">Recognized <br> <span class="text-lemon-highlight">Excellence.</span></h2>
        <p class="ach-lead-text">Apresiasi dan rekaman jejak dedikasi profesional dalam inovasi teknologi dan kontribusi sosial.</p>
    </div>

    <div class="ach-public-grid">
        @forelse($user->achievements as $ach)
        <div class="ach-public-card">
            <div class="ach-card-inner">
                <div class="ach-public-level" style="--ach-accent: {{ $ach->level_details['color'] }}">
                    <i class="fas fa-award me-2"></i>
                    {{ strtoupper($ach->level_details['label']) }}
                </div>

                <h4 class="ach-public-award-name">{{ $ach->award_name }}</h4>

                <div class="ach-public-meta">
                    <div class="ach-meta-item">
                        <i class="fas fa-university opacity-50"></i> {{ $ach->institution }}
                    </div>
                    <div class="ach-meta-item">
                        <i class="fas fa-calendar-alt opacity-50"></i> {{ $ach->attained_year }}
                    </div>
                </div>

                @if($ach->summary)
                <div class="ach-public-summary">
                    <p>{{ $ach->summary }}</p>
                </div>
                @endif
            </div>

            <div class="ach-card-decorator" style="background: {{ $ach->level_details['color'] }}"></div>
        </div>
        @empty
        <div class="ach-public-empty">
            <i class="fas fa-medal mb-3 opacity-20 fa-3x"></i>
            <p>Daftar pencapaian sedang dalam proses verifikasi sistem.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    /* PUBLIC ACHIEVEMENTS - EDITORIAL & LUXURY STYLE */
    .yota-public-ach-showcase {
        --y-dark: #052c24;
        --y-lemon: #BEF264;
        --y-border: rgba(5, 44, 36, 0.05);
        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Header Styling */
    .ach-public-header-area {
        margin-bottom: 60px;
    }

    .ach-main-heading {
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
        transform: rotate(1deg);
    }

    .ach-lead-text {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 600px;
        font-weight: 500;
        line-height: 1.6;
    }

    /* Grid Layout */
    .ach-public-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 30px;
    }

    /* Card Styling */
    .ach-public-card {
        background: #ffffff;
        border: 1px solid var(--y-border);
        border-radius: 40px;
        padding: 45px;
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
    }

    .ach-public-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 30px 60px rgba(5, 44, 36, 0.08);
        border-color: var(--y-lemon);
    }

    /* Badge & Titles */
    .ach-public-level {
        display: inline-flex;
        align-items: center;
        background: color-mix(in srgb, var(--ach-accent), transparent 90%);
        color: var(--ach-accent);
        padding: 6px 16px;
        border-radius: 100px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        margin-bottom: 25px;
        width: fit-content;
    }

    .ach-public-award-name {
        font-weight: 800;
        color: var(--y-dark);
        font-size: 1.5rem;
        line-height: 1.2;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .ach-public-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .ach-meta-item {
        font-size: 13px;
        font-weight: 700;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .ach-public-summary {
        font-size: 14px;
        line-height: 1.7;
        color: #475569;
        font-weight: 500;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
    }

    /* Interactive Decorator */
    .ach-card-decorator {
        position: absolute;
        top: 0;
        right: 0;
        width: 60px;
        height: 60px;
        clip-path: polygon(100% 0, 0 0, 100% 100%);
        opacity: 0.1;
        transition: 0.5s;
    }

    .ach-public-card:hover .ach-card-decorator {
        opacity: 0.4;
        transform: scale(1.5);
    }

    .ach-public-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 80px;
        background: #f8fafc;
        border-radius: 40px;
        color: #94a3b8;
    }

    @media (max-width: 768px) {
        .ach-main-heading { font-size: 2.8rem; }
        .ach-public-grid { grid-template-columns: 1fr; }
        .ach-public-card { padding: 30px; }
    }
</style>
