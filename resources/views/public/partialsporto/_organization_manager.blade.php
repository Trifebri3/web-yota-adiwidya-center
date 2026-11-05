<div class="yota-public-org-showcase">
    <div class="org-public-header-area">
        <h2 class="org-main-heading">Leadership <span class="text-stroke">&</span> <br> <span class="text-lemon-highlight">Social Impact.</span></h2>
        <p class="org-lead-text">Membangun peradaban berkelanjutan melalui inisiatif teknologi dan kemanusiaan.</p>
    </div>

    <div class="org-public-grid">
        @forelse($user->organizations as $org)
        <div class="org-public-card">
            <div class="org-card-top">
                <div class="org-brand-box">
                    <img src="{{ $org->logo_url }}" alt="{{ $org->organization_name }}" class="org-public-logo">
                </div>
                <div class="org-status-chip">
                    {{ $org->full_status }}
                </div>
            </div>

            <div class="org-card-body-public">
                <h4 class="org-public-name">{{ $org->organization_name }}</h4>
                <div class="org-public-position">{{ $org->position }}</div>

                @if($org->contribution_desc)
                <div class="org-public-contribution">
                    <p>{{ $org->contribution_desc }}</p>
                </div>
                @endif
            </div>

            <div class="org-card-footer-line"></div>
        </div>
        @empty
        <div class="org-public-empty">
            <p>Data kontribusi organisasi sedang dalam tahap kurasi dokumentasi.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    /* PUBLIC NGO SHOWCASE - MODERN & ELEGANT */
    .yota-public-org-showcase {
        --y-dark: #052c24;
        --y-lemon: #BEF264;
        --y-gray: #f8fafc;
        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Header Styling */
    .org-public-header-area {
        margin-bottom: 60px;
    }

    .org-main-heading {
        font-size: clamp(2.5rem, 6vw, 4rem);
        font-weight: 800;
        color: var(--y-dark);
        line-height: 1.1;
        letter-spacing: -2px;
        margin-bottom: 20px;
    }

    .text-stroke {
        color: transparent;
        -webkit-text-stroke: 1.5px var(--y-dark);
        opacity: 0.3;
    }

    .text-lemon-highlight {
        color: var(--y-lemon);
        background: var(--y-dark);
        padding: 0 15px;
        border-radius: 15px;
        display: inline-block;
    }

    .org-lead-text {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 600px;
        font-weight: 500;
    }

    /* Grid System */
    .org-public-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 30px;
    }

    /* Card Styling */
    .org-public-card {
        background: #ffffff;
        border-radius: 40px;
        padding: 40px;
        border: 1px solid rgba(5, 44, 36, 0.05);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .org-public-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(5, 44, 36, 0.06);
        border-color: var(--y-lemon);
    }

    .org-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
    }

    .org-brand-box {
        width: 80px;
        height: 80px;
        background: #fff;
        padding: 10px;
        border-radius: 24px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
    }

    .org-public-logo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px;
    }

    .org-status-chip {
        background: var(--y-gray);
        color: var(--y-dark);
        font-size: 10px;
        font-weight: 800;
        padding: 8px 16px;
        border-radius: 100px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .org-public-name {
        font-weight: 800;
        color: var(--y-dark);
        font-size: 1.5rem;
        margin-bottom: 5px;
    }

    .org-public-position {
        color: #94a3b8;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 25px;
    }

    .org-public-contribution {
        font-size: 15px;
        line-height: 1.8;
        color: #475569;
        position: relative;
        padding-left: 20px;
        border-left: 3px solid var(--y-lemon);
    }

    .org-card-footer-line {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0%;
        height: 6px;
        background: var(--y-lemon);
        transition: 0.5s;
    }

    .org-public-card:hover .org-card-footer-line {
        width: 100%;
    }

    .org-public-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px;
        color: #94a3b8;
    }

    @media (max-width: 768px) {
        .org-public-grid { grid-template-columns: 1fr; }
        .org-public-card { padding: 30px; }
        .org-main-heading { font-size: 2.5rem; }
    }
</style>
