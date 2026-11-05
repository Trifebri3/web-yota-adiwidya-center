<section class="cs-cta-wrapper">
    <style>
        /* --- CSS MANDIRI (SCOPED) --- */
        .cs-cta-wrapper {
            padding: 100px 20px;
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            background: #ffffff;
        }

        .cs-cta-card {
            position: relative;
            width: 100%;
            max-width: 1100px;
            background: #0f172a; /* Slate 900 */
            border-radius: 60px;
            padding: 80px 40px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 40px 100px -20px rgba(13, 148, 136, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Dekorasi Glow Dinamis */
        .cs-cta-card::before {
            content: '';
            position: absolute;
            top: -150px;
            right: -150px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(13, 148, 136, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* Logo Branding Area */
        .cs-cta-logo-box {
            display: inline-flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
            padding: 12px 25px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
        }

        .cs-cta-icon-wrapper {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cs-cta-icon-wrapper svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 0 8px rgba(212, 255, 0, 0.4));
        }

        .cs-cta-brand-text {
            text-align: left;
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .cs-cta-brand-top {
            font-size: 11px;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .cs-cta-brand-bottom {
            font-size: 14px;
            font-weight: 900;
            color: #D4FF00; /* Lemon */
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        /* Typography */
        .cs-cta-title {
            font-size: clamp(34px, 5vw, 62px);
            font-weight: 900;
            color: #ffffff;
            line-height: 1.05;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: -2.5px;
        }

        .cs-cta-teal {
            color: #0d9488; /* Teal Premium */
            background: linear-gradient(to right, #0d9488, #2dd4bf);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cs-cta-desc {
            max-width: 600px;
            margin: 0 auto 50px;
            color: #94a3b8;
            font-size: 18px;
            line-height: 1.7;
            font-weight: 500;
        }

        /* Buttons Group */
        .cs-cta-btns {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cs-btn-main {
            background: #0d9488;
            color: white;
            padding: 20px 45px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 15px 30px rgba(13, 148, 136, 0.3);
        }

        .cs-btn-main:hover {
            background: #D4FF00;
            color: #0f172a;
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px rgba(212, 255, 0, 0.2);
        }

        .cs-btn-glass {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            padding: 20px 45px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.3s;
        }

        .cs-btn-glass:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Trust Badges */
        .cs-cta-trust {
            margin-top: 60px;
            padding-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: center;
            gap: 40px;
        }

        .cs-trust-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.4);
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .cs-trust-item i { color: #D4FF00; font-size: 12px; }

        @media (max-width: 768px) {
            .cs-cta-card { padding: 60px 25px; border-radius: 40px; }
            .cs-cta-btns { flex-direction: column; }
            .cs-cta-trust { flex-direction: column; gap: 20px; align-items: center; }
        }
    </style>

    <div class="cs-cta-card">
        {{-- Logo Header Section --}}
        <div class="cs-cta-logo-box">
            <div class="cs-cta-icon-wrapper">
                <div class="cs-cta-icon-wrapper">
    <img src="{{ asset('image/logocs.svg') }}" alt="Logo CS" style="width: 40px; height: 40px;">
</div>
            </div>
            <div class="cs-cta-brand-text">
                <span class="cs-cta-brand-top">THE COMMUNITY</span>
                <span class="cs-cta-brand-bottom">SPACE <small style="font-size: 8px; opacity: 0.5; font-weight: 500;">by YOTA</small></span>
            </div>
        </div>

        <div class="cs-cta-content">
            <h2 class="cs-cta-title">
                Saatnya Komunitasmu<br>
                <span class="cs-cta-teal">Naik Kelas Digital.</span>
            </h2>

            <p class="cs-cta-desc">
                Gabung dalam ekosistem eksklusif yang dirancang untuk mempercepat kolaborasi, inovasi teknologi, dan pertumbuhan dampak sosial secara berkelanjutan.
            </p>

            <div class="cs-cta-btns">
                <a href="https://community.siyota.org" target="_blank" class="cs-btn-main">
                    Gabung Sekarang
                    <i class="fas fa-arrow-right"></i>
                </a>
                <a href="#eksplorasi" class="cs-btn-glass">
                    Eksplorasi Ruang
                </a>
            </div>

            <div class="cs-cta-trust">
                <div class="cs-trust-item">
                    <i class="fas fa-bolt-lightning"></i> KOLABORASI EKSPRES
                </div>
                <div class="cs-trust-item">
                    <i class="fas fa-shield-check"></i> PRIVASI TERJAMIN
                </div>
                <div class="cs-trust-item">
                    <i class="fas fa-globe-asia"></i> JARINGAN NASIONAL
                </div>
            </div>
        </div>
    </div>
</section>