<div class="yota-public-identity-unique">
    <div class="identity-card-premium">
        <div class="decor-circle-1"></div>
        <div class="decor-circle-2"></div>

        <div class="row align-items-center position-relative" style="z-index: 2;">
            <div class="col-lg-4">
                <div class="profile-frame-container">
                    <div class="profile-ring-outer">
                        <div class="profile-ring-inner">
                            <img src="{{ $identity->avatar_url }}" alt="{{ $identity->full_name }}" class="img-fluid profile-img-luxury">
                        </div>
                    </div>
                    <div class="status-floating-pill">
                        <span class="pulse-dot"></span>
                        Expertise Verified
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="info-content-luxury">
                    <div class="badge-category-luxury">Professional Identity</div>
                    <h1 class="full-name-display">{{ $identity->full_name }}</h1>
                    <h3 class="pro-title-display text-gradient-yota">{{ $identity->professional_title }}</h3>

                    <div class="bio-container-luxury">
                        <div class="bio-quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="bio-text-luxury">
                            {{ $identity->about_me }}
                        </p>
                    </div>

                    <div class="key-labels-grid">
                        <div class="label-item">
                            <span class="label-val">100%</span>
                            <span class="label-key">Dedication</span>
                        </div>
                        <div class="label-item">
                            <span class="label-val">Tech</span>
                            <span class="label-key">Driven</span>
                        </div>
                        <div class="label-item">
                            <span class="label-val">NGO</span>
                            <span class="label-key">Founder</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* PUBLIC IDENTITY - LUXURY & PLAYFUL UI */
    .yota-public-identity-unique {
        --y-dark: #052c24;
        --y-lemon: #BEF264;
        --y-white: #ffffff;
        --y-soft: #F7F9F2;
        width: 100%;
        padding: 20px 0;
    }

    .identity-card-premium {
        background: var(--y-white);
        border-radius: 50px;
        padding: 60px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(5, 44, 36, 0.05);
        box-shadow: 0 40px 100px rgba(5, 44, 36, 0.05);
    }

    /* Floating Decoration */
    .decor-circle-1 {
        position: absolute;
        width: 300px;
        height: 300px;
        background: var(--y-lemon);
        filter: blur(80px);
        opacity: 0.15;
        top: -150px;
        right: -100px;
    }

    .decor-circle-2 {
        position: absolute;
        width: 200px;
        height: 200px;
        background: var(--y-dark);
        filter: blur(60px);
        opacity: 0.05;
        bottom: -100px;
        left: -50px;
    }

    /* Profile Frame Logic */
    .profile-frame-container {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
    }

    .profile-ring-outer {
        width: 260px;
        height: 260px;
        padding: 10px;
        background: linear-gradient(135deg, var(--y-dark), var(--y-lemon));
        border-radius: 80px; /* Playful Squircle */
        transform: rotate(-5deg);
        transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .identity-card-premium:hover .profile-ring-outer {
        transform: rotate(0deg) scale(1.05);
    }

    .profile-ring-inner {
        width: 100%;
        height: 100%;
        background: white;
        border-radius: 70px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-img-luxury {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: rotate(5deg);
        transition: 0.5s;
    }

    .identity-card-premium:hover .profile-img-luxury {
        transform: rotate(0deg);
    }

    /* Floating Pill */
    .status-floating-pill {
        position: absolute;
        bottom: 20px;
        right: 10%;
        background: var(--y-dark);
        color: var(--y-lemon);
        padding: 10px 20px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 20px rgba(5, 44, 36, 0.2);
    }

    .pulse-dot {
        width: 8px;
        height: 8px;
        background: var(--y-lemon);
        border-radius: 50%;
        animation: pulse-yota 2s infinite;
    }

    @keyframes pulse-yota {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(190, 242, 100, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(190, 242, 100, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(190, 242, 100, 0); }
    }

    /* Info Content */
    .badge-category-luxury {
        font-size: 12px;
        font-weight: 800;
        color: var(--y-dark);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
        opacity: 0.4;
    }

    .full-name-display {
        font-size: 4rem;
        font-weight: 800;
        color: var(--y-dark);
        letter-spacing: -2px;
        margin-bottom: 5px;
        line-height: 1;
    }

    .pro-title-display {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 30px;
    }

    .text-gradient-yota {
        background: linear-gradient(90deg, var(--y-dark), #4b5563);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .bio-container-luxury {
        position: relative;
        padding-left: 30px;
        margin-bottom: 40px;
    }

    .bio-quote-icon {
        position: absolute;
        left: 0;
        top: 0;
        font-size: 20px;
        color: var(--y-lemon);
        opacity: 0.8;
    }

    .bio-text-luxury {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #4b5563;
        font-weight: 500;
    }

    /* Key Labels Grid */
    .key-labels-grid {
        display: flex;
        gap: 40px;
    }

    .label-item {
        display: flex;
        flex-direction: column;
    }

    .label-val {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--y-dark);
    }

    .label-key {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        color: #9ca3af;
        letter-spacing: 1px;
    }

    @media (max-width: 991px) {
        .identity-card-premium { padding: 40px 20px; text-align: center; }
        .full-name-display { font-size: 2.5rem; }
        .bio-container-luxury { padding-left: 0; }
        .bio-quote-icon { display: none; }
        .key-labels-grid { justify-content: center; gap: 20px; }
        .profile-ring-outer { width: 200px; height: 200px; }
    }
</style>
