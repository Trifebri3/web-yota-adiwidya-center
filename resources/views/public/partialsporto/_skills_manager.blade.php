<div class="yota-public-sk-showcase">
    <div class="sk-public-header-area">
<h2 class="sk-main-heading">Technical <br> <span class="text-lemon-highlight">Expertise.</span></h2>
<p class="sk-lead-text">Keahlian lintas bidang yang mencakup ilmu pengetahuan, pendidikan, dan pengembangan umum, memberikan dasar kuat bagi kontribusi profesional di masa depan.</p>
    </div>

    <div class="sk-public-grid">
        @forelse($user->skills as $skill)
        <div class="sk-public-card">
            <div class="sk-card-inner">
                <div class="sk-top-row">
                    <div class="sk-icon-wrap" style="background: {{ $skill->color }}15; color: {{ $skill->color }}">
                        <i class="fas {{ $skill->category == 'ai_iot' ? 'fa-robot' : ($skill->category == 'hardware' ? 'fa-microchip' : 'fa-code') }}"></i>
                    </div>
                    <span class="sk-public-badge" style="border-color: {{ $skill->color }}30; color: {{ $skill->color }}">
                        {{ strtoupper($skill->category) }}
                    </span>
                </div>

                <div class="sk-mid-row">
                    <h5 class="sk-public-name">{{ $skill->name }}</h5>
                    <div class="sk-public-percent">{{ $skill->proficiency_percent }}%</div>
                </div>

                <div class="sk-public-progress-wrapper">
                    <div class="sk-public-bar-bg">
                        <div class="sk-public-bar-fill"
                             style="width: {{ $skill->proficiency_percent }}%; background: {{ $skill->color }}; box-shadow: 0 4px 12px {{ $skill->color }}40;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="sk-public-empty">
            <p>Matriks kompetensi teknis sedang diperbarui.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    /* PUBLIC SKILLS SHOWCASE - LUXURY & DYNAMIC */
    .yota-public-sk-showcase {
        --y-dark: #052c24;
        --y-lemon: #BEF264;
        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Header Styling */
    .sk-public-header-area {
        margin-bottom: 50px;
    }

    .sk-main-heading {
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

    .sk-lead-text {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 600px;
        font-weight: 500;
        line-height: 1.6;
    }

    .sk-public-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .sk-public-card {
        background: #ffffff;
        border: 1px solid rgba(5, 44, 36, 0.05);
        border-radius: 35px;
        padding: 30px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .sk-public-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(5, 44, 36, 0.06);
        border-color: var(--y-lemon);
    }

    .sk-top-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .sk-icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: 0.3s;
    }

    .sk-public-card:hover .sk-icon-wrap {
        transform: scale(1.1) rotate(-5deg);
    }

    .sk-public-badge {
        font-size: 9px;
        font-weight: 800;
        padding: 6px 12px;
        border-radius: 10px;
        border: 1.5px solid;
        letter-spacing: 1px;
    }

    .sk-mid-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 12px;
    }

    .sk-public-name {
        font-weight: 800;
        color: var(--y-dark);
        margin: 0;
        font-size: 1.2rem;
        letter-spacing: -0.5px;
    }

    .sk-public-percent {
        font-size: 13px;
        font-weight: 800;
        color: #94a3b8;
    }

    /* Progress Bar Animation */
    .sk-public-bar-bg {
        width: 100%;
        height: 8px;
        background: #f1f5f9;
        border-radius: 100px;
        overflow: hidden;
    }

    .sk-public-bar-fill {
        height: 100%;
        border-radius: 100px;
        transition: width 1.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .sk-public-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px;
        color: #94a3b8;
    }

    @media (max-width: 768px) {
        .sk-main-heading { font-size: 2.8rem; }
        .sk-public-grid { grid-template-columns: 1fr; }
    }
</style>
